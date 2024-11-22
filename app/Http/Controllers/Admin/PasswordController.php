<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{

    public function navigateChangePassword(){
        return view('admin.profile.passwordchange');
    }

    public function changePassword(Request $request){
        $this->checkValidation($request);
        $userRegisteredPassword = Auth::user()->password;

        if(Hash::check($request->oldPassword, $userRegisteredPassword)){

            User::where('id',Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);
            alert()->success('success','Password Changed Successfully..');
            if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin'){
                return to_route('profile#view');
            }
            if(Auth::user()->role == 'user'){
                return to_route('user#home');
            }
        }
        else{
            alert()->error('Process Fail...','Old passwords do not match. Try Again...');
            return back();
        }
    }

    //password validation
    private function checkValidation($request){
        $rules = [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6|max:20',
            'confirmPassword' => 'required|min:6|max:20|same:newPassword'
        ];

        $messages = ['oldPassword.required' => 'Please enter your current password.',
                    'newPassword.required' => 'Please enter a new password.',
                    'confirmPassword.same' => 'Confirm password must match new password.',];

        $request->validate($rules, $messages);
    }

}
