{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Enregister Licence')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('licence.index') }}" >AJOUTER UNE LICENCE</a></li>

                        </ol>
                    </div>
                    Gestion De Salle DE Sport

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <form action="{{ route('licence.store') }}" method="POST">
            @csrf
             <div class="card">
                        <div class="card-header  text-center">

                            <div class="text-center"> FORMULAIRE D'ENREGISTREMENT D'UNE LICENCE</div></div>
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
                                <input type="hidden" name="salle_id"  value="{{ $salle_id }}" class="form-control"required>

                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date Debut </label>
                                            <input type="date" name="date_debut"  value="{{ old('date_debut') }}" class="form-control"required>
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
                                            <label>Statut </label>
                                            <select class="form-control" name="statut" required="">
                                                <option value="">Selectionner</option>
                                                <option value="active" >active</option>
                                                <option value="expire" >expire</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label>Plan</label>
                                        <select class="form-control" id="plan_id" name="plan_id" required="">
                                            <option value="">Selectionner</option>
                                            @foreach ($plans as $plan)
                                            <option value="{{$plan->id}}">{{$plan->intitule}}</option>
                                                @endforeach

                                        </select>
                                    </div>

                                </div>

                                <br>
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
