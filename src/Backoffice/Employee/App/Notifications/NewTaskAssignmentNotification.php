<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

final class NewTaskAssignmentNotification extends TaskAssignmentNotification
{
    protected function getMailMessage(): MailMessage
    {
        return (new MailMessage())
            ->from($this->getFromAddress(), $this->getFromName())
            ->subject('New Task Assigned')
            ->view('mail.assigned-task', [
                'header' => 'New Task Assigned',
                'title' => $this->task->title,
                'description' => $this->task->description,
                'taskUrl' => $this->getTaskRedirectUrl(),
            ]);
    }
}
