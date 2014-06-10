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

	/**
	 * Display the list resource.
	 * GET /home
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$categories = $this->categoryRepository->getCategories()->featured()->withDepth()->having('depth', '>=', 1)->get();
		$hola = "hola";
		return View::make('pages.home')->with(compact("categories"));
	}

	/**
	 * Display the About page.
	 * GET /about
	 *
	 * @return Response
	 */

	public function about()
	{
		return View::make('pages.about');
	}

	/**
	 * Display the Contact page.
	 * GET /contact
	 *
	 * @return Response
	 */
	public function contact()
	{
		return View::make('pages.contact');
	}

	/**
	 * Send contact form.
	 * POST /contact
	 *
	 * @return Response
	 */
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
