{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Enregister Plan')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('plan.index') }}" >AJOUTER UNE PLAN</a></li>

                        </ol>
                    </div>
                    Gestion De Salle DE Sport

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <form action="{{ route('plan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
             <div class="card">
                        <div class="card-header  text-center">

                            <div class="text-center"> FORMULAIRE D'ENREGISTREMENT D'UNE PLAN</div></div>
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
                                            <input type="text" name="intitule"  value="{{ old('intitule') }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Type</label>
                                        <select class="form-control" name="type" required="">
                                            <option value="">Selectionner</option>
                                            <option value="abonnement" >Abonnement</option>
                                            <option value="sms" >sms</option>

                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nombre de jours ou sms </label>
                                            <input type="number" name="nb_jour"  value="{{ old('nb_jour') }}" class="form-control"required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Montant </label>
                                            <input  type="number" name="montant"  value="{{ old('montant') }}" class="form-control"required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Image </label>
                                            <input type="file" name="image"   class="form-control"  required>
                                        </div>
                                    </div>


                                </div>


                                <div class="row float-right ">
                                    <button type="submit" class="btn btn-success btn btn-lg "  onclick="this.disabled=true; this.form.submit();"> ENREGISTRER</button>

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
