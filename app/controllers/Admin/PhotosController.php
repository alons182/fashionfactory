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