<?php
/**
 * @package   ImpressPages
 */

namespace Plugin\DateFormField;


class SiteController
{

    /**
     * Render example form with date field
     * Access this controller by visiting example.com?sa=DateFormField
     * @return string
     */
    public function index()
    {
        $content = '';

        $content .= ipRenderWidget('Heading', array('title' => 'Example usage'));

        $form = new \Ip\Form();

        $field = new \Plugin\DateFormField\DateField(
            array(
                'name' => 'inputFieldName', // HTML "name" attribute
                'label' => 'Set something to a date', // Field label that will be displayed next to input field
                'value' => date('Y-m-d', time()) //1 means on by default
            ));
        $form->addField($field);

        $field = new \Ip\Form\Field\Submit (
            array(
                'value' => 'Submit', // HTML "name" attribute
            ));
        $form->addField($field);

        $content .= $form->render();

        return $content;

    }
}
