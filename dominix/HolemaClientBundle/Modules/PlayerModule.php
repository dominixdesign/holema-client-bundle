<?php

namespace dominix\HolemaClientBundle\Modules;

use Contao\Module;
use dominix\HolemaClientBundle\Models\HolemaPlayers;

class PlayerModule extends Module {

	protected $strTemplate = 'mod_player';

	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			/** @var \BackendTemplate|object $objTemplate */
			$objTemplate = new \BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### HOLEMA SPIELERDETAILS ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;
			return $objTemplate->parse();
		}

		// Set the item from the auto_item parameter
		if (!isset($_GET['items']) && \Config::get('useAutoItem') && isset($_GET['auto_item']))
		{
			\Input::setGet('items', \Input::get('auto_item'));
		}

		return parent::generate();
	}

  protected function compile()
  {
		$player = HolemaPlayers::findByAlias(\Input::get('items'));
		$players = HolemaPlayers::findByRound($this->holema_round,array('order' => 'lastname ASC'));

		if(!$player) {
			throw new PageNotFoundException('Page not found: ' . \Environment::get('uri'));
		} else {
			// Overwrite the page title (see #2853 and #4955)
			global $objPage;
			$objPage->pageTitle = strip_tags(\StringUtil::stripInsertTags($player->firstname).' '.\StringUtil::stripInsertTags($player->lastname));
		}

		$this->Template->headline = $this->headline;
		$this->Template->player = $player;
		$this->Template->players = $players->fetchAll();
		$this->Template->headlineUnit = $this->hl;
		$this->Template->cssId = $this->cssID[0];
		$this->Template->cssClass = $this->cssID[1];

  }

}
