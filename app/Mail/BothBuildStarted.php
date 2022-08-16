<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BuildStarted extends Mailable
{
    use Queueable, SerializesModels;

    public $instance;

    public $username;

    public $current_build_spo;

    public $latest_build_spo;

    public $current_build_pai;

    public $latest_build_pai;

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
        $this->current_build_spo = $mail_data['current_build_spo'];
        $this->latest_build_spo = $mail_data['latest_build_spo'];
        $this->current_build_pai = $mail_data['current_build_pai'];
        $this->latest_build_pai = $mail_data['latest_build_pai'];
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
            ->with('current_build_spo', $this->current_build_spo)
            ->with('latest_build_spo', $this->latest_build_spo)
            ->with('current_build_pai', $this->current_build_pai)
            ->with('latest_build_pai', $this->latest_build_pai)
            ->with('instance_id', $this->instance_id)
            ->with('at_time', $this->at_time);
    }
}
