<?php
namespace dominix\HolemaClientBundle\ContentElements;

class People extends \ContentElement {
    protected $strTemplate = 'ce_people';

    protected function compile()
  	{


			$objFile = \FilesModel::findByUuid($this->singleSRC);
			if ($objFile === null) {
				if (!\Validator::isUuid($this->singleSRC)) {
					return '<p class="error">'.$GLOBALS['TL_LANG']['ERR']['version2format'].'</p>';
				}
				return '';
			}
			if (is_file(TL_ROOT . '/' . $objFile->path)) {
				$this->Template->singleSRC = $objFile->path;
			}

			$this->Template->attributes = deserialize($this->people_attributes);
			$this->Template->people_name = $this->headline;

			if (TL_MODE == 'BE')
  		{
  			$this->strTemplate = 'be_wildcard';
  			$this->Template = new \BackendTemplate($this->strTemplate);
  		}
  	}
}
