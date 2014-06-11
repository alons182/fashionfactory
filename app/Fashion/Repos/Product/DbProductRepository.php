<?php namespace Fashion\Repos\Product;
use Str;
use Product;
use Category;
use Photo;
use Related;
use File;
use Fashion\Repos\DbRepository;
use Fashion\Repos\Category\CategoryRepository;

class DbProductRepository extends DbRepository implements ProductRepository{

	protected $model;

	function __construct(Product $model, CategoryRepository $categoryRepository)
	{
		$this->model = $model;
		$this->categoryRepository = $categoryRepository;
		
	}

	public function findById($id)
	{
		return $this->model->with('categories')->findOrFail($id);
	}
	
	public function search($search)
	{
		
		
		if(isset($search['cat']) && !empty($search['cat']))
		{
			
			$category = $this->categoryRepository->findById($search['cat']);

			$products = $category->products();
			
		}else
		{
			$products = $this->model;
		}
		
		if(isset($search['q']) && !empty($search['q']))
		{
			$products = $products->Search($search['q']);
		}

		if(isset($search['published']) && $search['published'] != "")
		{
			$products = $products->where('published', '=', $search['published']);
		}

      

		return $products;
	}

	public function getProducts()
	{

	    return $this->model;
	}
	public function getLasts()
	{
		return $this->getProducts()->orderBy('products.created_at', 'desc')
									->limit(6)->get(['products.id','products.name']);
	}
	public function relateds($product)
	{
		
		if($product->relateds)
		{
			return $this->getProducts()->with('categories')->whereIn('id', $product->relateds)->get(['products.id','products.name','products.image','products.slug']);
		}
	
	}
	public function list_products($value=null,$search = null)
	{
		if($search)
		  	$products = ($value) ? $this->getProducts()->has('categories')->where('id', '<>', $value)->search($search)->paginate(8) : $this->getProducts()->has('categories')->paginate(8); 
		else 
			$products = ($value) ? $this->getProducts()->has('categories')->where('id', '<>', $value)->paginate(8) : $this->getProducts()->has('categories')->paginate(8); 
		
		return $products;
	}

	public function store($data)
	{
		
		$data['slug'] = Str::slug($data['name']);

		$data['sizes'] = existDataArray($data, 'sizes');

		$data['colors'] = existDataArray($data, 'colors');

		$data['relateds'] = existDataArray($data, 'relateds');
		
		$data['image'] = ( $data['image'] ) ? $this->storeImage($data['image'], $data['name'], 'products', 200, null) : ''; 
		 
		$product = $this->model->create($data);
		 			
		$this->sync_categories($product, $data['categories'] );

		$this->sync_photos($product, $data);

		
		return $product;
	}

	
	public function update($id, $data)
	{
		$product = $this->model->findOrFail($id);
		
		$data['sizes'] = existDataArray($data, 'sizes');

		$data['colors'] = existDataArray($data, 'colors');

		$data['relateds'] =existDataArray($data, 'relateds');

		$data['image'] = ( $data['image'] ) ? $this->storeImage($data['image'], $data['name'], 'products', 200, null) : $product->image;

		$data['slug'] = Str::slug($data['name']);


		$product->fill($data);

		$product->save();

		$this->sync_categories($product, $data['categories'] );
		
		
		return $product;

		
	}


	public function sync_categories($product, $categories)
	{
		
		$product->categories()->sync($categories);
	}

	

	public function sync_photos($product, $data)
	{
	
		if(isset($data['new_photo_file']))
		{

			$cant = count($data['new_photo_file']);
		   
	        foreach ($data['new_photo_file'] as $photo) {

	        	
	            
	            $filename = $this->storeImage($photo, 'photo_'. $cant--, 'products/'.$product->id, 50, null);
	            
	            $photos = new Photo;
				$photos->url = $filename;
				$photos->url_thumb = 'thumb_'.$filename;
				
				$product->photos()->save($photos);
	        }

		}
	
	}

	public function destroy($id)
	  {
	    $product = $this->findById($id);
	    
	    $image_delete = $product->image;
	    
	    $photos_delete = $product->id;
	    
	    $product->delete();
	   	

	 	File::delete(dir_photos_path('products').$image_delete); 	
	  	
	  	File::delete(dir_photos_path('products').'thumb_'.$image_delete);
	    
	    File::deleteDirectory(dir_photos_path('products').$photos_delete); 	
	  	

	    return $product;
	  }

	

	




}