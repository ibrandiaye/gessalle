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
                     Gestion de plan

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <form method="POST" action="{{ route('plan.update', $plan->id) }}" enctype="multipart/form-data">
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
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Intutle </label>
                                            <input type="text" name="intitule"  value="{{ $plan->intitule }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Type</label>
                                        <select class="form-control" name="type" required="">
                                            <option value="">Selectionner</option>
                                            <option value="abonnement"  {{ $plan->type=="abonnement" ? "selected" : "" }} >Abonnement</option>
                                            <option value="sms" {{ $plan->type=="sms" ? "selected" : "" }} >sms</option>

                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nombre de jours </label>
                                            <input type="number" name="nb_jour"  value="{{ $plan->nb_jour }}" class="form-control"required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Montant </label>
                                            <input  type="number" name="montant"  value="{{ $plan->montant }}" class="form-control"required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Image </label>
                                            <input type="file" name="image"   class="form-control"  >
                                        </div>
                                    </div>
                                </div>

                                <div class="row float-right ">
                                    <button type="submit" class="btn btn-primary btn btn-lg "> MODIFIER</button>
                                </div>


                            </div>
                        </div>
        </form>


@endsection

