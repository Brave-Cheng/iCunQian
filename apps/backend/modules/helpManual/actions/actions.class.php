<?php

/**
 * helpManual actions.
 *
 * @package    oa
 * @subpackage helpManual
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class helpManualActions extends sfActions
{
  /**
   * Executes index action
   *
   */
    public function executeIndex(){
        $this->setLayout('layoutFrameset');
    }
    
    public function executeNav(){
        $this->setLayout('layoutFrameset');
    }
    
    public function executeContent(){
        $this->setLayout('layoutFrameset');
    }
    
    public function executeHeaderTitle(){
        $this->setLayout('layoutFrameset');
    }
}


