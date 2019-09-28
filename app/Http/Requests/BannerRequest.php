<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'image' => 'required|max:255',

        ];
    }

    public function messages()
    {
        return [
            'image.max' => 'Độ dài đường dẫn hình ảnh tối đa là 255',
            'image.required' => 'Bạn chưa nhập hình ảnh banner'
        ];
    }
}
