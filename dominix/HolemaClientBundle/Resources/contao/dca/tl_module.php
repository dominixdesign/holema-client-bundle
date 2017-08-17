<?php


$GLOBALS['TL_DCA']['tl_module']['fields']['holema_round'] = array
(
	 'label'                   => &$GLOBALS['TL_LANG']['tl_module']['holema_round'],
	 'exclude'                 => true,
	 'search'                  => true,
	 'inputType'               => 'select',
	 'options_callback'        => array('dominix\\HolemaClientBundle\\Models\\HolemaRounds', 'findForSelect'),
	 'eval'										 => array('onchange' => 'Backend.autoSubmit(\'tl_module\')'),
	 'sql'                     => "varchar(64) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['holema_table_rows'] = array
(
	 'label'                   => &$GLOBALS['TL_LANG']['tl_module']['holema_table_rows'],
	 'exclude'                 => true,
	 'inputType'               => 'text',
	 'eval'                    => array('mandatory'=>false, 'rgxp'=>'numeric', 'tl_class'=>'w50'),
	 'sql'                     => "int(3) NULL"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['holema_my_team'] = array
(
	 'label'                   => &$GLOBALS['TL_LANG']['tl_module']['holema_my_team'],
	 'exclude'                 => true,
	 'inputType'               => 'select',
	 'options_callback'        => array('dominix\\HolemaClientBundle\\Models\\HolemaStandings', 'findTeamsForSelect'),
	 'eval'                    => array('tl_class'=>'w50'),
	 'sql'                     => "int(5) NULL"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['holema_standings_columns'] = array
(
	 'label'                   => &$GLOBALS['TL_LANG']['tl_module']['holema_standings_columns'],
	 'inputType'               => 'checkboxWizard',
	 'options_callback'        => array('dominix\\HolemaClientBundle\\Models\\HolemaStandings', 'findColumnsForSelect'),
	 'reference'               => &$GLOBALS['TL_LANG']['holema_standings_columns'],
	 'eval'                    => array('multiple' => true, 'tl_class'=>'clr'),
	 'sql'                     => "blob NULL"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['holema_scorer_columns'] = array
(
	 'label'                   => &$GLOBALS['TL_LANG']['tl_module']['holema_scorer_columns'],
	 'inputType'               => 'checkboxWizard',
	 'options_callback'        => array('dominix\\HolemaClientBundle\\Models\\HolemaPlayers', 'findColumnsForSelect'),
	 'reference'               => &$GLOBALS['TL_LANG']['holema_scorer_columns'],
	 'eval'                    => array('multiple' => true, 'tl_class'=>'clr'),
	 'sql'                     => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_module']['palettes']['standings'] = '{title_legend},name,headline,type;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['standings'].= '{holema_legend},holema_round,holema_table_rows,holema_my_team,holema_standings_columns;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['standings'].= '{template_legend:hide},customTpl;{expert_legend:hide},cssID,space';

$GLOBALS['TL_DCA']['tl_module']['palettes']['scorerlist'] = '{title_legend},name,headline,type;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['scorerlist'].= '{holema_legend},holema_round,holema_table_rows,holema_scorer_columns;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['scorerlist'].= '{template_legend:hide},customTpl;{expert_legend:hide},cssID,space';
