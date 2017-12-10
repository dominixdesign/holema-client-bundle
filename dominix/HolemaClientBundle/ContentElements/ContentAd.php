<?php
namespace dominix\HolemaClientBundle\ContentElements;

class ContentAd extends \ContentElement {
    protected $strTemplate = 'ce_ad';

    protected function compile()
  	{
      if (TL_MODE == 'FE')
  		{
  			$this->Template->html = $this->html;
        $this->Template->headline = $this->headline;
  		} else {
  			$this->Template->html = '<pre>' . htmlspecialchars($this->html) . '</pre>';
  		}
  	}
}
