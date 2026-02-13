<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreMessageRequest extends FormRequest
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
    // $exception = $validator->getException();

    // throw (new $exception($validator))
    //   ->errorBag($this->errorBag)
    //   ->redirectTo($this->getRedirectUrl());

    if ($this->is('api/*')) {
      $resposne = ApiResponse::sendResponse('Validation errors', $validator->errors(), 422);

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
      'name' => 'required|min:3',
      'email' => ['required', 'email', 'unique', 'email:rfc,dns'],
      'message' => 'required',
      'phone' => 'required',
      // 'status' => ['required', 'boolean'],
    ];
  }
}
