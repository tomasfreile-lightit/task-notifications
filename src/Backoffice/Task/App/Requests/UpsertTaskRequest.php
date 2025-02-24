<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lightit\Backoffice\Task\Domain\DataTransferObjects\TaskDTO;
use Lightit\Backoffice\Task\Domain\Enums\TaskStatus;

class UpsertTaskRequest extends FormRequest
{
    public const TITLE = 'title';
    public const DESCRIPTION = 'description';
    public const STATUS = 'status';
    public const EMPLOYEE_ID = 'employee_id';

    public function rules(): array
    {
        $rules = [
            self::TITLE => ['required', 'string', 'max:255'],
            self::DESCRIPTION => ['required', 'string'],
            self::STATUS => ['sometimes', 'string', 'in:' . implode(',', TaskStatus::values())],
            self::EMPLOYEE_ID => ['required', 'exists:employees,id'],
        ];

        if (!$this->isMethod('POST')) {
            $rules[self::TITLE] = ['sometimes', 'string', 'max:255'];
            $rules[self::DESCRIPTION] = ['sometimes', 'string'];
            $rules[self::EMPLOYEE_ID] = ['sometimes', 'exists:employees,id'];
        }

        return $rules;
    }

    public function toDto(): TaskDTO
    {
        return TaskDTO::fromArray($this->validated());
    }
}