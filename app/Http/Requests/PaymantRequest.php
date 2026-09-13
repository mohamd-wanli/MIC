<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymantRequest extends FormRequest
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
            'student_id' => ['required', 'exists:students,id'],
           'course_id' => 'nullable|exists:courses,id',
        'payment_value' => 'required|numeric|min:0.01',
        'payment_type' => 'required|string|in:cash,visa,bank',
        'payment_category' => 'required|string|in:course,certificate,other',
        'note' => 'nullable|string|max:500',
        'department_id' => 'nullable|exists:departments,id',
         'receipt_number'   => 'required|string|max:50',
         'collected_at'=>'required|date|before_or_equal:today',
         'discount'      => 'nullable|numeric|min:0',




        ];
    }

    public function messages(): array
    {
        return [
            'payment_value.required' => 'قيمة الدفع مطلوبة',
            'payment_value.numeric' => 'قيمة الدفع يجب أن تكون رقماً',
            'payment_type.required' => 'نوع الدفع مطلوب',
            'receipt_number.required'  => 'رقم الوصل مطلوب',
        // 'receipt_number.unique'    => 'رقم الوصل مستخدم مسبقاً',
        'collected_at.required'    => 'تاريخ التحصيل مطلوب',
        'collected_at.before_or_equal' => 'تاريخ التحصيل لا يمكن أن يكون في المستقبل',
        'discount.numeric' => 'الحسم يجب أن يكون رقماً',
'discount.min'     => 'الحسم لا يمكن أن يكون سالباً',
        ];
    }
}
