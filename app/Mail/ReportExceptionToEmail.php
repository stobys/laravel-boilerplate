<?php

namespace App\Mail;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportExceptionToEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The exception instance.
     *
     * @var Exception
     */
    public $exception;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Exception $exception)
    {
        $this -> exception = $exception;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $toEmails = config('app.debug_emails');
        // if (! $toEmails) {
        //     return;
        // }

        // $toEmails = is_string($toEmails) ? explode(',', $toEmails) : $toEmails;

        return $this
                    // -> to($toEmails)
                    -> subject(config('app.name') .' / '. config('app.env') .' / Error : '. class_basename($this->exception))
                    -> view('emails.exception-report');
    }
}
