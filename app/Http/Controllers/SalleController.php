<?php

namespace App\Http\Controllers;

use App\Repositories\SalleRepository;
use Illuminate\Http\Request;

class SalleController extends Controller
{
     protected $salleRepository;

    public function __construct(SalleRepository $salleRepository)
    {
        $this->salleRepository = $salleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salles = $this->salleRepository->getAll();
        return view('salle.index',compact('salles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('salle.add');
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
        'nom' => 'required',
        'adresse' => 'required',
        'telephone' => 'required',
        'image' => 'required',
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'adresse.required' => 'L\'adresse est obligatoire obligatoire.',
            'telephone.required' => 'Le téléphone est obligatoire.',
            'image.required' => 'Le logo est obligatoire.',
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('logo'), $imageName);
        $request->merge(['logo'=>$imageName]);
        /* Store $imageName name in DATABASE from HERE  */
        $salle = $this->salleRepository->store($request->all());
        return redirect('salle');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salle = $this->salleRepository->getById($id);
        return view('salle.show',compact('salle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salle = $this->salleRepository->getById($id);
        return view('salle.edit',compact('salle'));
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
            $request->image->move(public_path('logo'), $imageName);
            $request->merge(['logo'=>$imageName]);
        }
        $this->salleRepository->update($id, $request->all());
        return redirect('salle');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->salleRepository->destroy($id);
        return redirect('salle');
    }

    public function editEtat($id,$etat)
    {
        $this->salleRepository->editEtat($id,$etat);
         return redirect('salle');
    }
}
