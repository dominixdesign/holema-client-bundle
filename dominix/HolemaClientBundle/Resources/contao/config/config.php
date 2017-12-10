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
	'holema_games' => array(
    'tables' => array('tl_holema_client_games')
	),
	'holema_players' => array(
    'tables' => array('tl_holema_client_players')
	),
	'holema_refresh' => array(
		'callback' => 'dominix\\HolemaClientBundle\\Modules\\ModuleRefresh'
	)
);

/* Model Classes */
$GLOBALS['TL_MODELS']['tl_holema_client_rounds'] = '\dominix\HolemaClientBundle\Models\HolemaRounds';
$GLOBALS['TL_MODELS']['tl_holema_client_standings'] = '\dominix\HolemaClientBundle\Models\HolemaStandings';
$GLOBALS['TL_MODELS']['tl_holema_client_games'] = '\dominix\HolemaClientBundle\Models\HolemaGames';
$GLOBALS['TL_MODELS']['tl_holema_client_players'] = '\dominix\HolemaClientBundle\Models\HolemaPlayers';

/* Frontend Modules */
$GLOBALS['FE_MOD']['holema']['standings'] = '\dominix\HolemaClientBundle\Modules\StandingsModule';
$GLOBALS['FE_MOD']['holema']['nextgame'] = '\dominix\HolemaClientBundle\Modules\NextGameModule';
$GLOBALS['FE_MOD']['holema']['scorerlist'] = '\dominix\HolemaClientBundle\Modules\ScorerlistModule';
$GLOBALS['FE_MOD']['holema']['roster'] = '\dominix\HolemaClientBundle\Modules\RosterModule';
$GLOBALS['FE_MOD']['holema']['lastgames'] = '\dominix\HolemaClientBundle\Modules\LastGamesModule';
$GLOBALS['FE_MOD']['holema']['schedule'] = '\dominix\HolemaClientBundle\Modules\ScheduleModule';

/* Content Elements */
$GLOBALS['TL_CTE']['media']['simplebox'] = '\dominix\HolemaClientBundle\ContentElements\SimpleBox';
$GLOBALS['TL_CTE']['texts']['people'] = '\dominix\HolemaClientBundle\ContentElements\People';
$GLOBALS['TL_CTE']['texts']['ad'] = '\dominix\HolemaClientBundle\ContentElements\ContentAd';
$GLOBALS['TL_HOOKS']['getAttributesFromDca'][] = array('\dominix\HolemaClientBundle\ContentElements\CeHelper', 'myGetAttributesFromDca');
$GLOBALS['TL_CTE']['grid']['rowStart'] = '\dominix\HolemaClientBundle\ContentElements\RowStart';
$GLOBALS['TL_CTE']['grid']['rowStop'] = '\dominix\HolemaClientBundle\ContentElements\RowStop';

/* Wrapper */
$GLOBALS['TL_WRAPPERS']['start'][] = 'rowStart';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'rowStop';

/* Cronjob */
$GLOBALS['TL_CRON']['hourly'][] = array('\dominix\HolemaClientBundle\Utils\HolemaApi','refreshAll');
