<?php namespace Fashion\Composers;


use Fashion\Repos\Category\CategoryRepository;

class MenuComposer
{
	
	public function __construct(CategoryRepository $categoryRepository)
	{
		$this->categoryRepository = $categoryRepository;
		$this->limit = 10;
	}

	public function compose($view)
	{
		//$primary_categories = $this->categoryRepository->getCategories()->featured()->withDepth()->having('depth', '>=', 1)->get();
		
		//foreach ($primary_categories as $sub) {
		//	dd($sub->getDescendants());
		///}

		//$sub_categories = $primary_categories->getDescendants();
		//dd($sub_categories);
		$view->with('menu', $this->categoryRepository->getCategories()->featured()->withDepth()->having('depth', '>=', 1)->get());
	}
}
