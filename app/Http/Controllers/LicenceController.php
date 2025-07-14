<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use App\Repositories\LicenceRepository;
use App\Repositories\PlanRepository;
use App\Repositories\SalleRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LicenceController extends Controller
{
   protected $licenceRepository;
   protected $salleRepository;
   protected $planRepository;

    public function __construct(LicenceRepository $licenceRepository,SalleRepository $salleRepository,
    PlanRepository $planRepository)
    {
        $this->licenceRepository = $licenceRepository;
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
        $user = Auth::user();
        if($user->role=="superadmin")
        {
            $licences = $this->licenceRepository->getAll();

        }
        elseif($user->role=="admin")
        {
            $licences = $this->licenceRepository->getLicenceBySalle($user->salle_id);
        }
        return view('licence.index',compact('licences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salles = $this->salleRepository->getAll();
        $plans = $this->planRepository->getAll();
        return view('licence.add',compact("salles","plans"));
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
        'date_debut' => 'required|date',
        //'date_fin' => 'required|date',
        'statut' => 'required|string',
        'salle_id' => 'required',
        'plan_id' => 'required',
        ] );
        $licenceAnterieur =   $this->licenceRepository->verifLicenceByEtat($request->salle_id,"active");
        if(!empty($licenceAnterieur))
        {
            return redirect()->back()->withErrors("Vous avez déjà une licence active");
        }
        $plan = $this->planRepository->getById($request->plan_id);
        $date_fin =  Carbon::parse($request->date_debut)->addDays($plan->nb_jour);
        $request->merge(['date_fin'=>$date_fin]);
        $licence = $this->licenceRepository->store($request->all());
        return redirect('licence');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $licence = $this->licenceRepository->getById($id);
        return view('licence.show',compact('licence'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $licence = $this->licenceRepository->getById($id);
        $salles = $this->salleRepository->getAll();
        $plans = $this->planRepository->getAll();
        return view('licence.edit',compact('licence','salles','plans'));
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
        $this->licenceRepository->update($id, $request->all());
         return redirect('licence');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->licenceRepository->destroy($id);
        return redirect('licence');
    }

     public function createBySalle($salle_id)
    {
        $plans = $this->planRepository->getAll();
        return view('licence.add-by-salle',compact("salle_id","plans"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBySalle(Request $request)
    {

        $this->validate($request, [
        'date_debut' => 'required|date',
        //'date_fin' => 'required|date',
        'statut' => 'required|string',
        'plan_id' => 'required',
        ] );
        $licenceAnterieur =   $this->licenceRepository->verifLicenceByEtat($request->salle_id,"active");
        if(!empty($licenceAnterieur))
        {
            return redirect()->back()->withErrors("Vous avez déjà une licence active");
        }
        $plan = $this->planRepository->getById($request->plan_id);
        $date_fin =  Carbon::parse($request->date_debut)->addDays($plan->nb_jour);
        $request->merge(['date_fin'=>$date_fin]);
        $licence = $this->licenceRepository->store($request->all());
        return redirect('licence');

    }
    public function createBySalleAndPlan($plan_id,$type)
        {
             $user = Auth::user();
            $plan = $this->planRepository->getById($plan_id);

            if($type=="abonnement")
            {

                $licenceAnterieur =   $this->licenceRepository->verifLicenceByEtat($user->salle_id,"active");
                if(!empty($licenceAnterieur))
                {
                    return redirect()->back()->withErrors("Vous avez déjà une licence active");
                }

                $licence = new Licence();
                $licence->date_debut = today();
                $licence->date_fin =Carbon::parse(today())->addDays($plan->nb_jour);
                $licence->statut = "active";
                $licence->salle_id = $user->salle_id;
                $licence->montant = $plan->montant;
                $licence->plan_id = $plan->id;
                $licence->save();
            }
            else
            {
                $this->salleRepository->updateQuantiteMessage($user->salle_id,$plan->nb_jour + $user->salle->ct_sms);
            }


            return redirect("home");
        }


}
