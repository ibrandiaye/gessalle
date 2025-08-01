<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VerifLicence;
use App\Repositories\ClientRepository;
use App\Repositories\SalleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
     protected $clientRepository;
   protected $salleRepository;

    public function __construct(ClientRepository $clientRepository,SalleRepository $salleRepository)
    {
        $this->middleware([VerifLicence::class])->except(['index',"show"]);
        $this->clientRepository = $clientRepository;
        $this->salleRepository = $salleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $clients = $this->clientRepository->getClientBySalle($user->salle_id);
        return view('client.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view ('client.add');
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
        ]);

        $request->merge(["salle_id"=>Auth::user()->salle_id]);
        $client = $this->clientRepository->store($request->all());
        return redirect('client');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = $this->clientRepository->getById($id);
        return view('client.show',compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = $this->clientRepository->getById($id);
        return view('client.edit',compact('client'));
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
        $this->clientRepository->update($id, $request->all());
         return redirect('client');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->clientRepository->destroy($id);
        return redirect('client');
    }
        //



}
