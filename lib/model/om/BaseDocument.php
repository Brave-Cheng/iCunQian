<?php


abstract class BaseDocument extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $proprietor;


	
	protected $block_number;


	
	protected $document_number;


	
	protected $title;


	
	protected $contract_number;


	
	protected $issue;


	
	protected $modifier = 0;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collProjectDocuments;

	
	protected $lastProjectDocumentCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getProprietor()
	{

		return $this->proprietor;
	}

	
	public function getBlockNumber()
	{

		return $this->block_number;
	}

	
	public function getDocumentNumber()
	{

		return $this->document_number;
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getContractNumber()
	{

		return $this->contract_number;
	}

	
	public function getIssue()
	{

		return $this->issue;
	}

	
	public function getModifier()
	{

		return $this->modifier;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = DocumentPeer::ID;
		}

	} 
	
	public function setProprietor($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->proprietor !== $v) {
			$this->proprietor = $v;
			$this->modifiedColumns[] = DocumentPeer::PROPRIETOR;
		}

	} 
	
	public function setBlockNumber($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->block_number !== $v) {
			$this->block_number = $v;
			$this->modifiedColumns[] = DocumentPeer::BLOCK_NUMBER;
		}

	} 
	
	public function setDocumentNumber($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->document_number !== $v) {
			$this->document_number = $v;
			$this->modifiedColumns[] = DocumentPeer::DOCUMENT_NUMBER;
		}

	} 
	
	public function setTitle($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = DocumentPeer::TITLE;
		}

	} 
	
	public function setContractNumber($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->contract_number !== $v) {
			$this->contract_number = $v;
			$this->modifiedColumns[] = DocumentPeer::CONTRACT_NUMBER;
		}

	} 
	
	public function setIssue($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->issue !== $v) {
			$this->issue = $v;
			$this->modifiedColumns[] = DocumentPeer::ISSUE;
		}

	} 
	
	public function setModifier($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->modifier !== $v || $v === 0) {
			$this->modifier = $v;
			$this->modifiedColumns[] = DocumentPeer::MODIFIER;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = DocumentPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = DocumentPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->proprietor = $rs->getString($startcol + 1);

			$this->block_number = $rs->getString($startcol + 2);

			$this->document_number = $rs->getString($startcol + 3);

			$this->title = $rs->getString($startcol + 4);

			$this->contract_number = $rs->getString($startcol + 5);

			$this->issue = $rs->getString($startcol + 6);

			$this->modifier = $rs->getInt($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Document object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DocumentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DocumentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(DocumentPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DocumentPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DocumentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DocumentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DocumentPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collProjectDocuments !== null) {
				foreach($this->collProjectDocuments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = DocumentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collProjectDocuments !== null) {
					foreach($this->collProjectDocuments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DocumentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getProprietor();
				break;
			case 2:
				return $this->getBlockNumber();
				break;
			case 3:
				return $this->getDocumentNumber();
				break;
			case 4:
				return $this->getTitle();
				break;
			case 5:
				return $this->getContractNumber();
				break;
			case 6:
				return $this->getIssue();
				break;
			case 7:
				return $this->getModifier();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			case 9:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DocumentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getProprietor(),
			$keys[2] => $this->getBlockNumber(),
			$keys[3] => $this->getDocumentNumber(),
			$keys[4] => $this->getTitle(),
			$keys[5] => $this->getContractNumber(),
			$keys[6] => $this->getIssue(),
			$keys[7] => $this->getModifier(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DocumentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setProprietor($value);
				break;
			case 2:
				$this->setBlockNumber($value);
				break;
			case 3:
				$this->setDocumentNumber($value);
				break;
			case 4:
				$this->setTitle($value);
				break;
			case 5:
				$this->setContractNumber($value);
				break;
			case 6:
				$this->setIssue($value);
				break;
			case 7:
				$this->setModifier($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
			case 9:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DocumentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setProprietor($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setBlockNumber($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDocumentNumber($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTitle($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setContractNumber($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIssue($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setModifier($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DocumentPeer::DATABASE_NAME);

		if ($this->isColumnModified(DocumentPeer::ID)) $criteria->add(DocumentPeer::ID, $this->id);
		if ($this->isColumnModified(DocumentPeer::PROPRIETOR)) $criteria->add(DocumentPeer::PROPRIETOR, $this->proprietor);
		if ($this->isColumnModified(DocumentPeer::BLOCK_NUMBER)) $criteria->add(DocumentPeer::BLOCK_NUMBER, $this->block_number);
		if ($this->isColumnModified(DocumentPeer::DOCUMENT_NUMBER)) $criteria->add(DocumentPeer::DOCUMENT_NUMBER, $this->document_number);
		if ($this->isColumnModified(DocumentPeer::TITLE)) $criteria->add(DocumentPeer::TITLE, $this->title);
		if ($this->isColumnModified(DocumentPeer::CONTRACT_NUMBER)) $criteria->add(DocumentPeer::CONTRACT_NUMBER, $this->contract_number);
		if ($this->isColumnModified(DocumentPeer::ISSUE)) $criteria->add(DocumentPeer::ISSUE, $this->issue);
		if ($this->isColumnModified(DocumentPeer::MODIFIER)) $criteria->add(DocumentPeer::MODIFIER, $this->modifier);
		if ($this->isColumnModified(DocumentPeer::CREATED_AT)) $criteria->add(DocumentPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DocumentPeer::UPDATED_AT)) $criteria->add(DocumentPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DocumentPeer::DATABASE_NAME);

		$criteria->add(DocumentPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setProprietor($this->proprietor);

		$copyObj->setBlockNumber($this->block_number);

		$copyObj->setDocumentNumber($this->document_number);

		$copyObj->setTitle($this->title);

		$copyObj->setContractNumber($this->contract_number);

		$copyObj->setIssue($this->issue);

		$copyObj->setModifier($this->modifier);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getProjectDocuments() as $relObj) {
				$copyObj->addProjectDocument($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new DocumentPeer();
		}
		return self::$peer;
	}

	
	public function initProjectDocuments()
	{
		if ($this->collProjectDocuments === null) {
			$this->collProjectDocuments = array();
		}
	}

	
	public function getProjectDocuments($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProjectDocumentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjectDocuments === null) {
			if ($this->isNew()) {
			   $this->collProjectDocuments = array();
			} else {

				$criteria->add(ProjectDocumentPeer::DOCUMENT_ID, $this->getId());

				ProjectDocumentPeer::addSelectColumns($criteria);
				$this->collProjectDocuments = ProjectDocumentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ProjectDocumentPeer::DOCUMENT_ID, $this->getId());

				ProjectDocumentPeer::addSelectColumns($criteria);
				if (!isset($this->lastProjectDocumentCriteria) || !$this->lastProjectDocumentCriteria->equals($criteria)) {
					$this->collProjectDocuments = ProjectDocumentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProjectDocumentCriteria = $criteria;
		return $this->collProjectDocuments;
	}

	
	public function countProjectDocuments($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseProjectDocumentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProjectDocumentPeer::DOCUMENT_ID, $this->getId());

		return ProjectDocumentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addProjectDocument(ProjectDocument $l)
	{
		$this->collProjectDocuments[] = $l;
		$l->setDocument($this);
	}


	
	public function getProjectDocumentsJoinProject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProjectDocumentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjectDocuments === null) {
			if ($this->isNew()) {
				$this->collProjectDocuments = array();
			} else {

				$criteria->add(ProjectDocumentPeer::DOCUMENT_ID, $this->getId());

				$this->collProjectDocuments = ProjectDocumentPeer::doSelectJoinProject($criteria, $con);
			}
		} else {
									
			$criteria->add(ProjectDocumentPeer::DOCUMENT_ID, $this->getId());

			if (!isset($this->lastProjectDocumentCriteria) || !$this->lastProjectDocumentCriteria->equals($criteria)) {
				$this->collProjectDocuments = ProjectDocumentPeer::doSelectJoinProject($criteria, $con);
			}
		}
		$this->lastProjectDocumentCriteria = $criteria;

		return $this->collProjectDocuments;
	}

} 