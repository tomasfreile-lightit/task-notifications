<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Lightit\Backoffice\Task\Domain\Models\Task;

abstract class TaskAssignmentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected readonly Task $task,
    ) {
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return $this->getMailMessage();
    }

    abstract protected function getMailMessage(): MailMessage;

    protected function getFromAddress(): string
    {
        $address = config('mail.from.address');
        return (is_string($address) && !empty($address)) ? $address : 'default@example.com';
    }

    protected function getFromName(): string
    {
        $name = config('mail.from.name');
        return (is_string($name) && !empty($name)) ? $name : 'Default Name';

    }
    protected const TASK_ROUTE = 'tasks.show';
    protected function getTaskRedirectUrl(): string
    {
        return route(self::TASK_ROUTE, $this->task->id);
    }
}
