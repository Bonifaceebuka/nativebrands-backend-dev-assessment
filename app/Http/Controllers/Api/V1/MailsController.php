<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Mails\EmailVerificationMail;
use App\Mails\ForgottenPasswordMail;
use Illuminate\Support\Facades\Mail;

class MailsController extends Controller
{

    public static function verify_mail($receiver, $verification_code)
    {
        Mail::to($receiver)
            ->send(new EmailVerificationMail($verification_code));
    }

    public static function forgotten_password_mail($receiver, $verification_code)
    {
        Mail::to($receiver)
            ->send(new ForgottenPasswordMail($verification_code));
    }
}
