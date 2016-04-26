<?php namespace Modules\Map\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class MapController extends Controller {

	public function __construct(){
		$this->middleware('auth');
	}

	public function index()
	{
		return view('map::index');
	}
	
}