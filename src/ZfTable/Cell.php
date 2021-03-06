<?php

namespace ZfTable;

use ZfTable\AbstractElement;
use ZfTable\Decorator\DecoratorFactory;

class Cell extends AbstractElement
{

    /**
     * Header object
     * @var Header
     */
    protected $header;

    /**
     * 
     * @param Header $header
     */
    public function __construct($header)
    {
        $this->header = $header;
    }

    /**
     * 
     * @param type $name
     * @param type $options
     * @return \ZfTable\Decorator\AbstractDecorator
     */
    public function addDecorator($name, $options)
    {
        $decorator = DecoratorFactory::factoryCell($name, $options);
        $decorator->setCell($this);
        $this->attachDecorator($decorator);
        return $decorator;
    }

    /**
     * Get header object
     * @return Header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set header object
     * @param Header $header
     * @return \ZfTable\Cell
     */
    public function setHeader($header)
    {
        $this->header = $header;
        return $this;
    }

    /**
     * Get actual row 
     * @return array
     */
    public function getActualRow()
    {
        return $this->getTable()->getRow()->getActualRow();
    }

    /**
     * Rendering single cell
     * @return string
     */
    public function render($type = 'html')
    {
        $row = $this->getTable()->getRow()->getActualRow();
        $value = $row[$this->getHeader()->getName()];

        foreach ($this->decorators as $decorator) {
            if ($decorator->validConditions()) {
                $value = $decorator->render($value);
            }
        }
        if($type == 'html'){
            return sprintf("<td %s>%s</td>", $this->getAttributes(), $value);
        }
        else{
            return $value;
        }
        
    }

}
