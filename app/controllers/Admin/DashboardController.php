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
		$categories = $this->categoryRepository->getLasts();
		$total_categories = $this->categoryRepository->getTotal();
		
		$products = $this->productRepository->getLasts();
		$total_products = $this->productRepository->getTotal();

		$users = $this->userRepository->getLasts();
		$total_users = $this->userRepository->getTotal();
		//return $categories;

		return \View::make('admin.dashboard.index')->withCategories($categories)->withTc($total_categories)->withProducts($products)->withTp($total_products)->withUsers($users)->withTu($total_users);
	}

	

}