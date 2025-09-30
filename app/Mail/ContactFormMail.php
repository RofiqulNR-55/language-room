<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $email;
    public $subjek;
    public $pesan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->nama = $data['nama'];
        $this->email = $data['email'];
        $this->subjek = $data['subjek'];
        $this->pesan = $data['pesan'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email, $this->nama)
                    ->to('languangeroom@gmail.com')
                    ->subject('Pesan Baru dari Formulir Kontak: ' . $this->subjek)
                    ->view('emails.contact-form');
    }
}