<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // جلب البيانات
        $email = $request->input('email');
        $subject = $request->input('subject');
        $messageContent = $request->input('message');

        // إرسال الإيميل
        Mail::raw($messageContent, function ($message) use ($email, $subject) {
            $message->to($email)
                    ->subject($subject);
        });

        // استجابة النجاح
        return response()->json(['message' => 'Email sent successfully']);
    }
}