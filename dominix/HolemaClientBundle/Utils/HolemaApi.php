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


}
