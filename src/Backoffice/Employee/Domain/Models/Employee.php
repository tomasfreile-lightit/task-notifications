<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Lightit\Backoffice\Task\Domain\Models\Task;

class Employee extends Model
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * @return HasMany<Task, $this>
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
