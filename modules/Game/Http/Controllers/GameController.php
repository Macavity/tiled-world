<?php namespace Modules\Game\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class GameController extends Controller {
	
	public function index()
	{
		return view('game::index');
	}
	
}