<?php

/**
 * @package apps\frontend\modules\Preview\actions
 */

/**
 * Preview actions.
 *
 * @package    apps
 * @subpackage Preview
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class PreviewActions extends sfActions
{
    
  
    /**
     * Execute index action
     *
     * @return void
     *
     * @issue 2673
     */
    public function executeIndex() {
        if ($this->getRequest()->getMethod() != sfRequest::GET) {
            $this->forward404();
        }
        if ($this->hasRequestParameter('pid')) {
            $this->product = DepositFinancialProductsPeer::retrieveByPk($this->getRequestParameter('pid'));
            $this->forward404Unless($this->product);
            $this->bank = DepositBankPeer::retrieveByPk($this->product->getBankId());

            $this->forward404Unless($this->bank);
            $this->img = util::getDomain() . '/images/';
            $this->setTemplate('previewV101');
        } else {
            $this->forward404();    
        }
    }   
}
