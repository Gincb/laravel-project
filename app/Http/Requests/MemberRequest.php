<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * Class MemberRequest
 * @package App\Http\Requests
 */
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
            'photo' => 'nullable|image|dimensions:min_width=600,min_height=300',
            'first_name' => 'required|min:3|max:40',
            'last_name' => 'required|min:3|max:40',
            'position' => 'required|min:3|max:191',
        ];
    }

    /**
     * @return UploadedFile|null
     */
    public function getPhoto(): ? UploadedFile
    {
        return $this->file('photo');
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->input('first_name');
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->input('last_name');
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->input('position');
    }
}
