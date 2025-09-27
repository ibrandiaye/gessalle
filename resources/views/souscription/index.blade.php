@extends('welcome')
@section('title', '| souscription')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                                <li class="breadcrumb-item active ">LISTE DES SOUSCRIPTIONS</li>

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
    <div >
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
                            <th>ACTIONS</th>
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
                            <td>
                                <a href="{{ route('getOneSouscriptionById', $souscription->id) }}" role="button" class="btn btn-info" target="_blank"><i class="fas fa-print"></i></a>
                                 @if (Auth::user()->role=="admin")
                                <a href="{{ route('souscription.edit', $souscription->id) }}" role="button" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                <form method="POST"
                                    action="{{ route('souscription.destroy', $souscription->id) }}"
                                    style="display:inline;"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                                @endif

                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
    </div>
</div>

@endsection
