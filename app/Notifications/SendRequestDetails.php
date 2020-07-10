<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;
use App\LockdownRequest;

class SendRequestDetails extends Notification implements ShouldQueue
{
    use Queueable;
    public $sender;
    public $details;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $sender, LockdownRequest $details)
    {
        $this->sender = $sender;
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You got a mail from '. $this->sender->name)
                    // ->line('They need '. $this->details->category->title)
                    ->line('Their phone number is '. $this->sender->phone)
                    ->line('Their email address is '. $this->sender->email)
                    // ->action('View Request', url('view/make/'.$this->details->id .'/request'))
                    ->action('View Request', route('view.make.request', $this->details->id))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
