@extends('welcome')
@section('title', '| plan')


@section('content')
<div class="row">
    <div class="col-sm-12">
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

        <div class="row " >
            <div class="col-lg-12">
                <h4 class="text-center">Scanner pour payer par orange Money<br><br></h4>
            </div>
        </div>
        <div class="row text-center" >
            <div class="col-lg-12 text-center">
                <img src="data:image/png;base64,{{ $qrcode }}">
            </div>
        </div>

@endsection
