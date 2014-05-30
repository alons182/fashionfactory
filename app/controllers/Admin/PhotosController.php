<?php namespace App\Controllers\Admin;

use Input;
use Fashion\Repos\Photo\PhotoRepository;

class PhotosController extends \BaseController {

	
	protected $photoRepository;
	
	function __construct(PhotoRepository $photoRepository)
	{
		$this->photoRepository = $photoRepository;
		$this->limit = 10;
	}

	/**
	 * Display a listing of the resource.
	 * GET /photos
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /photos/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /photos
	 *
	 * @return Response
	 */
	public function store()
	{
	 	
		$data['product_id'] = Input::get('id');
		$data['photo'] = $_FILES['file'];
		
		return $this->photoRepository->store($data);;
	}

	/**
	 * Display the specified resource.
	 * GET /photos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /photos/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /photos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /photos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//$id = Input::get('photo_id');
			
		return $this->photoRepository->destroy($id);;
	}

}