<?php namespace App\Controllers\Admin;


use Input;
use Fashion\Forms\Product\RegistrationForm;
use Fashion\Forms\Product\EditForm;
use Fashion\Repos\Product\ProductRepository;
use Fashion\Repos\Category\CategoryRepository;


class ProductsController extends \BaseController {

    protected $registrationForm;
    protected $editForm;
	protected $productRepository;
    protected $categoryRepository;
	  

	function __construct(RegistrationForm $registrationForm, EditForm $editForm, ProductRepository $productRepository, CategoryRepository $categoryRepository)
	{
		$this->registrationForm = $registrationForm;
		$this->editForm = $editForm;
		$this->productRepository = $productRepository;
		$this->categoryRepository = $categoryRepository;
		
		$this->limit = 10;
	}


	/**
	 * Display a listing of the resource.
	 * GET /productsssas
	 *
	 * @return Respoasdanse
	 */
	public function index()
	{
		
		$search = Input::all();
		
		$search['q'] = (isset($search['q'])) ? trim($search['q']) : '';
		$search['cat'] = (isset($search['cat'])) ? $search['cat'] : '';
		$search['published'] = (isset($search['published'])) ? $search['published'] : '';
	
		$categories = $this->categoryRepository->getParents(false);

		$products = $this->productRepository->search($search)->with('categories')->paginate($this->limit);
						
		return \View::make('admin.products.index')->with([
				'products' => $products,
				'search' => $search['q'],
				'options' => $categories,
				'categorySelected' => $search['cat'],
				'selectedStatus' => $search['published']

				]);

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /products/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = $this->categoryRepository->getParents();
		
		return \View::make('admin.products.create')->withCategories($categories);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /products
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		
		$this->registrationForm->validate($input);

		$product = $this->productRepository->store($input);
				
		return \Redirect::route('admin.products.index')->with([
				'flash_message' => 'Product created',
				'flash_type' => 'alert-success'
			]);;
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
		//return \Product::with('relateds')->find($id);
		

		$product = $this->productRepository->findById($id);

		$relateds = $this->productRepository->relateds($product);
		
		$categories = $this->categoryRepository->getParents();
		
		$selectedCategories = $product->categories()->select('categories.id AS id')->lists('id');

		
		return \View::make('admin.products.edit')->withProduct($product)->withCategories($categories)->withSelected($selectedCategories)->withRelateds($relateds);
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
		
		$input = Input::all();
		$this->editForm->validate($input);
		$this->productRepository->update($id, $input);

		return \Redirect::route('admin.products.index')->with([
				'flash_message' => 'Updated Product',
				'flash_type' => 'alert-success'
			]);
	}

	/**
	 * published a Product.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function pub($id)
	{
		
		$this->productRepository->update_state($id, 1);
		return \Redirect::route('admin.products.index');
	}

	/**
	 * Unpublished a Product.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function unpub($id)
	{
		
		$this->productRepository->update_state($id, 0);
		return \Redirect::route('admin.products.index');
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
		$this->productRepository->destroy($id);

		return \Redirect::route('admin.products.index')->with([
				'flash_message' => 'Product Delete',
				'flash_type' => 'alert-success'
			]);
	}

    /**
     * Remove multiple resource from storage.
     * DELETE /products/{id}
     *
     * @internal param int $chk_product (array of ids)
     * @return Response
     */
	public function destroy_multiple()
	{
		$products_id = Input::get('chk_product');

		foreach ($products_id as $id) {
			$this->productRepository->destroy($id);
		}
		
		return \Redirect::route('admin.products.index')->with([
				'flash_message' => 'Products Delete',
				'flash_type' => 'alert-success'
			]);
		
	}

	/**
	 * List of products for the modal view of related products.
	 * GET /products/list
	 *
	 * @param  int  exc_id (exclude current id for editing)
	 * @return Response
	 */
	public function list_products()
	{

		return $this->productRepository->list_products(input::get('exc_id'),input::get('key'));
		
	}



}