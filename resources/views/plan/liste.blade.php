@extends('welcome')
@section('title', '| plan')

@push('style')
    <style>

    .payment-method-card {
        border: 2px solid transparent;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
    }

    .payment-method-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
    }

    .form-check-input:checked + .payment-method-card {
        border-color: #0d6efd;
        background-color: #e7f1ff;
    }

    .payment-logo {
        height: 40px;
        width: auto;
        object-fit: contain;
    }

    .modal-body {
        padding: 2rem;
    }
</style>
@endpush

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

                            <!-- Subscribe Button href="{--{ route('createBySalleAndPlan', [$plan->id,$plan->type]) }--}" -->
                            <a data-toggle="modal" data-target="#exampleModalform{{ $plan->id }}"
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
                            <a data-toggle="modal" data-target="#exampleModalform{{ $plan->id }}"
                            class="btn btn-primary btn-lg btn-block rounded-pill py-3 shadow-sm mt-3" style="color: white;">
                                <i class="fas fa-mobile-alt mr-2"></i> Souscrire
                            </a>
                        </div>


                    </div>
                </div>

            @endif
        @endforeach


    </div>

</div>
 @foreach ($plans as $plan)
<div class="modal fade" id="exampleModalform{{ $plan->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Achat Pack @if($plan->type=="sms") SMS : {{ $plan->nb_jour }} SMS @elseif($plan->type=="abonnement") {{ $plan->intitule }} {{ $plan->nb_jour }} jours @endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="paymentForm" id="paymentForm{{ $plan->id }}" method="POST" action="{{ route('createBySalleAndPlan') }}">
                    @csrf
                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                    <input type="hidden" name="type" value="{{ $plan->type }}">

                    <!-- Choix du service de paiement -->
                    <div class="mb-4">
                        <h6 class="mb-3 fw-bold text-center">Choisissez votre méthode de paiement</h6>
                        <div class="d-flex justify-content-around align-items-center flex-wrap gap-3">

                            <!-- Option Orange Money -->
                            <div class="form-check payment-option">
                                <input class="form-check-input d-none" type="radio" name="paymentMethod" id="orangePayment{{ $plan->id }}" value="orange">
                                <label class="form-check-label payment-method-card p-3 rounded-3 shadow-sm" for="orangePayment{{ $plan->id }}">
                                    <div class="d-flex flex-column align-items-center">
                                        <img src="{{ asset('images/orange_ci.png') }}" alt="Orange Money" class="payment-logo mb-2">
                                        <span class="fw-medium">Orange Money</span>
                                    </div>
                                </label>
                            </div>
                            <!-- Option Wave wavePayment-->
                            <div class="form-check payment-option">
                                <input class="form-check-input d-none" type="radio" name="paymentMethod" id="wavePayment{{ $plan->id }}" value="wave" checked>
                                <label class="form-check-label payment-method-card p-3 rounded-3 shadow-sm" for="wavePayment{{ $plan->id }}">
                                    <div class="d-flex flex-column align-items-center">
                                        <img src="{{ asset('images/wave.png') }}" alt="Wave" class="payment-logo mb-2">
                                        <span class="fw-medium">Wave SEN</span>
                                    </div>
                                </label>
                            </div>
                            <!-- Option Free Money -->
                            <div class="form-check payment-option">
                                <input class="form-check-input d-none" type="radio" name="paymentMethod" id="freePayment{{ $plan->id }}" value="free">
                                <label class="form-check-label payment-method-card p-3 rounded-3 shadow-sm" for="freePayment{{ $plan->id }}">
                                    <div class="d-flex flex-column align-items-center">
                                        <img src="{{ asset('images/free.png') }}" alt="Free Money" class="payment-logo mb-2">
                                        <span class="fw-medium">Free Money</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Numéro de téléphone -->
                    <div class="mb-3">
                        <label for="phoneNumber{{ $plan->id }}" class="form-label fw-medium">Numéro de téléphone</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-phone"></i></span>
                            <input type="tel" name="tel" class="form-control py-2" id="phoneNumber{{ $plan->id }}" placeholder="77 123 45 67" required>
                        </div>
                        <small class="text-muted">Entrez le numéro associé à votre méthode de paiement</small>
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="d-grid gap-2 mt-4 text-center">
                        <button type="submit" class="btn btn-primary py-2 fw-bold rounded-pill shadow">
                            <i class="bi bi-lock-fill me-2"></i> Payer maintenant ({{ number_format($plan->montant, 0, ',', ' ') }} FCFA)
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
