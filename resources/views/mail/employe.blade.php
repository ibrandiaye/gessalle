
<p>Bonjour  ,</p>

<p>Votre compte a été créé avec succès. Vous pouvez dès à présent accéder à votre espace de gestion de votre salle de sport.</p>

<p>Voici vos informations de connexion :</p>
<p>Adresse e-mail : {{ $data->email }},</p>
<p> Mot de passe temporaire : {{ $password }}</p>
<p> Salle de sport : {{ $data->name }}</p>

<p> Lien d’accès à la plateforme : {{ env('APP_URL', 'http://127.0.0.1:8000/') }}</p>
