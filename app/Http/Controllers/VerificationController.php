<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Petugas;
use Auth;

class VerificationController extends Controller
{
    public function verify($user_id, Request $request) {
        if (!$request->hasValidSignature()) {
            return response()->json([
                'message' => 'Invalid / Expired URL Provided!'
            ], 401);
        }

        $user = Petugas::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return 'Berhasil Verifikasi Email';
    }

    public function resend() {
        if (Auth::user()->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email Already Verified'
            ], 400 );
        }

        Auth::user()->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Email Verification link sent to your email'
        ]);
    }
}
