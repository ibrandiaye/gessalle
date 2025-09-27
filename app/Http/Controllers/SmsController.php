<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use App\Repositories\ClientRepository;
use App\Repositories\SalleRepository;
use App\Repositories\SmsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmsController extends Controller
{
   protected $smsRepository;
   protected $salleRepository;
   protected $clientRepository;

    public function __construct(SmsRepository $smsRepository,SalleRepository $salleRepository,
        ClientRepository $clientRepository)
    {
       // $this->middleware([VerifLicence::class])->except(['index',"show"]);

        $this->smsRepository = $smsRepository;
        $this->salleRepository = $salleRepository;
        $this->clientRepository = $clientRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Message';
        $user = Auth::user();
        $sms = $this->smsRepository->getSmsBySalle($user->salle_id);
        return view('sms.index',compact('sms','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Message > Nouveau message";
        return view ('sms.add',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = auth()->user();
        $salle = $user->salle;
        $nbClient = $this->clientRepository->nbClientBySalle($salle->id);
        if($nbClient > $salle->ct_sms)
        {
            return redirect()->back()->withErrors(['licence' => "Nombre de message disponible Insuffisant"]);

        }



        $request->validate([

            'message' => 'required|string',


        ]);
        $clients = $this->clientRepository->getClientBySalle($salle->id);
        foreach ($clients as $key => $client) {
             $sms = new Sms();
                $sms->tel = $client->tel;
                $sms->message = $request->message;
                $sms->salle_id = $salle->id;
                $sms->save();
        }

        $this->salleRepository->updateQuantiteMessage($salle->id,$salle->ct_sms - $nbClient);
        return redirect('sms');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = "Message > Ajoute";
        $sms = $this->smsRepository->getById($id);
        return view('sms.show',compact('sms'),compact('title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Message > Ajoute";
        $sms = $this->smsRepository->getById($id);
        return view('sms.edit',compact('sms'),compact('title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


}
