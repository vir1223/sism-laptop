<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = User::orderBy('role')->get();
        return view('account.index',['akun'=>$data]);
    }
    
    /**
     * Show the form for creating a new resource.
    */
    public function create()
    {
        //
        return view('account.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'username'=>'required',
            'password'=>'required|min:6',
            'role'=>'required'
        ]);

        $a = User::create($validate);
        if($a){
            return redirect()->route('account.index');
        }
        return redirect()->back();
    }

   public function resetPassword(Request $request, User $user)
    {
        // Generate a new, random password
        $newPassword = Str::random(10);
        
        

        // Update the user's password with the new, hashed one
        $user->password = Hash::make($newPassword);
        $user->update();

        // Redirect back to the user list with a success message
        // and the new password, so the admin can see it.
        return back()->with([
            'success' => 'Password reset successfully for ' . $user->username . '.',
            'new_password' => $newPassword,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $a = User::find($id)->delete();
        if($a){
            return redirect()->route('account.index');
        }
        return redirect()->back();
    }
}
