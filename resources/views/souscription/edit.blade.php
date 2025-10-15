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
             <div class="card ">
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
                                            <option value="homme" {{$client->sexe=="homme" ? "selected" : '' }} >Homme</option>
                                            <option value="femme" {{$client->sexe=="femme" ? "selected" : '' }} >Femme</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date de Naissance </label>
                                            <input type="date" name="date_naiss"  value="{{ $client->date_naiss }}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Offre</label>
                                        <select class="form-control" id="offre_id" name="offre_id" required="">
                                            <option value="">Selectionner</option>
                                            @foreach ($offres as $offre)
                                            <option value="{{$offre->id}}" {{$souscription->offre_id==$offre->id ? "selected" : '' }}>{{$offre->nom}}</option>
                                                @endforeach

                                        </select>
                                    </div>
                                     <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date de début </label>
                                            <input type="date" name="date_debut"  value="{{ $souscription->date_debut }}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Commentaire </label>
                                            <textarea   name="commentaire"   class="form-control" > {{ $souscription->commentaire }} </textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Type Paiement</label>
                                        <select class="form-control" name="type_paiement" required="">
                                            <option value="">Selectionner</option>
                                            <option value="espece" {{$souscription->type_paiement=="espece" ? "selected" : '' }} >Espèce</option>
                                            <option value="OM" {{$souscription->type_paiement=="OM" ? "selected" : '' }} >OM</option>
                                            <option value="Wave" {{$souscription->type_paiement=="Wave" ? "selected" : '' }} >Wave</option>

                                        </select>
                                    </div>
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

