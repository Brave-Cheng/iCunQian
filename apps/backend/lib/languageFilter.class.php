<?php

class languageFilter extends sfFilter
{

    /**
     * execute description
     * 
     * @param  sfFilterChain  $filterChain 
     * @return  mixed 
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