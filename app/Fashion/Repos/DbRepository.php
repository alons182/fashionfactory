<?php namespace Fashion\Repos;

use Image;
use File;
use Str;

abstract class DbRepository
{
	protected $model;

	function __construct($model)
	{
		$this->model = $model;
	}

	public function getLasts()
	{
		return $this->model->orderBy('created_at', 'desc');
	}
	public function getTotal()
	{
		return $this->model->count();
	}
	public function findById($id)
	{
		return $this->model->findOrFail($id);
	}
	public function paginate($limit)
	{
		return $this->model->paginate($limit);
	}
	public function store($data)
	{
		return $this->model->create($data);
	}
	public function update($id, $data)
	{
		$model = $this->findById($id);
		$model->fill($data);
		$model->save();

		return $model;
	}
	public function update_state($id, $state)
	{
		
		$model = $this->findById($id);
		$model->published = $state;
		$model->save();

		return $model;
	}
	public function update_feat($id, $feat)
	{
		$model = $this->findById($id);
		$model->featured = $feat;
		$model->save();

		return $model;
	}
	public function destroy($id)
	{
		$model = $this->findById($id);
		$model->delete();
		
		return $model;
	}

	public function storeImage($file ,$name, $directory, $thumbWidth, $thumbHeight = null)
	{

		 $filename = Str::slug($name) .'.'. $file->getClientOriginalExtension();
		 $path = dir_photos_path($directory);
		 $image = Image::make($file->getRealPath());

		 File::exists($path) or File::makeDirectory($path);

		 $image->save($path . $filename)
		 	   ->resize($thumbWidth, $thumbHeight, function ($constraint) {
				    $constraint->aspectRatio(); })
		 	   ->save($path .'thumb_'. $filename);
		return  $filename;
	}
}
