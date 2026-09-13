<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
       return[
           'firstname' => 'required',
           'fathername' => 'required',
           'lastname' => 'required',
           'fullname' => 'required',
           'national_number' => 'required|max:11|numeric',
           'engish_firstname' => 'required',
           'english_lastname' => 'required',
           'grandfathername' => 'required',
           'gender' => 'required',
           'date_of_birth'=>'required|date',
           'email'=>'required',
           'telephone'=>'required|numeric',
           'mobile'=>'required|max:10|numeric',
           'address'=>'required',
           'nationality'=>'required',
       ];
    }

    public function messages(){
        return [
     'firstname.required'=>'الاسم الأول مطلوب' ,
     'fathername.required' =>'اسم الأب مطلوب' ,
     'lastname.required'=>'الكنية مطلوبة' ,
     'fullname.required'=>'الاسم الكامل مطلوب' ,
     'national_number.required'=>'الرقم الوطني مطلوب' ,
     'engish_firstname.required'=>'الاسم الأول انكليزي مطلوب' ,
     'english_lastname.required'=>'الكنية انكليزي مطلوبة' ,
     'grandfathername.required'=>'اسم الجد مطلوب' ,
     'gender.required'=>'الجنس مطلوب' ,
     'date_of_birth.required'=>'تاريخ الولادة مطلوب' ,
     'date_of_birth.date'=>'يجب ادخال تاريخ صحيح' ,
     'email.required'=>'الايميل مطلوب' ,
     'telephone.required'=>'هاتف مطلوب' ,
     'telephone.numeric'=>'يجب ادخال رقم' ,
     'mobile.required'=>'موبايل مطلوب' ,
     'mobile.numeric'=>'يجب ادخال رقم' ,
     'address.required'=>'العنوان مطلوب' ,
     'nationality.required'=>'الجنسية مطلوبة' ,
        ];
    }

}
