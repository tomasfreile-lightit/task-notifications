<?php

declare(strict_types=1);
namespace Lightit\Backoffice\Employee\Domain\Actions;

use Lightit\Backoffice\Employee\Domain\DataTransferObjects\EmployeeDTO;
use Lightit\Backoffice\Employee\Domain\Models\Employee;

class StoreEmployeeAction
{
    public function execute(EmployeeDTO $data): Employee
    {
        return Employee::create($data->toArray());
    }
}
