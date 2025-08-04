<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;

class CourseController extends GenericController
{

    function __construct()
    {
        $this->model = Course::class;

        $this->title = 'Curso';

        $this->search = 'name';

        $this->sortable = 'sort';

        $this->fk = 'trail_id';

        $this->includes = ['playlist'];

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
                'label' => 'Playlist',
                'name' => ['playlist','count'],
                'count' => 'playlist'
            ],
            
        ];

        $this->form = [
            [
                'title' => 'Curso',
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
                        'label' => 'Playlist',
                        'link' => 'admin.playlist',
                        'input' => 'link',
                        'size' => 6,
                        'fk' => true
                    ],
                ]
            ],
        ];
    }
}
