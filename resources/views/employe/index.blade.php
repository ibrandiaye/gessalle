@extends('welcome')
@section('title', '| employe')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">ACCUEIL</a></li>
                    <li class="breadcrumb-item active ">LISTE DES EMPLOYES</li>

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
    {!! $errors->first('licence') !!} . <a href="{{route('indexClient')}}"><u>Merci de renouveler votre licence pour pouvoir continuer</u></a>
</div>
@endif
<div class="row">
<div class="col-12">
    <div class="card-header">
        LISTE DES EMPLOYES
        <div class="float-right">
            <a href="{{ route('employe.create') }}" class="btn btn-primary">Ajouter un employe</a>
        </div>
    </div>
    <div class="card-body">

        <table id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NOM </th>
                    <th>PSEUDO</th>
                    <th>ROLE</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employes as $employe)
                <tr>
                    <td>{{ $employe->id }}</td>
                    <td>{{ $employe->user->name }}</td>
                    <td>{{ $employe->user->email}}</td>
                    <td>{{ $employe->user->role}}</td>
                    <td>
                        <a href="{{ route('employe.edit', $employe->id) }}" role="button" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <form method="POST"
                            action="{{ route('employe.destroy', $employe->id) }}"
                            style="display:inline;"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalform3{{$employe->user->id}}">
                            <i class="mdi mdi-account-key" title="Modifier mot de passe"></i>
                        </button>
                        <div class="modal fade" id="exampleModalform3{{$employe->user->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modification mot de passe</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('user.password.update.employe') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">

                                            <input type="hidden" name="id" value="{{ $employe->user->id}}">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Mot de passe</label>
                                                        <input type="password" class="form-control" id="field-3" placeholder="Mot de passe" name="password">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Repetez Mot de passe</label>
                                                        <input type="password" name="password_confirmation" class="form-control" id="field-4" placeholder="Repetez Mot de passe">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Modifier mot de passe</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>

    </div>

</div>
</div>

@endsection