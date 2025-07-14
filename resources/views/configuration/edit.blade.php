{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Modifier Configuration')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ACCUEIL</a></li>
                        <li class="breadcrumb-item active">Modifier un configuration</li>


                        </ol>
                    </div>
                     Gestion de configuration

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

            <form method="POST" action="{{ route('configuration.update', $configuration->id) }}">
                @csrf
                @method('PATCH')
                <div class="card ">
                        <div class="card-header text-center">FORMULAIRE DE MODIFICATION Configuration</div>
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
                                            <label>Parametre</label>
                                        <input type="text" name="parametre" class="form-control" value="{{$configuration->parametre}}"   required>
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Valeur </label>
                                            <input type="text" name="valeur"  value=" {{$configuration->valeur }}" class="form-control"required>
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

