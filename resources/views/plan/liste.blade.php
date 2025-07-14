@extends('welcome')
@section('title', '| plan')


@section('content')
<div class="row">
    <div class="col-sm-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                                <li class="breadcrumb-item active ">LISTE DES PLANS</li>

                                </ol>
                            </div>
                              Gestion de salle de sport

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

<H4>ABONNEMENT</H4>
<div class="col-12">
    <div class="row">
        @foreach ($plans as $plan)
            @if ($plan->intitule!="essai" && $plan->type=="abonnement" )
                <div class="col-lg-4 mb-4">
                    <div class="card card-pricing shadow-sm border-0 rounded-lg overflow-hidden mb-4">
                        <!-- Card Header with accent color -->
                        <div class="card-header bg-success text-white text-center py-4">
                            <h4 class="font-weight-light mb-0 text-uppercase">{{ $plan->intitule }}</h4>
                        </div>

                        <!-- Price Section -->
                        <div class="card-body text-center px-4 py-5">
                            <h2 class="display-4 mb-3 font-weight-bold text-dark">{{ $plan->montant }} <small class="h6 text-muted">/mois</small></h2>
                            <p class="text-muted mb-4">ABONNEMENT</p>

                            <!-- Features List (you can add plan features if available) -->
                            <ul class="list-unstyled mb-4">
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success mr-2"></i> Accès illimité</li>

                            </ul>

                            <!-- Subscribe Button -->
                            <a href="{{ route('createBySalleAndPlan', [$plan->id,$plan->type]) }}"
                            class="btn btn-danger btn-lg btn-block rounded-pill py-3 shadow-sm mt-3">
                                <i class="fas fa-arrow-right mr-2"></i> Acheter maintenant
                            </a>
                        </div>


                    </div>
                </div>
            @endif
        @endforeach


    </div>

</div>


<H4>PACK SMS</H4>
<div class="col-12">
    <div class="row">
        @foreach ($plans as $plan)
            @if ($plan->intitule!="essai" && $plan->type=="sms")
               <div class="col-lg-4 mb-4">
                    <div class="card card-pricing shadow-sm border-0 rounded-lg overflow-hidden mb-4">
                        <!-- Card Header with different accent color (info blue) -->
                        <div class="card-header bg-info text-white text-center py-4">
                            <h4 class="font-weight-light mb-0 text-uppercase">{{ $plan->intitule }}</h4>
                        </div>

                        <!-- Price Section -->
                        <div class="card-body text-center px-4 py-5">
                            <h2 class="display-4 mb-3 font-weight-bold text-dark">{{ $plan->montant }}
                                <small class="h6 text-muted">/forfait</small>
                            </h2>
                            <p class="text-info font-weight-bold mb-4">
                                <i class="fas fa-sms mr-2"></i> PACK SMS
                            </p>

                            <!-- Features List spécifique SMS -->
                            <ul class="list-unstyled mb-4">
                                <li class="py-2 border-bottom"><i class="fas fa-check text-info mr-2"></i>  {{ $plan->nb_jour }} SMS </li>

                            </ul>

                            <!-- Subscribe Button -->
                            <a href="{{ route('createBySalleAndPlan', [$plan->id,$plan->type]) }}"
                            class="btn btn-primary btn-lg btn-block rounded-pill py-3 shadow-sm mt-3">
                                <i class="fas fa-mobile-alt mr-2"></i> Souscrire
                            </a>
                        </div>


                    </div>
                </div>
            @endif
        @endforeach


    </div>

</div>

@endsection
