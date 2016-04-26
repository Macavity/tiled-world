<?php namespace Modules\Stats\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class StatsController extends Controller {
	
	public function index()
	{
		return view('stats::index');
	}
	
}