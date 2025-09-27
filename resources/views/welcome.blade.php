<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Gestion Salle</title>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('ncss/app.css') }}" />
    <link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/jquery.min.js') }}"></script>
    <link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    @stack('style')
</head>

<body>
    <div class="app">
         @php
            $user = Auth::user();
        @endphp
        @include('layouts.sidebar')
        <div id="sidebarOverlay" class="overlay" aria-hidden="true"></div>
        <main class="main" id="main">
            <div class="content">
                @include('layouts.navbar')
                @yield('content')
                @if($user->role!="superadmin")
                   <!-- <button class="float-right_connect"  data-toggle="modal" data-target="#exampleModalform2Ticket">
                       <i class="mdi mdi-file"></i> 
                   </button>-->
                   <!-- Floating ticket FAB -->
                <a id="fabTicket" class="fab-ticket" href="#" title="Tickets" aria-label="Tickets" data-toggle="modal" data-target="#exampleModalform2Ticket">
                    <span class="material-symbols-outlined" aria-hidden="true">confirmation_number</span>
                </a>

                @endif
            </div>
        </main>
        
                
                            <!-- Modal -->
                             <div class="modal fade" id="exampleModalform2{{Auth::user()->id}}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modification mot de passe</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('user.password.update') }}" method="POST">
                                            @csrf
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Mot de passe</label>
                                                        <input type="password" class="form-control" id="field-3" placeholder="Mot de passe"  name="password">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Repetez Mot de passe</label>
                                                        <input type="password" name="password_confirmation" class="form-control" id="field-4" placeholder="Repetez Mot de passe">                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                            <button type="submint" class="btn btn-warning">Modifier mot de passe</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                             <!-- Modal -->
                             <div class="modal fade" id="exampleModalform2Ticket" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center">Générer ticket Rapide</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('souscription.store.rapide') }}" method="POST">
                                            @csrf
                                        <div class="modal-body">

                                            <div class="row">

                                    
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Tel </label>
                                                        <input type="text" name="tel"  value="{{ old('tel') }}" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Type Paiement</label>
                                                    <select class="form-control" name="type_paiement" required="">
                                                        <option value="">Selectionner</option>
                                                        <option value="espece" {{old('type_paiement')=="espece" ? "selected" : '' }} >Espèce</option>
                                                        <option value="OM" {{old('type_paiement')=="OM" ? "selected" : '' }} >OM</option>
                                                        <option value="Wave" {{old('type_paiement')=="Wave" ? "selected" : '' }} >Wave</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                            <button type="submint" class="btn btn-primary">Valider</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                           

    </div>
    <script src="{{ asset('njs/ds.js') }}" >
    </script>
    <!-- jQuery  -->
        <script src="{{asset('js/popper.min.js') }}"></script>
        <script src="{{asset('js/bootstrap.min.js') }}"></script>
        <script src="{{asset('js/modernizr.min.js') }}"></script>
        <script src="{{asset('js/detect.js') }}"></script>
        <script src="{{asset('js/fastclick.js') }}"></script>
        <script src="{{asset('js/jquery.blockUI.js') }}"></script>
        <script src="{{asset('js/waves.js') }}"></script>
        <script src="{{asset('js/jquery.nicescroll.js') }}"></script>
        <!-- Required datatable js -->
        <script src="{{asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{asset('plugins/datatables/dataTables.buttons.min.js') }}"></script>
        <script src="{{asset('plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{asset('plugins/datatables/jszip.min.js') }}"></script>
        <script src="{{asset('plugins/datatables/pdfmake.min.js') }}"></script>
        <script src="{{asset('plugins/datatables/vfs_fonts.js') }}"></script>
        <script src="{{asset('plugins/datatables/buttons.html5.min.js') }}"></script>
        <script src="{{asset('plugins/datatables/buttons.print.min.js') }}"></script>
        <script src="{{asset('plugins/datatables/buttons.colVis.min.js') }}"></script>
        <!-- Responsive examples -->
        <script src="{{asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

        <!-- Datatable init js -->
        <script src="{{asset('pages/datatables.init.js') }}"></script>

        <!-- App js -->
        <script src="{{asset('js/app.js') }}"></script>
        <script src="{{asset('plugins/parsleyjs/parsley.min.js') }}"></script>
        <script src="{{asset('plugins/parsleyjs/fr.js') }}"></script>
        <script src="{{asset('js/jquery.blockUI.js') }}"></script>

          Chart JS
         <script src="{{asset('plugins/chart.js/chart.min.js') }}"></script>


        @yield("script")

        <script type="text/javascript">
           $(document).ready(function() {
                $('form').parsley();
              //  window.Parsley.setLocale("fr");
            });

        </script>
    @stack('scripts')
</body>

</html>