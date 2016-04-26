<?php namespace Modules\Character\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pingpong\Modules\Routing\Controller;

class CharacterController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List all characters of the current user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index()
	{
        //$activeCharacter = DB::table('characters')->where('user_id');

        $characters = DB::table('characters')->where('user_id')->get();


		return view('character::index', array(
        ));
	}

    public function create(){

        $maleHairStyles =   array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
        $femaleHairStyles = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);


        return view('character::create', array(
            'maleHairStyles' => $maleHairStyles,
            'femaleHairStyles' => $femaleHairStyles,
        ));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);
    }

	public function skills(){
		return view('character::skills');
	}

    public function inventory(){
        return view('character::inventory');
    }

    public function equipment(){
        return view('character::equipment');
    }

    public function edit(){
        return view('character::edit');
    }

    public function pl(){
        return view('character::pl');
    }

    public function quest(){
        return view('character::quest');
    }

    public function jobquest(){
        return view('character::jobquest');
    }
	
}