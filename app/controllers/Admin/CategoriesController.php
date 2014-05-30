<?php namespace App\Controllers\Admin;

use Input;
use Fashion\Forms\Category\RegistrationForm;
use Fashion\Forms\Category\EditForm;
use Fashion\Repos\Category\CategoryRepository;

class CategoriesController extends \BaseController {

	protected $registrationForm;
	protected $categoryRepository;  

	function __construct(RegistrationForm $registrationForm, EditForm $editForm, CategoryRepository $categoryRepository)
	{
		$this->registrationForm = $registrationForm;
		$this->editForm = $editForm;
		$this->categoryRepository = $categoryRepository;
		$this->limit = 10;
	}

	/**
	 * Display a listing of the resource.
	 * GET /categories
	 *
	 * @return Response
	 */
	public function index()
	{
		$search = Input::all();
		
		$search['q'] = (isset($search['q'])) ? trim($search['q']) : '';
		$search['published'] = (isset($search['published'])) ? $search['published'] : '';
		
		$categories = $this->categoryRepository->search($search)->withoutRoot()->withDepth()->orderBy('_lft')->paginate($this->limit);

		return \View::make('admin.categories.index')->with([
			'categories' => $categories,
			'search' => $search['q'],
			'selectedStatus' => $search['published']

			]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /categories/create
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$options = $this->categoryRepository->getParents();
		
		return \View::make('admin.categories.create')->withOptions($options);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /categories
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
			
		$this->registrationForm->validate($input);

		$this->categoryRepository->store($input);
		

				
		return \Redirect::route('admin.categories.index')->with([
				'flash_message' => 'Category created',
				'flash_type' => 'alert-success'
			]);;
	}

	/**
	 * Display the specified resource.
	 * GET /categories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /categories/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$category = $this->categoryRepository->findById($id);
		$options = $this->categoryRepository->getParents();
		return \View::make('admin.categories.edit')->withCategory($category)->withOptions($options);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /categories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();
		$this->editForm->validate($input);
		$this->categoryRepository->update($id, $input);

		return \Redirect::route('admin.categories.index')->with([
				'flash_message' => 'Updated Category',
				'flash_type' => 'alert-success'
			]);
	}

	/**
	 * Update the state of the category.
	 * PUT /categories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update_state_feat($id)
	{
		
		$input = Input::all();
		
		if(isset($input['published']))
		{
			$state = ($input['published']) ? 0 : 1; 
			$this->categoryRepository->update_state($id, $state);
		}else
		{
			$feat = ($input['featured']) ? 0 : 1;  
			$this->categoryRepository->update_feat($id, $feat);
		}

		return \Redirect::route('admin.categories.index');
	}
	

	/**
	 * Remove the specified resource from storage.
	 * DELETE /categories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->categoryRepository->destroy($id);

		return \Redirect::route('admin.categories.index')->with([
				'flash_message' => 'Category Delete',
				'flash_type' => 'alert-success'
			]);;
	}

}