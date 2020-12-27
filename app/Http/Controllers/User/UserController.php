<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Response;
use stdClass;
use Validator;
use Auth;
use App\Models\Company;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use App\Rules\MatchOldPassword;

class UserController extends Controller
{
	const URL = "";

	public function dashboard()
	{
		$user = parent::getUser();

		return view('user.overview', ['user' => $user]);
	}

	public function profile() {
		$user = parent::getUser();

		return view('user.profile', ['user' => $user]);
	}
    public function updateprofile(Request $request, Response $response) {

        $user =  parent::getUser();


        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],

        ]);
        User::find(auth()->user()->id)->update($request);
        return redirect()->route('user.profile')
            ->with('User profile has been updated.');
    }
    public function changepassword() {
        $user = parent::getUser();

        return view('user.change-password', ['user' => $user]);
    }

    public function postchangepassword(Request $request, Response $response) {

        $user =  parent::getUser();


        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'password' => ['required'],
            'confirm_password' => ['same:password'],

        ]);
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);
        return redirect()->route('user.changepassword')
            ->with('User password has been updated.');
    }


}
