<?php

namespace App\Http\Controllers;

use App\enums\Essai;
use App\Mail\CompteClient;
use App\Repositories\LicenceRepository;
use App\Repositories\PlanRepository;
use App\Repositories\SalleRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SalleController extends Controller
{
     protected $salleRepository;
     protected $planRepository;
     protected $licenceRepository;
     protected $userRepository;

    public function __construct(SalleRepository $salleRepository,
                                PlanRepository $planRepository,LicenceRepository $licenceRepository,UserRepository $userRepository)
    {
        $this->salleRepository = $salleRepository;
        $this->planRepository  = $planRepository;
        $this->licenceRepository = $licenceRepository;
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Salle";
        $salles = $this->salleRepository->getAll();
        return view('salle.index',compact('salles', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Salle > Ajoute salle";
        return view ('salle.add',compact('title'));
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
        'nom' => 'required',
        'adresse' => 'required',
        'telephone' => 'required',
        'image' => 'required',
        'essai' => 'required',
         'logo' => 'file|mimes:png,jpg,jpeg',
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'adresse.required' => 'L\'adresse est obligatoire obligatoire.',
            'telephone.required' => 'Le téléphone est obligatoire.',

        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('logo'), $imageName);
        $request->merge(['logo'=>$imageName]);


        $salle = $this->salleRepository->store($request->all());
       
        if($request->essai == Essai::OUI->value)    
        {
            $plan = $this->planRepository->getByIntitule("essai");
            if(!$plan)
            {
                $plan = $this->planRepository->store(["intitule"=>"essai","nb_jour"=>(int)$_ENV['NBR_ESSAI'],"montant"=>0,"statut"=>"active","type"=>"abonnement"]);
            }
            $request->merge(["salle_id"=>$salle->id,"plan_id"=>$plan->id,
            "date_fin"=>Carbon::parse(today())->addDays($plan->nb_jour),"montant"=>0,"password"=>Hash::make("P@sser123"),"name"=>$request->nom,
            "role"=>"admin","type_paiement"=>"essai","type"=>"abonnement" ]);
            $this->licenceRepository->store($request->all());
        }else{
             $request->merge(["salle_id"=>$salle->id,"role"=>"admin","name"=>$request->nom,"password"=>Hash::make("P@sser123")]);
        
        }

        $user = $this->userRepository->store($request->all());

        Mail::to($request->email)->send(new CompteClient($user));
        //dd("dddd");
        return redirect('salle')->with('success','Salle ajoutée avec succès');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = "Ajoute";
        $salle = $this->salleRepository->getById($id);
        return view('salle.show',compact('title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salle = $this->salleRepository->getById($id);

        return view('salle.edit',compact('salle'));
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
        if($request->image)
        {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('logo'), $imageName);
            $request->merge(['logo'=>$imageName]);
        }
        $this->salleRepository->update($id, $request->all());
         $plan = $this->planRepository->getByIntitule("essai");
        $request->merge(["salle_id"=>$id,"plan_id"=>$plan->id,"date_debut"=>today(),
        "date_fin"=>Carbon::parse(today())->addDays($plan->nb_jour),"montant"=>0,"password"=>Hash::make("P@sser123"),"name"=>$request->nom,
        "role"=>"admin","type_paiement"=>"essai","type"=>"abonnement" ]);
        if($request->essai=="oui")
        {
            $this->licenceRepository->store($request->all());
        }
        return redirect('salle');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->salleRepository->destroy($id);
        return redirect('salle');
    }

    public function editEtat($id,$etat)
    {
        $this->salleRepository->editEtat($id,$etat);
         return redirect('salle');
    }
}
