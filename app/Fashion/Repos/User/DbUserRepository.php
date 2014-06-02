<?php namespace Fashion\Repos\User;

use User;
use Fashion\Repos\DbRepository;

class DbUserRepository extends DbRepository implements UserRepository{

	protected $model;

	function __construct(User $model)
	{
		$this->model = $model;
	}

	public function search($search)
	{
				
		if(! count($search)>0) return $this->model;

		
		if(trim($search['q']))
		{
			$users = $this->model->Search($search['q']);
		}else
		{
			$users = $this->model;
		}
      
      

		return $users;
	}

	public function getLasts()
	{
		return $this->model->orderBy('users.created_at', 'desc')
									->limit(6)->get(['users.id','users.username']);
	}



}