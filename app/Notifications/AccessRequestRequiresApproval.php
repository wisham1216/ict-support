<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AccessRequestRequiresApproval extends Notification
{
    use Queueable;

    protected $access;

    public function __construct($access)
    {
        $this->access = $access;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Access Request Requires Your Approval')
            ->line('A new access request requires your approval.')
            ->line('Section: ' . ucfirst($this->access->section_type))
            ->line('Requested by: ' . $this->access->user->name)
            ->action('Review Request', route('access-requests.show', $this->access))
            ->line('Please review and take appropriate action.');
    }
}
