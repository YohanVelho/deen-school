<?php

namespace App\Http\Controllers\Admin;

use App\Models\TranslationsModel;

class TranslationsController extends GenericController
{

    function __construct()
    {
        $this->model = TranslationsModel::class;

        $this->title = 'Translate';

        $this->search = 'name';

        $this->translate = true;

        $this->table = [
            [
                'label' => '#',
                'name' => 'id',
                'size' => 50
            ],
            [
                'label' => 'Nome',
                'name' => 'name'
            ]
        ];

        $this->form = [
            [
                'inputs' => [
                    [
                        'label' => 'Lingua',
                        'name' => 'name2',
                        'validators' => ['required'],
                    ],
                    [
                        'label' => 'Lingua',
                        'name' => 'name',
                        'validators' => ['required'],
                        'translate' => true
                    ],
                    [
                        'label' => 'Lingua',
                        'name' => 'text',
                        'translate' => true,
                        'input' => 'textarea',
                        'inline' => true
                    ]
                ]
            ]
        ];
    }
}
