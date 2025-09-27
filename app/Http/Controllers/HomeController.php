<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Repositories\ClientRepository;
use App\Repositories\DepenseRepository;
use App\Repositories\LicenceRepository;
use App\Repositories\OffreRepository;
use App\Repositories\PaiementRepository;
use App\Repositories\PlanRepository;
use App\Repositories\SalleRepository;
use App\Repositories\SouscriptionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $salleRepository;
    protected $licenceRepository;
    protected $paiementRepository;
    protected $clientRepository;
    protected $depenseRepository;
    protected $offreRepository;
    protected $souscriptionRepository;
    protected $planRepository;
    public function __construct(SalleRepository $salleRepository,LicenceRepository $licenceRepository,
        PlanRepository $planRepository,
        PaiementRepository $paiementRepository,ClientRepository $clientRepository,
        DepenseRepository $depenseRepository,OffreRepository $offreRepository, SouscriptionRepository $souscriptionRepository)
    {
       // $this->middleware('auth');
       $this->licenceRepository = $licenceRepository;
       $this->salleRepository = $salleRepository;
       $this->clientRepository  = $clientRepository;
       $this->paiementRepository  = $paiementRepository;
       $this->depenseRepository = $depenseRepository;
       $this->offreRepository   = $offreRepository;
       $this->souscriptionRepository = $souscriptionRepository;
       $this->planRepository = $planRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $title="tableau de bord";
        if($user->role=="superadmin")
        {
        $nbSalleActive = $this->salleRepository->nbSalleByEtat("active");
        $nbSalleInactive = $this->salleRepository->nbSalleByEtat("inactive");
        $nbLicenceActive = $this->licenceRepository->nbLicenceByEtat("active");
        $nbLicenceInactive = $this->licenceRepository->nbLicenceByEtat("expire");
        $chiffreAffaire = $this->licenceRepository->chiffreAffaire();
        $chiffreAffaireParClient = $this->licenceRepository->chiffreAffaireParClient();
        $nbrSalle = $this->salleRepository->nbrSalle();
        $nbrPlan = $this->planRepository->allPlan();

       // dd($chiffreAffaireParClient);
        return view('home',compact("nbSalleActive","nbSalleInactive","nbrSalle","nbrPlan",
            "nbLicenceActive","nbLicenceInactive","chiffreAffaire","chiffreAffaireParClient",'title'));
        }
        else
        {
            $sommePaiment = $this->paiementRepository->sumPaiementBySalle($user->salle_id);
            $nbClient = $this->clientRepository->nbClientBySalle($user->salle_id);
            $depense = $this->depenseRepository->sumDepenseBySalle($user->salle_id);
            $nbOffre = $this->offreRepository->nbOffreBySalle($user->salle_id);
            $licence = $this->licenceRepository->getLicenceOneBySalle($user->salle_id);
            //dd($sommePaiment,$nbClient);
            return view('home-salle',compact("sommePaiment","nbClient","depense","nbOffre","licence",'title'));
        }

    }

    public function pageRapport()
    {
        $depenses = [];
        $debut = null;
        $fin = null;
        $depenseTotal = 0;
        $souscriptions =[];
        $souscriptionsTotal = 0;
        return view("rapport",compact("depenses","debut","fin",
                    "depenseTotal","souscriptions","souscriptionsTotal"));
    }

    public function rapport(Request $request)
    {
        $debut = $request->debut;
        $fin = $request->fin;
        $user = Auth::user();
        $depenseTotal = 0;
        $depenses = $this->depenseRepository->getDepenseBySalleAndDate($user->salle_id,$request->debut,$request->fin);
        foreach ($depenses as $key => $value) {
            $depenseTotal += $value->montant;
        }
        $souscriptions = $this->souscriptionRepository->getSouscriptionBySalleAnddate($user->salle_id,$request->debut,$request->fin);
        $souscriptionsTotal = 0;
        foreach ($souscriptions as $key => $value) {
            $souscriptionsTotal += $value->prix;
        }
        return view("rapport",compact("depenses","debut","fin",
                    "depenseTotal","souscriptions","souscriptionsTotal"));

    }
}
