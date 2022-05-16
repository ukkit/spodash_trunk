<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UrlFailed extends Mailable
{
    use Queueable, SerializesModels;

    public $id_number;
    public $type; // This will be Instance or Intellicus
    public $failcount;
    public $url;
    public $at_time;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_data)
    {
        $this->id_number = $mail_data['id_number'];
        $this->type = $mail_data['type'];
        $this->failcount = $mail_data['failcount'];
        $this->url = $mail_data['url'];
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
        // return $this->view('view.name');
        $failed_hours = ($this->failcount * 30) / 60; //Getting hours since URL is down
        return $this->subject($this->subject)->markdown('emails.action.url-check-failed')
            ->with('id_number', $this->id_number)
            ->with('type', $this->type)
            ->with('failed_hours', $failed_hours)
            ->with('url', $this->url)
            ->with('at_time', $this->at_time);
    }
}
