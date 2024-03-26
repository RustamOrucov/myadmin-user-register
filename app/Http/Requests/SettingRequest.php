<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        $data = [
            'logo' => [ 'nullable','mimetypes:image/jpeg,image/png,image/webp,image/avif,image/svg'],
            'favicon' => [ 'nullable','mimetypes:image/jpeg,image/png,image/webp,image/avif,image/svg'],

        ];
        return $this->mapLanguageValidations($data);
    }
    public function messages(): array
    {
        $messages = [];
        foreach (config('app.languages') as $lang) {
            $messages["$lang.name.required"] = "  $lang Name sahəsi məcburidir.";
            $messages["$lang.name.string"] = "  $lang Name sahəsi məcburidir.";
            $messages["$lang.name.max"] = " $lang Name sahəsi ən çox 255 simvol ola bilər.";
            $messages["$lang.text.string"] = "$lang təsvir sahəsi bir mətn olmalıdır.";
            $messages["$lang.text.max"] = "$lang təsvir sahəsi ən çox :max simvol ola bilər.";
            $messages["$lang.title.string"] = "$lang SEO başlıq sahəsi bir mətn olmalıdır.";
            $messages["$lang.title.max"] = "$lang SEO başlıq sahəsi ən çox :max simvol ola bilər.";
            $messages["$lang.seo_key.string"] = "$lang SEO açar sözlər sahəsi bir sətir olmalıdır.";
            $messages["$lang.seo_key.max"] = "$lang SEO açar sözlər sahəsi ən çox :max simvol ola bilər.";
        }
        return $messages;
    }
    private function mapLanguageValidations($data)
    {
        foreach (config('app.languages') as $lang) {
            $data[$lang] = 'required|array';
            $data["$lang.name"] = 'string|max:500';
            $data["$lang.title"] = 'nullable|string|max:400';
            $data["$lang.text"] = 'nullable|string|max:500';
            $data["$lang.seo_key"] = 'nullable|string|max:500';

        }
        return $data;
    }
}
