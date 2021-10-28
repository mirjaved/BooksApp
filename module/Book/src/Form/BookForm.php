<?php

namespace Book\Form;

use Zend\Form\Form;

class BookForm extends Form
{
    public function __construct($allAuthors, $allCategories)
    {
        // Define form name
        parent::__construct('bookForm');

        // Set POST method for this form
        $this->setAttribute('method', 'POST');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'title',
            'type' => 'Text',
            'attributes' => [
                'id' => 'title'
            ],
            'options' => [
                'label' => 'Title',
            ],
        ]);

        $this->add([
            'name' => 'description',
            'type' => 'Textarea',
            'attributes' => [
                'id' => 'description'
            ],
            'options' => [
                'label' => 'Description',
            ],
            'attributes' => [
                'rows' => '5',
                'cols' => '30',
            ],
        ]);

        $this->add([
            'type'  => 'select',
            'name' => 'author_id',
            'attributes' => [
                'id' => 'author_id'
            ],
            'options' => [
                'label' => 'Author',
                'value_options' => $allAuthors,
            ],
        ]);

        $this->add([
            'type'  => 'select',
            'name' => 'category_id',
            'attributes' => [
                'id' => 'category_id'
            ],
            'options' => [
                'label' => 'Category',
                'value_options' => $allCategories,
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Submit',
                'id' => 'buttonSave',
                'class' => 'btn btn-primary'
            ],
        ]);
    }
}

?>