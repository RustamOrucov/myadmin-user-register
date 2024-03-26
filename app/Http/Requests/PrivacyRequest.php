<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrivacyRequest extends FormRequest
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
        ];
             return $this->mapLanguageValidations($data);
    }
    public function messages(): array
    {
        $messages = [];
        foreach (config('app.languages') as $lang) {
            $messages["$lang.text.string"] = "$lang təsvir sahəsi bir mətn olmalıdır.";
            $messages["$lang.text.max"] = "$lang təsvir sahəsi ən çox :max simvol ola bilər.";

        }
        return $messages;
    }
    private function mapLanguageValidations($data)
    {
        foreach (config('app.languages') as $lang) {
            $data[$lang] = 'required|array';
            $data["$lang.text"] = 'nullable|string|max:500';

        }
        return $data;
    }
}
