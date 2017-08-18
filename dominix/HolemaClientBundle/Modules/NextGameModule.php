<?php

namespace dominix\HolemaClientBundle\Modules;

use Contao\Module;
use dominix\HolemaClientBundle\Models\HolemaGames;

class NextGameModule extends Module {

	protected $strTemplate = 'mod_nextgame';

	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			/** @var \BackendTemplate|object $objTemplate */
			$objTemplate = new \BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### HOLEMA NEXT GAME ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;
			return $objTemplate->parse();
		}

		if (empty($this->holema_round))
		{
			return '';
		}

		return parent::generate();
	}

  protected function compile()
  {
		$games = HolemaGames::findAll(array (
	    'order'   => ' gamedate DESC',
	    'column'  => array('hometeam=?','round=?'),
	    'value'   => array($this->holema_my_team, $this->holema_round)
	  ));
		var_dump($this->holema_my_team, $this->holema_round);
		if(!$games) {
			return null;
		}
		$games = $games->fetchAll();

		$this->Template->my_team = $this->holema_my_team;
		$this->Template->games = $games;
		$this->Template->columns = deserialize($this->holema_standings_columns);
		$this->Template->headline = $this->headline;
		$this->Template->headlineUnit = $this->hl;
		$this->Template->cssId = $this->cssID[0];
		$this->Template->cssClass = $this->cssID[1];

  }

}
