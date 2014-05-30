<?php

class PasswordResetsController extends \BaseController {

	

	/**
	 * Show the form for creating a new resource.
	 * GET /passwordresets/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('password_resets.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /passwordresets
	 *
	 * @return Response
	 */
	public function store()
	{
		
		$response = Password::remind(Input::only('email'),function($message)
			{
				$message->subject('Your Password Remider');
			});
		
		switch ($response)
		{
			case Password::INVALID_USER:
				return Redirect::back()->with([
									'flash_message' => Lang::get($response),
									'flash_type' => 'alert-danger'
								]);

				

			case Password::REMINDER_SENT:
				return Redirect::back()->with([
									'flash_message' => Lang::get($response),
									'flash_type' => 'alert-success'
								]);
		}


	}

	public function reset($token)
	{
		if (is_null($token)) App::abort(404);

		return View::make('password_resets.reset')->withToken($token);
	}

	public function postReset()
	{
		$creds = Input::only('email', 'password', 'password_confirmation','token');
		
		Password::validator(function($creds)
		{
		    return strlen($creds['password']) >= 3;
		});

		$response = Password::reset($creds, function($user, $password)
		{
			
			$user->password = $password;
			$user->save();

			
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with([
									'flash_message' => Lang::get($response),
									'flash_type' => 'alert-danger'
								]);

			case Password::PASSWORD_RESET:
				return Redirect::to('admin/login')->with([
									'flash_message' =>'Your password has been Change',
									'flash_type' => 'alert-success'
								]);;
		}
	}

	

}