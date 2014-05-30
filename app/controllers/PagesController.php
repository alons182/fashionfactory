<?php


use Fashion\Repos\Category\CategoryRepository;
use Fashion\Services\Mailers\ContactMailer;

class PagesController extends BaseController {

	
	protected $categoryRepository;  

	function __construct(CategoryRepository $categoryRepository, ContactMailer $mailer)
	{
		$this->categoryRepository = $categoryRepository;
		$this->mailer = $mailer;
		$this->limit = 10;
	}

	public function index()
	{
		
		$categories = $categories = $this->categoryRepository->getCategories()->featured()->withDepth()->having('depth', '>=', 1)->get();
		
		return View::make('pages.home')->withCategories($categories);
	}

	public function about()
	{
		return View::make('pages.about');
	}

	public function contact()
	{
		return View::make('pages.contact');
	}

	public function postContact()
	{
		$user = Input::all();
		
		$this->mailer->contact($user);
		
		return Redirect::route('contact')->with([
				'flash_message' => 'Información Enviada',
				'flash_type' => 'alert-success'
			]);;
	}


	
}
