<?php

class GameController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function hitAction()
    {
        $session = new Zend_Session_Namespace('zf-blackjack');
        $round = $session->round;
        $results = $session->results;
        $player = $round->getPlayer("player");
        $dealer = $round->getPlayer("dealer");

        if ($player->getHandValue() < 21) {
            $round->dealPlayer("player");
            if ($player->getHandValue() == 21) {
                $this->_redirect('game/stand');
            }

            if ($player->getHandValue() > 21) {
                if (!$round->isClosed()) {
                    $round->close();
                    $results->save(
                        $player->getHandValue(),
                        $dealer->getHandValue()
                    );
                }
            }
        }

        $this->_redirect('game/play');
    }

    public function standAction()
    {
        $session = new Zend_Session_Namespace('zf-blackjack');
        $round = $session->round;
        $results = $session->results;
        $dealer = $round->getPlayer("dealer");
        $player = $round->getPlayer("player");

        while($dealer->getHandValue() < 17) {
            $round->dealPlayer("dealer");
        }

        if (!$round->isClosed()) {
            $round->close();
            $results->save(
                $player->getHandValue(),
                $dealer->getHandValue()
            );            
        }
        
        $this->_redirect('game/play');
    }

    public function playAction()
    {
        $session = new Zend_Session_Namespace('zf-blackjack');
        $round = $session->round;
        $results = $session->results;
        $player = $round->getPlayer("player");
        $dealer = $round->getPlayer("dealer");

        $this->view->player = $player;
        $this->view->isClosed = $round->isClosed();
        $this->view->outcome = $results->getOutcome(
                $player->getHandValue(),
                $dealer->getHandValue()
            );
    }
}

