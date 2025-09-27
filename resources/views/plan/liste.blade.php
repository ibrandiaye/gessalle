@extends('welcome')
@section('title', '| plan')

@push('style')
    <style>
    
    .wrapper{
		max-width: 1090px;
		width: 100%;
		display: flex;
		flex-wrap: wrap;
		margin: auto;
		justify-content: space-between;
	}
	.wrapper .table{
		background: #fff;
		width: calc(33% - 20px);
		padding: 30px;
        border-radius: 30px;
	}
	@media (max-width: 1020px) {
		.wrapper .table{
		width: calc(50% - 20px);
		margin-bottom: 40px;
		}
	}
	@media (max-width: 698px) {
		.wrapper .table{
		width: 100%;
		}
	}
	.table .price-section{
		display: flex;
		justify-content: center;
	}
    .table .price-section-sms{
		display: flex;
		justify-content: center;
	}
	.price-section .price-area{
		height: 120px;
		width: 120px;
		border-radius: 50%;
		padding: 2px;
	}
    .price-section-sms .price-area-sms{
		height: 120px;
		width: 120px;
		border-radius: 50%;
		padding: 2px;
	}
	 .price-area .inner-area{
	 	height: 100%;
	 	width: 100%;
	 	border-radius: 50%;
	 	border:3px solid #fff;
	 	color: #fff;
	 	line-height: 117px;
	 	text-align: center;
	 	position: relative;
	}
	.price-area-sms .inner-area-sms{
	 	height: 100%;
	 	width: 100%;
	 	border-radius: 50%;
	 	border:3px solid #fff;
	 	color: #fff;
	 	line-height: 117px;
	 	text-align: center;
	 	position: relative;
	}
	.price-area .inner-area .text{
	 	font-size: 10px;
	 	font-weight: 400;
	 	position: absolute;
	 	top: -10px;
	 	right: 17px;
        margin-block: 25px;
	}
    
	.price-area-sms .inner-area-sms .text{
	 	font-size: 10px;
	 	font-weight: 400;
	 	position: absolute;
	 	top: -10px;
	 	right: 17px;
        margin-block: 25px;
	}
	.price-area .inner-area .price{
	 	font-size: 25px;
	 	font-weight: 300;
	 	margin-left: 16px;
	}
	.price-area-sms .inner-area-sms .price{
	 	font-size: 25px;
	 	font-weight: 300;
	 	margin-left: 16px;
	}
	.table .package_name{
	 	width: 100%;
	 	height: 2px;
	 	margin: 35px 0;
	 	position: relative;
	} 
	.table .package_name-sms{
	 	width: 100%;
	 	height: 2px;
	 	margin: 35px 0;
	 	position: relative;
	}
	.table .package_name::before{
	 	position: absolute;
	 	content: "";
	 	left: 50%;
	 	top: 50%;
	 	background: #fff;
	 	font-size: 25px;
	 	font-weight: 500;
	 	padding: 0 15px;
	 	transform: translate(-50%, -50%);
	}
	.table .package_name-sms::before{
	 	position: absolute;
	 	content: "";
	 	left: 50%;
	 	top: 50%;
	 	background: #fff;
	 	font-size: 25px;
	 	font-weight: 500;
	 	padding: 0 15px;
	 	transform: translate(-50%, -50%);
	}
	.table .features li{
	 	margin-bottom: 15px;
	 	list-style: none;
	 	display: flex;
	 	justify-content: space-between;
	}
	.table .features-sms li{
	 	margin-bottom: 15px;
	 	list-style: none;
	 	display: flex;
	 	justify-content: space-between;
	}
	.features li .list_name{
	 	font-size: 17px;
	 	font-weight: 400;
	}
    .features-sms li .list_name{
	 	font-size: 17px;
	 	font-weight: 400;
	}
	.features li .icon{
	 	font-size: 15px
	}
	.features-sms li .icon{
	 	font-size: 15px
	}
	.features li .icon.check{
	 	color: #0b5a36;
	}
	.features-sms li .icon.check{
	 	color: #2db94d;
	}
	.features li .icon.cross{
	 	color: #0b5a36;
	 }
     .features-sms li .icon.cross{
	 	color: #2db94d;
	 }
	 .table .btn {
	 	display: flex;
	 	justify-content: center;
	 }
	 
	 .table .btn-sms {
	 	display: flex;
	 	justify-content: center;
	 }
	 .table .btn button{
	 	width: 80%;
	 	height: 50px;
	 	color: #fff;
	 	font-size: 15px;
	 	font-weight: 500;
	 	border: none;
	 	outline: none;
	 	border-radius: 25px;
	 	cursor: pointer;
	 	transition: all 0.5s ease;
	 }
	 
	 .table .btn-sms button{
	 	width: 80%;
	 	height: 50px;
	 	color: #fff;
	 	font-size: 15px;
	 	font-weight: 500;
	 	border: none;
	 	outline: none;
	 	border-radius: 25px;
	 	cursor: pointer;
	 	transition: all 0.5s ease;
	 }
	 .table .btn button:hover {
	 	border-radius: 5px;
	 }
	 .table ::selection{
	 	color: #fff;
	 }
	 .table .btn-sms button:hover {
	 	border-radius: 5px;
	 }
	 .premium ::selection,
	 .premium .price-area,
	 .premium .inner-area,
	 .premium .btn button{
	 	background: #0b5a36;
	 }
     .premium-sms ::selection,
	 .premium-sms .price-area-sms,
	 .premium-sms .inner-area-sms,
	 .premium-sms .btn-sms button{
	 	background: #2db94d;
	 }
	 .premium .btn button:hover{
	 	color: #fff;
	 	background: #0b5a36;
	 }
	 .premium-sms .btn-sms button:hover{
	 	color: #fff;
	 	background: #43ef8b;
	 }
	 .premium .package_name{
	 	background: #0b5a36;
	 }
	 .premium-sms .package_name-sms{
	 	background: #43ef8b;
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
            <div class="btn-group float-right" id="title_ges">

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

<div class="wrapper">
    @foreach ($plans as $plan)
   
    @if ($plan->intitule != "Essai" && $plan->type=="abonnement" )
		<div class="table premium">
			<div class="price-section">
				<div class="price-area">
					<div class="inner-area">
						<span class="text">/mois</span>
						<span class="price">{{ $plan->montant }}</span>
					</div>
				</div>
			</div>
			<div class="package_name">{{ $plan->intitule }}</div>
			<div class="features">
			  <li>
			  	<p class="text-muted mb-4">ABONNEMENT</p>
			  	<span class="icon check"><i class="fas fa-check"></i>Accès illimité</span>
			  </li>
			</div>
			<div class="btn"><button data-toggle="modal" data-target="#exampleModalform{{ $plan->id }}">Acheter maintenant</button></div>
		</div>
         @endif

        @endforeach
	</div>

<H4>PACK SMS</H4>

<div class="wrapper">
    @foreach ($plans as $plan)
       @if ($plan->intitule!="Essai" && $plan->type=="sms" )
		<div class="table premium-sms">
			<div class="price-section-sms">
				<div class="price-area-sms">
					<div class="inner-area-sms">
						<span class="text">/forfait</span>
						<span class="price">{{ $plan->montant }}</span>
					</div>
				</div>
			</div>
			<div class="package_name-sms">{{ $plan->intitule }}</div>
			<div class="features-sms">
			  <li>
			  	<p class="text-muted mb-4">ABONNEMENT</p>
			  	<span class="icon check"><i class="fas fa-check"></i>Accès illimité</span>
			  </li>
			</div>
			<div class="btn-sms"><button data-toggle="modal" data-target="#exampleModalform{{ $plan->id }}"> Souscrire</button></div>
		</div>
         @endif
        @endforeach
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
