<?php namespace App\Controllers\Admin;

use Fashion\Repos\Category\CategoryRepository;
use Fashion\Repos\Product\ProductRepository;
use Fashion\Repos\User\UserRepository;

class DashboardController extends \BaseController {

	
	protected $categoryRepository;  

	function __construct( CategoryRepository $categoryRepository, ProductRepository $productRepository, UserRepository $userRepository)
	{
		$this->categoryRepository = $categoryRepository;
		$this->productRepository = $productRepository;
		$this->userRepository = $userRepository;
		$this->limit = 6;
	}



	/**
	 * Display a listing of the resource.
	 * GET /dashboard
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = $this->categoryRepository->getLasts()->withoutRoot()->withDepth()->limit($this->limit)->get();
		$products = $this->productRepository->getLasts()->limit($this->limit)->get();
		$users = $this->userRepository->getLasts()->limit($this->limit)->get();
		
		return \View::make('admin.dashboard.index')->withCategories($categories)->withProducts($products)->withUsers($users);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /dashboard/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /dashboard
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /dashboard/{id}
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
	 * GET /dashboard/{id}/edit
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
	 * PUT /dashboard/{id}
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
	 * DELETE /dashboard/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}