<?php

namespace App\Http\Controllers;

use App\Repositories\LicenceRepository;
use App\Repositories\PlanRepository;
use App\Repositories\SalleRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $licences = $this->licenceRepository->getAll();
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

        $plan = $this->planRepository->getById($request->plan_id);
        $date_fin = $date = Carbon::parse($request->date_debut)->addDays($plan->nb_jour);
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
        //


}
