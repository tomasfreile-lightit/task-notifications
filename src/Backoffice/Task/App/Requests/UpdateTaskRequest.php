<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lightit\Backoffice\Task\Domain\DataTransferObjects\TaskDTO;
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
            self::EMPLOYEE_ID => ['sometimes', 'exists:employees,id'],
        ];
    }

    public function toDto(TaskDTO $currentTask): TaskDTO
    {
        return new TaskDTO(
            title: $this->has(self::TITLE) 
                ? $this->string(self::TITLE)->toString() 
                : $currentTask->title,
            description: $this->has(self::DESCRIPTION) 
                ? $this->string(self::DESCRIPTION)->toString() 
                : $currentTask->description,
            status: $this->has(self::STATUS) 
                ? TaskStatus::from($this->input(self::STATUS)) 
                : $currentTask->status,
            employee_id: $this->has(self::EMPLOYEE_ID) 
                ? $this->integer(self::EMPLOYEE_ID) 
                : $currentTask->employee_id,
        );
    }
}
