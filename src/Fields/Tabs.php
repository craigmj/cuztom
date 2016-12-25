<?php

namespace Gizburdt\Cuztom\Fields;

use Gizburdt\Cuztom\Cuztom;
use Gizburdt\Cuztom\Support\Guard;

Guard::directAccess();

class Tabs extends Field
{
    /**
     * Base.
     * @var mixed
     */
    public $view = 'tabs';

    /**
     * Fillables.
     * @var mixed
     */
    public $panels = array();

    /**
     * Data.
     * @var array
     */
    public $data = array();

    /**
     * Construct.
     *
     * @param array $args
     * @param array $values
     */
    public function __construct($args, $values = null)
    {
        parent::__construct($args, $values);

        $this->data = $this->build($args);
    }

    /**
     * Outputs a field cell.
     *
     * @param string|array $value
     */
    public function outputCell($value = null)
    {
        return Cuztom::view('fields/cell/'.$this->view, array(
            'tabs'  => $this,
            'value' => $value
        ));
    }

    /**
     * Output.
     *
     * @param  string|array $value
     * @return string
     */
    public function output($value = null)
    {
        return Cuztom::view('fields/'.$this->view, array(
            'tabs'  => $this,
            'value' => $value,
            'type'  => $this->type
        ));
    }

    /**
     * Save.
     *
     * @param int   $object
     * @param array $values
     */
    public function save($object, $values)
    {
        foreach ($this->data as $tab) {
            $tab->save($object, $values);
        }
    }

    /**
     * Substract value.
     *
     * @param  array        $values
     * @return string|array
     */
    public function substractValue($values)
    {
        return $values;
    }

    /**
     * Build.
     *
     * @param array        $data
     * @param string|array $value
     */
    public function build($args)
    {
        foreach ($this->panels as $panel) {
            $tab = new Tab(
                array_merge($panel, array('parent' => $this)),
                $this->value
            );

            $tab->metaType = $this->metaType;
            $tab->object   = $this->object;
            $tab->tabsType = $this->type;

            $data[$tab->id] = $tab;
        }

        return $data;
    }
}
