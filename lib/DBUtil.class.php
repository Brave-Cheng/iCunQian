<?php

class DBUtil {

    public static function getPageRowNum() {
        $requeset = sfContext::getInstance()->getRequest();
        $pageRowNum = $requeset->getParameter("PageRowNum");
        if (!empty($pageRowNum) || !empty($_COOKIE['PageRowNum'])) {
            $pageRowNum = ($pageRowNum != "" ? $pageRowNum : $_COOKIE['PageRowNum']);
        } else {
            $pageRowNum = 20;
        }
        return $pageRowNum;
    }

    public static function getRowNumBySql($sql, $p, $connection, $countsql = "") {
        if ($countsql == "") {
            $pattern = "/^SELECT(.*)FROM/";
            $replace = "SELECT COUNT(*) AS count FROM";
            $sql = preg_replace($pattern, $replace, $sql);
            $sql = str_replace('group by sf_user.id', '', $sql);
        } else {
            $sql = $countsql;
        }
        $statement = $connection->prepareStatement($sql);
        $resultset = $statement->executeQuery($p);
        if ($resultset->next()) {
            return $resultset->getInt("count");
        } else {
            return 0;
        }
    }

    public static function setPagerParamSql($sql, $p, $connection, $countsql = "") {
        $requeset = sfContext::getInstance()->getRequest();
        $pager = array();
        $pager["pager"] = $requeset->getParameter("pager", 1);
        $pager["pagerRowNum"] = self::getRowNumBySql($sql, $p, $connection, $countsql);
        $pager["pagerPage"] = ceil($pager["pagerRowNum"] / self::getPageRowNum());
        $pager["pagerPageRowNum"] = self::getPageRowNum();
        return $pager;
    }

    public static function pagerSql($sql, $p, $class = "", $countsql = "") {
        $connection = Propel::getConnection();

        $pager = self::setPagerParamSql($sql, $p, $connection, $countsql);

        if ($pager["pager"] < 1) {
            $pager["pager"] = 1;
        }
        if ($pager["pagerPage"] > 0 && $pager["pager"] > $pager["pagerPage"]) {
            $pager["pager"] = $pager["pagerPage"];
        }

        $start = ($pager["pager"] - 1) * self::getPageRowNum();
        $sql .= " LIMIT $start," . self::getPageRowNum();

        $statement = $connection->prepareStatement($sql);

        if ($class != "") {
            $resultset = $statement->executeQuery($p, ResultSet::FETCHMODE_NUM);
            $code = '$list' . " = " . "$class::populateObjects" . "(" . '$resultset' . ");";
            eval($code);
            $pager["results"] = $list;
        } else {
            $resultset = $statement->executeQuery($p);
            $pager["results"] = $resultset;
        }
        return $pager;
    }

    public static function sortBySql($sql) {
        $requeset = sfContext::getInstance()->getRequest();
        $sortBy = $requeset->hasParameter("sortBy") ? $requeset->getParameter("sortBy") : "";
        $sort = $requeset->hasParameter("sort") ? $requeset->getParameter("sort") : "ASC";

        if ($sortBy == "")
            return $sql;
        $sql .= " ORDER BY $sortBy $sort";
        return $sql;
    }

    public static function execSql($sql, $p, $class = "", $con = "propel") {
        $connection = Propel::getConnection($con);
        $statement = $connection->prepareStatement($sql);
        if ($class != "") {
            $resultset = $statement->executeQuery($p, ResultSet::FETCHMODE_NUM);
            $code = '$list' . " = " . "$class::populateObjects" . "(" . '$resultset' . ");";
            eval($code);
            return $list;
        } else {
            $resultset = $statement->executeQuery($p);
            return $resultset;
        }
    }

    /**
     * get Project User Role Name
     * @param int $userId
     * @param int $projectId
     * @return string
     * @issue 2326
     * @author brave
     */
    public static function getProjectUserRoleName($userId, $projectId) {
        $criteria = new Criteria();
        $criteria->add(ProjectMemberPeer::SF_GUARD_USER_ID, $userId);
        $criteria->add(ProjectMemberPeer::PROJECT_ID, $projectId);
        $criteria->addJoin(ProjectRolePeer::ID, ProjectMemberPeer::PROJECT_ROLE_ID);
        $criteria->clearSelectColumns();
        $criteria->addSelectColumn(ProjectRolePeer::NAME);
        $rs = ProjectMemberPeer::doSelectRS($criteria);
        while ($row = mysql_fetch_assoc($rs->getResource())) {
            $rows[] = $row['NAME'];
        }
        return empty($rows[0]) ? '' : $rows[0];
    }

    /**
     * get pm of project
     * @param int $projectId
     * @param string $role
     * @return object
     * @issue <2326> <2333>
     * @author brave
     */
    public static function getProjectRole($projectId, $role = ProjectRolePeer::PROJECT_PM) {
        $criteria = new Criteria();
        $criteria->add(ProjectMemberPeer::PROJECT_ID, $projectId);
        $criteria->addJoin(ProjectRolePeer::ID, ProjectMemberPeer::PROJECT_ROLE_ID);
        $criteria->add(ProjectRolePeer::NAME, $role);
        $criteria->setDistinct();
        return ProjectMemberPeer::doSelect($criteria);
    }
    
}