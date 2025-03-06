<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\App\Transformers;

use Flugg\Responder\Transformers\Transformer;
use Lightit\Backoffice\Employee\Domain\Models\Employee;

class EmployeeTransformer extends Transformer
{
    public function transform(Employee $employee): array
    {
        return [
            'id' => $employee->id,
            'name' => $employee->name,
            'email' => $employee->email,
        ];
    }
}
