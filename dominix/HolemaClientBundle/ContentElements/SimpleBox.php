<?php
namespace dominix\HolemaClientBundle\ContentElements;

class SimpleBox extends \ContentElement {
    protected $strTemplate = 'ce_simplebox';

    protected function compile()
    {

        $this->url = ampersand($this->url);
        if ($this->linkTitle == '') {
    			$this->linkTitle = $this->url;
    		}

        $objFile = \FilesModel::findByUuid($this->singleSRC);
    		if ($objFile === null) {
    			if (!\Validator::isUuid($this->singleSRC)) {
    				return '<p class="error">'.$GLOBALS['TL_LANG']['ERR']['version2format'].'</p>';
    			}
    			return '';
    		}
    		if (is_file(TL_ROOT . '/' . $objFile->path)) {
    		  $this->Template->singleSRC = $objFile->path;
    		} else {
          $this->Template->html = $this->html;
        }

        $this->Template->href = $this->url;
        $this->Template->linkTitle = specialchars($this->titleText ?: $this->linkTitle);

        if (TL_MODE == 'BE') {
    			$this->Template->title = '';
    			$this->Template->linkTitle = '';
          $this->Template->html = '<pre>' . htmlspecialchars($this->html) . '</pre>';
    		}
    }

}
