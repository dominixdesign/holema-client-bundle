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
					$ret[$team->holemaid] = $team->name;
				}
			}

			return $ret;

		}

		public function findTeamsForDisplay($row, $label, $dc, $args) {
			$args[0] = date('d.m.Y',$args[0]);
			$args[1] = self::getTeamData($args[1],$args[3]);
			$args[2] = self::getTeamData($args[2],$args[3]);
			return $args;
		}

    public static function getTeamData($holemaId, $round, $data='name') {
      $team = self::findAll(array (
  	    'limit'   => 1,
  	    'column'  => array('holemaid=?','round=?'),
  	    'value'   => array($holemaId, $round)
  	  ));
      if($team) {
        $team = $team->fetchAll();
        return $team[0][$data];
      } else {
        return '## unknown team ('.$holemaId.', '.$round.') ##';
      }
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
