<?php

// app/Notifications/DocumentApprovedNotification.php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class DocumentApprovedNotification extends Notification
{
    protected $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    // The notification's delivery channels
    public function via($notifiable)
    {
        return ['database', 'mail']; // Send via database and email
    }

    // Get the notification's mail representation
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Your document "' . $this->item->title . '" has been approved.')
            ->action('View Document', url('/documents/' . $this->item->id))
            ->line('Thank you for using our application!');
    }

    // Get the notification's database representation
    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Document Approved',
            'message' => 'Your document "' . $this->item->title . '" has been approved.',
            'item_id' => $this->item->id,
        ];
    }
}
