@extends('welcome')
@section('title', '| licence')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                                <li class="breadcrumb-item active ">LISTE DES LICENCES</li>

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
            LISTE DES LICENCES
            <div class="float-right">
                <a href="{{ route('licence.create') }}" class="btn btn-primary">Créer une licence</a>
            </div>
        </div>
            <div class="card-body">

                <table id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Salle </th>
                            <th>Date début</th>
                            <th>Date Fin</th>
                            <th>Plan </th>
                            <th>Montant </th>
                            <th>Etat </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($licences as $licence)
                        <tr>
                            <td>{{ $licence->id }}</td>
                            <td>{{ $licence->salle->nom }}</td>
                            <td>{{ $licence->date_debut}}</td>
                            <td>{{ $licence->date_fin}}</td>
                            <td>{{ $licence->plan->intitule}}</td>
                            <td>{{ $licence->plan->montant}}</td>
                             <td>
                                @if($licence->statut=="active")
                                    <span class="badge badge-success">{{ $licence->statut }}</span>
                                @else
                                    <span class="badge badge-danger">{{ $licence->statut }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('licence.edit', $licence->id) }}" role="button" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                <form method="POST"
                                    action="{{ route('licence.destroy', $licence->id) }}"
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
