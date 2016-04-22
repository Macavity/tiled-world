<?php namespace Modules\Map\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class MapController extends Controller {
	
	public function index()
	{
		return view('map::index');
	}
	
}