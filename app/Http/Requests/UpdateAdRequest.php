<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdRequest extends FormRequest
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
     *    'title' => 'sometimes|required|min:3',
     *    'text' => 'sometimes|required',
     *    'phone' => 'sometimes|required',
     *    'status' => ['sometimes', 'required', 'boolean'],
     *    'domain_id' => 'sometimes|required|exists:domains,id',
     *   ];
     *
     */

    return [
      'title' => 'sometimes|required|min:3',
      'text' => 'sometimes|required',
      'phone' => 'sometimes|required',
      'status' => ['sometimes', 'required', 'boolean'],
      'domain_id' => 'sometimes|required|exists:domains,id',
    ];
  }
}
