<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Sichikawa\LaravelSendgridDriver\SendGrid;

class SendMail extends Mailable
{
    use Queueable, SerializesModels, SendGrid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $details;

    public function __construct($details)
    {
        $this->details=$details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->subject('Approval Mail.')
        //             ->view('emails.sendmail');
                    $address = 'shithil.s@somaiya.edu';
                    // $subject = 'Approval Mail.';
                    $name = 'Shithil!';
                    $message= 'Your event has been approved';
            
                    return $this->view('emails.sendmail')
                                ->from($address, $name)
                                ->replyTo($address, $name)
                                ->subject($this->details['subject']);
                                // ->with();
                        
    }
}
