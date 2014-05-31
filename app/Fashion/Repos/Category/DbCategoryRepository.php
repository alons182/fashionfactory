<?php namespace Fashion\Repos\Category;

use Str;
use Category;
use File;
use Fashion\Repos\DbRepository;

class DbCategoryRepository extends DbRepository implements CategoryRepository{

	protected $model;

	function __construct(Category $model)
	{
		$this->model = $model;
		
	}

	public function store($data)
	{
		
		 $data['slug'] = Str::slug($data['name']);

		 $data['image'] = ( $data['image'] ) ? $this->storeImage($data['image'], $data['name'], 'categories', 200, null) : ''; 
			 
		 return $this->model->create($data);
		
	}

	
	public function update($id, $data)
	{
		$category = $this->model->findOrFail($id);
		
		$data['image'] = ( $data['image'] ) ? $this->storeImage($data['image'], $data['name'], 'categories', 200, null) : $category->image; 

	    $data['slug'] = Str::slug($data['name']);
		
		$category->fill($data);
		
		$category->save();

		return $category;

		
	}

	public function search($search)
	{

		
		if(isset($search['q']) && !empty($search['q']))
		{
			$categories = $this->getCategories()->Search($search['q']);
		}else
		{
			$categories = $this->getCategories();
		}

		if(isset($search['published']) && $search['published'] != "")
		{
			$categories = $categories->where('published', '=', $search['published']);
		}

      
      

		return $categories;
	}

	public function getCategories()
	{

	    return $this->model;
	}

	public function getParents($root = true)
	{
		$all = ($root) ? $this->model->select('id', 'name')->withDepth()->get() : $this->model->withoutRoot()->select('id', 'name')->withDepth()->get();
		
		$result = array();

		foreach ($all as $item)
		{
			$name = $item->name;

			if ($item->depth > 0) $name = str_repeat('—', $item->depth).' '.$name;

			$result[$item->id] = $name;
		}

		return $result;
	}

	public function destroy($id)
	  {
	    $category = $this->findById($id);
	    
	    $image_delete = $category->image;
	    
	    $category->delete();
	   
	  	File::delete(dir_photos_path('categories').$image_delete); 	
	  	
	  	File::delete(dir_photos_path('categories').'thumb_'.$image_delete);
	  


	    return $category;
	  }

	



}