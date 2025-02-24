<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Lightit\Backoffice\Employee\Domain\Models\Employee;
use Lightit\Backoffice\Task\Domain\Enums\TaskStatus;

/**
 * @property string $title
 * @property string $description
 * @property TaskStatus $status
 * @property int $employee_id
 */
class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'employee_id',
    ];

    protected $casts = [
        'status' => TaskStatus::class,
    ];

    /**
     * @return BelongsTo<Employee, $this>
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
