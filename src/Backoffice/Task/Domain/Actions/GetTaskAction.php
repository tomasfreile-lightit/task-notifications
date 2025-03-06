<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\Actions;

use Lightit\Backoffice\Task\Domain\Models\Task;

final readonly class GetTaskAction
{
    public function execute(Task $task): Task
    {
        return $task;
    }
}
