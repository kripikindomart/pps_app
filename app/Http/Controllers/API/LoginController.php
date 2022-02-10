<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\ApiarController as ApiarController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class LoginController extends ApiarController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'roles' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('auth_token')->plainTextToken;
        $success['name'] =  $user->name;
        $user->assignRole($request->input('roles'));

        return $this->sendResponse($success, 'User register successfully.');
    }


    public function login(Request $request)
    {
        //VALIDASI EMAIL DAN PASSWORD YANG DIKIRIMKAN
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        //ADA 3 VALUE YANG DIKIRIMKAN, YAKNI: EMAIL, PASSWORD DAN REMEMBER_ME
        //AMBIL SEMUA REQUEST TERSEBUT KECUALI REMEMBER ME KARENA YANG DIBUTUHKAN 
        //UNTUK OTENTIKASI ADALAH EMAIL DAN PASSWORD
        $auth = $request->except(['remember_me']);

        //MELAKUKAN PROSES OTENTIKASI
        if (Auth::attempt($auth, $request->remember_me)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            //KEMUDIAN KIRIM RESPONSENYA KE CLIENT UNTUK DIPROSES LEBIH LANJUT
            return response()->json(['status' => 'success', 'data' => $token], 200);
        }
        //APABILA GAGAL, KIRIM RESPONSE LAGI KE BAHWA PERMINTAAN GAGAL
        return response()->json(['status' => 'failed']);
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
