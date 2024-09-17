<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\BloodPressureStatus;
use Illuminate\Support\Facades\Mail;

class SendingEmailController extends Controller
{
    public static function sendBPAlertEmail($record){
        try {

            $suggestion = $record->getBloodPressureSuggestion();
            $user = $record->user;


            // Mail::to($user->email)->send(new BloodPressureStatus($user->fullName(), $record->getBloodPressureStatus(), $suggestion));

            Mail::to($user->email)->queue(new BloodPressureStatus($user->fullName(), $record->getBloodPressureStatus(), $suggestion));


            FilamentForm::notification('success', 'Email was sent successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            FilamentForm::error('Failed to send email. Please try again later.');
        }

    }
}
