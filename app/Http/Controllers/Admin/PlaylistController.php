<?php

namespace App\Http\Controllers\Admin;

use App\Models\Playlist;

class PlaylistController extends GenericController
{

    function __construct()
    {
        $this->model = Playlist::class;

        $this->title = 'Playlist';

        $this->search = 'name';

        $this->sortable = 'sort';

        $this->includes = 'lessons';

        $this->fk = 'course_id';

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
                'label' => 'Aulas',
                'name' => ['lessons','count'],
                'count' => 'lessons'
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
                        'label' => 'Aulas',
                        'link' => 'admin.lesson',
                        'input' => 'link',
                        'size' => 6,
                        'fk' => true
                    ],
                ]
            ],
        ];
    }
}
