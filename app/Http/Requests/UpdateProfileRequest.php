<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'gender' => 'required',
            'birthday' => 'required|date',
            'phone' => 'required|size:10',
            'address' => 'required',
            'province_id' => 'required',
            'district_id' => 'required',
            'email' => [
                'required', 'max:255', 'string', 'email',
                Rule::unique('customers')->ignore($this->id),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ và tên là trường bắt buộc.', 
            'name.max' => 'Họ và tên không được dài quá :max ký tự.', 
            'gender.required' => 'Giới tính là trường bắt buộc.',
            'birthday.required' => 'Ngày sinh là trường bắt buộc.',
            'birthday.date' => 'Ngày sinh không đúng định dạng.',
            'phone.required' => 'Số điện thoại là trường bắt buộc.',
            'phone.size' => 'Số điện thoại phải là :size số.',
            'address.required' => 'Địa chỉ là trường bắt buộc.',
            'email.required' => 'Email là trường bắt buộc.',
            'email.email' => 'Email chưa đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'email.string' => 'Email phải là một chuỗi.',
            'email.max' => 'Email không được dài quá :max ký tự.',
            'province_id.required' => 'Tỉnh/Thành phố là trường bắt buộc.',
            'district_id.required' => 'Quận/Huyện là trường bắt buộc.',
        ];
    }
}
