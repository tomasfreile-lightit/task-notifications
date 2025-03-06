<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Lightit\Backoffice\Task\Domain\DataTransferObjects\TaskDTO;
use Lightit\Backoffice\Task\Domain\Enums\TaskStatus;
use Lightit\Backoffice\Task\Domain\Models\Task;

final class UpdateTaskRequest extends FormRequest
{
    public const TITLE = 'title';

    public const DESCRIPTION = 'description';

    public const STATUS = 'status';

    public const EMPLOYEE_ID = 'employeeId';

    public function rules(): array
    {
        return [
            self::TITLE => ['sometimes', 'string', 'max:255'],
            self::DESCRIPTION => ['sometimes', 'string'],
            self::STATUS => ['sometimes', 'string', Rule::enum(TaskStatus::class)],
            self::EMPLOYEE_ID => ['sometimes', 'exists:employees,id'],
        ];
    }

    public function toDto(Task $currentTask): TaskDTO
    {
        return new TaskDTO(
            title: $this->has(self::TITLE)
                ? $this->string(self::TITLE)->toString()
                : $currentTask->title,
            description: $this->has(self::DESCRIPTION)
                ? $this->string(self::DESCRIPTION)->toString()
                : $currentTask->description,
            status: $this->has(self::STATUS)
                ? TaskStatus::from($this->string(self::STATUS)->toString())
                : $currentTask->status,
            employeeId: $this->has(self::EMPLOYEE_ID)
                ? $this->integer(self::EMPLOYEE_ID)
                : $currentTask->employee_id,
        );
    }
}
