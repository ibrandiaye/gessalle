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
                     Gestion de licence

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <form method="POST" action="{{ route('licence.update', $licence->id) }}">
            @csrf
            @method('PATCH')
             <div class="card ">
                        <div class="card-header text-center">FORMULAIRE DE MODIFICATION Département</div>
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
                                    {{-- <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Type </label>
                                            <select class="form-control" name="type" required="">
                                                <option value="">Selectionner</option>
                                                <option value="mensuel" {{ $licence->type=='mensuel' ? 'selected' : ''}} >mensuel</option>
                                                <option value="annuel" {{ $licence->type=='annuel' ? 'selected' : ''}}>annuel</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date Debut </label>
                                            <input type="date" name="date_debut"  value="{{ $licence->date_debut }}" class="form-control"required>
                                        </div>
                                    </div>
                                    {{--<div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date Fin </label>
                                            <input type="date" name="date_fin"  value="{{ $licence->date_fin }}" class="form-control"required>
                                        </div>
                                    </div>--}}
                                     <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Montant </label>
                                            <input  type="number" name="montant"  value="{{ $licence->montant }}" class="form-control"required>
                                        </div>
                                    </div>
                                     <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Statut </label>
                                            <select class="form-control" name="statut" required="">
                                                <option value="">Selectionner</option>
                                                <option value="active" {{ $licence->statut=='active' ? 'selected' : ''}}>active</option>
                                                <option value="expire" {{ $licence->statut=='expire' ? 'selected' : ''}}>expire</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Salle</label>
                                        <select class="form-control" id="salle_id" name="salle_id" required="">
                                            <option value="">Selectionner</option>
                                            @foreach ($salles as $salle)
                                            <option value="{{$salle->id}}" {{ $licence->salle_id==$salle->id ? 'selected' : ''}}>{{$salle->nom}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Plan</label>
                                        <select class="form-control" id="plan_id" name="plan_id" required="">
                                            <option value="">Selectionner</option>
                                            @foreach ($plans as $plan)
                                            <option value="{{$plan->id}}" {{ $licence->plan_id==$plan->id ? 'selected' : ''}} >{{$plan->intitule}}</option>
                                                @endforeach

                                        </select>
                                    </div>

                                </div>

                                <div class="row float-right ">
                                    <button type="submit" class="btn btn-primary btn btn-lg "> MODIFIER</button>
                                </div>


                            </div>
                        </div>
        </form>


@endsection

