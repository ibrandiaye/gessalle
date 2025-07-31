@extends('welcome')
@section('title', '| client')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                                <li class="breadcrumb-item active ">LISTE DES CLIENTS</li>

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
    <div class="card ">
        <div class="card-header">
            LISTE DES CLIENTS
            <div class="float-right">
                <a href="{{ route('client.create') }}" class="btn btn-primary">Ajouter un client</a>
            </div>
        </div>
            <div class="card-body">

                <table id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>PRENOM </th>
                            <th>NOM </th>
                            <th>EMAIL</th>
                            <th>TEL</th>
                            <th>SEXE</th>
                            <th>DATE DE NAISSANCE</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->prenom }}</td>
                            <td>{{ $client->nom}}</td>
                            <td>{{ $client->email}}</td>
                             <td>{{ $client->tel }}</td>
                            <td>{{ $client->sexe}}</td>
                            <td>{{ $client->date_naiss}}</td>
                            <td>
                                <a href="{{ route('getSouscriptionByClient', $client->id) }}" role="button" class="btn btn-primary"><i class="fas fa-eye" title="Vois Souscriptions"></i></a>
                                <a href="{{ route('createByClient', $client->id) }}" role="button" class="btn btn-info"><i class="fas fa-database" title="souscrire"></i></a>

                                <a href="{{ route('client.edit', $client->id) }}" role="button" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                <form method="POST"
                                    action="{{ route('client.destroy', $client->id) }}"
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
