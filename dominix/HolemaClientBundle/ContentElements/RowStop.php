<?php
namespace dominix\HolemaClientBundle\ContentElements;

class RowStop extends \ContentElement {
    protected $strTemplate = 'ce_row_stop';

    /**
  	 * Generate the content element
  	 */
  	protected function compile()
  	{
  		if (TL_MODE == 'BE')
  		{
  			$this->strTemplate = 'be_wildcard';
  			$this->Template = new \BackendTemplate($this->strTemplate);
  		}
  	}

}
