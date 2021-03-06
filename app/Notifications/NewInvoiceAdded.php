<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NewInvoiceAdded extends Notification
{
    use Queueable;
    private $invoice;
    private $type;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoice, $type)
    {
        $this->invoice = $invoice;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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

    public function toDatabase($notifiable)
    {
        return [

            'data' => 'new invoice added',
            'id' => $this->invoice->id,
            'title' => "تم اضافة" . $this->type . "جديد بواسطة :",
            'user' => Auth::user()->name,

        ];
    }
}
