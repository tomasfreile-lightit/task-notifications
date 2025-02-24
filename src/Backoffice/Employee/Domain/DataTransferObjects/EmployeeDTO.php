<?php

declare(strict_types=1);
namespace Lightit\Backoffice\Employee\Domain\DataTransferObjects;

class EmployeeDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
