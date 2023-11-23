<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function loginProses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $data = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        $request = [
            'code' => '200',
            'message' => 'Login Berhasil',
            'data' => [
                'app_title' => 'Tracking Surat',
                'app_logo' => 'https://www.adaptivewfs.com/wp-content/uploads/2020/07/logo-placeholder-image.png',
                'id_pegawai' => 4,
                'nama_pegawai' => 'John Doe',
                'token' => 'svalknj83w749efijwo'
            ]
        ];
        if ($request['code'] === '200') {
            $token = $request['data'];
            Session::put('login', $token);
            return redirect()->route('home')->with('success', 'You are successfully logged in');
        } else {
            return redirect()->route('login')->with('failure', 'Username or Password is invalid');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('login');
        // dd($request->session()->all());
        return redirect()->route('home');
    }
}
