<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lightit\Backoffice\Employee\Domain\DataTransferObjects\EmployeeDTO;

class StoreEmployeeRequest extends FormRequest
{
    public const NAME = 'name';

    public const EMAIL = 'email';

    public function rules(): array
    {
        return [
            self::NAME => ['required', 'string', 'max:255'],
            self::EMAIL => ['required', 'email', 'unique:employees,email'],
        ];
    }

    public function toDto(): EmployeeDTO
    {
        return new EmployeeDTO(
            name: $this->string(self::NAME)->toString(),
            email: $this->string(self::EMAIL)->toString(),
        );
    }
}
