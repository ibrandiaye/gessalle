<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use App\Repositories\LicenceRepository;
use App\Repositories\PlanRepository;
use App\Repositories\SalleRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
    public function createBySalleAndPlan(Request $request)
        {

            //$plan_id,$type
          // dd($request);

           // dd($api_key);
            $user = Auth::user();
            $plan = $this->planRepository->getById($request->plan_id);

            $api_key = env("API_KEY", 'PIX_22a66ce1-58f8-4587-9e6c-06e2d37f86b9');
            $wave_service = env("WAVE", 211);
            $orange_service = env("ORANGESN", 213);
            $yas_service = env("YAS",155);
            $bussiness_name_id = env("BUSINESS_NAME_ID", 'am-1yw9ja8y813e0');
            $service_id = "";
            $app_url = env("APP_URL", 'https://sport.syntechadvanced.sn/');
            /*if($request->type=="abonnement")
            {*/
           // $paymentMethod = $request->ppaymentMethod
            if($request->type=="abonnement")
            {
                /*$licenceAnterieur =   $this->licenceRepository->verifLicenceByEtat($user->salle_id,"active");
                 if(!empty($licenceAnterieur))
                {
                    return redirect()->back()->withErrors("Vous avez déjà une licence active");
                }*/
            }

                $licence = new Licence();
                $licence->date_debut = today();
                $licence->date_fin =Carbon::parse(today())->addDays($plan->nb_jour);
                $licence->statut = "paiement_en_cours";
                $licence->salle_id = $user->salle_id;
                $licence->montant = $plan->montant;
                $licence->plan_id = $plan->id;
                $licence->type = $request->type;
                $licence->type_paiement = $request->paymentMethod;
                $licence->save();
                 //dd($request->type);
                //dd($request->paymentMethod);
                if($request->paymentMethod=="wave")
                {
                    $service_id = $wave_service;
                }
                elseif($request->paymentMethod=="orange")
                {
                    $service_id = $orange_service;
                }
                elseif($request->paymentMethod=="free")
                {
                    $service_id = $yas_service;
                }

                $params = [
                'amount' => $plan->montant,
                'destination' => $request->tel,
                'api_key' => $api_key,
                'ipn_url' => $app_url."api/valider/paiement",
                'service_id' => (int)$service_id,
                'custom_data' => $licence->id,
                'business_name_id' => $bussiness_name_id,
                'redirect_url' => $app_url."",
                'redirect_error_url' => $app_url.""
            ];
            //dd($params);
                $payements = $this->licenceRepository->sendAirtimeRequest($params,$request->paymentMethod);
               // dd($request->type);
              //  dd($payements["data"]["sms_link"]);
            //  dd($payements);
                if($payements["statut_code"]==200)
                {

                    if($request->paymentMethod=="wave")
                    {
                       // dd($payements);
                        header("Location: ".$payements["data"]["sms_link"]);
                        exit();
                    }
                    elseif($request->paymentMethod=="orange")
                    {
                        //dd($payements);
                        $isMobile = $this->licenceRepository->isMobile();
                        if(!$isMobile)
                        {
                            $qrcode = $payements["data"]["sms_link2"];
                            return view("plan.orange",compact("qrcode"));
                        }
                        else
                        {
                            header("Location: ".$payements["data"]["sms_link1"]);
                            exit();
                        }
                    }
                    elseif($request->paymentMethod=="free")
                    {
                        return view("plan.free");
                    }


                }
                else
                {
                    return redirect()->back()->withErrors("Erreur de paiement");
                }

            /*}
            else
            {
                $this->salleRepository->updateQuantiteMessage($user->salle_id,$plan->nb_jour + $user->salle->ct_sms);
            }*/


            return redirect("home");
        }

        public function validatePaiement(Request $request)
        {
            //return response()->json("ok");
                       $licence_id  = $request['custom_data'];
            if($request['state']=="SUCCESSFUL" && $licence_id)
            {
                $licence = $this->licenceRepository->getById($licence_id);

                if($licence->type=="abonnement")
                {
                     DB::table("licences")->where("id",$licence_id)->update(["statut"=>"active"]);
                }
                else
                {

                    $plan = $this->planRepository->getById($licence->plan_id);
                    $this->salleRepository->updateQuantiteMessage($licence->salle_id,$plan->nb_jour + $licence->salle->ct_sms);
                    DB::table("licences")->where("id",$licence_id)->update(["statut"=>"active"]);
                }

            }
            return response()->json("ok");

        }

}
