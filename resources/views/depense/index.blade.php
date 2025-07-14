@extends('welcome')
@section('title', '| depense')


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
    <div class="card ">
        <div class="card-header">
            LISTE DES DEPENSES
            <div class="float-right">
                <a href="{{ route('depense.create') }}" class="btn btn-primary">Ajouter un dépense</a>
            </div>
        </div>
            <div class="card-body">

                <table id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date Depense </th>
                            <th>Libelle </th>
                            <th>Montant </th>
                            <th>Employe</th>
                            <th>Actions</th>
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
                            <td>
                                <a href="{{ route('depense.edit', $depense->id) }}" role="button" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                <form method="POST"
                                    action="{{ route('depense.destroy', $depense->id) }}"
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
