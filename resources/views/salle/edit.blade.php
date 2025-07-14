{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Modifier Salle')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ACCUEIL</a></li>
                        <li class="breadcrumb-item active">Modifier un salle</li>


                        </ol>
                    </div>
                     Gestion de salle

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

            <form method="POST" action="{{ route('salle.update', $salle->id) }}">
                @csrf
                @method('PATCH')
                <div class="card ">
                        <div class="card-header text-center">FORMULAIRE DE MODIFICATION Salle</div>
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
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Nom</label>
                                        <input type="text" name="nom" class="form-control" value="{{$salle->nom}}"   required>
                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>adresse </label>
                                            <input type="text" name="adresse"  value=" {{$salle->adresse }}" class="form-control"required>
                                        </div>
                                    </div>
                                   <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>telephone </label>
                                            <input type="text" name="telephone"  value=" {{$salle->telephone }}" class="form-control"required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>adresse </label>
                                            <input type="text" name="adresse"  value=" {{$salle->adresse }}" class="form-control"required>
                                        </div>
                                    </div>
                                     <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Logo </label>
                                            <input type="file" name="image"   class="form-control"  >
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Essai</label>
                                        <select class="form-control" id="essai" name="essai" required>
                                            <option value="">Selectionner</option>

                                            <option value="oui" {{ "oui"==$salle->essai ? 'selected' : '' }}>Oui</option>
                                             <option value="non" {{ "non"==$salle->essai ? 'selected' : '' }}>Non</option>

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

