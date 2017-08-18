<?php

/*
 * This file is part of the HolemaClientBundle.
 *
 * (c) Dominik Sander <http://dominix-design.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$GLOBALS['TL_DCA']['tl_holema_client_players'] = array
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
								'holemaid,round' => 'unique'
            )
        )
    ),
    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 11,
            'fields'                  => array('round'),
            'panelLayout'             => 'filter;search,limit'
        ),
        'label' => array
        (
            'fields'                  => array('round', 'lastname','firstname'),
            'showColumns'             => true,
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
                'label'               => &$GLOBALS['TL_LANG']['tl_holema_client_players']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ),
            'copy'   => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_holema_client_players']['copy'],
                'href'                => 'act=paste&amp;mode=copy',
                'icon'                => 'copy.gif',
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_holema_client_players']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_holema_client_players']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),
    // Palettes
    'palettes' => array
    (
        'default' => '{style_legend},styleDesignation;{css_legend},cssClasses;{permissions_legend},disableInArticle,disableInContent,disableInCalendarEvent,disableInForm,disableInFormField,disableInLayout,disableInModule,disableInNews,disableInPage'
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
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_players']['round'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'text',
						'options_callback'				=> array('dominix\\HolemaClientBundle\\Models\\HolemaRounds', 'findForSelect'),
            'eval'                    => array('mandatory' => true, 'rgxp'=>'numeric', 'tl_class' => 'w50'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'holemaid' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_players']['holemaid'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory' => true, 'tl_class' => 'w50'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'eliteprospectsid' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['eliteprospectsid'],
            'exclude'                 => true,
            'inputType'               => 'number',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>5, 'rgxp'=>'numeric', 'tl_class'=>'w50'),
            'sql'                     => "int(10) NOT NULL default '0'"
        ),
        'alias' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_players']['alias'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength' => 255, 'tl_class' => 'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'firstname' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_players']['firstname'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'lastname' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_players']['lastname'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'position' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['position'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>5, 'rgxp'=>'alphanumeric', 'tl_class'=>'w50'),
            'sql'                     => "varchar(5) NOT NULL default ''"
        ),
        'nationality' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['nationality'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'rgxp'=>'alphanumeric', 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'jersey' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['jersey'],
            'exclude'                 => true,
            'inputType'               => 'number',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>5, 'rgxp'=>'numeric', 'tl_class'=>'w50'),
            'sql'                     => "int(5) NOT NULL default '0'"
        ),
        'shoots' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['shoots'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>5, 'rgxp'=>'alphanumeric', 'tl_class'=>'w50'),
            'sql'                     => "varchar(5) NOT NULL default ''"
        ),
        'birthplace' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['position'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'rgxp'=>'alphanumeric', 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'birthday' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['birthday'],
            'exclude'                 => true,
            'inputType'               => 'number',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>5, 'rgxp'=>'numeric', 'tl_class'=>'w50'),
            'sql'                     => "int(25) NOT NULL default '0'"
        ),
        'height' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['height'],
            'exclude'                 => true,
            'inputType'               => 'number',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>5, 'rgxp'=>'numeric', 'tl_class'=>'w50'),
            'sql'                     => "int(5) NOT NULL default '0'"
        ),
        'weight' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['weight'],
            'exclude'                 => true,
            'inputType'               => 'number',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>5, 'rgxp'=>'numeric', 'tl_class'=>'w50'),
            'sql'                     => "int(5) NOT NULL default '0'"
        ),
        'games' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['games'],
            'exclude'                 => true,
            'inputType'               => 'number',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>5, 'rgxp'=>'numeric', 'tl_class'=>'w50'),
            'sql'                     => "int(5) NOT NULL default '0'"
        ),
        'goals' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['goals'],
            'exclude'                 => true,
            'inputType'               => 'number',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>5, 'rgxp'=>'numeric', 'tl_class'=>'w50'),
            'sql'                     => "int(5) NOT NULL default '0'"
        ),
        'assists' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['assists'],
            'exclude'                 => true,
            'inputType'               => 'number',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>5, 'rgxp'=>'numeric', 'tl_class'=>'w50'),
            'sql'                     => "int(5) NOT NULL default '0'"
        ),
        'points' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['points'],
            'exclude'                 => true,
            'inputType'               => 'number',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>5, 'rgxp'=>'numeric', 'tl_class'=>'w50'),
            'sql'                     => "int(5) NOT NULL default '0'"
        ),
        'penalties' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['penalties'],
            'exclude'                 => true,
            'inputType'               => 'number',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>5, 'rgxp'=>'numeric', 'tl_class'=>'w50'),
            'sql'                     => "int(5) NOT NULL default '0'"
        ),
        'plusminus' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['plusminus'],
            'exclude'                 => true,
            'inputType'               => 'number',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>5, 'rgxp'=>'numeric', 'tl_class'=>'w50'),
            'sql'                     => "int(5) NOT NULL default '0'"
        ),
        'faceoffswon' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['faceoffswon'],
            'exclude'                 => true,
            'inputType'               => 'number',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>5, 'rgxp'=>'numeric', 'tl_class'=>'w50'),
            'sql'                     => "int(5) NOT NULL default '0'"
        ),
        'faceoffslost' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['faceoffslost'],
            'exclude'                 => true,
            'inputType'               => 'number',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>5, 'rgxp'=>'numeric', 'tl_class'=>'w50'),
            'sql'                     => "int(5) NOT NULL default '0'"
        ),
        'shots' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['shots'],
            'exclude'                 => true,
            'inputType'               => 'number',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>5, 'rgxp'=>'numeric', 'tl_class'=>'w50'),
            'sql'                     => "int(5) NOT NULL default '0'"
        ),
        'epstats' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_holema_client_standings']['epstats'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>5, 'rgxp'=>'numeric', 'tl_class'=>'w50'),
            'sql'                     => "blob Null"
        )
    )
);
