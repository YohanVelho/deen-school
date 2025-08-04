<?php

namespace App\Http\Controllers\Admin;

use App\Models\ModulesModel;

class ModuleController extends GenericController
{

    function __construct()
    {
        $this->model = ModulesModel::class;

        $this->title = 'Módulos';

        $this->sortable = 'position';

        $this->search = 'name';

        $this->includes = 'parent';

        $this->table = [
            [
                'label' => '#',
                'name' => 'id',
                'size' => 50
            ],
            [
                'label' => 'Nome',
                'name' => 'name'
            ],
            [
                'label' => 'Pai',
                'name' => ['parent','name']
            ]
        ];

        $modules = ModulesModel::get()->toArray();
        $modules = array_map(function ($value) {
            return [
                'value' => $value['id'],
                'description' => $value['name'],
            ];
        }, $modules);

        $this->form = [
            [
                'title' => 'Dados',
                'icon' => 'person',
                'inputs' => [
                    [
                        'label' => 'Nome',
                        'name' => 'name',
                        'validators' => ['required','max:100']
                    ],
                    [
                        'input' => 'select',
                        'label' => 'Pai',
                        'name' => 'parent',
                        'data' => $modules
                    ],
                    [
                        'label' => 'Controller',
                        'name' => 'controller',
                        'size' => 6
                    ],
                    [
                        'label' => 'URL',
                        'name' => 'url',
                        'size' => 6
                    ],

                    [
                        'label' => 'Ícone',
                        'name' => 'icon',
                        'size' => 6,
                        'validators' => ['required']
                    ],
                    [
                        'input' => 'checkbox',
                        'name' => 'crud',
                        'label' => 'CRUD',
                        'size' => 2
                    ],
                    [
                        'input' => 'checkbox',
                        'name' => 'action',
                        'label' => 'Ação',
                        'size' => 2,
                        'default' => false
                    ],
                    [
                        'input' => 'checkbox',
                        'name' => 'active',
                        'label' => 'Ativo',
                        'size' => 2,
                    ]
                ]
            ]
        ];
    }
}
