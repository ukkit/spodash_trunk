<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ServerShutdown extends Mailable
{
    use Queueable, SerializesModels;

    public $instance;
    public $username;
    public $instance_id;
    public $at_time;
    public $subj;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_data)
    {
        $this->instance = $mail_data['instance'];
        $this->username = $mail_data['username'];
        $this->instance_id = $mail_data['instance_id'];
        $this->at_time = $mail_data['at_time'];
        $this->subj = $mail_data['subject'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subj)->markdown('emails.action.server-shutdown')
            ->with('instance', $this->instance)
            ->with('username', $this->username)
            ->with('instance_id', $this->instance_id)
            ->with('at_time', $this->at_time);
    }
}
