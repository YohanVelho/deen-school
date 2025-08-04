<?php

namespace App\Http\Controllers\Admin;

use App\Models\ModulesModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends GenericController
{

    function __construct(Request $request)
    {
        $this->model = UserModel::class;

        $this->title = 'Usuários';

        $this->order = 'name';

        $this->search = ['name','email'];

        $modules = ModulesModel::with('parent')->where('active', 1)->where('crud', 1)->orderBy('position')->get()->toArray();
        $modules = array_map(function($value){
            return [
                'value' => $value['id'],
                'description' => ($value['parent'] ? $value['parent']['name'].' | ' : '').$value['name'],
            ];
        }, $modules);

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
                'label' => 'E-mail',
                'name' => 'email'
            ]
        ];

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
                        'label' => 'Email',
                        'name' => 'email',
                        'size' => 10,
                        'validators' => ['required','email', Rule::unique(UserModel::class, 'email')->ignore($request->route('id'))]
                    ],
                    [
                        'input' => 'checkbox',
                        'name' => 'active',
                        'label' => 'Ativo',
                        'size' => 2,
                        'default' => true
                    ],
                    [
                        'label' => 'Senha',
                        'name' => 'password',
                        'type' => 'password',
                        'size' => 6,
                        'validators' => array_merge(['confirmed','min:6'], empty($request->route('id')) ? ['required'] : ['nullable']),
                        'hint' => 'A senha deve conter no mínimo 6 caracteres'
                    ],
                    [
                        'label' => 'Confirme a Senha',
                        'name' => 'password_confirmation',
                        'type' => 'password',
                        'size' => 6
                    ]
                ]
            ],
            [
                'title' => 'Permissões',
                'icon' => 'vpn_key',
                'inputs' => [
                    [
                        'label' => 'Permissões',
                        'name' => 'permissions',
                        'type' => 'multiple',
                        'input' => 'select',
                        'data' => $modules,
                        'hint' => 'Selecione as permissões pressionando o botão CTRL'
                    ]
                ]
            ]
        ];
    }
}
