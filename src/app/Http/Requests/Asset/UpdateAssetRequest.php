<?php

namespace App\Http\Requests\Asset;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateAssetRequest",
 *     required={"name", "status"},
 *     @OA\Property(property="name", type="string", example="Iphone SE"),
 *     @OA\Property(property="status", type="integer"),
 * )
 */

class UpdateAssetRequest extends FormRequest
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
        return [
            'name' => 'sometimes|string|max:255',
            'status' => 'sometimes|integer',
            'code' => 'prohibited'
        ];
    }
}
