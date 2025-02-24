<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Lightit\Backoffice\Task\Domain\Models\Task;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
