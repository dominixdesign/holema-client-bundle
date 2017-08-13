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

class HolemaStandings
{

  const TABLE = 'tl_holema_client_standings';

  public static function refresh() {

    $data = json_decode(HolemaApi::getStandings());

    $objDatabase = Database::getInstance();

    foreach($data->teamstats->teams->team as $team) {
      $res = $objDatabase->prepare("SELECT id FROM ".self::TABLE." WHERE id = ? AND round = ?")->execute($team->{'@id'}, $data->teamstats->round->{'@id'});

      if($res->count() == 1) {
        // already existing id, make update
        $objDatabase->prepare("UPDATE ".self::TABLE." SET
          name = ?,
          shortname = ?,
          city = ?,
          games = ?,
          rw = ?,
          ow = ?,
          pw = ?,
          pl = ?,
          ol = ?,
          rl = ?,
          points = ?,
          goalsfor = ?,
          goalsagainst = ?,
          penalties = ?,
          tstamp = UNIX_TIMESTAMP()
          WHERE id = ? AND round = ?")->execute(
            $team->name,
            $team->shortname,
            $team->city,
            $team->games,
            $team->rw,
            $team->ow,
            $team->pw,
            $team->pl,
            $team->ol,
            $team->rl,
            $team->points,
            $team->goalsfor,
            $team->goalsagainst,
            $team->penalties,

            $team->{'@id'}, $data->teamstats->round->{'@id'});
      } else {
        $objDatabase->prepare("INSERT INTO ".self::TABLE."
        (id, round, name, shortname, city, games, rw, ow, pw, pl, ol, rl, points, goalsfor, goalsagainst, penalties, tstamp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, UNIX_TIMESTAMP()) ")
        ->execute(
          $team->{'@id'},
          $data->teamstats->round->{'@id'},
          $team->name,
          $team->shortname,
          $team->city,
          $team->games,
          $team->rw,
          $team->ow,
          $team->pw,
          $team->pl,
          $team->ol,
          $team->rl,
          $team->points,
          $team->goalsfor,
          $team->goalsagainst,
          $team->penalties);
      }
    }

  }


}
