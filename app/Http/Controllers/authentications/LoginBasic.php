<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\MainMenuPermission;
use App\Models\PermissionConfig;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  public function login_verfication(Request $request)
  {

    //dd($request->all());

    $user_data = User::where('user_name', $request->username)->first();

    if ($user_data) {
      if (Hash::check($request->password, $user_data->password)) {
        Auth::login($user_data); // Log the user in
        session(['user_data' => $user_data]);
        return redirect()->route('dashboard-analytics')->with('success', 'Post created successfully.');
      } else {
        return back()->withErrors([
          'username' => 'The provided password does not match our records.',
        ]);
      }
    } else {

      return back()->withErrors([
        'username' => 'The provided credentials do not match our records.',
      ]);
    }
  }
}
