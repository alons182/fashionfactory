<?php namespace Fashion\Services\Search;

use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
	
	public function register()
	{
		$this->app->bind('search','Fashion\Services\Search\Search');
	}
}