<?php
/**
 * @author Manuel Stosic <manuel.stosic@krankikom.de>
 */

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class FormWithTwoSelects extends Form implements InputFilterProviderInterface
{
    public function init()
    {
        $this->add([
            'type'       => 'select',
            'name'       => 'parent',
            'attributes' => [
                'id'    => 'select-parent',
                'class' => 'form-control'
            ],
            'options'    => [
                'label'         => 'Parent Select',
                'empty_option'  => '-- please make a selection --',
                'value_options' => [
                    ['value' => 1, 'label' => '00 - 09', 'attributes' => ['data-key' => '0x']],
                    ['value' => 2, 'label' => '10 - 19', 'attributes' => ['data-key' => '1x']],
                    ['value' => 3, 'label' => '20 - 29', 'attributes' => ['data-key' => '2x']],
                ]
            ]
        ]);

        $this->add([
            'type'       => 'select',
            'name'       => 'child',
            'attributes' => [
                'id'    => 'select-child',
                'class' => 'form-control'
            ],
            'options'    => [
                'label'         => 'Child Select',
                'empty_option'  => '-- choose parent first --',
                'value_options' => [
                    ['value' => 0, 'attributes' => ['data-key' => '0x'], 'label' => 'zero'],
                    ['value' => 1, 'attributes' => ['data-key' => '0x'], 'label' => 'one'],
                    ['value' => 2, 'attributes' => ['data-key' => '0x'], 'label' => 'two'],
                    ['value' => 3, 'attributes' => ['data-key' => '0x'], 'label' => 'three'],
                    ['value' => 4, 'attributes' => ['data-key' => '0x'], 'label' => 'four'],
                    ['value' => 5, 'attributes' => ['data-key' => '0x'], 'label' => 'five'],
                    ['value' => 6, 'attributes' => ['data-key' => '0x'], 'label' => 'six'],
                    ['value' => 7, 'attributes' => ['data-key' => '0x'], 'label' => 'seven'],
                    ['value' => 8, 'attributes' => ['data-key' => '0x'], 'label' => 'eight'],
                    ['value' => 9, 'attributes' => ['data-key' => '0x'], 'label' => 'nine'],
                    ['value' => 10, 'attributes' => ['data-key' => '1x'], 'label' => 'ten'],
                    ['value' => 11, 'attributes' => ['data-key' => '1x'], 'label' => 'eleven'],
                    ['value' => 12, 'attributes' => ['data-key' => '1x'], 'label' => 'twelve'],
                    ['value' => 13, 'attributes' => ['data-key' => '1x'], 'label' => 'thirteen'],
                    ['value' => 14, 'attributes' => ['data-key' => '1x'], 'label' => 'fourteen'],
                    ['value' => 15, 'attributes' => ['data-key' => '1x'], 'label' => 'fifteen'],
                    ['value' => 16, 'attributes' => ['data-key' => '1x'], 'label' => 'sixteen'],
                    ['value' => 17, 'attributes' => ['data-key' => '1x'], 'label' => 'seventeen'],
                    ['value' => 18, 'attributes' => ['data-key' => '1x'], 'label' => 'eighteen'],
                    ['value' => 19, 'attributes' => ['data-key' => '1x'], 'label' => 'nineteen'],
                    ['value' => 20, 'attributes' => ['data-key' => '2x'], 'label' => 'twenty'],
                    ['value' => 21, 'attributes' => ['data-key' => '2x'], 'label' => 'twenty-one'],
                    ['value' => 22, 'attributes' => ['data-key' => '2x'], 'label' => 'twenty-two'],
                    ['value' => 23, 'attributes' => ['data-key' => '2x'], 'label' => 'twenty-three'],
                    ['value' => 24, 'attributes' => ['data-key' => '2x'], 'label' => 'twenty-four'],
                    ['value' => 25, 'attributes' => ['data-key' => '2x'], 'label' => 'twenty-five'],
                    ['value' => 26, 'attributes' => ['data-key' => '2x'], 'label' => 'twenty-six'],
                    ['value' => 27, 'attributes' => ['data-key' => '2x'], 'label' => 'twenty-seven'],
                    ['value' => 28, 'attributes' => ['data-key' => '2x'], 'label' => 'twenty-eight'],
                    ['value' => 29, 'attributes' => ['data-key' => '2x'], 'label' => 'twenty-nine'],
                ]
            ]
        ]);

        $this->add([
            'type'       => 'submit',
            'name'       => 'submit',
            'attributes' => [
                'value' => 'submit'
            ]
        ]);
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return [
            'child' => [
                'validators' => [
                    ['name' => 'callback', 'options' => [
                        'callback' => function ($value, $context) {
                            /**
                             * !!! IMPORTANT !!!
                             * !!! In a real-life-scenario you would likely do a database query here to find out if the
                             * !!! value of the second select-list is allowed within the scope of the first select list.
                             * !!! IMPORTANT !!!
                             *
                             * $value             = Value of #select-child
                             * $context['parent'] = Value of #select-parent
                             *
                             * We simplify this with an inline-array-map
                             */
                            $allowedMapping = [
                                1 => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                                2 => [10, 11, 12, 13, 14, 15, 16, 17, 18, 19],
                                3 => [20, 21, 22, 23, 24, 25, 26, 27, 28, 29],
                            ];

                            return in_array($value, $allowedMapping[$context['parent']]);
                        }
                    ]]
                ]
            ]
        ];
    }
}