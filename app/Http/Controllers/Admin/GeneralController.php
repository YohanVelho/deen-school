<?php

namespace App\Http\Controllers\Admin;

use App\Models\GeneralModel;
use Intervention\Image\Size;

class GeneralController extends GenericController
{
    function __construct()
    {

        parent::__construct();

        $this->model = GeneralModel::class;

        $this->title = 'Empresa';

        $this->unique = true;

        $levels = [
            [
                "id" => 1,
                "name" => "Teste"
            ]
        ];

        $this->form = [
            [
                'title' => 'Informações Gerais',
                'icon' => 'info',
                'inputs' => [
                    [
                        'input' => 'preview',
                        'link' => 'home'
                    ],
                    [
                        'label' => 'Logo',
                        'name' => 'logo',
                        'input' => 'image',
                        'folder' => 'images',
                        'size' => 6
                    ],
                    [
                        'label' => 'Favicon',
                        'name' => 'favicon',
                        'input' => 'image',
                        'folder' => 'images',
                        'size' => 6,
                        'alt' => false
                    ]
                ],
            ],
            [
                'title' => 'Contato',
                'icon' => 'phone',
                'inputs' => [
                    [
                        'label' => 'Email',
                        'name' => 'email',
                    ],
                    [
                        'label' => 'Telefone',
                        'name' => 'phone',
                        'size' => 6
                    ],
                    [
                        'label' => 'Whatsapp',
                        'name' => 'whatsapp',
                        'size' => 6
                    ]
                ]
            ],
            [
                'title' => 'Redes Sociais',
                'icon' => 'info',
                'inputs' => [
                    [
                        'label' => 'Facebook',
                        'name' => 'facebook',
                        'size' => 6
                    ],
                    [
                        'label' => 'Instagram',
                        'name' => 'instagram',
                        'size' => 6
                    ],
                    [
                        'label' => 'Youtube',
                        'name' => 'youtube',
                        'size' => 6
                    ],
                    [
                        'label' => 'Linkedin',
                        'name' => 'linkedin',
                        'size' => 6
                    ]
                ],
            ],
            [

                'title' => 'Scripts',
                'icon' => 'code',
                'inputs' => [
                    [
                        'label' => 'Head',
                        'name' => 'script_head',
                        'input' => 'textarea',
                        'richtext' => false
                    ],
                    [
                        'label' => 'Body',
                        'name' => 'script_body',
                        'input' => 'textarea',
                        'richtext' => false
                    ],
                    [
                        'label' => 'Footer',
                        'name' => 'script_footer',
                        'input' => 'textarea',
                        'richtext' => false
                    ],
                ],
            ],
        ];
    }
}
