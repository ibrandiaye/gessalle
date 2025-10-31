<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VerifLicence;
use App\Models\Client;
use App\Repositories\ClientRepository;
use App\Repositories\OffreRepository;
use App\Repositories\PaiementRepository;
use App\Repositories\SalleRepository;
use App\Repositories\SouscriptionRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SouscriptionController extends Controller
{
     protected $souscriptionRepository;
   protected $offreRepository;
   protected $clientRepository;
   protected $paiementRepository;
   protected $salleRepository;

    public function __construct(SouscriptionRepository $souscriptionRepository,OffreRepository $offreRepository,
    ClientRepository $clientRepository,PaiementRepository $paiementRepository,SalleRepository $salleRepository)
    {
        $this->middleware([VerifLicence::class])->except(['index',"show","getOneSouscriptionById"]);

        $this->souscriptionRepository = $souscriptionRepository;
        $this->offreRepository = $offreRepository;
        $this->clientRepository = $clientRepository;
        $this->paiementRepository = $paiementRepository;
        $this->salleRepository = $salleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Tickets";
        $user = Auth::user();
        $souscriptions = $this->souscriptionRepository->getSouscriptionBySalle($user->salle_id);
        return view('souscription.index',compact('souscriptions','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $offres = $this->offreRepository->getAllBySalle(Auth::user()->salle_id);
        $clients = $this->clientRepository->getAll();
        return view ('souscription.add',compact('offres','clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([

            'nom' => 'required|string',
            'prenom' => 'required|string',
            'date_naissance' => 'date',
            'date_debut' => 'date',
            'type_paiement' => 'required|string',
        ]);

        $offre = $this->offreRepository->getById($request->offre_id);
        $date_fin =  Carbon::parse($request->date_debut)->addDays($offre->duree);

        $request->merge(["salle_id"=>Auth::user()->salle_id,'date_fin'=>$date_fin,'etat'=>'active']);
        $client = $this->clientRepository->store($request->all());
        $request->merge(["client_id"=>$client->id]);
        $souscription = $this->souscriptionRepository->store($request->all());
        $request->merge(["souscription_id"=>$souscription->id,'date_paiement'=>$request->date_debut,
        "reference"=>$client->id."-".$request->date_debut,"montant"=>$offre->prix]);
        $this->paiementRepository->store($request->all());
        return redirect('souscription')->with('success', 'Ticket ajouter avec succès.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $souscription = $this->souscriptionRepository->getById($id);
        return view('souscription.show',compact('souscription'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $souscription = $this->souscriptionRepository->getById($id);
         $offres = $this->offreRepository->getAllBySalle(Auth::user()->salle_id);
        $clients = $this->clientRepository->getAll();
        $client = $this->clientRepository->getById($souscription->client_id);
        return view('souscription.edit',compact('souscription','clients','offres','client'));
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
          $offre = $this->offreRepository->getById($request->offre_id);
        $date_fin =  Carbon::parse($request->date_debut)->addDays($offre->duree);

        $request->merge(["salle_id"=>Auth::user()->id,'date_fin'=>$date_fin]);
        $this->souscriptionRepository->update($id, $request->all());
         return redirect('souscription')->with('success', 'Ticket modifier avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->souscriptionRepository->destroy($id);
        return redirect('souscription');
    }
        //
    public function createByClient($client_id)
    {
         $offres = $this->offreRepository->getAllBySalle(Auth::user()->salle_id);
         $client = $this->clientRepository->getById($client_id);
        return view("souscription.add-client",compact("client_id","offres",'client'));
    }

     public function storeByClient(Request $request)
    {
         $request->validate([
            'date_debut' => 'date',
            'type_paiement' => 'required|string',
        ]);

        $offre = $this->offreRepository->getById($request->offre_id);
        $date_fin =  Carbon::parse($request->date_debut)->addDays($offre->duree);

        $request->merge(["salle_id"=>Auth::user()->salle_id,'date_fin'=>$date_fin,'etat'=>'active']);
      //  dd($request->salle_id);
        $souscription = $this->souscriptionRepository->store($request->all());
        $request->merge(["souscription_id"=>$souscription->id,'date_paiement'=>$request->date_debut,
        "reference"=>$request->client_id."-".$request->date_debut,"montant"=>$offre->prix]);
        $this->paiementRepository->store($request->all());
        return redirect('souscription');

    }

    public function getSouscriptionByClient($client)
    {
        $souscriptions = $this->souscriptionRepository->getSouscriptionByClient($client);
        $client = $this->clientRepository->getById($client);
        //dd($client);
        return view("souscription.show",compact("souscriptions","client"));
    }
   public function getOneSouscriptionById($id)
    {
        $souscription = $this->souscriptionRepository->getOneSouscriptionById($id);

        // 🔹 Vérifie si la souscription existe
        if (!$souscription) {
            return redirect()
                ->back()
                ->with('error', 'Souscription introuvable.');
        }

        $salle = $this->salleRepository->getSalleById($souscription->salle_id);

        // 🔹 Génère le QR code avec l’URL complète et propre
        $url = url("impression/souscription/{$id}");
        $qrcode = QrCode::size(100)->generate($url);

        return view('souscription.impression', compact('souscription', 'salle', 'qrcode'));
    }


    public function ticketRapide()
    {
        $offres = $this->offreRepository->getAll();
        $clients = $this->clientRepository->getAll();
        return view ('souscription.ticket-rapide',compact('offres'));
    }
    public function storeRapide(Request $request)
    {
        $user = Auth::user();
        $offre = $this->offreRepository->OffreBySalleAndFirst($user->salle_id);
        $date_fin =  Carbon::parse(today())->addDays($offre->duree);

        $request->merge(["salle_id"=>$user->salle_id,'date_fin'=>$date_fin,'etat'=>'active','date_debut'=>today()]);
        if($request->tel)
        {
            $client =  $this->clientRepository->getClientBySalleAndTel($user->salle_id,$request->tel);
          
            if(empty($client))
            {
                $client = new Client();
                $client->nom = "anonyme";
                $client->tel = $request->tel;
                $client->salle_id = $user->salle_id;
                $client->save();
            }
        }else
        {
            $client =  $this->clientRepository->getClientBySalleAndName($user->salle_id,"anonyme");

            if(empty($client))
            {
                $client = new Client();
                $client->nom = "anonyme";
                $client->salle_id = $user->salle_id;
                $client->save();
            }

        }
       // $client = $this->clientRepository->store($request->all());
        $request->merge(["client_id"=>$client->id,"offre_id"=>$offre->id]);
        $souscription = $souscription = $this->souscriptionRepository->store($request->all());
        $request->merge(["souscription_id"=>$souscription->id,'date_paiement'=>$request->date_debut,
        "reference"=>$client->id."-".$request->date_debut,"montant"=>$offre->prix]);
        $this->paiementRepository->store($request->all());
        return redirect()->route("getOneSouscriptionById",[$souscription->id]);
    }
}
