<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Sendmailable extends Mailable
{
    use Queueable, SerializesModels;
    public $name, $trxId, $price, $sendEmailFor, $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name = null, $trxId = null, $price = null, $sendEmailFor, $status = null)
    {
        date_default_timezone_set('GMT');
        $this->name    = $name;
        $this->trxId   = $trxId;
        $this->price   = $price;
        $this->sendEmailFor = $sendEmailFor;
        $this->status  = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch ($this->sendEmailFor) {
            case '0':
                return $this->view('email.payment_confirm');
                break;
            case '1':
                return $this->view('email.payment_confirmed');
                break;
            default:
                    // sendEmailFor include trx data on file AdminController : 186
                $trx = $this->sendEmailFor;
                $dikubur = date('H:i', strtotime('+3 hour', strtotime($trx->payment_created_at)));
                return $this->view('email.check_schedule')
                            ->with([
                                'ahliwaris' => $trx->ahliwaris,
                                'jenazah'   => $trx->jenazah,
                                'identitas' => $trx->identitas,
                                'agama'     => $trx->agama,
                                'jk'        => $trx->jk,
                                'lahir'     => $trx->lahir,
                                'mati'      => $trx->mati,
                                'blok'      => $trx->blok,
                                'dikubur'   => $dikubur,
                                'pkg_price'      => $trx->pkg_price,
                                'transaction_id' => $trx->transaction_id,
                                'status'    => $this->status
                            ]);
                break;
        }
    }
}
