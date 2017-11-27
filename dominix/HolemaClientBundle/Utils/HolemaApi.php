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

use dominix\HolemaClientBundle\Models\HolemaStandings;
use Contao\StringUtil;
use Contao\Files;

use dominix\HolemaClientBundle\Models\HolemaRounds;
use dominix\HolemaClientBundle\Utils\HolemaRefreshStandings;
use dominix\HolemaClientBundle\Utils\HolemaRefreshGames;
use dominix\HolemaClientBundle\Utils\HolemaRefreshPlayers;

class HolemaApi
{

  const API_URL = 'https://del2.holema.eu/api/teams/';
  const API_KEY = '***REMOVED***';

  private static function call($page, $round) {
    $uri = self::API_URL . $page . "/" . $round;

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $uri,
      CURLOPT_USERAGENT => 'starting6media powered website',
      CURLOPT_HTTPHEADER => array('apikey: '.self::API_KEY)
    ));

    $response = curl_exec($curl);
		if(curl_errno($curl)>0) {
			throw new \Exception(curl_error());
		} elseif(curl_getinfo($curl,CURLINFO_HTTP_CODE)!=200) {
			throw new \Exception('Holema response http code: '.curl_getinfo($curl,CURLINFO_HTTP_CODE));
		}
		curl_close($curl);

    return $response;

  }

  public static function getStandings($round) {
    return self::call('standings.json', $round);
  }

  public static function getGames($round) {
    return self::call('games.json', $round);
  }

  public static function getRoster($round) {
    return self::call('roster.json', $round);
  }

  public static function getStats($round) {
    return self::call('stats.json', $round);
  }

	public static function updateTeam($holemaTeam, $round) {

		$t = HolemaStandings::findAll(array (
	    'limit'   => 1,
	    'column'  => array('holemaid=?','round=?'),
	    'value'   => array($holemaTeam->{'@id'}, $round)
	  ));
		if(!$t) {
			$t = new HolemaStandings();
			$t->holemaid = $holemaTeam->{'@id'};
		}

		$t->shortname = $holemaTeam->shortname;
		$t->tstamp = time();
		$t->name = $holemaTeam->name;
		$t->city = $holemaTeam->city;
		$t->round = $round;
		$t->alias = StringUtil::generateAlias($t->name);
		$t->save();

		foreach([20, 50, 100, 200] as $width) {
			$filename = TL_ROOT . HolemaStandings::getLogoFilename($t->alias, $width);
			if(!file_exists($filename)) {
				Files::getInstance()->fputs(fopen($filename, 'w+'), file_get_contents($holemaTeam->logo->{'image_'.$width}));
			}
		}

		return $t;

	}

	public static function refreshAll() {
		$r = HolemaRounds::findAll(array (
	    'column'  => array('autorefresh=?'),
	    'value'   => array(1)
	  ));

		foreach($r as $round) {
				HolemaRefreshStandings::refresh($round->holemaid);
				HolemaRefreshGames::refresh($round->holemaid);
				HolemaRefreshPlayers::refresh($round->holemaid);
		}

	}


}
