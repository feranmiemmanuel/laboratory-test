<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailJob implements ShouldQueue
{
    use Queueable;
    public $event;
    /**
     * Create a new job instance.
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $permittedChars     = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $customUuid         = substr(str_shuffle($permittedChars), 0, 50);
        $email         = $this->event->details['email'];
        $name          = $this->event->details['name'];
        $subject       = $this->event->details['subject'];
        $template      = $this->event->details['template'];

        $data = [
            'email'         => $this->event->details['email'],
            'name'          => $this->event->details['name'],
            'content'       => $this->event->details['content'],
            'title'         => $this->event->details['title'],
            'template_used' => $this->event->details['template'],
            'track_id'      => $customUuid,
            'subject'       => $this->event->details['subject'],
        ];
        Mail::send($template, $data, function ($message) use ($email, $name, $subject) {
            $message->to($email, $name);
            $message->subject($subject);
        });
    }
}
