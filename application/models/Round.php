<?php

class Application_Model_Round
{
	protected $decks = 1;
	protected $players;
	protected $cards;
	protected $currentCard = 0;
	protected $closed = false;

	function __construct()
	{
		$this->players = array();
		$this->cards = array();

		$deck = new Application_Model_Deck();
		for ($i = 0; $i < $this->decks; $i++) {
			$this->cards = array_merge($this->cards, $deck->getCards());
		}
		$this->shuffle();

		$dealer = new Application_Model_Dealer();
		$this->addPlayer($dealer, "dealer");
		$this->addPlayer(new Application_Model_Player(), "player");
		$this->dealHand();
	}

	public function shuffle()
	{
		shuffle($this->cards);
		$this->currentCard = 0;
	}

	public function nextCard()
	{
		if ($this->currentCard < count($this->cards)) {
			$nextCard = $this->cards[$this->currentCard];
			$this->currentCard++;
			return $nextCard;
		}
		throw new Exception('Sorry! we ran out of cards!');
	}

	public function addPlayer($player, $key)
	{
		$this->players[$key] = $player;
	}

	public function getPlayer($key)
	{
		return $this->players[$key];
	}

	public function dealHand()
	{
		$cardsPerPlayer = 0;
		while ($cardsPerPlayer < 2) {
			foreach ($this->players as $key => $player) {
				$this->dealPlayer($key);
			}
			$cardsPerPlayer++;
		}
	}

	public function dealPlayer($playerKey)
	{
		$this->players[$playerKey]->deal( $this->nextCard() );
	}

	public function close()
	{
		$this->closed = true;
	}

	public function isClosed()
	{
		return $this->closed;
	}
}
