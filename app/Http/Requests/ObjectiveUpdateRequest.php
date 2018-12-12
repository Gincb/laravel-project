<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use App\Objective;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ObjectiveUpdateRequest extends ObjectiveStoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
        return parent::rules();
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();
        $validator->after(function (Validator $validator) {
            if ($this->isMethod('put') && $this->slugExists()) {
                $validator->errors()->add('slug', 'Slug already exists.');
                return;
            }
        });
        return $validator;
    }

    /**
     * @return bool
     */
    protected function slugExists(): bool
    {
        $slug = Objective::whereSlug($this->getSlug())
            ->where(
                'id',
                '!=',
                $this->route()->parameter('objective')->id
            )
            ->get();
        if (!empty($slug->toArray())) {
            return true;
        }
        return false;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return Str::slug($this->input('slug') ? $this->input('slug') : $this->getTitle());
    }
}
