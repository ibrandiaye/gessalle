@extends('welcome')
@section('title', '| salle')


@section('content')
 <div class="page-content-wrapper ">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">

                                        <ol class="breadcrumb hide-phone p-0 m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                                        <li class="breadcrumb-item active ">Liste des salles de sport</li>

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
                    LISTE DES SALLES DE SPORT
                    <div class="float-right">
                        <a href="{{ route('salle.create') }}" class="btn btn-primary">Ajouter une salle de sport</a>
                    </div>
                </div>
                    <div class="card-body">

                        <table id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>logo</th>
                                    <th>Nom </th>
                                    <th>Adresse</th>
                                    <th>Téléphone</th>
                                    <th>Etat</th>
                                    <th>Essai</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($salles as $salle)
                                <tr>
                                    <td>{{ $salle->id }}</td>
                                    <td> <img class="img img-rounded" height="40px" src="{{ asset('logo/'.$salle->logo) }}"></td>
                                    <td>{{ $salle->nom }}</td>
                                    <td>{{ $salle->adresse}}</td>
                                    <td>{{ $salle->telephone}}</td>
                                     <td>
                                        @if($salle->etat=="active")
                                            <span class="badge badge-success">{{ $salle->etat }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $salle->etat }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $salle->essai }}</td>
                                    <td>
                                        <a href="{{ route('createBySalle', $salle->id) }}" role="button" class="btn btn-info"><i class="fas fa-database" title="Ajouter Licence"></i></a>
                                         @if($salle->etat=="active")
                                            <a href="{{ route('edit.etat', ["id"=>$salle->id,"etat"=>"inactive"]) }}" role="button" class="btn btn-info" title="Changer Etat"><i class="ion-arrow-swap" title="Changer Etat"  ></i></a>
                                        @else
                                            <a href="{{ route('edit.etat', ["id"=>$salle->id,"etat"=>"active"]) }}" role="button" class="btn btn-info" title="Changer Etat"><i class="ion-arrow-swap" title="Changer Etat"  ></i></a>
                                        @endif
                                        <a href="{{ route('salle.edit', $salle->id) }}" role="button" class="btn btn-warning" title="modifier"><i class="fas fa-edit" title="modifier"  ></i></a>
                                    <form method="POST"
                                            action="{{ route('salle.destroy', $salle->id) }}"
                                            style="display:inline;"
                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" title="supprimer">
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
    </div>
 </div>

@endsection
