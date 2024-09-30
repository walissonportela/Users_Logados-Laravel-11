<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    // Carregar a página de login
    public function index(){
        return view('login.index');
    }

    // Logar o usuário
    public function loginProcess(LoginRequest $request)
    {
        // Valida os dados de usuário usando a classe LoginRequest
        $request->validated();

        // Tenta auneticar o usuário usando o email e a senha fornecidos
        $authenticated = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        // Verifica se a autenticação falhou
        if(!$authenticated){

            // Redireciona de volta para o formulário de login com a mensagem de erro
            return back()->withInput()->with('error', 'E-Mail ou senha inválido!');
        }

        // Recupera o usuário autenticado do banco de dados
        $user = User::where('id', Auth::id())->first();

        // Atualiza o campo last_active_at com a data e hora atuais
        $user->update(['last_active_at' => Carbon::now()]);

        // Redirecionando o usuário autenticado para o dashboard
        return redirect()->route('dashboard.index');
    }

    public function updateLastActive()
    {

        // Recupera o usuário logado do banco de dados
        $user = User::where('id', Auth::id())->first();

        // Verifica se o usuário foi encontrado
        if($user){
            // Atualiza o campo last_archive_at do usuário com datas e horas atuais
            $user->update(['last_archive_at' => Carbon::now()]);

            // Registra um log informativo da atualização do last_archive_at
            Log::info('last_archive_at atualizado.', [
                'user_id' => $user->id,
                'last_active-at' => $user->last_active_at, // Valor antes da atualização
                'lats_active_at' => Carbon::now(), // Valor atualizado
            ]);

            // Conta o número de usuários ativos nos últimos 1 minuto
            $activeUsers = User::where('last_active_at', '>=', Carbon::now()->subMinutes(1)->count());

            // Retorna uma mensagem JSON com o status de sucesso e o número de usuários ativos
            return response()->json(['status' => 'success', 'activeUsers' => $activeUsers]);
        }

        // Retorna uma resposta JSON com status de erro se o usuário não foi encontrado
        return response()->json(['status' => 'error'], 401);
    }

    // Deslogar o usuário 
    public function destroy()
    {
        // Recupera o usuário autenticado do banco de dados
        $user = User::where('id', Auth::id())->first();

        // Atualiza o campo last_active_at com a data e hora atuais
        $user->update(['last_active_at' => null]);
        
        // Deslogar o usuário
        Auth::logout();

        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('login.index')->with('success', 'Deslogado com sucesso!');
    }
}
