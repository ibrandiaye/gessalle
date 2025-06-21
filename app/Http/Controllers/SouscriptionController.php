<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepository;
use App\Repositories\OffreRepository;
use App\Repositories\SouscriptionRepository;
use Illuminate\Http\Request;

class SouscriptionController extends Controller
{
     protected $souscriptionRepository;
   protected $offreRepository;
   protected $clientRepository;

    public function __construct(SouscriptionRepository $souscriptionRepository,OffreRepository $offreRepository,
    ClientRepository $clientRepository)
    {
        $this->souscriptionRepository = $souscriptionRepository;
        $this->offreRepository = $offreRepository;
        $this->clientRepository = $clientRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $souscriptions = $this->souscriptionRepository->getAll();
        return view('souscription.index',compact('souscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $offres = $this->offreRepository->getAll();
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

        ]);

        $souscription = $this->souscriptionRepository->store($request->all());
        return redirect('souscription');

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
         $offres = $this->offreRepository->getAll();
        $clients = $this->clientRepository->getAll();
        return view('souscription.edit',compact('souscription','clients','offres'));
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
        $this->souscriptionRepository->update($id, $request->all());
         return redirect('souscription');
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

}
