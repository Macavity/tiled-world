<?php namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Character\Repositories\CharacterRepository;
use Pingpong\Modules\Routing\Controller;

class ImageController extends Controller {

    private $characters;

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function jobList(Request $request)
	{
		$jobs = [];

        

		return view('admin::images.joblist', [
            'title' => "Image Positions - Jobs",
            'messages' => [],
            'user' => $request->user(),
        ]);
	}
	
}