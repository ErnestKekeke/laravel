<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\CheckController;


class AdminController extends Controller
{
    private string $adminKey;

    public function __construct()
    {
        $this->adminKey = config('app.admin_key', '123456');
    }

    public function index(){
        return view('admin');
    }

    public function allUsers(Request $request){
        $users = null;
        $request->validate([
            'adminkey' => 'required|string',
        ]);

        if ($request->adminkey !== $this->adminKey) {
            return view('admin', compact('users'));
        }

        $users = User::all();

        session(['admin_users' => $users]);

        return view('admin', compact('users'));
    }

    public function changePassword(Request $request, $email){
        $request->validate([
            'password' => 'required|string|min:6',
        ]);
        $password = strip_tags(trim($request->password));
        $password = CheckController::password($password);

        if ($password === null) {
            return redirect('/admin')->with(["error"=>"password not accepted, must contain at least 1 digit, and a min of 6 characters"]);
        }

        $user = User::where('email', $email)->first();
        if($user === null) return redirect('/admin')->with(["error"=>"email or userid, not found in the database"]);
        
        if ($user) $user->update(['password' => Hash::make($password)]);

        // return "changed password " . $user->email . ", password: " . $user->password;

        return redirect('/admin')->with(["success"=>$user->userid . " was changed successfuully !!"]);
    }

    public function delete($email){
        $user = User::where('email', $email)->first();
        if($user === null) return redirect('/admin')->with(["error"=>"email or userid, found in the database"]);
        return $user->email . " delete successfully";
    }


    public function close(){
        session()->forget('admin_users');  // Remove users from session

        // Redirect to admin index with no-cache headers
        return redirect()->route('admin.index')
            ->withHeaders([
                'Cache-Control' => 'no-cache, no-store, must-revalidate', // HTTP 1.1.
                'Pragma' => 'no-cache', // HTTP 1.0.
                'Expires' => '0', // Proxies.
            ]);
    }
}
