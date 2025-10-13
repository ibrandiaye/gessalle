<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  @php
  $salle =  auth::user()->salle;
  @endphp
  <title>{{$salle->nom}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/icons.css') }}" rel=   "stylesheet" type="text/css">
    <link href="{{asset('css/style.css') }}" rel="stylesheet" type="text/css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<style>

  th,td {
   /* border: solid 1px;*/
   /* text-align: center;*/
    font-weight: bold;
  }
  table {

                border-collapse: collapse;
                font-size: 23px;
            }
            body
            {
                font-size: 23px;
            }
            .wrapper
            {
                width: 110mm; /* Largeur pour l'impression */
            }
            .invoice
            {
                width: 110mm; /* Largeur pour l'impression */
            }
</style>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <div class="row">
        <div class="col-12">



          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <div class="row">
                <div class="col-12">
                  <h4>
                 {{--    <img class="img float-right" src="{{ asset('assets/img/logo.png') }}" style="width: 20%;"> --}}


                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <center>
                @if($salle->logo)
                    <img class="img " src="{{ asset('logo/'.$salle->logo) }}" style="height: 50px;"><br>

                @endif
              </center>
              <center>{{ $salle->nom }}</center><br>
              <center>Adresse{{ $salle->adresse }}</center><br>
             <center> ------------------------------</center>

             <table style="width: 100%;border: none;">
                <tr>
                    <td><b>N° Fature </b></td>
                    <td class="float-right"><b>{{ $souscription->id }}</b></td>
                </tr>
                <tr>
                    <td><b> Client</b></td>
                    <td class="float-right"><b><strong>
                    {{ $souscription->prenom }} {{ $souscription->nom }} </strong></b></td>
                </tr>
                <tr>
                    <td><b> TEL</b></td>
                    <td class="float-right"><b><strong>
                    {{ $souscription->tel }}  </strong></b></td>
                </tr>
                <tr>
                    <td><b>  Date</b></td>
                    <td class="float-right"><b> {{  Carbon\Carbon::parse( $souscription->created_at)->format('d-m-Y H:i') }}</b></td>
                </tr>
                <tr>
                    <td><b>  INfOLINE</b></td>
                    <td class="float-right"><b> {{ $salle->adresse }}</b></td>
                </tr>

             </table>



            <!-- /.row -->
            <center> ------------------------------</center>
            <strong>Montant : {{$souscription->prix}} CFA</strong><br>
            <strong>Debut : {{Carbon\Carbon::parse( $souscription->date_debut)->format('d-m-Y') }}</strong><br>
            <strong>Fin : {{Carbon\Carbon::parse( $souscription->date_fin)->format('d-m-Y') }}</strong><br>
            <center> ------------------------------</center>
             <center>{{ $qrcode }}</center>

          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
      <br><br>
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript">
  window.addEventListener("load", window.print());
</script>
</body>
</html>
