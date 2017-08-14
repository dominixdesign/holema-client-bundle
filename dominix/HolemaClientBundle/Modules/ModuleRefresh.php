<?php

/*
 * This file is part of the HolemaClientBundle.
 *
 * (c) Dominik Sander <http://dominix-design.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dominix\HolemaClientBundle\Modules;

use Contao\Database;
use Contao\BackendModule;
use dominix\HolemaClientBundle\Models\HolemaRounds;
use dominix\HolemaClientBundle\Utils\HolemaStandings;

class ModuleRefresh extends BackendModule
{

	protected $strTemplate = 'be_refresh';

	public function compile() {

		if (\Input::post('FORM_SUBMIT') == 'tl_holema_refresh') {
			$done = array();
			foreach(\Input::post('round') as $round) {
					HolemaStandings::refresh($round);
					$done[$round] = HolemaRounds::findOneBy('holemaid', $round);
			}
			$this->Template->result = $done;
		}


		$this->Template->href = $this->getReferer(true);
		$this->Template->title = specialchars($GLOBALS['TL_LANG']['MSC']['backBTTitle']);
		$this->Template->button = $GLOBALS['TL_LANG']['MSC']['backBT'];
		$this->Template->formSubmit = 'contao?do=holema_refresh';
		$this->Template->rounds = HolemaRounds::findAll();

	}

}
