<?php

/*
 * This file is part of the HolemaClientBundle.
 *
 * (c) Dominik Sander <http://dominix-design.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dominix\HolemaClientBundle\Utils;

use Contao\Database;
use dominix\HolemaClientBundle\Models\HolemaPlayers;
use Contao\StringUtil;
use Contao\Files;

class HolemaRefreshPlayers
{

  public static function refresh($round) {
		if(!$round) {return "round missing!";}

    $rosterData = json_decode(HolemaApi::getRoster($round));
		$statsData = json_decode(HolemaApi::getStats($round));

		if($rosterData->teamroster->players == "") {
			return null;
		}

		foreach($rosterData->teamroster->players->player as $player) {

			$p = HolemaPlayers::findAll(array (
		    'limit'   => 1,
		    'column'  => array('holemaid=?','round=?'),
		    'value'   => array($player->{'@id'}, $round)
		  ));
			if(!$p) {
				$p = new HolemaPlayers();
				$p->holemaid = $player->{'@id'};
			}
			$birthday = date_parse_from_format("d.m.Y", $player->birthday);
			$p->eliteprospectsid = $player->{'@eliteprospectsid'};
			$p->firstname = $player->firstname;
			$p->lastname = $player->lastname;
			$p->round = $round;
			$p->jersey = $player->jersey;
			$p->position = $player->position;
			$p->nationality = $player->nationality;
			$p->shoots = $player->shoots;
			$p->birthday = mktime(0,0,0,$birthday['month'],$birthday['day'],$birthday['year']);
			$p->birthplace = $player->birthplace;
			$p->height = $player->height;
			$p->weight = $player->weight;

			if($statsData->playerstats->players != '') {
				foreach($statsData->playerstats->players->player as $stat) {
					if($player->{'@id'} == $stat->{'@id'}) break;
				}
				$p->games = $stat->games;
				$p->goals = $stat->goals;
				$p->assists = $stat->assists;
				$p->points = $stat->points;
				$p->penalties = $stat->penalties;
				$p->plusminus = $stat->plusminus;
				$p->faceoffswon = $stat->faceoffswon;
				$p->faceoffslost = $stat->faceoffslost;
				$p->shots = $stat->shots;
			}

			$p->alias = StringUtil::generateAlias($p->firstname." ".$p->lastname);

			foreach([50, 100, 200] as $width) {
				if(strstr($player->image->{'image_'.$width}, 'noimage')) continue;
				$filename = TL_ROOT . '/files/holema_player_pictures/' . $p->alias . "_" . $width . ".png";
				if(!file_exists($filename)) {
					Files::getInstance()->fputs(fopen($filename, 'w+'), file_get_contents($player->image->{'image_'.$width}));
				}
			}

			if($p->eliteprospectsid) {
				$rss = new \SimpleXMLElement('http://eliteprospects.com/rss_player_stats2.php?player='.$p->eliteprospectsid, null, true);
				foreach($rss->xpath('channel/item') as $item)
				{
				  $p->epstats = utf8_decode($item->description);
					break;
				}
			}

			$p->tstamp = time();
			$p->save();

			/*
			<games>52</games>
			<goals>23</goals>
			<assists>27</assists>
			<points>50</points>
			<penalties>66</penalties>
			<plusminus>+12</plusminus>
			<faceoffswon>568</faceoffswon>
			<faceoffslost>487</faceoffslost>
			<shots>190</shots>
			*/
		}

  }

}
