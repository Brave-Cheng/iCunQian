<?php

/**
 * tender actions.
 *
 * @package    oa
 * @subpackage tender
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class tenderActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('project', 'completeTender');
  }
  
}
