<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lightit\Backoffice\Task\Domain\DataTransferObjects\UpdateTaskDTO;
use Lightit\Backoffice\Task\Domain\Enums\TaskStatus;

class UpdateTaskRequest extends FormRequest
{
    public const TITLE = 'title';

    public const DESCRIPTION = 'description';

    public const STATUS = 'status';

    public const EMPLOYEE_ID = 'employee_id';

    public function rules(): array
    {
        return [
            self::TITLE => ['sometimes', 'string', 'max:255'],
            self::DESCRIPTION => ['sometimes', 'string'],
            self::STATUS => ['sometimes', 'string', 'in:' . implode(',', TaskStatus::values())],
            self::EMPLOYEE_ID => ['sometimes', 'nullable', 'exists:employees,id'],
        ];
    }

    public function toDto(): UpdateTaskDTO
    {
        return UpdateTaskDTO::fromArray($this->validated());
    }
}
