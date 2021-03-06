<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 */
class Application_Model_PhonecodeMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Phonecode');
        }
        return $this->_dbTable;
    }

    /*
     * saving data in table
     */
    public function addInfo(array $data)
    {
        $date = new Zend_Db_Expr('CURDATE()');
        foreach($data as $item){
            if(!isset($item['LastUpdate'])){
                $item['LastUpdate'] = $date;
            }
            $this->getDbTable()->insert($item);
        }
        return count($data);
    }

}

