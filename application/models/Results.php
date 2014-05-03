<?php

class Application_Model_Results
{
	protected $wins = 0;
	protected $looses = 0;
	protected $draws = 0;
	protected $results = 0;

	function __construct() {
		$this->results = array();
	}

	public function getOutcome($player, $dealer)
	{
		$outcome = 'draw';
		if ($player > 21) {
			$outcome = 'loose';
		} else {
			if ($dealer > 21) {
				$outcome = 'win';
			} else {
				if ($player > $dealer) {
					$outcome = 'win';
				} elseif ($player < $dealer) {
					$outcome = 'loose';
				}
			}
		}

		return $outcome;	
	}

	public function save($player, $dealer)
	{
		$outcome = $this->getOutcome($player, $dealer);
		switch($outcome) {
			case 'win':
				$this->wins++;
				break;
			case 'loose':
				$this->looses++;
				break;
			case 'draw':
				$this->draws++;
				break;
		}

		$this->results[] = array(
			'player' => $player,
			'dealer' => $dealer,
			'outcome' => $outcome
		);		
	}

	public function getWins() 
	{
		return $this->wins;
	}

	public function getLooses()
	{
		return $this->looses;
	}

	public function getDraws()
	{
		return $this->draws;
	}

	public function getTotal()
	{
		return $this->wins + $this->looses + $this->draws;
	}

	public function getHistory()
	{
		return $this->results;
	}
}