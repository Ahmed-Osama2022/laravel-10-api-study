<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class UpdateAdRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  protected function failedValidation(Validator $validator)
  {
    if ($this->is('api/*')) {
      // $resposne = ApiResponse::sendResponse('Validation errors', $validator->errors(), 422);

      // OR (With errors messages only)!
      $resposne = ApiResponse::sendResponse('Validation errors', $validator->messages()->all(), 422);

      throw new ValidationException($validator, $resposne);
    }
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    /**
     * NOTE:
     * For PATCH request use this
     *  return [
     *   'title' => 'sometimes|required|min:3',
     *   'text' => 'sometimes|required',
     *   'phone' => 'sometimes|required',
     *   'status' => ['sometimes', 'required', 'boolean'],
     *   'domain_id' => 'sometimes|required|exists:domains,id',
     * ];
     * ||=======================================================||
     * But for PUT request use this:
     *  return [
     *    'title' => 'sometimes|min:3',
     *    'text' => 'sometimes',
     *    'phone' => 'sometimes',
     *    'status' => ['sometimes', ', 'boolean'],
     *    'domain_id' => 'sometimes|exists:domains,id',
     *   ];
     *
     */

    return [
      'title' => 'sometimes|min:3',
      'text' => 'sometimes|required|',
      'phone' => 'sometimes|required|min:10',
      'status' => ['sometimes', 'required', 'boolean'],
      'domain_id' => 'sometimes|required|exists:domains,id',
    ];
  }
}
