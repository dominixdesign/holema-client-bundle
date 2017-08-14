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
			$ret = array();
			$ret[-1] = "";
			foreach(HolemaStandings::findByRound($dc->activeRecord->holema_round) as $team) {
				$ret[$team->id] = $team->name;
			}

			return $ret;

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
