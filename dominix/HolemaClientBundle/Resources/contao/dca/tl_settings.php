<?php

if (isset($GLOBALS['TL_DCA']['tl_settings'])) {
    // Palettes
    foreach ($GLOBALS['TL_DCA']['tl_settings']['palettes'] as $k => $v) {
        $GLOBALS['TL_DCA']['tl_settings']['palettes'][$k] .= ';{holema_legend:hide},holemaId';
    }
    // Fields
    $GLOBALS['TL_DCA']['tl_settings']['fields']['holemaId'] = array
    (
        'label'            => &$GLOBALS['TL_LANG']['MSC']['holemaId'],
        'inputType'        => 'text',
        'eval'             => array('tl_class' => 'clr'),
        'sql'              => "int(5) NULL"
    );
}
