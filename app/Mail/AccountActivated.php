<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;

class AccountActivated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The object instance.
     *
     * @var Object
     */
    public $object;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this -> object = $user;
    }

    /** Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // -- mail is send with
        //Mail::to($request->user())
        //  -> bc($moreUsers)
        //  -> bcc($evenMoreUsers)
        //  -> send(new AccountActivated($user));
        //
        //  .. -> queue(new OrderShipped($order));
        //  .. ->later( now()->addMinutes(10), new OrderShipped($order) );

        return $this
                    -> from()       // if not defined, config('mail.fron') taken
                    -> subject()
                    -> attach('/path/to/file', [
                        'as' => 'name.pdf',
                        'mime' => 'application/pdf',
                    ])
                    -> attachFromStorage('/path/to/file', [
                        'as' => 'name.pdf',
                        'mime' => 'application/pdf',
                    ])
                    // you might use this method if you have generated a PDF in memory and want to attach it to the email without writing it to disk
                    ->attachData($this->pdf, 'name.pdf', [
                        'mime' => 'application/pdf',
                    ]);
                    -> with([
                        'userName'  => $this -> object -> username,
                        'prop'      => $this -> object -> username,
                    ])
                    -> view('view.name')
                    -> text('view.name_plain');
    }
}
