<?php

namespace Gizburdt\Cuztom\Fields;

use Gizburdt\Cuztom\Cuztom;
use Gizburdt\Cuztom\Support\Guard;
use Gizburdt\Cuztom\Fields\Field;
use Gizburdt\Cuztom\Fields\Traits\Checkable;

Guard::directAccess();

class Checkboxes extends Field
{
    use Checkable;

    /**
     * Css class
     * @var string
     */
    public $_input_type = 'checkbox';

    /**
     * Css class
     * @var string
     */
    public $css_class = 'cuztom-input cuztom-checkbox';

    /**
     * Construct
     *
     * @param array $field
     * @since 0.3.3
     */
    public function __construct($field)
    {
        parent::__construct($field);

        $this->default_value = (array) $this->default_value;
        $this->after_name   .= '[]';
    }

    /**
     * Output input
     *
     * @param  string|array $value
     * @return string
     * @since  2.4
     */
    public function _output_input($value = null)
    {
        ob_start(); ?>

        <div class="cuztom-checkboxes-wrap">
            <?php if (is_array($this->options)) : ?>
                <?php foreach ($this->options as $slug => $name) : ?>
                    <label for="<?php echo $this->get_id(Cuztom::uglify($slug)); ?>">
                        <?php echo $this->_output_option($value, $this->default_value, $slug); ?>
                        <?php echo Cuztom::beautify($name); ?>
                    </label>
                    <br/>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php $ob = ob_get_clean(); return $ob;
    }
}