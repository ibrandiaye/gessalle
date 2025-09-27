<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\PlanRepository;
use App\Repositories\SalleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userRepository;
    protected $salleRepository;
    protected $planRepository;
    public function __construct(UserRepository $userRepository,SalleRepository $salleRepository,
    PlanRepository $planRepository){
        $this->userRepository =$userRepository;
        $this->salleRepository = $salleRepository;
        $this->planRepository = $planRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $title = "Utilisateurs";
        $users = $this->userRepository->getAll();
        return view('user.index',compact('users','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Ajoute Utilisateur";
        $salles = $this->salleRepository->getAll();
        return view('user.add',compact("salles", 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|string|min:8|confirmed|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
        'role' => 'required',
        //'g-recaptcha-response' => 'required|captcha',
        ], [
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.regex' => 'Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial.',
        ]);

        //$users = $this->userRepository->store($request->all());
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => $request['role'],
            'salle_id' => $request['salle_id'] ?? null,
        ]);
        return redirect('user');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->getById($id);
        return view('user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Modifier Utilisateur";
        $user = $this->userRepository->getById($id);
        $salles = $this->salleRepository->getAll();

        return view('user.edit',compact('user',"salles", 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->userRepository->update($id, $request->all());
       // if(Auth::user()->role=="admin")
          //  return redirect('user');
       // else
            return redirect()->back()->with('success', 'Compte modifier avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userRepository->destroy($id);
        return redirect('user');
    }

    public function updatePassword(Request $request)
    {

        $this->validate($request,
        [
                'password' => 'required|string|min:8|confirmed|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
            ],
            messages: [
                'password.required' => 'Le mot de passe est obligatoire.',
                'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
                'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
                'password.regex' => 'Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial.',
            ]);
            $user = Auth::user();

            User::where("id",$user->id)->update(["password"=>Hash::make($request['password']),"is_first_connected"=>false]);
            return redirect(to: 'home');

       /* else if(Auth::user()->role=="candidats")
        {
            User::where("id",Auth::user()->id)->update(["password"=>Hash::make($request['password'])]);
            return redirect('modifier/motdepasse')->with('success', 'Candidat modifier avec succès.');
        }*/


    }

    public function modifierMotDePasse()
    {
        $user = Auth::user();
        $nbJour= 0;
        if($user->salle_id && $user->salle->essai == "oui" )
        {
            $plan = $this->planRepository->getByIntitule("essai");
            $nbJour = $plan->nb_jour;
        }

        return view("user.modifier_password",compact("nbJour"));
    }

}
