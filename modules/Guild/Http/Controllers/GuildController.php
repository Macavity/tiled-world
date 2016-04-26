<?php namespace Modules\Guild\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class GuildController extends Controller {
	
	public function index()
	{
		return view('guild::index');
	}
	
}