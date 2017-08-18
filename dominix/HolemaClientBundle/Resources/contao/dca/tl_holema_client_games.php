<?php

/*
 * This file is part of the HolemaClientBundle.
 *
 * (c) Dominik Sander <http://dominix-design.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$GLOBALS['TL_DCA']['tl_holema_client_games'] = array
(
    // Config
    'config'   => array
    (
        'dataContainer' => 'Table',
        'enableVersioning' => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
								'hometeam' => 'index',
								'awayteam' => 'index'
            )
        )
    ),
    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 11,
            'fields'                  => array('gamedate'),
            'panelLayout'             => 'filter;search,limit'
        ),
        'label' => array
        (
            'fields'                  => array('gamedate', 'hometeam', 'awayteam', 'round'),
            'showColumns'             => true,
						'label_callback'					=> array('dominix\\HolemaClientBundle\\Models\\HolemaStandings', 'findTeamsForDisplay')
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_holema_client_games']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ),
            'copy'   => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_holema_client_games']['copy'],
                'href'                => 'act=paste&amp;mode=copy',
                'icon'                => 'copy.gif',
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_holema_client_games']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_holema_client_games']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),
    // Palettes
    'palettes' => array
    (
        'default' => 'round,hometeam,awayteam,gameday,gamedate,gametime,spectators,periodscore,homescore,awayscore,resulttype,gamestatus,ended'
    ),
    // Fields
    'fields'   => array
    (
        'id' => array
        (
					'sql'                     => "int(10) unsigned NOT NULL AUTO_INCREMENT"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'round' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_games']['round'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'select',
						'options_callback'				=> array('dominix\\HolemaClientBundle\\Models\\HolemaRounds', 'findForSelect'),
            'eval'                    => array('mandatory' => true, 'tl_class' => 'clr w50', 'onchange' => 'Backend.autoSubmit(\'tl_holema_client_games\')'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'hometeam' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_games']['hometeam'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'select',
						'options_callback'			  => array('dominix\\HolemaClientBundle\\Models\\HolemaStandings', 'findTeamsForSelect'),
            'eval'                    => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'clr w50'),
            'sql'                     => "int(10)"
        ),
        'awayteam' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_games']['awayteam'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'select',
						'options_callback'			  => array('dominix\\HolemaClientBundle\\Models\\HolemaStandings', 'findTeamsForSelect'),
            'eval'                    => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'                     => "int(10)"
        ),
        'gameday' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_games']['gameday'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp' => 'numeric', 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'                     => "int(25)"
        ),
        'gamedate' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_games']['gamedate'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('datepicker' => true, rgxp => 'date', 'mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'                     => "int(10) unsigned NOT NULL"
        ),
        'gametime' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_games']['gametime'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'                     => "varchar(25) NOT NULL default ''"
        ),
        'location' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_games']['location'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'spectators' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_games']['spectators'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'number',
            'eval'                    => array('rgxp' => 'numeric', 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'                     => "int(25)"
        ),
        'periodscore' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_games']['periodscore'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory' => false, 'maxlength' => 50, 'tl_class' => 'w50'),
            'sql'                     => "varchar(50)"
        ),
        'homescore' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_games']['homescore'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp' => 'numeric', 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'                     => "int(25)"
        ),
        'awayscore' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_games']['awayscore'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp' => 'numeric', 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'                     => "int(25)"
        ),
        'resulttype' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_games']['resulttype'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'select',
						'options'									=> array('' => 'regulär','OT' => 'Overtime','SO' => 'Shootout','OR' => 'Spielwertung'),
            'eval'                    => array('rgxp' => 'alpha', 'mandatory' => false, 'maxlength' => 5, 'tl_class' => 'w50'),
            'sql'                     => "varchar(5)"
        ),
        'gamestatus' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_games']['gamestatus'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength' => 255, 'tl_class' => 'w50'),
            'sql'                     => "varchar(50)"
        ),
        'ended' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_games']['ended'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class' => 'w50'),
            'sql'                     => "int(1) NOT NULL default '0'"
        )
    )
);
