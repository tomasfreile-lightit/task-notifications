<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Transformers;

use Flugg\Responder\Transformers\Transformer;
use Lightit\Backoffice\Task\Domain\Models\Task;

final class TaskTransformer extends Transformer
{
    public function transform(Task $task): array
    {
        return [
            'id' => $task->id,
            'title' => $task->title,
            'description' => $task->description,
            'status' => $task->status,
            'employee_id' => $task->employee_id,
        ];
    }
}
