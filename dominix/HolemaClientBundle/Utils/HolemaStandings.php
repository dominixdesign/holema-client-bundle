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

class HolemaStandings
{

  public static function refresh() {

    $data = json_decode(HolemaApi::getStandings());

    var_dump($data);

  }


}
