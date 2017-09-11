<?php

namespace dominix\HolemaClientBundle\Modules;

use Contao\Module;
use dominix\HolemaClientBundle\Models\HolemaGames;
use dominix\HolemaClientBundle\Models\HolemaStandings;

class LastGamesModule extends Module {

	protected $strTemplate = 'mod_lastgames';

	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			/** @var \BackendTemplate|object $objTemplate */
			$objTemplate = new \BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### HOLEMA LAST GAMES ###';
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
			'limit'   => $this->holema_table_rows,
	    'column'  => array('hometeam=?','gamedate<?'),
	    'value'   => array($this->holema_my_team, time())
	  ));
		if(!$games) {
			return null;
		}
		$gameArray = $games->fetchAll();
		foreach($gameArray as $key => $game) {
			$gameArray[$key]['home'] = HolemaStandings::findByIdAndRound($game['hometeam'],$game['round']);
			$gameArray[$key]['away'] = HolemaStandings::findByIdAndRound($game['awayteam'],$game['round']);
		}

		$this->Template->my_team = $this->holema_my_team;
		$this->Template->games = $gameArray;
		$this->Template->headline = $this->headline;
		$this->Template->headlineUnit = $this->hl;
		$this->Template->cssId = $this->cssID[0];
		$this->Template->cssClass = $this->cssID[1];

  }

}
