<?php

namespace App\Http\Controllers;

use App\Repositories\OffreRepository;
use App\Repositories\SalleRepository;
use Illuminate\Http\Request;

class OffreController extends Controller
{
   protected $offreRepository;
   protected $salleRepository;

    public function __construct(OffreRepository $offreRepository,SalleRepository $salleRepository)
    {
        $this->offreRepository = $offreRepository;
        $this->salleRepository = $salleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offres = $this->offreRepository->getAll();
        return view('offre.index',compact('offres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('offre.add');
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

        $offre = $this->offreRepository->store($request->all());
        return redirect('offre');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offre = $this->offreRepository->getById($id);
        return view('offre.show',compact('offre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offre = $this->offreRepository->getById($id);
        return view('offre.edit',compact('offre'));
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
        $this->offreRepository->update($id, $request->all());
         return redirect('offre');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->offreRepository->destroy($id);
        return redirect('offre');
    }
        //



}
