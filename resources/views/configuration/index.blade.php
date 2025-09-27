@extends('welcome')
@section('title', '| configuration')


@section('content')
 <div class="page-content-wrapper ">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">

                                        <ol class="breadcrumb hide-phone p-0 m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                                        <li class="breadcrumb-item active ">Liste des configurations de sport</li>

                                        </ol>
                                    </div>
                                    Gestion de configuration de sport

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
            <div>
                <div class="card-header">
                    LISTE DES CONFIGURATIONS DE SPORT
                    <div class="float-right">
                        <a href="{{ route('configuration.create') }}" class="btn btn-primary">Ajouter une configuration </a>
                    </div>
                </div>
                    <div class="card-body">

                        <table id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom </th>
                                    <th>Valeur</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($configurations as $configuration)
                                <tr>
                                    <td>{{ $configuration->id }}</td>
                                    <td>{{ $configuration->parametre }}</td>
                                    <td>{{ $configuration->valeur}}</td>

                                    <td>

                                        <a href="{{ route('configuration.edit', $configuration->id) }}" role="button" class="btn btn-warning" title="modifier"><i class="fas fa-edit" title="modifier"  ></i></a>
                                    <form method="POST"
                                            action="{{ route('configuration.destroy', $configuration->id) }}"
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
