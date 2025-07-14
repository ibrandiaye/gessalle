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
                        <li class="breadcrumb-item active">Modifier un depense</li>


                        </ol>
                    </div>
                     Gestion de depense

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <form method="POST" action="{{ route('depense.update', $depense->id) }}">
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
                                            <label>Libelle </label>
                                            <input type="text" name="libelle"  value="{{ $depense->libelle }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date Depense </label>
                                            <input type="date" name="date_depense"  value="{{ $depense->date_depense }}" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Montant </label>
                                            <input  type="number" name="montant"  value="{{ $depense->montant }}" class="form-control"required>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Description </label>
                                            <input type="text" name="description"  value="{{ $depense->description') }}" class="form-control" required>
                                        </div>
                                    </div> --}}
                                     <div class="col-lg-6">
                                        <label>Employe</label>
                                        <select class="form-control" id="employe_id" name="employe_id" >
                                            <option value="">Selectionner</option>
                                            @foreach ($employes as $employe)
                                            <option value="{{$employe->id}}" {{ $employe->id==$depense->employe_id ? 'selected' : '' }} >{{$employe->pseudo}}</option>
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

