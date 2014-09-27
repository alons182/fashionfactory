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
            'categories'     => $categories,
            'search'         => $search['q'],
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
            'flash_type'    => 'alert-success'
        ]);;
    }


    /**
     * Show the form for editing the specified resource.
     * GET /categories/{id}/edit
     *
     * @param  int $id
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
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $input = Input::all();
        $this->editForm->validate($input);
        $this->categoryRepository->update($id, $input);

        return \Redirect::route('admin.categories.index')->with([
            'flash_message' => 'Updated Category',
            'flash_type'    => 'alert-success'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     * DELETE /categories/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->categoryRepository->destroy($id);

        return \Redirect::route('admin.categories.index')->with([
            'flash_message' => 'Category Delete',
            'flash_type'    => 'alert-success'
        ]);;
    }


    /**
     * Featured.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function feat($id)
    {
        $this->categoryRepository->update_feat($id, 1);

        return \Redirect::route('admin.categories.index');
    }

    /**
     * un-featured.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function unfeat($id)
    {
        $this->categoryRepository->update_feat($id, 0);

        return \Redirect::route('admin.categories.index');
    }


    /**
     * published.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function pub($id)
    {
        $this->categoryRepository->update_state($id, 1);

        return \Redirect::route('admin.categories.index');
    }

    /**
     * Unpublished.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function unpub($id)
    {
        $this->categoryRepository->update_state($id, 0);

        return \Redirect::route('admin.categories.index');
    }


    /**
     * Move the specified page up.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function up($id)
    {
        return $this->move($id, 'before');
    }

    /**
     * Move the specified page down.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function down($id)
    {
        return $this->move($id, 'after');
    }

    /**
     * Move the page.
     *
     * @param  int $id
     * @param  'before'|'after' $dir
     *
     * @return Response
     */
    protected function move($id, $dir)
    {
        $category = $this->categoryRepository->findById($id);
        $response = \Redirect::route('admin.categories.index');

        if (! $category->isRoot())
        {
            $sibling = $dir === 'before' ? $category->getPrevSibling() : $category->getNextSibling();

            if ($sibling)
            {
                $category->$dir($sibling);

                if ($category->save())
                {
                    return $response->withSuccess([
                        'flash_message' => 'The vategory has been successfully moved!',
                        'flash_type'    => 'alert-success'
                    ]);
                }

                return $response->withError('Failed to save the category while moving.');
            }
        }

        return $response->with([
            'flash_message' => 'The category did not move.',
            'flash_type'    => 'alert-warning'
        ]);
    }

}