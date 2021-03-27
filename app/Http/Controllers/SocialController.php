<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

class SocialController extends Controller
{
    public function github() {
        return Socialite::driver('github')->redirect();
    }

    public function githubRedirect() {
        $user = Socialite::driver('google')->user();
        dd($user);
    }

    public function google() {
        return Socialite::driver('google')->redirect();
    }

    public function googleRedirect() {

        $user = Socialite::driver('google')->user();
        dd($user);
        
        // try {
        //     $user = Socialite::driver('google')->user();

        //     $findUser = Petugas::where('google_id', $user->id)->first();
        //     if ($findUser) {
        //         Auth::login($user);
        //         return 'Berhasil Login. Selamat Datang '. $user->name;

        //         return response()->json([
        //             'message' => 'Berhasil Login. Selamat Datang ' . $user->name
        //         ]);
        //     } else {
        //         $newUser = Petugas::create([
        //             'name' => $user->name,
        //             'email' => $user->email,
        //             'google_id' => $user->id,
        //             'password' => encrypt('123456dummy')
        //         ]);

        //         Auth::login($newUser);
        //         return 'Berhasil Login. Selamat Datang '.$newUser->name;
        //         return response()->json([
        //             'message' => 'Berhasil Login. Selamat Datang ' . $newUser->name
        //         ]);
        //     }
        // } catch (\Throwable $th) {
        //     dd($th->getMesage());
        // }
    }
}
