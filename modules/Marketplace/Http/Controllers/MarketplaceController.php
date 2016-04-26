<?php namespace Modules\Marketplace\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class MarketplaceController extends Controller {
	
	public function index()
	{
		return view('marketplace::index');
	}
	
}