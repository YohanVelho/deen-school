<?php

namespace App\Http\Controllers\Admin;

use App\Models\NewsletterModel;

class NewsletterController extends GenericController
{
    function __construct()
    {

        parent::__construct();

        $this->model = NewsletterModel::class;

        $this->title = 'Newsletter';

        $this->add = false;
        $this->edit = false;

        $this->search = ['name', 'email'];

        $this->order = ['created_at','desc'];

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
                'label' => 'Email',
                'name' => 'email'
            ]
        ];

        $this->export = $this->table;

        $this->view = [
            [
                'title' => 'Email',
                'icon' => 'email',
                'inputs' => [
                    [
                        'label' => 'Nome',
                        'name' => 'name',
                        'size' => 6
                    ],
                    [
                        'label' => 'Data',
                        'name' => 'created_at',
                        'size' => 6,
                    ],
                    [
                        'label' => 'Email',
                        'name' => 'email',
                        'size' => 6
                    ],
                ]
            ]
        ];
    }
}
