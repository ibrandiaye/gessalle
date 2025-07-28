@extends('welcome')

@section('content')
 <div class="page-content-wrapper ">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        {{-- <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Gestion de salle de spot</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol> --}}
                    </div>
                    <h4 class="page-title">Tableau de bord</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            @if($licence)
                 @if ($licence->date_fin >= today())
               <marquee><p> Votre Licence expire le {{  Carbon\Carbon::parse( $licence->date_fin)->format('d-m-Y') }} </p></marquee>
                @else
                    <marquee><p> Votre Licence a expire depuis le {{ Carbon\Carbon::parse( $licence->date_fin)->format('d-m-Y')}} </p></marquee>
                @endif
            @endif

        </div>
        <div class="row">

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="col-3 align-self-center">
                                <div class="round">
                                    <i class="mdi mdi-home"></i>
                                </div>
                            </div>
                            <div class="col-9 align-self-center text-right">
                                <div class="m-l-10">
                                    <h5 class="mt-0">{{ $depense}} </h5>
                                     <p class="mb-0 text-muted">Dépense</p>
                                    {{-- <p class="mb-0 text-muted">dont  <span class="badge bg-soft-success"><i class="mdi mdi-arrow-up"></i>{{ $nbSalleActive }} actives</span>
                                    <span class="badge bg-soft-danger"><i class="mdi mdi-arrow-down"></i>{{ $nbSalleInactive }} inactives</span>
                                    </p> --}}
                                </div>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height:3px;">
                            <div class="progress-bar  bg-success" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="col-3 align-self-center">
                                <div class="round">
                                    <i class="mdi mdi-account"></i>
                                </div>
                            </div>
                            <div class="col-9 text-right align-self-center">
                                <div class="m-l-10 ">
                                    <h5 class="mt-0">{{ $nbClient}} </h5>
                                     <p class="mb-0 text-muted">Clients</p>
                                    {{-- <p class="mb-0 text-muted">dont  <span class="badge bg-soft-success"><i class="mdi mdi-arrow-up"></i>{{ $nbLicenceActive }} actives</span>
                                    <span class="badge bg-soft-danger"><i class="mdi mdi-arrow-down"></i>{{ $nbLicenceInactive }} inactives</span> --}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height:3px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 48%;" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="search-type-arrow"></div>
                        <div class="d-flex flex-row">
                            <div class="col-3 align-self-center">
                                <div class="round ">
                                    <i class="ion-social-usd"></i>
                                </div>
                            </div>
                            <div class="col-9 align-self-center text-right">
                                <div class="m-l-10 ">
                                    <h5 class="mt-0">{{ $sommePaiment }}</h5>
                                    <p class="mb-0 text-muted">Chiffre d'affaire</p>
                                </div>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height:3px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 61%;" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="search-type-arrow"></div>
                        <div class="d-flex flex-row">
                            <div class="col-3 align-self-center">
                                <div class="round ">
                                    <i class="ion-navicon-round"></i>
                                </div>
                            </div>
                            <div class="col-9 align-self-center text-right">
                                <div class="m-l-10 ">
                                    <h5 class="mt-0">{{ Auth::user()->salle->ct_sms }}</h5>
                                    <p class="mb-0 text-muted">Nombre SMS</p>
                                </div>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height:3px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 61%;" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->

        </div><!--end row-->
    </div>
 </div>
@endsection
