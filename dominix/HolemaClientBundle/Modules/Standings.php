<?php

/*
 * This file is part of the HolemaClientBundle.
 *
 * (c) Dominik Sander <http://dominix-design.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dominix\HolemaClientBundle\Modules;

use Contao\Database;
use Contao\Backend;
use dominix\HolemaClientBundle\Utils\HolemaStandings;

class Standings extends Backend
{
  public function manualRefreshTeams() {
    if( $this->Input->get('key') === 'refreshTeams' ) {
      return HolemaStandings::refresh();
    }
  }

}
