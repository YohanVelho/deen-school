<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lesson;

class LessonController extends GenericController
{

    function __construct()
    {
        $this->model = Lesson::class;

        $this->title = 'Aulas';

        $this->search = 'name';

        $this->sortable = 'sort';

        $this->fk = 'playlist_id';


        $this->table = [
            [
                'label' => 'Nome',
                'name' => 'name'
            ],

        ];

        $this->form = [
            [
                'title' => 'Aula',
                'icon' => 'list',
                'active' => 'active',
                'inputs' => [
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
                        'label' => 'Video',
                        'name' => 'video',
                    ],
                    [
                        'label' => 'Conteúdo de apoio',
                        'name' => 'content',
                        'richtext' => true,
                        'input' => 'textarea'
                    ],
                ]
            ],
        ];
    }
}
