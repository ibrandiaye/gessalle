@extends('welcome')

@section('content')
 <div class="page-content-wrapper ">

    <div class="container-fluid">
        <div class="row">
             @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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
            @if($licence)
                 @if ($licence->date_fin >= today())
               <marquee><p> Votre Licence expire le {{  Carbon\Carbon::parse( $licence->date_fin)->format('d/m/Y') }} </p></marquee>
                @else
                    <marquee><p> Votre Licence a expire depuis le {{ Carbon\Carbon::parse( $licence->date_fin)->format('d/m/Y')}} </p></marquee>
                @endif
            @endif

        </div>
        <!-- ==================================================================== -->
        <!-- KPI cards -->
        <section class="stats" aria-label="Statistiques clés">
          <div class="card-d kpi">
            <div class="ico">💵</div>
                <div class="m-l-10">
                  <h5 class="mt-0">{{ $depense}} </h5>
                  <p class="mb-0 text-muted">Dépense du jours </p>
                  {{-- <p class="mb-0 text-muted">dont  <span class="badge bg-soft-success"><i class="mdi mdi-arrow-up"></i>{{ $nbSalleActive }} actives</span>
                  <span class="badge bg-soft-danger"><i class="mdi mdi-arrow-down"></i>{{ $nbSalleInactive }} inactives</span></p> --}}
                </div>
       
          </div>

          <div class="card-d kpi">
            <div class="ico">👥</div>
            <div class="m-l-10 ">
              <h5 class="mt-0">{{ $nbClient}} </h5>
              <p class="mb-0 text-muted">Nombre de Clients</p>
              {{-- <p class="mb-0 text-muted">dont  <span class="badge bg-soft-success"><i class="mdi mdi-arrow-up"></i>{{ $nbLicenceActive }} actives</span>
                <span class="badge bg-soft-danger"><i class="mdi mdi-arrow-down"></i>{{ $nbLicenceInactive }} inactives</span> --}}</p>
            </div>
          </div>

          <div class="card-d kpi">
            <div class="ico">📈</div>
            <div>
              <div class="value">{{ $sommePaiment }}<span style="color:var(--accent);font-size:13px;font-weight:700;margin-left:6px"></span></div>
              <div class="small">Chiffre d'affaire du jours</div>
            </div>
          </div>

          <div class="card-d kpi">
            <div class="ico">✉️</div>
            <div class="m-l-10 ">
               <h5 class="mt-0">{{ Auth::user()->salle->ct_sms }}</h5>
               <p class="mb-0 text-muted">Nombre SMS</p>
            </div>
          </div>
        </section>
    </div>
 </div>
@endsection
