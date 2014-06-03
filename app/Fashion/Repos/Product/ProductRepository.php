<?php namespace Fashion\Repos\Product;


interface ProductRepository {

	public function paginate($limit);
	public function findById($id);
	public function store($data);
	public function update($id, $data);
	public function destroy($id);
	public function search($search);
	public function getProducts();
	public function getLasts();
	public function sync_categories($product, $categories);
	public function sync_photos($product, $data);
	

	
}