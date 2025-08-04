<?php

namespace App\Http\Controllers\Admin;

use App\Models\LanguageModel;

class LanguageController extends GenericController
{
    function __construct()
    {

        parent::__construct();

        $this->model = LanguageModel::class;

        $this->title = 'Línguas';

        $this->sortable = 'position';

        //$this->add = false;

        $this->delete = false;

        $this->table = [
            [
                'label' => '#',
                'name' => 'id',
                'size' => 50
            ],
            [
                'label' => 'Sigla',
                'name' => 'slug',
                'size' => 100
            ],
            [
                'label' => 'Nome',
                'name' => 'name'
            ]
        ];

        $this->form = [
            [
                'title' => 'Dados',
                'icon' => 'info',
                'inputs' => [
                    [
                        'label' => 'Nome',
                        'name' => 'name',
                        'size' => 8
                    ],
                    [
                        'label' => 'Slug',
                        'name' => 'slug',
                        'size' => 4
                    ],
                    [
                        'label' => 'Ícone',
                        'name' => 'logo',
                        'input' => 'image',
                        'folder' => 'images',
                        'size' => 8,
                        'alt' => false
                    ],
                    [
                        'label' => 'Ativo',
                        'name' => 'active',
                        'input' => 'checkbox',
                        'size' => 4
                    ]
                ],
            ],
        ];
    }
}
