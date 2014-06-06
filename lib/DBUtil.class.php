<?php

class DBUtil
{
    /**
     * get page number
     * 
     * @return int
     */
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
    
    /**
     * get row number by sql
     * 
     * @param string $sql        sql
     * @param string $p          sql
     * @param string $connection connection
     * @param string $countsql   count sql
     * 
     * @return int
     */
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
    
    /**
     * set pager param sql
     * 
     * @param string $sql        sql
     * @param string $p          sql
     * @param string $connection connection
     * @param string $countsql   count sql
     * 
     * @return int
     */
    public static function setPagerParamSql($sql, $p, $connection, $countsql = "") {
        $requeset = sfContext::getInstance()->getRequest();
        $pager = array();
        $pager["pager"] = $requeset->getParameter("pager", 1);
        $pager["pagerRowNum"] = self::getRowNumBySql($sql, $p, $connection, $countsql);
        $pager["pagerPage"] = ceil($pager["pagerRowNum"] / self::getPageRowNum());
        $pager["pagerPageRowNum"] = self::getPageRowNum();
        return $pager;
    }

    /**
     * pager sql
     * 
     * @param string $sql      sql
     * @param string $p        sql
     * @param string $class    class
     * @param string $countsql count sql
     * 
     * @return string
     */
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

    /**
     * sort sql
     * 
     * @param string $sql sql
     * 
     * @return string
     */
    public static function sortBySql($sql) {
        $requeset = sfContext::getInstance()->getRequest();
        $sortBy = $requeset->hasParameter("sortBy") ? $requeset->getParameter("sortBy") : "";
        $sort = $requeset->hasParameter("sort") ? $requeset->getParameter("sort") : "ASC";

        if ($sortBy == "")
            return $sql;
        $sql .= " ORDER BY $sortBy $sort";
        return $sql;
    }

    /**
     * query sql
     * 
     * @param string $sql   sql
     * @param string $p     sql
     * @param string $class class
     * @param string $con   connection
     * 
     * @return string
     */
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
}