<?php namespace App\Controllers\Admin;

use Input;
use User;
use Auth;
use Fashion\Forms\User\RegistrationForm;
use Fashion\Forms\User\EditForm;
use Fashion\Repos\User\UserRepository;


class UsersController extends \BaseController {

	protected $registrationForm;
	protected $userRepository;  

	function __construct(RegistrationForm $registrationForm, EditForm $editForm, UserRepository $userRepository)
	{
		$this->registrationForm = $registrationForm;
		$this->editForm = $editForm;
		$this->userRepository = $userRepository;
		$this->limit = 10;
	}

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		$search = Input::all();
		
		if(! count($search)>0)
		{
		
			$search['q'] = "";
					
		}
		
		$users = $this->userRepository->search($search)->paginate($this->limit);
		
		return \View::make('admin.users.index')->with([
			'users' => $users,
			'search' => $search['q']
			
			]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return \View::make('admin.users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::only('username','email','password','password_confirmation','user_type');
			
		$this->registrationForm->validate($input);

		$user = $this->userRepository->store($input);
		
		//Auth::login($user);
		
		return \Redirect::route('users')->with([
				'flash_message' => 'User created',
				'flash_type' => 'alert-success'
			]);;
	}

	
	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = $this->userRepository->findById($id);

		return \View::make('admin.users.edit')->withUser($user);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::only('username','email','password','password_confirmation','user_type');
		$this->editForm->validate($input);
		$this->userRepository->update($id, $input);

		return \Redirect::route('users')->with([
				'flash_message' => 'Updated User',
				'flash_type' => 'alert-success'
			]);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
		$this->userRepository->destroy($id);

		return \Redirect::route('users')->with([
				'flash_message' => 'User Delete',
				'flash_type' => 'alert-success'
			]);;
	}

}