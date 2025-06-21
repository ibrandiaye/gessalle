<?php

namespace App\Http\Controllers;

use App\Repositories\DepenseRepository;
use App\Repositories\EmployeRepository;
use App\Repositories\SalleRepository;
use Illuminate\Http\Request;

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
        $this->employeRepository = $employeRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depenses = $this->depenseRepository->getAll();
        return view('depense.index',compact('depenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employes = $this->employeRepository->getAll();
        return view ('depense.add',compact("employes"));
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
