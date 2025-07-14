@extends('welcome')
@section('title', '| plan')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                                <li class="breadcrumb-item active ">LISTE DES PLANS</li>

                                </ol>
                            </div>
                              Gestion de salle de sport

                        </div>
                    </div>
                    <div class="clearfix"></div>
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

<div class="col-12">
    <div class="card ">
        <div class="card-header">
            LISTE DES PLANS
            <div class="float-right">
                <a href="{{ route('plan.create') }}" class="btn btn-primary">Ajouter un plan</a>
            </div>
        </div>
            <div class="card-body">

                <table id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Intitule </th>
                             <th>Type </th>
                            <th>Nombre de jour  / SMS</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                            <td>{{ $plan->id }}</td>
                            <td>{{ $plan->intitule }}</td>
                             <td>{{ $plan->type }}</td>
                            <td>{{ $plan->nb_jour}}</td>
                            <td>{{ $plan->montant}}</td>
                            <td>@if($plan->statut=="active")
                                    <span class="badge badge-success">{{ $plan->statut }}</span>
                                @else
                                    <span class="badge badge-danger">{{ $plan->statut }}</span>
                                @endif
                            </td>
                            <td>
                                @if($plan->statut=="active")
                                    <a href="{{ route('updatePlanByEtat', ["id"=>$plan->id,"statut"=>"desactive"]) }}" role="button" class="btn btn-info" title="Changer Etat"><i class="ion-arrow-swap" title="Changer Etat"  ></i></a>
                                @else
                                    <a href="{{ route('updatePlanByEtat', ["id"=>$plan->id,"statut"=>"active"]) }}" role="button" class="btn btn-info" title="Changer Etat"><i class="ion-arrow-swap" title="Changer Etat"  ></i></a>
                                @endif
                                <a href="{{ route('plan.edit', $plan->id) }}" role="button" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                <form method="POST"
                                    action="{{ route('plan.destroy', $plan->id) }}"
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
</div>

@endsection
