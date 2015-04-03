<?php
namespace base\mysqltools;

class mysqltools {

    var $tabela = null;

    var $id = null;

    var $where = null;
    var $order = null;
    var $limit = null;
    var $set = null;
    var $preValues = null;
    var $values = null;

    private function where() {

        if($this->getWhere()) {

            $tmp = " where ".$this->getWhere();
            return $tmp;

        }

    }

    private function set() {

        if($this->getSet()) {

            $tmp = " set ".$this->getSet();
            return $tmp;

        }

    }
    private function order() {

        if($this->getOrder()) {

            $tmp = " order by ".$this->getOrder();
            return $tmp;

        }

    }

    private function preValues() {

        if($this->getPreValues()) {

            $tmp = $this->getPreValues();
            return $tmp;

        }

    }

    private function values() {

        if($this->getValues()) {

            $tmp = $this->getValues();
            return $tmp;

        }

    }

    private function limit() {

        if($this->getLimit()) {

            $tmp = " limit ".$this->getLimit();
            return $tmp;

        }

    }

    public function clear() {
        $this->setWhere(null); $this->setOrder(null);
        $this->setLimit(null); $this->setTabela(null);
    }

    public function selectSQL() {
        $tmp = "select * from {$this->getTabela()} {$this->where()} {$this->order()} {$this->limit()}";
        return $tmp;
    }
    public function updateSQL() {
        $tmp = "update {$this->getTabela()} {$this->set()} {$this->where()} {$this->order()} {$this->limit()}";
        return $tmp;
    }
    public function insertSQL() {
        $tmp = "insert into {$this->getTabela()} {$this->preValues()} values {$this->values()} ";
        return $tmp;
    }

    public function getRowByID($table,$identificador,$id) {
        $this->clear();
        $this->setTabela($table);
        $this->setWhere($identificador."=".$id);
        $this->setLimit("1");
        return $this->selectSQL();
    }

    /**
     * @return null
     */
    public function getPreValues()
    {
        return $this->preValues;
    }

    /**
     * @param null $preValues
     */
    public function setPreValues($preValues)
    {
        $this->preValues = $preValues;
    }

    /**
     * @return null
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param null $values
     */
    public function setValues($values)
    {
        $this->values = $values;
    }

    /**
     * @return null
     */
    public function getSet()
    {
        return $this->set;
    }

    /**
     * @param null $set
     */
    public function setSet($set)
    {
        $this->set = $set;
    }


    /**
     * @return null
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param null $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return null
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param null $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return null
     */
    public function getWhere()
    {
        return $this->where;
    }

    /**
     * @param null $where
     */
    public function setWhere($where)
    {
        $this->where = $where;
    }


    /**
     * @return null
     */
    public function getTabela()
    {
        return $this->tabela;
    }

    /**
     * @param null $tabela
     */
    public function setTabela($tabela)
    {
        $this->tabela = $tabela;
    }



}
