<?php namespace Fashion\Repos\Photo;


interface PhotoRepository {

	
	public function store($data);
	public function destroy($id);
	public function getPhotos($id);
	
	

	
}