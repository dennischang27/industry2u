<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $name;
    public $subject;
    public $msg;
    public $phone;
    public $company_name;
    public $address;

    public function __construct($input)
    {

        $this->email =  $input['email'];
        $this->name =  $input['name'];
        $this->phone =  $input['phone'];
        $this->subject =  $input['subject'];
        $this->address =  $input['address'];
        $this->msg =  $input['message'];
        $this->company_name =  $input['company_name'];
  
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->from( $this->email ,$this->name )
                    ->to('enquiry@industry2u.asia')
                    ->view('inquirymail');
    }
}
