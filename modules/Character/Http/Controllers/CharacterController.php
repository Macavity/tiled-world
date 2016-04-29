<?php namespace Modules\Character\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Character\Entities\Character;
use Modules\Game\Repositories\ExperienceRepository;
use Pingpong\Modules\Routing\Controller;
use Modules\Character\Repositories\CharacterRepository;

class CharacterController extends Controller {

    /**
     * @var CharacterRepository
     */
    protected $characters;

    /**
     * @var ExperienceRepository
     */
    private $experience;

    public function __construct(CharacterRepository $characterRepository, ExperienceRepository $experienceRepository)
    {
        $this->middleware('auth');

        $this->characters = $characterRepository;
        $this->experience = $experienceRepository;

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

    public function create()
    {
        $maleHairStyles =   array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
        $femaleHairStyles = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);


        return view('character::create', array(
            'maleHairStyles' => $maleHairStyles,
            'femaleHairStyles' => $femaleHairStyles,
        ));
    }

    public function store(Request $request)
    {
        // @TODO Character:store - Strengthen validation
        $this->validate($request,[
            'name' => 'required|max:255',
            'gender' => 'required',
            'job' => 'required',
            'hair-style' => 'required',
            'hair-color' => 'required',
        ]);

        $gender = ($request->input('gender') === "male") ? GENDER_MALE : GENDER_FEMALE;

        switch($request->input('job')){
            case 'arc':
                $job = JOB_ARCHER; break;
            case 'thf':
                $job = JOB_THIEF; break;
            case 'mer':
                $job = JOB_MERCHANT; break;
            case 'mag':
                $job = JOB_MAGE; break;
            case 'aco':
                $job = JOB_ACOLYTE; break;
            case 'swd':
                $job = JOB_SWORDMAN; break;
            default:
                $job = JOB_NOVICE;
        }

        $request->user()->characters()->create([
            'name' => $request->input('name'),
            'gender' => $gender,
            'job' => $job,
            'hair_style' => $request->input('hair-style'),
            'hair_color' => $request->input('hair-color'),
        ]);

        return redirect('/char');
    }

    /**
     * Delete a character
     *
     * @param Request $request
     * @param Character $char
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Character $char){

        // Check authorization to delete this character
        $this->authorize('destroy', $char);

        $char->delete();

        return redirect('/char');
    }

    public function view(Character $character){

        $this->authorize('view', $character);

        $nextBaseExp = $this->experience->nextBaseExpForChar($character);
        $nextJobExp = $this->experience->nextJobExpForChar($character);

        // LevelUP ?
        $baseLevelUp = ($nextBaseExp > 0 && $character->base_exp >= $nextBaseExp);
        $jobLevelUp = ($nextJobExp > 0 && $character->job_exp >= $nextJobExp);

        return view('character::view', compact(
            'character',
            'baseLevelUp',
            'jobLevelUp'
        ));
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