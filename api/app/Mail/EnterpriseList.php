<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnterpriseList extends Mailable
{
    use Queueable, SerializesModels;

    public $nameCompany;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $nameCompany)
    {
        $this->nameCompany = $nameCompany;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.enterprise_list');
    }
}
