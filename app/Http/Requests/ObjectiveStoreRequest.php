<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use App\Objective;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

/**
 * Class ObjectiveStoreRequest
 * @package App\Http\Requests
 */
class ObjectiveStoreRequest extends FormRequest
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
        return [
            'title' => 'required|min:3|max:191|string',
            'plan' => [
                'nullable',
                'array',
                'exists:plans,id',
            ],
        ];
    }

    /**
     * @return Validator
     */
    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();
        $validator->after(function (Validator $validator) {
            if ($this->isMethod('post') && $this->slugExists()) {
                $validator
                    ->errors()
                    ->add('title', 'Slug by name exists on DB');
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
        $slug = Objective::whereSlug($this->getSlug())->get();
        if (!empty($slug->toArray())) {
            return true;
        }
        return false;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ? string
    {
        return $this->input('title');
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return Str::slug($this->getTitle());
    }

    /**
     * @return array
     */
    public function getPlansIds(): array
    {
        return $this->input('plan', []);
    }
}
