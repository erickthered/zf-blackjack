<?php

class Application_Model_Deck
{
	protected $cards;

	function __construct()
	{
		for($i=0; $i<52; $i++) {
			$this->cards[] = new Application_Model_Card($i);
		}
	}

	public function getCards() {
		// foreach ($this->cards as $card) {
		// 	echo $card->getImage();
		// 	echo $card.'<div style="clear:both"></div><hr/>';
		// }
		return $this->cards;
	}
}
