<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NewInvoiceAddedEmail extends Notification
{
    use Queueable;
    private $invoice;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
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
        $url = 'http://127.0.0.1:8000/InvoicesDetails/' . $this->invoice->id;

        return (new MailMessage)
            ->subject('اضافة فاتورة جديدة')
            ->line('اضافة فاتورة جديدة')
            ->action('عرض الفاتورة', $url)
            ->line('شكرا لاستخدامك مورا سوفت لادارة الفواتير')
            ->line('مع تحيات محمود جمال');
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
