<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VerifLicence;
use App\Repositories\DepenseRepository;
use App\Repositories\EmployeRepository;
use App\Repositories\SalleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepenseController extends Controller
{
    protected $depenseRepository;
    protected $salleRepository;
    protected $employeRepository;

    public function __construct(DepenseRepository $depenseRepository,SalleRepository $salleRepository,
    EmployeRepository $employeRepository)
    {

        $this->depenseRepository = $depenseRepository;
        $this->salleRepository = $salleRepository;
        $this->middleware([VerifLicence::class])->except(['index',"show"]);
        $this->employeRepository = $employeRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Depenses";
        $user = Auth::user();
        $depenses = $this->depenseRepository->getDepenseBySalle($user->salle_id);
        return view('depense.index',compact('depenses','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Ajoute une dépense";
        $employes = $this->employeRepository->getEmployeBySalle(Auth::user()->salle_id);
        return view ('depense.add',compact("title","employes"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request, [
        'libelle' => 'required',
        'date_depense' => 'required|date',
        'montant' => 'required|integer',
        'employe_id' => 'required|integer',
        ] );
         $request->merge(["salle_id"=>Auth::user()->salle_id]);
        $depense = $this->depenseRepository->store($request->all());
        return redirect('depense');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $depense = $this->depenseRepository->getById($id);
        return view('depense.show',compact('depense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $depense = $this->depenseRepository->getById($id);
        $employes = $this->employeRepository->getAll();
        return view('depense.edit',compact('depense','employes'));
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
        $this->depenseRepository->update($id, $request->all());
         return redirect('depense');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->depenseRepository->destroy($id);
        return redirect('depense');
    }
        //



}
