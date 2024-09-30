<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine se o usuário está autorizado a fazer está solicitação 
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define as regras de validação para a solicitação de login
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // O campo 'email' deve ser preenchido e conter um e-mail válido
            'email' => 'required|email',
            // O campo 'password' deve ser preenchido 
            'password' => 'required',
        ];
    }

    // Define as mensagens de erros personalizadas para a validação
    public function messages(): array{

        return[
            // Mensagem para quando o campo 'email' não for preenchido
            'email.required' => 'Campo e-mail é obrigatório!',
            // Mensagem para quando o campo 'email' não contiver um endereço de e-mail válido
            'email.email' => 'Necessário enviar e-mail válido!',
            // Mensagem para quando o campo 'password' não for preenchido 
            'password.required' => 'Campo senha é obrigatório!',
        ];
    }
}
