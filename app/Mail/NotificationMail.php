<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The notification object instance.
     *
     * @var Notification
     */
    public $notification;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('iotproject.chernozem@gmail.com', 'Chernozem Ekibi')
                    ->subject('Chernozem Sera Bilgilendirmesi')
                    ->view('mail.notification');
    }
}
