<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', '2fa']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function reauthenticate(Request $request)
    {
        // Cek User Login
        $user = \Auth::user();

        // initialise the 2FA class
        $google2fa = app('pragmarx.google2fa');

        // generate secret key baru untuk user
        $user->google2fa_secret = $google2fa->generateSecretKey();

        // memperbaharui data user
        $user->save();

        // generate the QR image
        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $user->google2fa_secret
        );

        // Passing the QR barcode image ke view.
        return view('google2fa.register', ['QR_Image' => $QR_Image, 
                                            'secret' => $user->google2fa_secret,
                                            'reauthenticating' => true
                                        ]);
    }
}
