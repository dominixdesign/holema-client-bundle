<?php

/*
 * This file is part of the HolemaClientBundle.
 *
 * (c) Dominik Sander <http://dominix-design.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dominix\HolemaClientBundle\Models;

use Contao\Database;
use Contao\Model;

class HolemaStandings extends Model
{

    /**
     * Name of the table
     * @var string
     */
    protected static $strTable = 'tl_holema_client_standings';

		public function findTeamsForSelect($dc) {
			$round = ($dc->activeRecord->holema_round) ? $dc->activeRecord->holema_round : $dc->activeRecord->round;
			$ret = array();
			$ret[-1] = "";
			if(HolemaStandings::findByRound($round)) {
				foreach(HolemaStandings::findByRound($round) as $team) {
					$ret[$team->id] = $team->name;
				}
			}

			return $ret;

		}

		public function findTeamsForDisplay($row, $label, $dc, $args) {
			$teamNames = self::findMultipleByIds(array($args[1],$args[2]))->fetchAll();
			$args[0] = date('d.m.Y',$args[0]);
			$args[1] = $teamNames[0]['name'];
			$args[2] = $teamNames[1]['name'];
			return $args;
		}

		public function findColumnsForSelect() {
			$ret = array();
    	$objDatabase = Database::getInstance();
			$res = $objDatabase->prepare("SHOW COLUMNS FROM ".self::$strTable)->execute()->fetchAllAssoc();
			foreach($res as $column) {
				$ret[$column['Field']] = $column['Field'];
			}
			return $ret;
		}
}
