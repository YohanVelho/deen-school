<?php

namespace App\Http\Controllers\Admin;

use App\Models\TranslateModel;

class TranslateController extends GenericController
{

    function __construct()
    {
        $this->model = TranslateModel::class;

        $this->title = 'Tradução';

        $this->search = 'name_pt';

        $this->translate = true;

        $this->table = [
            [
                'label' => '#',
                'name' => 'id',
                'size' => 50
            ],
            [
                'label' => 'Nome',
                'name' => 'name_pt'
            ]
        ];

        $this->form = [
            [
                'title' => 'Translate',
                'icon' => 'swap_vert',
                'active' => 'active',
                'inputs' => [
                    [
                        'label' => 'Lingua',
                        'name' => 'name',
                        'validators' => ['required'],
                        'translate' => true
                    ]
                ]
            ],
            [
                'title' => 'SEO',
                'icon' => 'code',
                'inputs' => [
                    [
                        'input' => 'seo',
                        'route' => '',
                        'slug' => '',
                        'title' => '',
                        'description' => '',
                        'image' => '',
                        'translate' => true
                    ]
                ]
            ]
        ];

        $this->tabs = [
            [
                'title' => 'Base',
                'icon' => 'person',
                'form' => [
                    [
                        'title' => 'Base',
                        'icon' => 'person',
                        'active' => 'active',
                        'inputs' => [
                            [
                                'label' => 'Todos',
                                'name' => 'base',
                                'validators' => ['required']
                            ]
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Table',
                'icon' => 'table_view',
                'form' => [
                    [
                        'title' => 'Table',
                        'icon' => 'table',
                        'inputs' => [
                            [
                                'name' => 'teste',
                                'input' => 'table',
                                'model' => TranslateModel::class,
                                'fk' => 'number',
                                'sortable' => 'position',
                                'inputs' => [
                                    [
                                        'input' => 'hidden',
                                        'name' => 'id'
                                    ],
                                    [
                                        'label' => 'Descrição',
                                        'name' => 'description',
                                        'translate' => true
                                    ],
                                ]

                            ],
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Galeria',
                'icon' => 'image',
                'form' => [
                    [
                        'title' => 'Galeria',
                        'icon' => 'image',
                        'inputs' => [
                            [
                                'name' => 'gallery',
                                'input' => 'gallery',
                                'model' => FastKnowGalleryModel::class,
                                'fk' => 'know',
                                'image' => 'image',
                                'sortable' => 'position',
                                'folder' => 'know_gallery'
                            ],
                        ]
                    ]
                ]
            ]
        ];
    }
}
