@extends('welcome')
@section('title', '| user')


@section('content')

            <div class="page-title-box">
                <div class="btn-group float-right">

                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ACCUEIL</a></li>
                        <li class="breadcrumb-item active ">LISTE DES UTILISATEURS</li>

                    </ol>
                </div>
                Gestion de salle de sport

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

        <div>
            <div class="card-header">
                LISTE DES UTILISATEURS
                <div class="float-right">
                    <a href="{{ route('user.create') }}" class="btn btn-primary">Ajouter un utilisateur</a>
                </div>
            </div>
            <div class="card-body">

                <table id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NOM </th>
                            <th>EMAIL</th>
                            <th>ROLE</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->role}}</td>
                            <td>
                                <a href="{{ route('user.edit', $user->id) }}" role="button" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                <form method="POST"
                                    action="{{ route('user.destroy', $user->id) }}"
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