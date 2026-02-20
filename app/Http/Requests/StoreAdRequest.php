<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreAdRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Handle a failed validation attempt.
   *
   * @param  \Illuminate\Contracts\Validation\Validator  $validator
   * @return void
   *
   * @throws \Illuminate\Validation\ValidationException
   */
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
    return [
      'title' => 'required|min:3',
      'text' => 'required',
      'phone' => 'required',
      'status' => ['required', 'boolean'],
      'domain_id' => 'required|exists:domains,id', // Ensure the domain_id exists in the domains table
      // 'domain_id' => 'required'
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   * @return array
   */
  public function attributes()
  {
    return [
      'title' => 'Ad title',
      'text' => 'Ad text',
      'phone' => 'Ad phone',
      'status' => 'Ad status',
      'domain_id' => 'Domain ID'
    ];
  }
}
