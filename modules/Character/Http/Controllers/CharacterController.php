<?php namespace Modules\Character\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pingpong\Modules\Routing\Controller;
use Modules\Character\Repositories\CharacterRepository;

class CharacterController extends Controller {

    /**
     * @var CharacterRepository
     */
    protected $characters;

    public function __construct(CharacterRepository $characterRespository)
    {
        $this->characters = $characterRespository;

        $this->middleware('auth');
    }

    /**
     * List all characters of the current user
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index(Request $request)
	{
		return view('character::index', array(
            'characters' => $this->characters->forUser($request->user())
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
        // @TODO Character:store - Strengthen validation
        $this->validate($request,[
            'name' => 'required|max:255',
            'gender' => 'required',
            'job' => 'required',
            'hair-style' => 'required',
            'hair-color' => 'required',
        ]);

        $request->user()->characters()->create([
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'job' => $request->input('job'),
            'hair_style' => $request->input('hair-style'),
            'hair_color' => $request->input('hair-color'),
        ]);

        return redirect('/char');
    }

    public function view(){
        return view('character::view');
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