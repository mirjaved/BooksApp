<?php

namespace Book\Form;

use Zend\Form\Form;
use Book\Entity\Book;
use Book\Entity\Author;

class BookForm extends Form
{    
    public function __construct()
    {
        // Define form name
        parent::__construct('bookForm');

        // Set POST method for this form
        $this->setAttribute('method', 'POST');

        $this->addElements();
    }
    
    /**
     * This method adds elements to form (input fields and submit button).
     */
    protected function addElements() 
    {
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
            'name' => 'author_id',
            'type' => 'Text',
            'attributes' => [
                'id' => 'author_id'
            ],
            'options' => [
                'label' => 'Author',
            ],
        ]);

        // $this->add([
        //     'type'  => 'select',
        //     'name' => 'author_id',
        //     'attributes' => [                
        //         'id' => 'author_id'
        //     ],
        //     'options' => [
        //         'label' => 'Author',
        //         'value_options' => [
        //             '' => '',
        //         ]
        //     ],
        // ]);

        $this->add([
            'name' => 'category_id',
            'type' => 'Text',
            'attributes' => [
                'id' => 'category_id'
            ],
            'options' => [
                'label' => 'Category',
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