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
		$view->with('menu', $this->categoryRepository->getCategories()->featured()->withDepth()->having('depth', '>=', 1)->get());
	}
}
