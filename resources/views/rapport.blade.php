@extends('welcome')
@section('title', '| depense')

@section("css")
<style>
        .payment-option {
    padding: 15px;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    width: 45%;
    transition: all 0.3s ease;
    }

    .payment-option:hover {
    border-color: #0d6efd;
    cursor: pointer;
    }

    .form-check-input:checked + label {
    color: #0d6efd;
    }

    .form-check-input:checked + label img {
    filter: brightness(0) saturate(100%) invert(34%) sepia(74%) saturate(2476%) hue-rotate(202deg) brightness(98%) contrast(101%);
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                                <li class="breadcrumb-item active ">LISTE DES DEPENSES</li>

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
  @if ($errors->has('licence'))
        <div class="alert alert-danger">
            {!!  $errors->first('licence') !!} . <a href="{{route('indexClient')}}"><u>Merci de renouveler votre licence pour pouvoir continuer</u></a>
        </div>
    @endif
    <div class="col-12">
        <form method="POST" action="{{ route("rapport") }}">
            @csrf
            <div class="row">
                <div class="col-4">
                <div class="form-group">
                    {{-- <label>Debut </label> --}}
                    Debut : <input type="date" name="debut"  value="{{ $debut }}" class="form-control" required>
                </div>
            </div>
            <div class="col-4">
                Fin : <input type="date" name="fin"  value="{{ $fin}}" class="form-control" required>
            </div>
            <div class="col-4">
                <br>
                <button type="submit" class="btn btn-primary btn btn-lg "> Valider</button>

            </div>
            </div>
        </form>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-6">
                 <div class="text-center">
                <h5>Depense Total : {{ $depenseTotal }}</h5>
            </div>
            </div>
            <div class="col-6">
                 <div class="text-center">
                <h5>Montant des Souscriptions : {{ $souscriptionsTotal }}</h5>
            </div>
            </div>
        </div>
    </div>
    <div class="col-12">
    <div class="card ">
        <div class="card-header">
            LISTE DES SOUSCRIPTIONS
            <div class="float-right">
                <a href="{{ route('souscription.create') }}" class="btn btn-primary">Ajouter un souscription</a>
            </div>
        </div>
            <div class="card-body">

                <table id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>PRENOM & NOM </th>

                            <th>EMAIL</th>
                            <th>TEL</th>
                            <th>SEXE</th>
                            <th>TYPE</th>
                            <th>DEBUT </th>
                            <th>FIN </th>
                             <th>Etat </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($souscriptions as $souscription)
                        <tr>

                            <td>{{ $souscription->prenom}} {{ $souscription->nom}}</td>
                            <td>{{ $souscription->email}}</td>
                             <td>{{ $souscription->tel }}</td>
                            <td>{{ $souscription->sexe}}</td>
                            <td>{{ $souscription->offre}}</td>
                            <td>{{ Carbon\Carbon::parse( $souscription->date_debut)->format('d-m-Y')}} </td>
                            <td>{{ Carbon\Carbon::parse( $souscription->date_fin)->format('d-m-Y')}} </td>
                            <td>
                                @if ($souscription->date_fin >=today())
                                    <span class="badge badge-success">Valide</span>
                                @else
                                    <span class="badge badge-danger">Expiré</span>
                                @endif
                            </td>


                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
    </div>
</div>
<div class="col-12">
    <div class="card ">
        <div class="card-header">

        </div>
            <div class="card-body">

                <table id="datatable-buttons1" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date Depense </th>
                            <th>Libelle </th>
                            <th>Montant </th>
                            <th>Employe</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($depenses as $depense)
                        <tr>
                            <td>{{ $depense->id }}</td>
                            <td> {{ Carbon\Carbon::parse( $depense->date_depense)->format('d-m-Y')}} </td>
                            <td>{{ $depense->libelle }}</td>
                            <td>{{ $depense->montant}}</td>
                            <td>{{ $depense->employe->pseudo}}</td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
    </div>
</div>

@endsection
