<?php

namespace App\Http\Controllers\Admin;

use App\Models\SeoModel;

class SeoController extends GenericController
{
    function __construct()
    {
        parent::__construct();

        $this->model = SeoModel::class;

        $this->title = 'SEO';

        $this->table = [
            [
                'label' => 'Link',
                'name' => 'link'
            ],
            [
                'label' => 'Título',
                'name' => 'title'
            ]
        ];

        $this->form = [
            [
                'title' => 'Seo',
                'icon' => 'dashboard',
                'inputs' => [
                    [
                        'label' => 'Link',
                        'name' => 'link',
                    ],
                    [
                        'label' => 'Título',
                        'name' => 'title'
                    ],
                    [
                        'label' => 'Descrição',
                        'name' => 'description'
                    ],
                    [
                        'label' => 'Palavras-chave',
                        'name' => 'keywords',
                        'input' => 'tags'
                    ],
                    [
                        'label' => 'Canonical Tag',
                        'name' => 'canonical'
                    ],
                    [
                        'label' => 'Imagem (compartilhamento Facebook):',
                        'name' => 'seo_img',
                        'input' => 'image',
                        'folder' => 'seo_img'
                    ],
                ],
            ],
        ];
    }
}
