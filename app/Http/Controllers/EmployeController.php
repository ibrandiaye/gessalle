<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VerifLicence;
use App\Mail\EmployeMail;
use App\Models\User;
use App\Repositories\EmployeRepository;
use App\Repositories\SalleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class EmployeController extends Controller
{
     protected $employeRepository;
   protected $salleRepository;
   public $userRepository;

    public function __construct(EmployeRepository $employeRepository,SalleRepository $salleRepository,
                                UserRepository $userRepository)
    {
        $this->middleware([VerifLicence::class])->except(['index',"show"]);

        $this->employeRepository = $employeRepository;
        $this->salleRepository = $salleRepository;
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $employes = $this->employeRepository->getEmployeBySalle($user->salle_id);
        return view('employe.index',compact('employes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('employe.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $salle = $user->salle;

        if (!$salle->hasActiveLicence()) {
            return redirect()->back()->withErrors(['licence' => 'La salle n\'a pas de licence active.']);
        }

        $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|string|min:8|confirmed|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
        //'g-recaptcha-response' => 'required|captcha',
        ], [
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.regex' => 'Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial.',
        ]);

        //$users = $this->userRepository->store($request->all());
        $user = $user_employe = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => "employe",
            'salle_id' => $user->salle_id,
        ]);
        $request->merge(["pseudo"=>$request['email'],'salle_id'=>$user->salle_id,'user_id'=>$user_employe->id]);
        $employe = $this->employeRepository->store($request->all());
                Mail::to($request->email)->send(new EmployeMail($user,$request->password));

        return redirect('employe');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employe = $this->employeRepository->getById($id);
        return view('employe.show',compact('employe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $user = auth()->user();
        $salle = $user->salle;

        if (!$salle->hasActiveLicence()) {
            return redirect()->back()->withErrors(['licence' => 'La salle n\'a pas de licence active.']);
        }

        $employe = $this->employeRepository->getById($id);
        return view('employe.edit',compact('employe'));
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
         $user = auth()->user();
        $salle = $user->salle;

        if (!$salle->hasActiveLicence()) {
            return redirect()->back()->withErrors(['licence' => 'La salle n\'a pas de licence active.']);
        }

        $this->employeRepository->update($id, $request->all());
         return redirect('employe');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->employeRepository->destroy($id);
        return redirect('employe');
    }
        //
public function updatePassword(Request $request)
    {
        $user = auth()->user();
        $salle = $user->salle;

        if (!$salle->hasActiveLicence()) {
            return redirect()->back()->withErrors(['licence' => 'La salle n\'a pas de licence active.']);
        }

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

            User::where("id",$request->user_id)->update(["password"=>Hash::make($request['password']),"is_first_connected"=>false]);
            return redirect()->back()->with("success","Mot moidfier avec Succée");




    }


}
