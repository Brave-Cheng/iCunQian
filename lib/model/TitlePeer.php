<?php

/**
 * Subclass for performing query and update operations on the 'title' table.
 *
 * 
 *
 * @package lib.model
 */ 
class TitlePeer extends BaseTitlePeer
{
    public static function getAllTitles(){
        $c = new Criteria();
        $c->addAscendingOrderByColumn( TitlePeer::ID );
        return TitlePeer::doSelect( $c );
    }
    public static function getTitleName($userId, $titleId){
        $c = new Criteria();
        $c->add(TitleSfGuardUserPeer::TITLE_ID, $titleId);
        $c->add(TitleSfGuardUserPeer::SF_GUARD_USER_ID, $userId);
        $c->addJoin(TitleSfGuardUserPeer::TITLE_ID, TitlePeer::ID);
        $title = TitlePeer::doSelectOne($c);
        return $title;
    }
}
