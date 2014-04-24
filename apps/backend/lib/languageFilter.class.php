<?php
class languageFilter extends sfFilter
{
    public function execute($filterChain) {
        // Execute this filter only once
        if ($this->isFirstCall()){
            $request = $this->getContext()->getRequest();
            $user    = $this->getContext()->getUser();
            $user->setCulture('zh');
            //if ($request->getParameter('language') != '') {
                //$user->setCulture($request->getParameter('language'));
            //}
        }
        // Execute next filter
        $filterChain->execute();
    }
}
?>