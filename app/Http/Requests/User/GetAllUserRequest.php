<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GetAllUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $fillables = implode(',', (new User())->getFillable());
        return [
            'q'               => 'sometimes|string|min:1|max:100',
            'sleep'           => 'sometimes|integer|min:100|max:5000',
            'simulate_throw'  => 'sometimes|bool',
            'order_by'        => "sometimes|string|in:$fillables",
            'order_direction' => 'sometimes|string|in:asc,desc',
            'per_page'        => 'sometimes|integer|min:1|max:500',
            'page'            => 'sometimes|integer|min:1',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'  => 'error',
            'message' => 'Os dados fornecidos são inválidos!',
            'errors'  => $validator->errors(),
        ], 422));
    }
}
