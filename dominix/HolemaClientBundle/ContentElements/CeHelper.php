<?php

namespace dominix\HolemaClientBundle\ContentElements;

class CeHelper {

  public function myGetAttributesFromDca($arrAttributes, $objDca) {
      if($objDca->activeRecord->type=='simplebox' && $arrAttributes['id'] == 'singleSRC') {
        $arrAttributes['mandatory'] = false;
      }
      if($objDca->activeRecord->type=='simplebox' && $arrAttributes['id'] == 'url') {
        $arrAttributes['mandatory'] = false;
      }
      if($objDca->activeRecord->type=='simplebox' && $arrAttributes['id'] == 'html') {
        $arrAttributes['mandatory'] = false;
      }
      return $arrAttributes;
  }

}
