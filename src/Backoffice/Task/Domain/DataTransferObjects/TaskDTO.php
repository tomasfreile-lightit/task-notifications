<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\DataTransferObjects;

use Lightit\Backoffice\Task\Domain\Enums\TaskStatus;

class TaskDTO
{
    public function __construct(
        public readonly ?string $title = null,
        public readonly ?string $description = null,
        public readonly ?TaskStatus $status = null,
        public readonly ?int $employee_id = null,
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
        $data = [];

        if (isset($this->title)) {
            $data['title'] = $this->title;
        }

        if (isset($this->description)) {
            $data['description'] = $this->description;
        }

        if (isset($this->status)) {
            $data['status'] = $this->status->value;
        }

        if (isset($this->employee_id)) {
            $data['employee_id'] = $this->employee_id;
        }

        return $data;
    }
}
