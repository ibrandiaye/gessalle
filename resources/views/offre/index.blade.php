@extends('welcome')
@section('title', '| offre')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                                <li class="breadcrumb-item active ">LISTE DES OFFRES</li>

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
        <div class="card-header">
            LISTE DES OFFRES
            <div class="float-right">
                <a href="{{ route('offre.create') }}" class="btn btn-primary">Ajouter un offre</a>
            </div>
        </div>
            <div class="card-body">

                <table id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom </th>
                            <th>Nombre de jour </th>
                            <th>Montant</th>
                            <th>Description</th>
                            <th>Etat</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($offres as $offre)
                        <tr>
                            <td>{{ $offre->id }}</td>
                            <td>{{ $offre->nom }}</td>
                            <td>{{ $offre->duree}}</td>
                            <td>{{ $offre->prix}}</td>
                            <td>{{ $offre->description}}</td>
                            <td>
                                @if($offre->etat=="active")
                                    <span class="badge badge-success">{{ $offre->etat }}</span>
                                @else
                                    <span class="badge badge-danger">{{ $offre->etat }}</span>
                                @endif
                            </td>

                            <td>
                                 @if($offre->etat=="active")
                                    <a href="{{ route('updateOffreByEtatAndSalle', ["id"=>$offre->id,"etat"=>"desactive"]) }}" role="button" class="btn btn-info" title="Changer Etat"><i class="ion-arrow-swap" title="Changer Etat"  ></i></a>
                                @else
                                    <a href="{{ route('updateOffreByEtatAndSalle', ["id"=>$offre->id,"etat"=>"active"]) }}" role="button" class="btn btn-info" title="Changer Etat"><i class="ion-arrow-swap" title="Changer Etat"  ></i></a>
                                @endif
                                <a href="{{ route('offre.edit', $offre->id) }}" role="button" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                <form method="POST"
                                    action="{{ route('offre.destroy', $offre->id) }}"
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

@endsection
