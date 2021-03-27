<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ValidateUserRegister;

use App\Petugas;
use App\Siswa;
use App\User;

use Auth;
use Hash;
class AuthController extends Controller
{
    public function registerAdmin(Request $request) {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);

        $admin = Petugas::create($input);
        if ($admin) {
            $input['role'] == 'admin' ? $role = 'Admin' : $role = 'Petugas';
            return response()->json([
                'status' => 1,
                'message' => 'Berhasil Register '.$role,
                'user'  => $admin
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Gagal Register Admin/Petugas'
            ]);
        }
    }

    public function registerSiswa(Request $request) {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $siswa = Siswa::create($input);

        if ($siswa) {
            return response()->json([
                'status' => 1,
                'message' => 'Berhasil Register Siswa',
                'user'  => $siswa
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Gagal Register Siswa'
            ]);
        }
    }

    public function loginAdmin(Request $request) {
        $credentials = request(['email', 'password']);
        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            $token = $admin->createToken('admin')->accessToken;
            return response()->json([
                'status' => 1,
                'message' => 'Selamat Datang '.$admin->name,
                'token' => $token,
                'user' => $admin
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Email atau password salah',
            ]);
        }
    }

    public function loginSiswa(Request $request) {
        $credentials = request(['email', 'password']);
        if (Auth::guard('siswa')->attempt($credentials)) {
            $siswa = Auth::guard('siswa')->user();
            $siswa['role'] = 'siswa';
            $token = $siswa->createToken('siswa')->accessToken;
            return response()->json([
                'status' => 1,
                'message' => 'Selamat Datang '.$siswa->name,
                'token' => $token,
                'user' => $siswa
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Email atau password salah',
            ]);
        }
    }

    public function getUser() {
        $users = User::get();

        return response()->json([
            'status' => 1,
            'message' => 'Berhasil mendapatkan data seluruh user',
            'data' => $users
        ]);
    }

    public function cekAkun() {
        $user = Auth::user();
        return $user;
    }
}
