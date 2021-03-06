<?php

namespace dominix\HolemaClientBundle\Modules;

use Contao\Module;
use dominix\HolemaClientBundle\Models\HolemaGames;
use dominix\HolemaClientBundle\Models\HolemaStandings;

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
	    'order'   => ' gamedate ASC',
			'limit'   => 1,
	    'column'  => array('hometeam=?','gamedate>?'),
	    'value'   => array($this->holema_my_team, time())
	  ));
		if(!$games) {
			return null;
		}
		$game = $games->fetchAll()[0];

		$game['home'] = HolemaStandings::findByIdAndRound($game['hometeam'],$game['round']);
		$game['away'] = HolemaStandings::findByIdAndRound($game['awayteam'],$game['round']);

		$this->Template->my_team = $this->holema_my_team;
		$this->Template->game = $game;
		$this->Template->columns = deserialize($this->holema_standings_columns);
		$this->Template->headline = $this->headline;
		$this->Template->headlineUnit = $this->hl;
		$this->Template->cssId = $this->cssID[0];
		$this->Template->cssClass = $this->cssID[1];

  }

}
