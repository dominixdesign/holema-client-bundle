<?php

/*
 * This file is part of the HolemaClientBundle.
 *
 * (c) Dominik Sander <http://dominix-design.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$GLOBALS['BE_MOD']['holema'] = array(
	'holema_rounds' => array(
		'tables' => array('tl_holema_client_rounds')
	),
	'holema_teams' => array(
    'tables' => array('tl_holema_client_standings'),
    'refreshTeams' => array('dominix\\HolemaClientBundle\\Modules\\Standings','manualRefreshTeams')
	)
);

array_insert($GLOBALS['TL_DCA']['tl_settings'],0,array(
'fields' => array('name' => array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['team_name'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'text',
    'eval'                    => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
    'sql'                     => "varchar(255) NOT NULL default ''"
))
));
