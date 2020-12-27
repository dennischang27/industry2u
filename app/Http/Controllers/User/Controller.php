<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller as BaseController;
use App\Mail\InvitationMail;
use App\Mail\RequestMail;
use App\Mail\CustomizeProductRequestMail;
use App\Models\UserInvitation;
use App\Models\Request;
use Auth;
use Exception;
use Mail;

class Controller extends BaseController
{
	public const DOCUMENT_TYPE = [
		"application/pdf",
		"image/jpg",
		"image/jpeg",
		"image/png",
	];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function getUser() {
		return Auth::user();
	}

}
