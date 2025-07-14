<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Gestion Salle</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{asset('images/favicon.ico') }}">

        <link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/style.css') }}" rel="stylesheet" type="text/css">
        <script src="{{asset('js/jquery.min.js') }}"></script>
        <!-- DataTables -->
        <link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/fab.css') }}" rel="stylesheet" type="text/css">

        @yield("css")

    </head>


    <body class="fixed-left">

        <!-- Loader -->
       {{--   <div id="preloader"><div id="status"><div class="spinner"></div></div></div>  --}}

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                    <i class="ion-close"></i>
                </button>

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <!--<a href="index.html" class="logo"><i class="mdi mdi-assistant"></i> Zoter</a>-->
                         <a href="index.html" class="logo">
                            <img src="{{ asset('images/logo3.jpg') }}" alt="" height="50">
                        </a>
                    </div>
                </div>

                <div class="sidebar-inner niceScrollleft">

                    <div id="sidebar-menu">
                        <ul>

                            <li class="menu-title">
                                @php
                                    $user = Auth::user();
                                @endphp

                             <li>
                                    <a href="{{ route('home') }}">
                                        <i class="mdi mdi-airplay"></i> Tableau de bords
                                    </a>
                                </li>


                             @if($user->role=="superadmin")
                                <li >
                                    <a href="{{ route('user.index') }}" ><i class="mdi mdi-account-circle"></i><span>Utilisateur </span></a>
                                </li>
                                <li >
                                    <a href="{{ route('salle.index') }}" ><i class="mdi mdi-home"></i><span>Salle </span></a>
                                </li>
                                <li >
                                    <a href="{{ route('licence.index') }}" ><i class="mdi mdi-clipboard-text"></i><span>Licence </span></a>
                                </li>
                                <li >
                                    <a href="{{ route('plan.index') }}" ><i class="ion-social-usd"></i><span>Plan </span></a>
                                </li>
                                <li >
                                    <a href="{{ route('configuration.index') }}" ><i class="mdi mdi-image-filter-vintage"></i><span>Configuration </span></a>
                                </li>
                            @elseif($user->role=="admin")
                                <li >
                                    <a href="{{ route('client.index') }}" ><i class="mdi mdi-account-card-details"></i><span>Client </span></a>
                                </li>
                                  <li >
                                    <a href="{{ route('souscription.index') }}" ><i class="mdi mdi-database-plus"></i><span>Souscription </span></a>
                                </li>
                                <li >
                                    <a href="{{ route('depense.index') }}" ><i class="mdi mdi-square-inc-cash"></i><span>Depense </span></a>
                                </li>
                                <li >
                                    <a href="{{ route('employe.index') }}" ><i class="mdi mdi-account"></i><span>Employe </span></a>
                                </li>

                                <li >
                                    <a href="{{ route('offre.index') }}" ><i class="ion-social-usd"></i><span>Offre </span></a>
                                </li>

                                <li >
                                    <a  href="{{ route('sms.index') }}"  ><i class="mdi mdi-email"></i><span> Sms </span></a>
                                </li>
                                 <li >
                                    <a href="{{ route('indexClient') }}" ><i class="mdi mdi-cart"></i><span>Boutique </span></a>
                                </li>
                                 <li >
                                    <a href="{{ route('rapport') }}" ><i class="mdi mdi-poll"></i><span>Rapport </span></a>
                                </li>

                                @elseif($user->role=="employe")
                                 <li >
                                    <a href="{{ route('client.index') }}" ><i class="mdi mdi-account-card-details"></i><span>Client </span></a>
                                </li>
                                  <li >
                                    <a href="{{ route('souscription.index') }}" ><i class="mdi mdi-database-plus"></i><span>Souscription </span></a>
                                </li>
                                <li >
                                    <a href="{{ route('depense.index') }}" ><i class="mdi mdi-square-inc-cash"></i><span>Depense </span></a>
                                </li>

                            @endif
                        </ul>

                    </div>

                    <div class="clearfix">

                    </div>
                </div> <!-- end sidebarinner -->

            </div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <div class="topbar">

                        <nav class="navbar-custom">

                            <ul class="list-inline float-right mb-0">
                                <!-- language-->
                                 <li class="list-inline-item " style="color: white;">
                                   @if($user->salle_id)

                                  {{ $user->salle->nom }}

                                   @endif
                                </li>
                                <li class="list-inline-item dropdown notification-list">

                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                       aria-haspopup="false" aria-expanded="false">
                                        <img src="{{ asset('images/users/avatar-1.jpg') }}" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <!-- item-->
                                        <div class="dropdown-item noti-title">
                                            <h5>Bienvenue</h5>
                                        </div>
                                        <a class="dropdown-item notify-item"  data-toggle="modal" data-target="#exampleModalform2{{$user->id}}">
                                            <i class="mdi mdi-account-key" title="Modifier mot de passe"></i> Changer votre <br> Mot de passe
                                        </a>
                                        <a class="dropdown-item notify-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="mdi mdi-logout m-r-5 text-muted"></i>{{ __('Deconnexion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>



                                    </div>
                                </li>

                            </ul>

                            <ul class="list-inline menu-left mb-0">
                                <li class="float-left">
                                    <button class="button-menu-mobile open-left waves-light waves-effect">
                                        <i class="mdi mdi-menu"></i>
                                    </button>
                                </li>
                            </ul>

                            <div class="clearfix"></div>

                        </nav>

                    </div>
                    <!-- Top Bar End -->

                    <div class="page-content-wrapper ">

                        <div class="container-fluid">

                           @yield("content")
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
                                                        <label>Nom </label>
                                                        <input type="text" name="nom"  value="{{ old('nom') }}" class="form-control"required>
                                                    </div>
                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Tel </label>
                                                        <input type="text" name="tel"  value="{{ old('tel') }}" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
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
                             @if($user->role!="superadmin")
                             <button class="btn btn-primary fab"  data-toggle="modal" data-target="#exampleModalform2Ticket">
                                 <i class="mdi mdi-file"></i>
                            </button>

                        @endif


                        </div><!-- container -->


                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->

                <footer class="footer">
                    © 2025 MI.
                </footer>

            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->


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


    </body>
</html>
