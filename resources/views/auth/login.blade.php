<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Syntech Advanced — Connexion</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('ncss/newcostum.css') }}" rel="stylesheet" type="text/css">
    </head>
    <style>
    
    </style>
    <body>
       <main class="page">
    <!-- Colonne gauche décorative avec fond d'écran -->
    <section aria-hidden="true" class="visual"></section>

    <!-- Colonne droite: formulaire de connexion -->
    <section class="auth">
      <div class="card" role="form" aria-labelledby="titre">
        <h1 id="titre" class="title"><span class="brand">Syna Syntech Advanced</span></h1>
        <p class="subtitle">Améliorer la satisfaction client et augmenter les revenus, un appel à la fois.</p>

        <form action="#" method="post" action="{{ route('login') }}" novalidate>
            @csrf
          <div class="field">
            <label class="label" for="email">{{ __('Email ') }}</label>
            <input class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" name="email" type="email" autocomplete="email" placeholder="exemple@domaine.com" required autocomplete="email" />
            @error('email')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

          <div class="field">
          <label class="label" for="password">{{ __('Mot de passe') }}</label> 
            <input class="input" id="password" name="password" type="password" autocomplete="current-password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required />
            @error('password')
             <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

          <div class="row">
            <label class="check" for="remember">
              <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/> Restez‑moi connecté
            </label>
            <a class="link" href="#">Nom d'utilisateur/mot de passe oublié</a>

            @if (Route::has('password.request'))
             <a class="text-muted" href="{{ route('password.request') }}"><i class="fa fa-lock mr-1"></i> Mot de passe oublier</a>
            @endif
          </div>

          <button class="btn" type="submit">Login</button>

          <div class="hr"></div>

          <div class="row" style="justify-content:flex-start; gap:10px">
            <span class="muted">Vous n'avez pas encore de compte&nbsp;?</span>
            <a class="btn signup" href="#">Inscrivez‑vous</a>
          </div>
        </form>
      </div>
    </section>
  </main>

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
