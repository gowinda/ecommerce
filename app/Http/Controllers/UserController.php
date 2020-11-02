<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    protected $user = null;
    protected $user_info = null;
    public function __construct(User $user, UserInfo $user_info)
    {
        $this->user = $user;
        $this->user_info = $user_info;
        $this->middleware('auth')->only(['showChangepasswordForm']);
    }
    public function showChangepasswordForm(Request $request){
        if($request->user()->role != $request->role){
            return redirect()->route('change-password',$request->user()->role);
        }
        return view('common.change-password-form');
    }

    public function savePassword(Request $request){
        $rules = $this->user->getPasswordChangeRules();
       $request->validate($rules);
        $password = Hash::make($request->password);
        $request->user()->password = $password;
        $request->user()->save();
        $request->session()->flash('success','Password Change Successfully.');
        return redirect()->route($request->user()->role);

    }
    public function registerUser(Request $request){
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'address' => 'required|string',
            'role' => 'required|in:seller,user',
            'phone' => 'required|string'
        ]);
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $this->user->fill($data);
        $status = $this->user->save();
        if ($status){
            $data['user_id'] = $this->user->id;
            $this->user_info->fill($data);
            $this->user_info->save();

            $request->session()->flash('success','Thankyou for registering with us. Please login to use our system ');
        }else{
            $request->session()->flash('error','Sorry! There was problem while adding please contact admin ');
        }
        return redirect()->route('login');
    }
}
