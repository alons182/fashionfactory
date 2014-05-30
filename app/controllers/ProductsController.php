<?php


use Fashion\Repos\Product\ProductRepository;
use Fashion\Repos\Category\CategoryRepository;
use Fashion\Repos\Photo\PhotoRepository;

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
	 * Show the form for creating a new resource.
	 * GET /products/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /products
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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

	/**
	 * Show the form for editing the specified resource.
	 * GET /products/{id}/edit
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
	 * PUT /products/{id}
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
	 * DELETE /products/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}