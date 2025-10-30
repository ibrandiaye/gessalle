<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>{{ $salle->nom }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background-color: #f8f9fa;
            font-size: 18px;
            padding: 20px;
        }

        .ticket-wrapper {
            width: 110mm;
            margin: 0 auto;
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .ticket-header {
            text-align: center;
            border-bottom: 2px dashed #999;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .ticket-header img {
            height: 60px;
            margin-bottom: 10px;
        }

        .ticket-title {
            font-weight: 700;
            font-size: 22px;
            margin: 0;
        }

        .ticket-info table {
            width: 100%;
            font-size: 17px;
        }

        .ticket-info td {
            padding: 3px 0;
        }

        .ticket-summary {
            border-top: 2px dashed #999;
            border-bottom: 2px dashed #999;
            padding: 10px 0;
            margin: 15px 0;
            text-align: center;
            font-weight: 600;
        }

        .qrcode {
            text-align: center;
            margin-top: 15px;
        }

        .btn-back {
            display: inline-block;
            margin-bottom: 20px;
        }

        @media print {
            body {
                background: #fff;
                padding: 0;
            }
            .btn-back {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="text-center">
    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm btn-back">
        ⬅️ Retour
    </a>
</div>

<div class="ticket-wrapper">
    <div class="ticket-header">
        @if($salle->logo)
            <img src="{{ asset('logo/'.$salle->logo) }}" alt="Logo {{ $salle->nom }}">
        @endif
        <h1 class="ticket-title">{{ $salle->nom }}</h1>
        <p class="text-muted mb-0">{{ $salle->adresse }}</p>
    </div>

    <div class="ticket-info">
        <table>
            <tr>
                <td><strong>N° Facture :</strong></td>
                <td class="text-end">{{ $souscription->id }}</td>
            </tr>
            <tr>
                <td><strong>Client :</strong></td>
                <td class="text-end">{{ $souscription->prenom }} {{ $souscription->nom }}</td>
            </tr>
            <tr>
                <td><strong>Téléphone :</strong></td>
                <td class="text-end">{{ $souscription->tel }}</td>
            </tr>
            <tr>
                <td><strong>Date :</strong></td>
                <td class="text-end">{{ Carbon\Carbon::parse($souscription->created_at)->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td><strong>Infoline :</strong></td>
                <td class="text-end">{{ $salle->adresse }}</td>
            </tr>
        </table>
    </div>

    <div class="ticket-summary">
        <div>Montant : <strong>{{ $souscription->prix }} CFA</strong></div>
        <div>Début : <strong>{{ Carbon\Carbon::parse($souscription->date_debut)->format('d/m/Y') }}</strong></div>
        <div>Fin : <strong>{{ Carbon\Carbon::parse($souscription->date_fin)->format('d/m/Y') }}</strong></div>
    </div>

    <div class="qrcode">
        {!! $qrcode !!}
    </div>
</div>

<script>
    window.addEventListener('load', () => {
        // Supprime la ligne suivante si tu veux éviter l’impression automatique
        window.print();
    });
</script>

</body>
</html>
