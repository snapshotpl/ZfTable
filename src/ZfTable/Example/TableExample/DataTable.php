<?php

namespace ZfTable\Example\TableExample;

use ZfTable\AbstractTable;

class DataTable extends AbstractTable
{

    //Definition of headers
    protected $headers = array(
        'idcustomer' => array('title' => 'Id', 'width' => '50'),
        'name' => array('title' => 'Name'),
        'surname' => array('title' => 'Surname'),
        'street' => array('title' => 'Street'),
        'city' => array('title' => 'City'),
        'active' => array('title' => 'Active'),
    );

    public function init()
    {
        //Table attributes
        $this->addAttr('id', 'zfDataTableExample');
        $this->addClass('display');
    }

    /**
     * Initializable where quick search
     */
    public function initQuickSearch()
    {
        $quickSearchValue = $this->getParamAdapter()->getQuickSearch();
        $quickSearchQuery = new \Zend\Db\Sql\Select();

        if (strlen($quickSearchValue)) {
            //Unsecure query (without quote)
            $quickSearchQuery->where('name like "%' . $quickSearchValue . '%"');
            $this->getSource()->setQuickSearchQuery($quickSearchQuery);
        }
    }

}
