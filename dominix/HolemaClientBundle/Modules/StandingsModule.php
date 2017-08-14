<?php

namespace dominix\HolemaClientBundle\Modules;

use Contao\Module;
use dominix\HolemaClientBundle\Models\HolemaStandings;

class StandingsModule extends Module {

	protected $strTemplate = 'mod_standings';

	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			/** @var \BackendTemplate|object $objTemplate */
			$objTemplate = new \BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### HOLEMA TABELLE ###';
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
		$standings = HolemaStandings::findByRound($this->holema_round,array('order' => ' points DESC'))->fetchAll();
		if($this->holema_table_rows>0) {
			$startKey = 0;
			$r = 1;
			foreach($standings as $key => $team) {
				$standings[$key]['rank'] = $r++;
				if($team['id'] == $this->holema_my_team) {
					if($key >= $this->holema_table_rows) {
						$startKey += ($key - $this->holema_table_rows) + 3;
					}
					if(($startKey + $this->holema_table_rows) > count($standings) ) {
						$startKey = count($standings) - $this->holema_table_rows ;
					}
				}
			}

			$standings = array_slice($standings, $startKey, $this->holema_table_rows);

		}
		$this->Template->my_team = $this->holema_my_team;
		$this->Template->standings = $standings;
		$this->Template->headline = $this->headline;
		$this->Template->headlineUnit = $this->hl;
		$this->Template->cssId = $this->cssID[0];
		$this->Template->cssClass = $this->cssID[1];

  }

}
