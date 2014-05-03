<?php

class Application_Model_Player
{
	protected $cards = array();

	public function deal($card)
	{
		$this->cards[] = $card;
	}

	public function getHand()
	{
		return $this->cards;
	}

	public function getHandValue()
	{
		$value = 0;
		$aces = 0;

		foreach ($this->cards as $card) {
			$cardValue = $card->getValue();
			if ($cardValue > 10) {
				$cardValue = 10;
			}
			if ($cardValue == 1) {
				$cardValue = 11;
				$aces++;
			}
			$value += $cardValue;
		}

		if ($value > 21 && $aces > 0) {
			$value -= 10;
		}

		return $value;
	}
}
