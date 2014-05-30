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

	

}