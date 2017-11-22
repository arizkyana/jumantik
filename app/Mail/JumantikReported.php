<?php

namespace App\Mail;

use App\Laporan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class JumantikReported extends Mailable
{
    use Queueable, SerializesModels;

    public $laporan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Laporan $laporan)
    {
        $this->laporan = $laporan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('agung.rizkyana@gmail.com')
            ->view('email.jumantik.reported');
    }
}
