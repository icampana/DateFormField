<?php
/**
 * @package   ImpressPages
 */

namespace Plugin\DateFormField;

/**
 * Main field class responsible to render the field.
 * Class DateField
 * @package Plugin\DateFormField
 */
class DateField extends \Ip\Form\Field
{

    public function render($doctype, $environment) {
        return '<input placeholder="Y-m-d" class="form-control date-field '.implode(' ',$this->getClasses()).'" name="'.htmlspecialchars($this->getName()).'" value="'.htmlspecialchars($this->getValue()).'" '.$this->getAttributesStr($doctype).' '.$this->getValidationAttributesStr($doctype).'  />';
    }

    /**
     * CSS class that should be applied to surrounding element of this field.
     * By default empty. Extending classes should specify their value.
     */
    public function getTypeClass() {
        return 'date-field';
    }
}
