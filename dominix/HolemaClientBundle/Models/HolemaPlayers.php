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

class HolemaPlayers extends Model
{

    /**
     * Name of the table
     * @var string
     */
    protected static $strTable = 'tl_holema_client_players';

}
