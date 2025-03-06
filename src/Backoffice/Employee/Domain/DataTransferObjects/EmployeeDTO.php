<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\Domain\DataTransferObjects;

final readonly class EmployeeDTO
{
    public function __construct(
        public string $name,
        public string $email,
    ) {
    }
}
