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
use dominix\HolemaClientBundle\Models\HolemaGames;
use dominix\HolemaClientBundle\Models\HolemaStandings;

class HolemaRefreshGames
{

  const TABLE = 'tl_holema_client_standings';

  public static function refresh($round) {
		if(!$round) {return "round missing!";}

    $data = json_decode(HolemaApi::getGames($round));

		foreach($data->schedule->games->game as $game) {
			$date = date_parse_from_format("d.m.Y", $game->gamedate);
			$time = explode(':',$game->gametime);
			$g = HolemaGames::findById($game->{'@id'});
			if(!$g) {
				$g = new HolemaGames();
				$g->id = $game->{'@id'};
				HolemaApi::updateTeam($game->hometeam, $data->schedule->round->{'@id'});
				HolemaApi::updateTeam($game->awayteam, $data->schedule->round->{'@id'});
			}
			$g->hometeam = $game->hometeam->{'@id'};
			$g->awayteam = $game->awayteam->{'@id'};
			$g->gamedate = mktime($time[0],$time[1],0,$date['month'],$date['day'],$date['year']);
			$g->gametime = $game->gametime;
			$g->round = $data->schedule->round->{'@id'};
      $g->location = $game->location;
			$g->spectators = $game->spectators;
			$g->periodscore = $game->periodscore;
			$g->gamestatus = $game->gamestatus;
			$g->homescore = $game->homescore;
			$g->awayscore = $game->awayscore;
			$g->ended = ($game->ended) ? 1 : 0;
			$g->tstamp = time();
			$g->save();
		}

  }

}
