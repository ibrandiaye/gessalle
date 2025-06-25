<?php

namespace App\Http\Controllers;

use App\Repositories\LicenceRepository;
use App\Repositories\SalleRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $salleRepository;
    protected $licenceRepository;
    public function __construct(SalleRepository $salleRepository,LicenceRepository $licenceRepository)
    {
       // $this->middleware('auth');
       $this->licenceRepository = $licenceRepository;
       $this->salleRepository = $salleRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $nbSalleActive = $this->salleRepository->nbSalleByEtat("active");
        $nbSalleInactive = $this->salleRepository->nbSalleByEtat("inactive");
        $nbLicenceActive = $this->licenceRepository->nbLicenceByEtat("active");
        $nbLicenceInactive = $this->licenceRepository->nbLicenceByEtat("expire");
        $chiffreAffaire = $this->licenceRepository->chiffreAffaire();
        return view('home',compact("nbSalleActive","nbSalleInactive",
            "nbLicenceActive","nbLicenceInactive","chiffreAffaire"));
    }
}
