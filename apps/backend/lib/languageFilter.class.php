<?php

/**
 * @package apps\backend\lib
 */

class languageFilter extends sfFilter
{

    /**
     * execute description
     * 
     * @param object $filterChain sfFilterChain
     * 
     * @return  mixed 
     *
     * @issue 2763
     */
    public function execute($filterChain) {
        // Execute this filter only once
        if ($this->isFirstCall()){
            $request = $this->getContext()->getRequest();
            $user    = $this->getContext()->getUser();
            $user->setCulture('zh');
        }
        // Execute next filter
        $filterChain->execute();
    }
}
?>