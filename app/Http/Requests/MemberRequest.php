<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'first_name' => 'required|min:3|max:40',
            'last_name' => 'required|min:3|max:40',
            'position' => 'required|min:3|max:191',
        ];
    }

    public function getFirstName(): string
    {
        return $this->input('first_name');
    }

    public function getLastName(): string
    {
        return $this->input('last_name');
    }

    public function getPosition(): string
    {
        return $this->input('position');
    }
}
