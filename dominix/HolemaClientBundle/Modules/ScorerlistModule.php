<?php

namespace dominix\HolemaClientBundle\Modules;

use Contao\Module;
use dominix\HolemaClientBundle\Models\HolemaPlayers;

class ScorerlistModule extends Module {

	protected $strTemplate = 'mod_scorerlist';

	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			/** @var \BackendTemplate|object $objTemplate */
			$objTemplate = new \BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### HOLEMA SCORERLISTE ###';
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
		$players = HolemaPlayers::findByRound($this->holema_round,array('order' => ' points DESC'));
	
		if(!$players) {
			return null;
		}
		$players = $players->fetchAll();
		if($this->holema_table_rows>0) {
			$players = array_slice($players, 0, $this->holema_table_rows);

		}

		$this->Template->players = $players;
		$this->Template->columns = deserialize($this->holema_scorer_columns);
		$this->Template->headline = $this->headline;
		$this->Template->headlineUnit = $this->hl;
		$this->Template->cssId = $this->cssID[0];
		$this->Template->cssClass = $this->cssID[1];

  }

}
