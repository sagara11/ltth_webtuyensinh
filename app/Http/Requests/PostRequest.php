<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'name' => 'required|max:255',
            'content' => 'required',
            'image' => 'max:255',
            'alt_thumbnail' =>'max:255',
            'seo_title' => 'max:255',
            'seo_keyword' => 'max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tiêu đề bài viết',
            'name.max' => 'Độ dài tên danh mục tối đa là 255',
            'image.max' => 'Độ dài đường dẫn ảnh tối đa là 255',
            'content.required' => 'Bạn chưa nhập nội dung',
            'alt_thumbnail' =>'Alt_hình ảnh có độ dài tối đa là 255',
            'seo_title' => 'seo_title có độ dài tối đa là 255',
            'seo_keyword' => 'seo_keyword có độ dài tối đa là 255'
        ];
    }
}
