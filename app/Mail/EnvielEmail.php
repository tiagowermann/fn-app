<?php

namespace App\Mail;

use App\Models\Balances;
use App\Models\Release;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class EnvielEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $resulmo;
    /**
     * Create a new message instance.
     */
    public function __construct($email)
    {
        //
        if($email == 'entry'){
          $this->resulmo = 'entry';
          
        }else if($email == 'exit'){
           $this->resulmo = 'exit';
           
        }
        
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Resgister Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
       
            $user = auth()->user();
            $banlances = new Balances();
        // $releases = new Release();
            $resul = $banlances->select($this->resulmo)->where('id_user', '=', $user->id)->first();
         
        // $exit = $banlances->where('id_user', '=', $user->id)->first();
        // $rele = $releases->where('id_user', '=', $user->id)->get();

        return new Content(
            view: 'Mail.enviel',
            with :[
                'user'=>$user->name,
                'resul'=>$resul
                ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    // public function build(){

    //     return $this->view('')
    // }
}
