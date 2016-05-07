<?php namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Character\Repositories\CharacterRepository;
use Pingpong\Modules\Routing\Controller;

class AdminController extends Controller {

    private $characters;

	public function __construct(CharacterRepository $characterRepository)
	{
		$this->middleware('auth');

		$this->characters = $characterRepository;

	}

	public function index(Request $request)
	{
		return view('admin::index', [
            'title' => "Dashboard",
            'messages' => [],
            'user' => $request->user(),
        ]);
	}
	
}