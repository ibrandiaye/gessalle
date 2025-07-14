{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Enregister Salle')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('salle.index') }}" >Ajouter une salle</a></li>

                        </ol>
                    </div>
                    Gestion Salle de sport

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <form action="{{ route('salle.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
             <div class="card">
                        <div class="card-header  text-center">FORMULAIRE D'ENREGISTREMENT D'UNE SALLE</div>
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
                                            <label>Nom </label>
                                            <input type="text" name="nom"  value="{{ old('nom') }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Adresse </label>
                                            <input type="text" name="adresse"  value="{{ old('adresse') }}" class="form-control"  required>
                                        </div>
                                    </div>
                                     <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Email </label>
                                            <input type="email" name="email"  value="{{ old('email') }}" class="form-control"  required>
                                        </div>
                                    </div>
                                   <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Téléphone </label>
                                            <input type="text" name="telephone"  value="{{ old('telephone') }}" class="form-control"  required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Logo </label>
                                            <input type="file" name="image"   class="form-control"  required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Essai</label>
                                        <select class="form-control" id="essai" name="essai" required>
                                            <option value="">Selectionner</option>

                                            <option value="oui" {{ "oui"==old('essai') ? 'selected' : '' }}>Oui</option>
                                             <option value="non" {{ "non"==old('essai') ? 'selected' : '' }}>Non</option>

                                        </select>
                                    </div>

                                </div>


                                <div class="row float-right ">

                                    <button type="submit" class="btn btn-primary btn btn-lg "  onclick="this.disabled=true; this.form.submit();"> Sauvegarder</button>

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
