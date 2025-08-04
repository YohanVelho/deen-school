<?php

namespace App\Http\Controllers\Admin;

use App\Models\RecoveryModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{

    public function index(Request $request)
    {
        if(session('user')){
            return redirect(route('admin.dashboard'));
        }

        if($request->isMethod('post')){

            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required']
            ]);

            $user = UserModel::where('email', $request->input('email'))->first();

            if($user){
                $user = $user->makeVisible('password')->toArray();
                if(password_verify($request->input('password'), $user['password'])){
                    unset($user['password']);
                    session([
                        'user' => $user
                    ]);
                    return redirect(route('admin.dashboard'));
                }
            }

            return redirect(route('admin.login'))->with('alert','Usuário ou Senha Inválidos!');
        }

        return view("admin.pages.login.index");
    }

    public function logout()
    {
        session(['user' => null]);
        return redirect(route('admin.login'));
    }

    public function recovery(Request $request)
    {
        if(session('user')){
            return redirect(route('admin.dashboard'));
        }

        if($request->isMethod('post')){

            $request->validate([
                'email' => ['required', 'email']
            ]);

            $user = UserModel::where('email', $request->input('email'))->first();

            if($user){
                $token = md5(date('dmYHisu').rand(0,100));
                $recovery = new RecoveryModel([
                    'token' => $token,
                    'user' => $user['id'],
                    'expires' => date('Y-m-d H:i:s', strtotime('+1 day')),
                    'used' => false
                ]);
                $recovery->save();

                $url = route('admin.login.reset', ['token' => $token]);
                $html = 'Olá,<br><br>Para cadastrar sua nova senha acesse o link abaixo:<br>';
                $html .= '<a href="'.$url.'">'.$url.'</a>';

                Mail::html($html, function($call) use ($user){
                    $call->to($user['email'], $user['name'])
                         ->subject('Recuperação de Senha');
                });

                return redirect(route('admin.login.recovery'))
                    ->with('alert','Um e-mail com instruções de recuperação foi enviado!');
            }

            return redirect(route('admin.login.recovery'))
                ->with('alert','O e-mail não foi localizado!');
        }

        return view("admin.pages.login.recovery");
    }


    public function reset(Request $request)
    {
        if(session('user')){
            return redirect(route('admin.dashboard'));
        }

        if($request->isMethod('post')){

            $request->validate([
                'password' => ['confirmed', 'required', 'min:6']
            ]);

            $token = $request->route('token');

            $recovery = RecoveryModel::where('used', 0)->where('expires', '>', date('Y-m-d H:i:s'))->where('token', $token)->first();

            if($recovery){
                $user = UserModel::where('id', $recovery['user'])->first();
                $user->password = $request->input('password');
                $user->save();

                $recovery->used = true;
                $recovery->save();

                return redirect(route('admin.login'))
                    ->with('alert','Senha alterada com sucesso! Realize seu login abaixo');
            }

            return redirect(route('admin.login.reset', ['token' => $token]))
                ->with('alert','O token não foi localizado ou já expirou! Solicite novamente a recuperação de senha!');

        }

        return view("admin.pages.login.reset");
    }

}
