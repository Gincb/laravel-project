<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use App\Project;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

/**
 * Class ProjectStoreRequest
 * @package App\Http\Requests
 */
class ProjectStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
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
            'description' => 'required',
            'category' => [
                'nullable',
                'array',
                'exists:categories,id',
            ]
        ];
    }

    /**
     * @return Validator
     */
    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();

        $validator->after(function (Validator $validator){
            if($this->isMethod('post')&& $this->slugExists()){
                $validator->errors()->add('title', 'Slug by this name exists on DB');

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
        $title = $this->getTitle();

        if(!$title){
            return true;
        }

        $slug = Project::whereSlug($title)->get();

        if(!empty($slug->toArray())){
            return true;
        }

        return false;
    }

    /**
     * @return array|null|string
     */
    public function getTitle(): ? string
    {
        return $this->input('title');
    }

    /**
     * @return array|null|string
     */
    public function getDescription(): string
    {
        return $this->input('description');
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
    public function getCategoriesIds(): array
    {
        return $this->input('category', []);
    }
}
