<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\DataTransferObjects;

use Lightit\Backoffice\Task\Domain\Enums\TaskStatus;

readonly class TaskDTO
{
    public function __construct(
        public string $title,
        public string $description,
        public TaskStatus $status,
        public int $employeeId,
    ) {
    }
}
