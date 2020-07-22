<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use App\Admin;
// use App\User;
use Auth;
use App\User;
class MultiloginController extends Controller
{
  public function getLogin()
  {
    return view('login');
  }

  public function postLogin(Request $request)
  {
      // Validate the form data
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required'
    ]);
      // Attempt to log the user in
      // Passwordnya pake bcrypt
    if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
        // if successful, then redirect to their intended location
      return redirect()->intended('/adminmakam');
    } else if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
      return redirect()->intended('/ahliwaris');
    } else {
      return redirect()->back()->withMsg('Fail! Email or Password incorrect');
    }
  }

  public function logout()
  {
    if (Auth::guard('admin')->check()) {
      Auth::guard('admin')->logout();
    } elseif (Auth::guard('user')->check()) {
      Auth::guard('user')->logout();
    }
    return redirect('/');
  }

  public function registerUser(Request $request) {
    $name = $request->name;
    $email = $request->email;
    $password = bcrypt($request->password);
    $isEmailExists = User::where('email', $email)->count();
    if($isEmailExists == 1) {
      return redirect()->back()->withMsg('Email has been use!');
    }
    User::create([
      'name' => $name,
      'email' => $email,
      'password' => $password
    ]);
    return redirect()->back()->withMsg('User has been registered, please log in');
  }

}