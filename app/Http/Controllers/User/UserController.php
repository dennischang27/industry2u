<?php

namespace App\Http\Controllers\User;

use Request;
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

		return view('user.profile',compact('user'));
	}

    private function validateProfile($data) {
        $rules = [
            'last_name' => ['required', 'string'],
            'first_name' => ['required', 'string']
        ];

        $validator = Validator::make($data, $rules);

        return $validator;
    }
    public function updateprofile(User $user) {

	    $this->validate(request(), [
            'last_name' => 'required',
            'first_name' => 'required',
        ]);


        $user->last_name = request('last_name');
        $user->first_name = request('first_name');
        $user->phone = request('phone');

        $user->save();

            return redirect()->route('user.profile')
                ->with('success','User profile has been updated.');

    }
    public function changepassword() {
        $user = parent::getUser();

        return view('user.change-password', ['user' => $user]);
    }

    public function postchangepassword(User $user) {



        $this->validate(request(), [
            'old_password' => ['required', new MatchOldPassword],
            'password' => ['required'],
            'confirm_password' => ['same:password'],

        ]);
        $user->password =  Hash::make(request('password'));

        return redirect()->route('user.changepassword')
            ->with('success','User password has been updated.');
    }


}
