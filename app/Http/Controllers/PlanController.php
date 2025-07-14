<?php

namespace App\Http\Controllers;

use App\Repositories\PlanRepository;
use Illuminate\Http\Request;

class PlanController extends Controller
{
     protected $planRepository;

    public function __construct(PlanRepository $planRepository)
    {
        $this->planRepository = $planRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = $this->planRepository->getAll();
        return view('plan.index',compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('plan.add');
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
        'intitule' => 'required',
        'nb_jour' => 'required|integer',
        'montant' => 'required|integer',
        ], );
        if($request->image)
        {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('photo'), $imageName);
            $request->merge(['photo'=>$imageName]);
        }


        $plan = $this->planRepository->store($request->all());
        return redirect('plan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = $this->planRepository->getById($id);
        return view('plan.show',compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = $this->planRepository->getById($id);
        return view('plan.edit',compact('plan'));
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
        if($request->image)
        {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('photo'), $imageName);
            $request->merge(['photo'=>$imageName]);
        }
        $this->planRepository->update($id, $request->all());
        return redirect('plan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->planRepository->destroy($id);
        return redirect('plan');
    }
     public function indexClient()
    {
        $plans = $this->planRepository->getAll();
        return view('plan.liste',compact('plans'));
    }

    public function updatePlanByEtat($id,$statut)
    {
        $this->planRepository->updatePlanByEtat($id,$statut);
        return redirect()->back()->with("success"," Mise à jour avec succée");
    }

}
