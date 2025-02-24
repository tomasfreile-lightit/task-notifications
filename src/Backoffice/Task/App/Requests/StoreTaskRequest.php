<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lightit\Backoffice\Task\Domain\DataTransferObjects\TaskDTO;
use Lightit\Backoffice\Task\Domain\Enums\TaskStatus;

class StoreTaskRequest extends FormRequest
{
    public const TITLE = 'title';

    public const DESCRIPTION = 'description';

    public const STATUS = 'status';

    public const EMPLOYEE_ID = 'employee_id';

    public function rules(): array
    {
        return [
            self::TITLE => ['required', 'string', 'max:255'],
            self::DESCRIPTION => ['required', 'string'],
            self::STATUS => ['sometimes', 'string', 'in:' . implode(',', TaskStatus::values())],
            self::EMPLOYEE_ID => ['required', 'exists:employees,id'],
        ];
    }

    public function toDto(): TaskDTO
    {
        return new TaskDTO(
            title: $this->string(self::TITLE)->toString(),
            description: $this->string(self::DESCRIPTION)->toString(),
            status: $this->has(self::STATUS)
                ? TaskStatus::from($this->string(self::STATUS)->toString())
                : TaskStatus::Pending,
            employee_id: $this->integer(self::EMPLOYEE_ID),
        );
    }
}
