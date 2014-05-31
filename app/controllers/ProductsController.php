<?php


use Fashion\Repos\Product\ProductRepository;
use Fashion\Repos\Category\CategoryRepository;
use Fashion\Repos\Photo\PhotoRepository;
use Fashion\Services\Search\Search;

class ProductsController extends \BaseController {

	
	protected $productRepository;
	protected $categoryRepository;    
	protected $photoRepository;
	
	function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository, PhotoRepository $photoRepository)
	{
		$this->productRepository = $productRepository;
		$this->categoryRepository = $categoryRepository;
		$this->photoRepository = $photoRepository;
		$this->limit = 15;
	}

	/**
	 * Display a listing of the resource.
	 * GET /products
	 *
	 * @return Response
	 */
	public function index($category)
	{
		
		$category = $this->categoryRepository->getCategories()->SearchSlug($category)->firstOrFail();
				 
		$products = $category->products()->with('categories')->where('published', '=', 1)->paginate($this->limit);
		
		return  View::make('products.index')->withProducts($products)->withCategory($category); 
	}

	/**
	 * Display a listing of the resource.
	 * GET /products
	 *
	 * @return Response
	 */
	public function search()
	{
		
		$search = Input::all();
		
		$products = $this->productRepository->search($search)->with('categories')->where('published', '=', 1)->paginate($this->limit);
		
		return  View::make('products.index')->withProducts($products)->withSearch($search['q']); 
	}

	/**
	 * Display the specified resource.
	 * GET /products/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($category, $product)
	{
		$category = $this->categoryRepository->getCategories()->SearchSlug($category)->firstOrFail();
		
		$product = $category->products()->SearchSlug($product)->firstOrFail();

		$photos = $this->photoRepository->getPhotos($product->id);
		
		return  View::make('products.show')->withProduct($product)->withCategory($category)->withPhotos($photos); 
	}

	

}