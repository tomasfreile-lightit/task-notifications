<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Lightit\Backoffice\Task\Domain\Models\Task;

abstract class TaskAssignmentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected readonly Task $task
    ) {
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return $this->getMailMessage();
    }

    abstract protected function getMailMessage(): MailMessage;

    protected const FROM_EMAIL = 'mail.from.from_email_lightit';
    protected const TASK_ROUTE = 'tasks.show';

    protected function getFromEmail(): string
    {
        return (string) config(self::FROM_EMAIL);
    }

    protected function getTaskRedirectUrl(): string
    {
        return route(self::TASK_ROUTE, $this->task->id);
    }
}
