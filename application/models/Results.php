<?php

/**
 * 
 */
class Application_Model_Results
{
	/**
	 * [$wins description]
	 * @var integer
	 */
	protected $wins = 0;
	/**
	 * [$looses description]
	 * @var integer
	 */
	protected $looses = 0;
	/**
	 * [$draws description]
	 * @var integer
	 */
	protected $draws = 0;
	/**
	 * [$results description]
	 * @var integer
	 */
	protected $results = 0;

	/**
	 * [__construct description]
	 */
	function __construct() {
		$this->results = array();
	}

	/**
	 * [getOutcome description]
	 * @param  [type] $player [description]
	 * @param  [type] $dealer [description]
	 * @return [type]         [description]
	 */
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

	/**
	 * [save description]
	 * @param  [type] $player [description]
	 * @param  [type] $dealer [description]
	 * @return [type]         [description]
	 */
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

	/**
	 * [getWins description]
	 * @param  boolean $asPercent [description]
	 * @return [type]             [description]
	 */
	public function getWins($asPercent = false) 
	{
		if (!$asPercent) {
			return $this->wins;
		}
		$total = $this->getTotal();
		if (0 == $total) return 0;
		return round($this->wins/$total*100, 2);
	}

	/**
	 * [getLooses description]
	 * @param  boolean $asPercent [description]
	 * @return [type]             [description]
	 */
	public function getLooses($asPercent = false)
	{
		if (!$asPercent) {
			return $this->looses;
		}
		$total = $this->getTotal();
		if (0 == $total) return 0;
		return round($this->wins/$total*100, 2);
	}

	/**
	 * [getDraws description]
	 * @param  boolean $asPercent [description]
	 * @return [type]             [description]
	 */
	public function getDraws($asPercent = false)
	{
		if (!$asPercent) {
			return $this->draws;
		}
		$total = $this->getTotal();
		if (0 == $total) return 0;
		return round($this->wins/$total*100, 2);		
	}

	/**
	 * [getTotal description]
	 * @return [type] [description]
	 */
	public function getTotal()
	{
		return $this->wins + $this->looses + $this->draws;
	}

	/**
	 * [getHistory description]
	 * @return [type] [description]
	 */
	public function getHistory()
	{
		return $this->results;
	}
}