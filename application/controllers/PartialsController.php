<?php

class PartialsController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout()->disableLayout();
    }

    public function indexAction()
    {
        // action body
    }

    public function playerAction()
    {
        $session = new Zend_Session_Namespace('zf-blackjack');
        $this->view->player = $session->round->getPlayer("player");
    }

    public function dealerAction()
    {
        $session = new Zend_Session_Namespace('zf-blackjack');
        $this->view->isClosed = $session->round->isClosed();
        $this->view->dealer = $session->round->getPlayer("dealer");
    }

    public function statsAction()
    {
        $session = new Zend_Session_Namespace('zf-blackjack');
        $this->view->stats = $session->results;
    }
}