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
use dominix\HolemaClientBundle\Models\HolemaStandings;

class HolemaRefreshStandings
{

  const TABLE = 'tl_holema_client_standings';

  public static function refresh($round) {
		if(!$round) {return "round missing!";}

    $data = json_decode(HolemaApi::getStandings($round));

    $objDatabase = Database::getInstance();

    foreach($data->teamstats->teams->team as $team) {

			$t = HolemaStandings::findAll(array (
		    'limit'   => 1,
		    'column'  => array('holemaid=?','round=?'),
		    'value'   => array($team->{'@id'}, $data->teamstats->round->{'@id'})
		  ));

			if(!$t) {
				$t = HolemaApi::updateTeam($team, $data->teamstats->round->{'@id'}, true);
			}

			$t->name = $team->name;
			$t->round = $data->teamstats->round->{'@id'};
			$t->shortname = $team->shortname;
			$t->city = $team->city;
			$t->games = $team->games;
			$t->rw = $team->rw;
			$t->ow = $team->ow;
			$t->pw = $team->pw;
			$t->pl = $team->pl;
			$t->ol = $team->ol;
			$t->rl = $team->rl;
			$t->points = $team->points;
			$t->goalsfor = $team->goalsfor;
			$t->goalsagainst = $team->goalsagainst;
			$t->penalties = $team->penalties;
			$t->save();

    }

  }


}
