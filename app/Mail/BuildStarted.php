<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BuildStarted extends Mailable
{
    use Queueable, SerializesModels;

    public $instance;
    public $username;
    public $current_build;
    public $latest_build;
    public $instance_id;
    public $at_time;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_data)
    {
        $this->instance = $mail_data['instance'];
        $this->username = $mail_data['username'];
        $this->current_build = $mail_data['current_build'];
        $this->latest_build = $mail_data['latest_build'];
        $this->instance_id = $mail_data['instance_id'];
        $this->at_time = $mail_data['at_time'];
        $this->subject = $mail_data['subject'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->markdown('emails.action.build-started')
            ->with('instance', $this->instance)
            ->with('username', $this->username)
            ->with('current_build', $this->current_build)
            ->with('latest_build', $this->latest_build)
            ->with('instance_id', $this->instance_id)
            ->with('at_time', $this->at_time);
    }
}
