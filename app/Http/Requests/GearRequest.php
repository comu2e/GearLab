<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GearRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'gear_name' => 'required',
            'maker_name' => 'required',
            'content' => ['required','min:2'],
            'image_url' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'gear_name.required' => '登録するギアの名前を入力してください',
            'maker_name.required' => '登録するギアのメーカ名を入力してください',
            'content.min' => 'ギアのお気に入りポイントを2文字以上入力してください',
            'content.required' => 'ギアのお気に入りポイントを入力してください',
            'image_url.required' => '画像をアップロードしてください',
        ];
    }
}
