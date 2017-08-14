<?php

/*
 * This file is part of the HolemaClientBundle.
 *
 * (c) Dominik Sander <http://dominix-design.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* Backend Module */
$GLOBALS['BE_MOD']['holema'] = array(
	'holema_rounds' => array(
		'tables' => array('tl_holema_client_rounds')
	),
	'holema_teams' => array(
    'tables' => array('tl_holema_client_standings')
	),
	'holema_refresh' => array(
		'callback' => 'dominix\\HolemaClientBundle\\Modules\\ModuleRefresh'
	)

);

/* Model Classes */
$GLOBALS['TL_MODELS']['tl_holema_client_rounds'] = '\dominix\HolemaClientBundle\Models\HolemaRounds';
$GLOBALS['TL_MODELS']['tl_holema_client_standings'] = '\dominix\HolemaClientBundle\Models\HolemaStandings';

/* Frontend Modules */
$GLOBALS['FE_MOD']['holema']['standings'] = '\dominix\HolemaClientBundle\Modules\StandingsModule';
