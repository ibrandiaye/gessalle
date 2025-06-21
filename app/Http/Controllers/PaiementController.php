<?php

namespace App\Http\Controllers;

use App\Repositories\PaiementRepository;
use App\Repositories\SouscriptionRepository;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    protected $paiementRepository;
   protected $souscriptionRepository;

    public function __construct(PaiementRepository $paiementRepository,SouscriptionRepository $souscriptionRepository)
    {
        $this->paiementRepository = $paiementRepository;
        $this->souscriptionRepository = $souscriptionRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paiements = $this->paiementRepository->getAll();
        return view('paiement.index',compact('paiements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('paiement.add');
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

        $paiement = $this->paiementRepository->store($request->all());
        return redirect('paiement');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paiement = $this->paiementRepository->getById($id);
        return view('paiement.show',compact('paiement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paiement = $this->paiementRepository->getById($id);
        return view('paiement.edit',compact('paiement'));
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
        $this->paiementRepository->update($id, $request->all());
         return redirect('paiement');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->paiementRepository->destroy($id);
        return redirect('paiement');
    }
}
