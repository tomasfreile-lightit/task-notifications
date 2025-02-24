<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\DataTransferObjects;

use Lightit\Backoffice\Task\Domain\Enums\TaskStatus;

class UpdateTaskDTO
{
    public function __construct(
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?TaskStatus $status,
        public readonly ?int $employee_id,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'] ?? null,
            description: $data['description'] ?? null,
            status: isset($data['status']) ? TaskStatus::from($data['status']) : null,
            employee_id: $data['employee_id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status?->value,
            'employee_id' => $this->employee_id,
        ], fn ($value) => !is_null($value));
    }
} 