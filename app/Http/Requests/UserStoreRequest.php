<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;

class UserStoreRequest extends FormRequest
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
            'name'=>['required'],
            'surname'=>['required'],
            'email'=>['required', 'email', 'unique:users'],
            'password'=>['required',\Illuminate\Validation\Rules\Password::min(3)->symbols()->mixedCase()->numbers()],
            'phone'=>['nullable','size:7'],
            'img' => [ 'nullable','mimetypes:image/jpeg,image/png,image/webp,image/avif,image/svg'],
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Adınızı qeyd edin',
            'surname.required'=>'Soyadınızı qeyd edin',
            'img.mimetypes'=>'Şəkil formatını düzgün daxil edin',
            'email.required'=>'Email yazın',
            'email.email'=>'Email düzgün qeyd edin',
            'phone.size'=>'Nömrəni düzgün daxil edin',
            'email.unique' => 'Email istifadə edilmişdir',
            'password.min' => 'Password 3 simvoldan yuxarı olmalıdır',
            'password.size' => 'Password 3 simvoldan yuxarı olmalıdır',
            'password.symbols' => 'Password ən az bir simvol istifadə edilməlidir (, . / ! ? və.s)',
            'password.mixedCase' => 'Password bir ədəd böyük hərf olmalıdır',
            'password.numbers' => 'Password ən az bir rəqəm istifadə edilməlidir',
            'password.required'=>'Password boş ola bilməz'
        ];
    }
}
