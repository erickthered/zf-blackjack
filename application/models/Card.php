<?php

/**
 * 
 */
class Application_Model_Card
{
	/**
	 * [$value description]
	 * @var [type]
	 */
	protected $value;
	/**
	 * [$suit description]
	 * @var [type]
	 */
	protected $suit;

	/**
	 * [__construct description]
	 * @param [type] $id [description]
	 */
	function __construct($id)
	{
		if ( 0 > $id || 52 <= $id) {
			throw new Exception($id.' is not a valid card ID');
		}
		$this->suit = floor($id /13);
		$this->value = $id % 13 + 1;
	}

	/**
	 * [getValue description]
	 * @return [type] [description]
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * [getSuit description]
	 * @return [type] [description]
	 */
	public function getSuit()
	{
		return $this->suit;
	}

	/**
	 * [getImage description]
	 * @return [type] [description]
	 */
	public function getImage($blank = false)
	{
		$horizontalOffset = -73*($this->value - 1);
		$verticalOffset = -98*$this->suit;

		if ($blank) {
			$html = '<div class="card blank"></div>';
		} else {
			$html = '<div style="background-position: '.
				$horizontalOffset.'px '.
				$verticalOffset.'px;" class="card"></div>';
		}

		return $html;
	}

	/**
	 * [__toString description]
	 * @return string [description]
	 */
	public function __toString()
	{
		switch($this->value) {
			case 1:
				$value = 'Ace';
				break;
			case 11:
				$value = 'J';
				break;
			case 12:
				$value = 'Q';
				break;
			case 13:
				$value = 'K';
				break;
			default:
				$value = $this->value;
				break;
		}
		switch($this->suit) {
			case 0:
				$suitName = "Clubs";
				break;
			case 1:
				$suitName = "Diamonds";
				break;
			case 2:
				$suitName = "Hearts";
				break;
			case 3:
				$suitName = "Spades";
				break;
		}

		return $value.' of '.$suitName;
	}
}
