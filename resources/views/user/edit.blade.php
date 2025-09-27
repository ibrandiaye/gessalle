{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Modifier Département')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ACCUEIL</a></li>
                        <li class="breadcrumb-item active">Modifier un utilisateur</li>


                        </ol>
                    </div>
                     Gestion de salle

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <form method="POST" action="{{ route('user.update', $user->id) }}">
            @csrf
            @method('PATCH')
             <div class="card ">
                   
                        <div class="card-header ">
                            <div class="text-center">
                            FORMULAIRE DE MODIFICATION D'UN UTILISATEUR
                            </div>
                        </div>
                   
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                @endif
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nom</label>
                                        <input type="text" name="name" class="form-control" value="{{$user->name}}"   required>
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>email </label>
                                            <input type="email" name="email"  value=" {{$user->email }}" class="form-control"required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Salle</label>
                                        <select class="form-control" name="salle_id" >
                                             <option value="">Selectionner</option>
                                            @foreach ($salles as $salle)
                                            <option {{old('salle_id', $user->salle_id) == $salle->id ? 'selected' : ''}}
                                                value="{{$salle->id}}">{{$salle->nom}}</option>
                                                @endforeach

                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Role</label>
                                        <select class="form-control" name="role" required="">
                                            <option value="">Selectionner</option>
                                            <option value="admin" {{$user->role=="admin" ? 'selected' : ''}}>Admin</option>
                                            <option value="employe" {{$user->role=="employe" ? 'selected' : ''}}>Employe</option>

                                        </select>
                                    </div>
                                </div>

                                <br>
                                <div class="row float-right ">

                                    <button type="submit" class="btn btn-primary btn btn-lg "> MODIFIER</button>
                                </div>


                            </div>
                        </div>
        </form>


@endsection

