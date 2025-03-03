<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

final class ReassignedTaskNotification extends TaskAssignmentNotification
{
    protected function getMailMessage(): MailMessage
    {
        return (new MailMessage())
            ->from($this->getFromAddress(), $this->getFromName())
            ->subject('Reassigned Task')
            ->view('mail.assigned-task', [
                'header' => 'Task Reassigned',
                'title' => $this->task->title,
                'description' => $this->task->description,
                'taskUrl' => $this->getTaskRedirectUrl(),
            ]);
    }
}
