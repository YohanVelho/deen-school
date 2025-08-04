<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trail;

class TrailController extends GenericController
{

    function __construct()
    {
        $this->model = Trail::class;

        $this->title = 'Trilha';

        $this->search = 'name';

        $this->sortable = 'sort';

        $this->includes = ['courses'];

        $this->table = [
            [
                'label' => 'Imagem',
                'name' => 'image',
                'type' => 'image'
            ],
            [
                'label' => 'Nome',
                'name' => 'name'
            ],
            [
                'label' => 'Cursos',
                'name' => ['courses','name'],
                'count' => 'courses'
            ],
            
        ];


        $this->form = [
            [
                'title' => 'Trilha',
                'icon' => 'list',
                'active' => 'active',
                'inputs' => [
                    [
                        'label' => 'Imagem',
                        'name' => 'image',
                        'alt' => false,
                        'input' => 'image'
                    ],
                    [
                        'label' => 'Nome',
                        'name' => 'name',
                        'validators' => ['required'],
                    ],
                    [
                        'label' => 'Descrição',
                        'name' => 'desc',
                    ],
                    [
                        'label' => 'Cursos',
                        'link' => 'admin.courses',
                        'input' => 'link',
                        'size' => 6,
                        'fk' => true
                    ],
                ]
            ],
        ];
    }
}
