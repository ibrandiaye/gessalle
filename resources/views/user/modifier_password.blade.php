<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>DIGI 221</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">

    </head>
    <body>


    <!-- Begin page -->
    <div class="accountbgs"></div>
    <div class="wrapper-page">
        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                        <p>{{ $error }}</p>
                    </div>
            @endforeach
        @endif
        <div class="card">
            <div class="card-header text-center">Bienvenue dans la plateforme de gestion des salles de sport. <br>
            @if (Auth::user()->salle_id && Auth::user()->salle->essai=="oui")
            Vous bénéficiez dès maintenant d’une période d’essai gratuite de <b  style="color: red;"> {{ $nbJour }} jours </b> pour découvrir toutes les fonctionnalités de la plateforme et optimiser la gestion de votre salle de sport.
            @endif
            </div>

            <div class="card-body">

                <div class="text-center">
                   <p>Modifier votre de passe</p>
                </div>

                <div class="px-3 pb-3">
                    <form method="POST" action="{{ route('user.password.update') }}">
                        @csrf
                        <div class="row mb-3">

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Mot de passe">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Répétez Votre mot de passe">
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Modifier
                                </button>


                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



        <!-- jQuery  -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/modernizr.min.js') }}"></script>
        <script src="{{ asset('js/detect.js') }}"></script>
        <script src="{{ asset('js/fastclick.js') }}"></script>
        <script src="{{ asset('js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('js/waves.js') }}"></script>
        <script src="{{ asset('js/jquery.nicescroll.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('js/app.js') }}"></script>


    </body>
</html>
