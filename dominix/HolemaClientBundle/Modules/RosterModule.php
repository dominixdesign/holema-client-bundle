<?php

namespace dominix\HolemaClientBundle\Modules;

use Contao\Module;
use dominix\HolemaClientBundle\Models\HolemaPlayers;

class RosterModule extends Module {

	protected $strTemplate = 'mod_roster';

	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			/** @var \BackendTemplate|object $objTemplate */
			$objTemplate = new \BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### HOLEMA SPIELERLISTE ###';
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
		$players = HolemaPlayers::findByRound($this->holema_round,array('order' => 'jersey ASC'));
		$playerlist = array();

		if(!$players) {
			return null;
		}
		foreach($players->fetchAll() as $p) {
			switch($p['position']) {
				case 'RW':
				case 'C':
				case 'LW':
					$playerlist['F'][] = $p;
					break;
				default:
					$playerlist[$p['position']][] = $p;
					break;
			}
		}

		$playerlist['0G'] = $playerlist['G'];
		$playerlist['2D'] = $playerlist['D'];
		$playerlist['4F'] = $playerlist['F'];
		unset($playerlist['G']);
		unset($playerlist['D']);
		unset($playerlist['F']);
		ksort($playerlist);

		$this->Template->players = $playerlist;
		$this->Template->configData = json_decode(preg_replace('/(\v|\s)+/', ' ', $this->holema_config_json),true);

		$this->Template->headline = $this->headline;
		$this->Template->headlineUnit = $this->hl;
		$this->Template->cssId = $this->cssID[0];
		$this->Template->cssClass = $this->cssID[1];

  }

}
