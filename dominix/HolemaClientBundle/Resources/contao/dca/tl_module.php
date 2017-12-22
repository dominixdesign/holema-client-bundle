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
$GLOBALS['TL_DCA']['tl_module']['fields']['holema_config_json'] = array
(
	 'label'                   => &$GLOBALS['TL_LANG']['tl_module']['holema_config_json'],
	 'inputType'               => 'textarea',
	 'reference'               => &$GLOBALS['TL_LANG']['holema_config_json'],
	 'eval'                    => array('style'=>'height:60px', 'preserveTags'=>true, 'rte'=>'ace|html', 'tl_class'=>'clr'),
	 'sql'                     => "text NULL"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['holema_from_date'] = array
(
	 'label'                   => &$GLOBALS['TL_LANG']['tl_module']['holema_from_date'],
	 'inputType'               => 'text',
	 'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
	 'sql'                     => "varchar(10) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['holema_to_date'] = array
(
	 'label'                   => &$GLOBALS['TL_LANG']['tl_module']['holema_to_date'],
	 'inputType'               => 'text',
	 'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
	 'sql'                     => "varchar(10) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['palettes']['standings'] = '{title_legend},name,headline,type;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['standings'].= '{holema_legend},holema_round,holema_table_rows,holema_my_team,holema_standings_columns;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['standings'].= '{template_legend:hide},customTpl;{expert_legend:hide},cssID,space';

$GLOBALS['TL_DCA']['tl_module']['palettes']['scorerlist'] = '{title_legend},name,headline,type;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['scorerlist'].= '{holema_legend},holema_round,holema_table_rows,holema_scorer_columns;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['scorerlist'].= '{template_legend:hide},customTpl;{expert_legend:hide},cssID,space';

$GLOBALS['TL_DCA']['tl_module']['palettes']['roster'] = '{title_legend},name,headline,type;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['roster'].= '{holema_legend},holema_round,holema_my_team,holema_config_json;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['roster'].= '{template_legend:hide},customTpl;{expert_legend:hide},cssID,space';

$GLOBALS['TL_DCA']['tl_module']['palettes']['player'] = '{title_legend},name,headline,type;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['player'].= '{template_legend:hide},customTpl;{expert_legend:hide},cssID,space';

$GLOBALS['TL_DCA']['tl_module']['palettes']['nextgame'] = '{title_legend},name,headline,type;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['nextgame'].= '{holema_legend},holema_round,holema_my_team;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['nextgame'].= '{template_legend:hide},customTpl;{expert_legend:hide},cssID,space';

$GLOBALS['TL_DCA']['tl_module']['palettes']['lastgames'] = '{title_legend},name,headline,type;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['lastgames'].= '{holema_legend},holema_round,holema_my_team,holema_table_rows;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['lastgames'].= '{template_legend:hide},customTpl;{expert_legend:hide},cssID,space';

$GLOBALS['TL_DCA']['tl_module']['palettes']['schedule'] = '{title_legend},name,headline,type;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['schedule'].= '{holema_legend},holema_from_date,holema_to_date,holema_my_team;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['schedule'].= '{template_legend:hide},customTpl;{expert_legend:hide},cssID,space';
