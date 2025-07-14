{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Enregister Souscription')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('souscription.index') }}" >Ajouter un souscription</a></li>

                        </ol>
                    </div>
                    Gestion Offre de sport

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <form action="{{ route('storeByClient') }}" method="POST">
            @csrf
             <div class="card">
                        <div class="card-header ">
                            <div class="text-center">
                                FORMULAIRE D'ENREGISTREMENT D'UN SOUSCRIPTION
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
                                @endif
                                <div class="row">
                                   <input type="hidden" name="client_id" value="{{ $client_id }}">
                                    <div class="col-lg-6">
                                        <label>Offre</label>
                                        <select class="form-control" id="offre_id" name="offre_id" required="">
                                            <option value="">Selectionner</option>
                                            @foreach ($offres as $offre)
                                            <option value="{{$offre->id}}">{{$offre->nom}}</option>
                                                @endforeach

                                        </select>
                                    </div>
                                     <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date de début </label>
                                            <input type="date" name="date_debut"  value="{{ old('date_debut') }}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Commentaire </label>
                                            <textarea   name="commentaire"   class="form-control" > {{ old('commentaire') }} </textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Type Paiement</label>
                                        <select class="form-control" name="type_paiement" required="">
                                            <option value="">Selectionner</option>
                                            <option value="espece" {{old('type_paiement')=="espece" ? "selected" : '' }} >Espèce</option>
                                            <option value="OM" {{old('type_paiement')=="OM" ? "selected" : '' }} >OM</option>
                                            <option value="Wave" {{old('type_paiement')=="Wave" ? "selected" : '' }} >Wave</option>

                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row float-right ">

                                    <button type="submit" class="btn btn-primary btn btn-lg "  onclick="this.disabled=true; this.form.submit();"> Sauvegarer</button>

                                </div>
                            </div>

                            </div>

            </form>

@endsection


