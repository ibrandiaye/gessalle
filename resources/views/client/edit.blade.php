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
                        <li class="breadcrumb-item active">Modifier un client</li>


                        </ol>
                    </div>
                     Gestion de salle

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <form method="POST" action="{{ route('client.update', $client->id) }}">
            @csrf
            @method('PATCH')
            
                        <div class="card-header text-center">FORMULAIRE DE MODIFICATION D'UN CLIENT</div>
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
                                            <label>Prenom </label>
                                            <input type="text" name="prenom"  value="{{ $client->prenom }}" class="form-control"required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nom </label>
                                            <input type="text" name="nom"  value="{{ $client->nom }}" class="form-control"required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>email </label>
                                            <input type="email" name="email"  value="{{ $client->email }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Tel </label>
                                            <input type="text" name="tel"  value="{{ $client->tel }}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Sexe</label>
                                        <select class="form-control" name="sexe" required="">
                                            <option value="">Selectionner</option>
                                            <option value="h" {{ $client->sexe=="h" ? "selected" : '' }} >Homme</option>
                                            <option value="f" {{ $client->sexe=="f" ? "selected" : '' }} >Femme</option>

                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date de Naissance </label>
                                            <input type="date" name="date_naiss"  value="{{ $client->date_naissance }}" class="form-control" >
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row float-right ">

                                    <button type="submit" class="btn btn-primary btn btn-lg "> MODIFIER</button>
                                </div>


                            </div>
             
        </form>


@endsection

