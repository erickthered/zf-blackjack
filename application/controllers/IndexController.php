<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function playAction()
    {
        $session = new Zend_Session_Namespace('zf-blackjack');
        if (!isset($session->round) || $session->round->isClosed()) {
            $round = new Application_Model_Round();
            if (!isset($session->results)) {
                $session->results = new Application_Model_Results();
            }

            $session->round = $round;            
        }

        $this->_redirect('game/play');
    }

    public function scoresAction()
    {
        $session = new Zend_Session_Namespace('zf-blackjack');
        $this->view->results = $session->results->getHistory();
    }
}
