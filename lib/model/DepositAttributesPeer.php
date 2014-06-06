<?php

/**
 * @package lib\model
 */

/**
 * Subclass for performing query and update operations on the 'deposit_attributes' table.
 *
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
class DepositAttributesPeer extends BaseDepositAttributesPeer
{

    /**
     * save and return attribute
     *
     * @param string $type  attribute type
     * @param string $value attribute value
     *
     * @issue 2568
     * @return object DepositAttribute
     */
    static public function saveAndBackAttribute($type, $value) {
        $criteria = new Criteria();
        $criteria->add(DepositAttributesPeer::TYPE, $type);
        $criteria->add(DepositAttributesPeer::VALUE, $value);
        $attribute = DepositAttributesPeer::doSelectOne($criteria);
        if ($attribute) {
            return $attribute;
        } else {
            $newAttribute = new DepositAttributes();
            $newAttribute->setType($type);
            $newAttribute->setValue($value);
            $newAttribute->save();
            return $newAttribute;
        }
    }

    /**
     * fetch standard adapter
     *
     * @param boolean $trans An array of key/value pairs to be flipped
     *
     * @issue 2568
     * @return array
     */
    public static function fetchStandardAdapterList($trans = false) {
        $attributes = array();
        $adapters = Config::getInstance('CrawlConfig')->getAttributeAdapter();
        foreach ($adapters as $key => $adapter) {
            $attributes[$key] = array_keys($adapter);
            if ($trans) {
                $flip = array();
                $vars = array_keys($adapter);
                foreach ($vars as $value) {
                    $flip[$value] = $value;
                }
                unset($vars);
                $attributes[$key] = $flip;
            }
        }
        return $attributes;
    }

    /**
     *  For the specified adapter
     *
     * @param string $element adapter name
     *
     * @issue 2568
     * @return string
     */
    public static function fetchStandardAdapter($element) {
        $adapters = Config::getInstance('CrawlConfig')->getAttributeAdapter();
        foreach ($adapters as $adapter) {
            foreach ($adapter as $standard => $haystack) {
                if (in_array($element, $haystack)) {
                    return $standard;
                }
            }
        }
    }

    /**
     * Initializes the attribute library
     *
     * @issue 2568
     * @return null
     */
    public static function initializeAttributes() {
        $attributes = self::fetchStandardAdapterList();
        foreach ($attributes as $key => $attribute) {
            foreach ($attribute as $element) {
                self::saveAndBackAttribute($key, $element);
            }
        }
    }

    /**
     * get valid status
     *
     * @issue 2568
     * @return string
     */
    public static function getValidStatus() {
        $string = '';
        $attribute = Config::getInstance('CrawlConfig')->getAttributeAdapter();
        $status = array_keys($attribute['status']);
        unset($status[2]);
        foreach ($status as $var) {
            $string .= " drf. status = '" . $var . "' OR ";
        }
        return "( " . trim($string, 'OR ') . " )";
    }


    /**
     * get filter
     *
     * @param int     $since timestamp
     * @param string  $type  type name
     * @param int     $limit number
     * @param booelan $total total condtion
     *
     * @issue 2568
     * @return object Criteria
     */
    public static function filters($since, $type = null, $limit = 100, $total = false) {
        $criteria = new Criteria();
        if ($type) {
            $criteria->add(DepositAttributesPeer::TYPE, $type);
            if ($total) {
                return $criteria;
            }
        }
        if ($total) {
            return $criteria;
        }
        if ($since) {
            echo $since;
            $criteria->add(DepositAttributesPeer::UPDATED_AT, $since, Criteria::GREATER_THAN);
        }
        $criteria->addAscendingOrderByColumn(DepositAttributesPeer::UPDATED_AT);
        $criteria->setLimit($limit);
        return $criteria;
    }


    /**
     * fetch attribute
     *
     * @param int    $since timestamp
     * @param string $type  type name
     * @param int    $limit number
     *
     * @issue 2568
     * @return array
     */
    public static function fetchAttributes($since, $type = null, $limit = 100) {
        $attributeLists = array();
        if ($since) {
            $since = date('Y-m-d H:i:s', $since);
        } else {
            $since = null;
        }
        $criteria = self::filters($since, $type, $limit);
        $attributes = DepositAttributesPeer::doSelect($criteria);
        foreach ($attributes as $attribute) {
            $attributeLists[] = array(
                'id'            => $attribute->getId(),
                'type'          => $attribute->getType(),
                'value'         => $attribute->getValue(),
                'sync_status'   => $attribute->getSyncStatus(),
                'create_at'     => $attribute->getCreatedAt(),
                'update_at'     => $attribute->getUpdatedAt(),
            );
        }
        return array('list' => $attributeLists, 'total' => DepositAttributesPeer::doCount(self::filters($since, $type, $limit, true)));
    }

}
