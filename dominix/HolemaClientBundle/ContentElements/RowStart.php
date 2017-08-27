<?php
namespace dominix\HolemaClientBundle\ContentElements;

class RowStart extends \ContentElement {
    protected $strTemplate = 'ce_row_start';

    protected function compile()
  	{
  		if (TL_MODE == 'BE')
  		{
  			$this->strTemplate = 'be_wildcard';
  			$this->Template = new \BackendTemplate($this->strTemplate);
  		}
  	}
}
