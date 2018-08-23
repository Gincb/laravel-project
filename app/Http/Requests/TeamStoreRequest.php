<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use App\Team;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

/**
 * Class TeamStoreRequest
 * @package App\Http\Requests
 */
class TeamStoreRequest extends FormRequest
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
            'title' => 'required|min:3|max:191|string',
            'member' => [
                'required',
                'array',
                'exists:members,id'
            ]
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
        $slug = Team::whereSlug($this->getSlug())->get();
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

    public function getMembersIds(): array
    {
        return $this->input('member', []);
    }
}
