<?php
namespace dominix\HolemaClientBundle\ContentElements;

class People extends \ContentElement {
    protected $strTemplate = 'ce_people';

		public function generate()
		{
			if (TL_MODE == 'BE')
			{
				/** @var \BackendTemplate|object $objTemplate */
				$objTemplate = new \BackendTemplate('be_wildcard');
				$objTemplate->title = $this->headline;
				$objTemplate->id = $this->id;
				$objTemplate->link = $this->name;
				$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;
				return $objTemplate->parse();
			}

			return parent::generate();
		}

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

  	}
}
