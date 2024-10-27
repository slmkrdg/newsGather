<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsFilterRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Kullanıcı yetkilendirmesi için true döndürüyoruz
    }

    public function rules()
    {
        return [
            'coin'          => 'nullable|exists:coins,code', 
            'start_date'    => 'nullable|date',
            'end_date'      => 'nullable|date|after_or_equal:start_date', 
        ];
    }

    public function messages()
    {
        return [
            'coin.exists'               => 'Seçtiğiniz coin mevcut değil.',
            'start_date.date'           => 'Başlangıç tarihi geçersiz bir tarih.',
            'end_date.date'             => 'Bitiş tarihi geçersiz bir tarih.',
            'end_date.after_or_equal'   => 'Bitiş tarihi, başlangıç tarihinden sonra veya eşit olmalıdır.',
        ];
    }
}
