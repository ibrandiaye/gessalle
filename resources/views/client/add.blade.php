{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Enregister Client')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('client.index') }}" >Ajouter un client</a></li>

                        </ol>
                    </div>
                    Gestion Salle de sport

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <form action="{{ route('client.store') }}" method="POST">
            @csrf
             <div class="card">
                        <div class="card-header ">
                            <div class="text-center">
                                FORMULAIRE D'ENREGISTREMENT D'UN CLIENT
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
                                @if ($message = Session::get('licence'))
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Prenom </label>
                                            <input type="text" name="prenom"  value="{{ old('prenom') }}" class="form-control"required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nom </label>
                                            <input type="text" name="nom"  value="{{ old('nom') }}" class="form-control"required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>email </label>
                                            <input type="email" name="email"  value="{{ old('email') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Tel </label>
                                            <input type="text" name="tel"  value="{{ old('tel') }}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Sexe</label>
                                        <select class="form-control" name="sexe" required="">
                                            <option value="">Selectionner</option>
                                            <option value="homme" {{old('sexe')=="homme" ? "selected" : '' }} >Homme</option>
                                            <option value="femme" {{old('sexe')=="femme" ? "selected" : '' }} >Femme</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date de Naissance </label>
                                            <input type="date" name="date_naiss"  value="{{ old('date_naiss') }}" class="form-control" >
                                        </div>
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


{{-- @section('script')
<script>
       url_app = '{{ config('app.url') }}';
    $("#salle_id").change(function () {
    var salle_id =  $("#salle_id").children("option:selected").val();
   // $(".salle").val(salle_id);
   // $(".departement").val("");
    $(".commune").val("");
    $("#departement_id").empty();
    $("#commune_id").empty();
        var departement = "<option value=''>Veuillez selectionner</option>";
        $.ajax({
            type:'GET',
            url:url_app+'/departement/by/salle/'+salle_id,
            data:'_token = <?php echo csrf_token() ?>',
            success:function(data) {

                $.each(data,function(index,row){
                    //alert(row.nomd);
                    departement +="<option value="+row.id+">"+row.nom+"</option>";

                });

                $("#departement_id").append(departement);
            }
        });
    });
    $("#departement_id").change(function () {
        var departement_id =  $("#departement_id").children("option:selected").val();
      //  $(".departement").val(departement_id);
       // $(".commune").val("");
       $("#arrondissement_id").empty();
            var arrondissement = "<option value=''>Veuillez selectionner</option>";
            $.ajax({
                type:'GET',
                url:url_app+'/arrondissement/by/departement/'+departement_id,
                data:'_token = <?php echo csrf_token() ?>',
                success:function(data) {

                    $.each(data,function(index,row){
                        //alert(row.nomd);
                        arrondissement +="<option value="+row.id+">"+row.nom+"</option>";

                    });

                    $("#arrondissement_id").append(arrondissement);
                }
            });
        });




</script>
@endsection
 --}}
