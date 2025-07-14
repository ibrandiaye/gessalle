<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VerifLicence;
use App\Repositories\OffreRepository;
use App\Repositories\SalleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffreController extends Controller
{
   protected $offreRepository;
   protected $salleRepository;

    public function __construct(OffreRepository $offreRepository,SalleRepository $salleRepository)
    {
        $this->middleware([VerifLicence::class])->except(['index',"show"]);

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
        $user = Auth::user();
        $offres = $this->offreRepository->getOffreBySalle($user->salle_id);
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

        $user = auth()->user();
        $salle = $user->salle;

        if (!$salle->hasActiveLicence()) {
            return redirect()->back()->withErrors(['licence' => 'La salle n\'a pas de licence active.']);
        }

        $request->validate([

            'nom' => 'required|string',
            'duree' => 'required|integer',
            'prix' => 'required|integer',

        ]);
        $request->merge(["salle_id"=>Auth::user()->salle_id]);
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
         $user = auth()->user();
        $salle = $user->salle;

        if (!$salle->hasActiveLicence()) {
            return redirect()->back()->withErrors(['licence' => 'La salle n\'a pas de licence active.']);
        }

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
         $user = auth()->user();
        $salle = $user->salle;

        if (!$salle->hasActiveLicence()) {
            return redirect()->back()->withErrors(['licence' => 'La salle n\'a pas de licence active.']);
        }

        $this->offreRepository->destroy($id);
        return redirect('offre');
    }
        //

    public function updateOffreByEtatAndSalle($id,$etat)
    {
        $this->offreRepository->updateOffreByEtatAndSalle($id,$etat);
        return redirect('offre');
    }

}
