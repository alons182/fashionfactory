<?php


use Fashion\Repos\Category\CategoryRepository;

class CategoriesController extends \BaseController {

	protected $categoryRepository;  

	function __construct(CategoryRepository $categoryRepository)
	{
		$this->categoryRepository = $categoryRepository;
		$this->limit = 10;
	}

	/**
	 * Display a listing of the resource.
	 * GET /categories
	 *
	 * @return Response
	 */
	public function index()
	{

			
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /categories/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /categories
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /categories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$category = $this->categoryRepository->getCategories()->SearchSlug($slug)->firstOrFail();
		 
		$categories =  $this->categoryRepository->getCategories()->SearchParent($category->id)->where('published', '=', 1)->withDepth()->get();
		
	
		return  View::make('categories.index')->withCategories($categories);
		
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /categories/{id}/edit
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
	 * PUT /categories/{id}
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
	 * DELETE /categories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}