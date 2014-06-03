<?php namespace Fashion\Repos\Category;


interface CategoryRepository {

	public function paginate($limit);
	public function findById($id);
	public function store($data);
	public function update($id, $data);
	public function destroy($id);
	public function getCategories();
	public function getLasts();
	public function getParents();
	public function search($search);
	

	
}