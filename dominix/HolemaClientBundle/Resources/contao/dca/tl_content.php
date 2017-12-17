<?php

$GLOBALS['TL_DCA']['tl_content']['fields']['people_attributes'] = array
(
	 'label'                   => &$GLOBALS['TL_LANG']['tl_module']['people_attributes'],
	 'exclude'                 => true,
	 'search'                  => true,
	 'inputType'               => 'keyValueWizard',
	 'sql'                     => "text NULL",
	 'eval'                    => array('tl_class'=>'clr')
);

//simplebox
$GLOBALS['TL_DCA']['tl_content']['palettes']['simplebox'] = '{type_legend},type;{link_legend},headline,singleSRC,url,titleText;{text_legend},html;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests;{invisible_legend:hide},invisible,start,stop';

// wrapper
$GLOBALS['TL_DCA']['tl_content']['palettes']['rowStart'] = '{type_legend},type;{template_legend:hide},customTpl;';
$GLOBALS['TL_DCA']['tl_content']['palettes']['rowStop'] = '{type_legend},type;{template_legend:hide},customTpl;';

// people box
$GLOBALS['TL_DCA']['tl_content']['palettes']['people'] = '{type_legend},type;{link_legend},headline,people_attributes;{image_legend},singleSRC;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['palettes']['ad'] = '{type_legend},type;{link_legend},headline,html;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';
