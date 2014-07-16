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
        $this->limit = 10;
    }

    /**
     * Display a listing of the resource.
     * GET /products
     *
     * @param $category
     * @return Response
     */
    public function index($category)
    {
        $category = $this->categoryRepository->getCategories()->SearchSlug($category)->firstOrFail();
        $products = $category->products()->with('categories')->where('published', '=', 1)->paginate($this->limit);

        return View::make('products.index')->withProducts($products)->withCategory($category);
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
        $products = Search::products($search);

        return View::make('products.index')->withProducts($products)->withSearch($search['q']);
    }

    /**
     * Display the specified resource.
     * GET /products/{id}
     *
     * @param $category
     * @param $product
     * @internal param int $id
     * @return Response
     */
    public function show($category, $product)
    {
        $category = $this->categoryRepository->getCategories()->SearchSlug($category)->firstOrFail();
        $product = $category->products()->SearchSlug($product)->firstOrFail();
        $relateds = $this->productRepository->relateds($product);
        $photos = $this->photoRepository->getPhotos($product->id);

        return View::make('products.show')->withProduct($product)->withRelateds($relateds)->withCategory($category)->withPhotos($photos);
    }


}