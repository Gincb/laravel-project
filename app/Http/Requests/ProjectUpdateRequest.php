<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use App\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Str;

/**
 * Class ProjectUpdateRequest
 * @package App\Http\Requests
 */
class ProjectUpdateRequest extends ProjectStoreRequest
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
     * @return Validator
     */
    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();
        $validator->after(function (Validator $validator) {
            if($this->isMethod('put') && $this->slugExists()) {
                $validator->errors()->add('slug', 'Slug by name exists');
                return;
            }
        });

        return $validator;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    protected function slugExists(): bool
    {
        /** @var ProjectRepository $projectRepository */
        $projectRepository = app(ProjectRepository::class);

        $slug = $projectRepository->getBySlugAndNotId(
            $this->getSlug(),
            (int)$this->route()->parameter('project')
        );

        return !empty($slug);
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return Str::slug($this->input('slug') ? $this->input('slug') : $this->getTitle());
    }
}
