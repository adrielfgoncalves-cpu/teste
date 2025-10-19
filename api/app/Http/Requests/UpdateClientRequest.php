<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $clientId = $this->route()->parameter('client');
        //dd ($clientId);
        return [
            'nome' => "required",
            "email" => "required|email|unique:clientes,email,{$clientId}", //se for email do proprio usuario, permite atualizar
            'telefone' => "required",
            'endereco' => "required",
        ];
    }
}
