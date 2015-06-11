<?php

namespace Plugin\DateFormField;

class GridDateField extends \Ip\Internal\Grid\Model\Field
{



    /**
     * Generate field value preview for table view. HTML is allowed
     * @param array() $data current record data
     * @return string
     */
    public function preview($recordData)
    {
        if (is_numeric($recordData[$this->field])) {
            return date('Y-m-d', $recordData[$this->field]);
        } else {
            return date('Y-m-d');
        }
    }


    /**
     * Return an object which can be used as a field for standard Ip\Form class.
     * @return \Ip\Form\Field
     */
    public function createField()
    {
        $field = new \Plugin\DateFormField\DateField(array(
            'label' => $this->label,
            'name' => $this->field
        ));
        $field->setValue( $this->defaultValue );
        return $field;
    }

    /**
     * Grid doesn't put user's input directly into the database. Each field type decides how to process
     * submitted data. Use this method to process submitted data and return associative array of values to be
     * stored to the database. If you need to do some other actions on other tables or process files after new
     * record has been created, use onCreate method.
     * @param $postData user posted data
     * @return array
     */
    public function createData($postData)
    {
        if (isset($postData[$this->field])) {
            return array($this->field => (int) strtotime ($postData[$this->field]));
        }
        return array();
    }

    /**
     * Return an object which can be used as a field for standard Ip\Form class.
     * @param $curData current record data
     * @return \Ip\Form\Field
     */
    public function updateField($curData)
    {
        $timestamp = (int) $curData[$this->field];
        
        if ($timestamp == 0){
            $timestamp = time();
        }
        
        $field = new \Plugin\DateFormField\DateField(array(
            'label' => $this->label,
            'name' => $this->field
        ));
        $field->setValue( date('Y-m-d', $timestamp));
        return $field;
    }

    /**
     * Grid doesn't put user's input directly into the database. Each field type decides how to process
     * submitted data. Use this method to process submitted data and return associative array of values to be
     * stored to the database. If you need to do some other actions on other tables or process files after update, use onUpdate method.
     * @param $postData user posted data
     * @return array
     */
    public function updateData($postData)
    {
        $timestamp = strtotime( $postData[$this->field] );
        
        return array($this->field => (int) $timestamp);
    }

    /**
     * Return an object which can be used as a field for standard Ip\Form class.
     * @param array $searchVariables current search filter values
     * @return \Ip\Form\Field
     */
    public function searchField($searchVariables)
    {
        $field = new \Plugin\DateFormField\DateField(array(
            'label' => $this->label,
            'name' => $this->field
        ));
        if (!empty($searchVariables[$this->field])) {
            $field->setValue($searchVariables[$this->field]);
        }
        return $field;
    }

    /**
     * Process entered search values and provide part of SQL query which can be added in WHERE clause.
     * @param array $searchVariables user's posted search values
     * @return string
     */
    public function searchQuery($searchVariables)
    {
        if (isset($searchVariables[$this->field]) && $searchVariables[$this->field] !== '') {
            //$searchVariables['start_date'];
            //$searchVariables['end_date'];
            
            return ' `' . $this->field . '` = '. $searchVariables[$this->field];
        }
    }

}

