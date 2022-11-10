<?php
declare(strict_types=1);

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

final class CreateTransactionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'coin' => 'required|string',
            'amount' => 'required|string',
            'type' => 'required|string',
        ];
    }
}
