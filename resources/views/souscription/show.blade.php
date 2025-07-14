@extends('welcome')
@section('title', '| souscription')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                                <li class="breadcrumb-item  "><a href="{{ route('souscription.index') }}" >LISTE DES SOUSCRIPTIONS</a></li>

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

<div class="col-12">
    <div class="card ">
        <div class="card-header">
            LISTE DES SOUSCRIPTIONS
            <div class="float-right">
                <a href="{{ route('createByClient', $client->id) }}" class="btn btn-primary">Ajouter un souscription</a>
            </div>
        </div>
            <div class="card-body">

                <table id="datatable-buttons" class="table table-bordered table-responsive table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>PRENOM </th>
                            <th>NOM </th>
                            <th>EMAIL</th>
                            <th>TEL</th>
                            <th>SEXE</th>
                            <th>TYPE</th>
                            <th>DATE DEBUT</th>
                            <th>DATE FIN</th>
                            <th>Etat</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($souscriptions as $souscription)
                        <tr>
                            <td>{{ $souscription->id }}</td>
                            <td>{{ $client->prenom }}</td>
                            <td>{{ $client->nom}}</td>
                            <td>{{ $client->email}}</td>
                             <td>{{ $client->tel }}</td>
                            <td>{{ $client->sexe}}</td>
                            <td>{{ $souscription->offre}}</td>
                            <td>{{ $souscription->date_debut }}</td>
                            <td>{{ $souscription->date_fin }}</td>
                            <td>@if($souscription->etat=="active")
                                <span class="badge badge-success">{{ $souscription->etat }}</span>
                            @else
                                <span class="badge badge-danger">{{ $souscription->etat }}</span>
                            @endif</td>
                            <td>
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


                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
    </div>
</div>

@endsection
