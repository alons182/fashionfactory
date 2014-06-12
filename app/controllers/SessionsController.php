<?php

use Fashion\Forms\User\LoginForm;

class SessionsController extends \BaseController {

    protected $loginForm;

    function __construct(LoginForm $loginForm)
    {
        $this->loginForm = $loginForm;
    }


    /**
     * Show the form for creating a new resource.
     * GET /sessions/create
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /sessions
     *
     * @return Response
     */
    public function store()
    {
        $this->loginForm->validate($input = Input::only('email', 'password'));

        if (Auth::attempt($input))
        {
            return Redirect::intended('admin');
        }

        return Redirect::back()->withInput()->with([
            'flash_message' => 'Invalid Credentials',
            'flash_type'    => 'alert-danger'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     * DELETE /sessions/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id = null)
    {
        Auth::logout();

        return Redirect::route('login');
    }

}