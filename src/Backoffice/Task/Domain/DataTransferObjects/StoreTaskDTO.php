<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\DataTransferObjects;

use Lightit\Backoffice\Task\Domain\Enums\TaskStatus;

class StoreTaskDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly TaskStatus $status,
        public readonly int $employee_id,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'],
            description: $data['description'],
            status: TaskStatus::from($data['status'] ?? TaskStatus::Pending->value),
            employee_id: $data['employee_id'],
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status->value,
            'employee_id' => $this->employee_id,
        ];
    }
} 