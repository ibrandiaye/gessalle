<?php
namespace App\Repositories;

use PHPUnit\Framework\Exception;


class RessourceRepository {
    protected $model;

    public function getPaginate($n)
    {
        return $this->model->paginate($n);
    }
    public  function getAll(){
        return $this->model->get();
    }

    public function store(Array $inputs)
    {
        return $this->model->create($inputs);
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($id, Array $inputs)
    {
        $this->getById($id)->update($inputs);
    }

    public function destroy($id)
    {
        $this->getById($id)->delete();
    }
function sendAirtimeRequest($params,$type) {
    // URL de l'API

    $url = 'https://proxy-coreapi.pixelinnov.net/api_v1/transaction/airtime';



    // Vérification des paramètres obligatoires
    if (empty($params['destination']) || empty($params['api_key']) || empty($params['business_name_id'])) {
        throw new Exception('Les paramètres destination, api_key et business_name_id sont obligatoires');
    }

    // Préparation des données à envoyer
    $postData = [
        'amount' => $params['amount'] ?? 0,
        'destination' => $params['destination'],
        'api_key' => $params['api_key'],
        'ipn_url' => $params['ipn_url'] ?? '',
        'service_id' => $params['service_id'] ?? 17,
        'custom_data' => $params['custom_data'] ?? 'your_custom_data',
        'business_name_id' => $type=="wave" ? $params['business_name_id'] : '',
        'redirect_url' => $params['redirect_url'] ?? '',
        'redirect_error_url' => $params['redirect_error_url'] ?? ''
    ];
    //dd($postData);
    // Initialisation de cURL
    $ch = curl_init();

    // Configuration des options cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json'
    ]);

    // Exécution de la requête
    $response = curl_exec($ch);
    dd($response);
    // Gestion des erreurs
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        curl_close($ch);
        throw new Exception("Erreur cURL : " . $error_msg);
    }

    // Fermeture de la session cURL
    curl_close($ch);


    // Décodage de la réponse JSON
    $decodedResponse = json_decode($response, true);


    if (json_last_error() !== JSON_ERROR_NONE) {
        dd(json_last_error_msg());
        //throw new Exception("Erreur lors du décodage de la réponse JSON : " . json_last_error_msg());
    }

    return $decodedResponse;
}

function isMobile() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

    // Liste des mots-clés courants pour les appareils mobiles
    $mobileKeywords = [
        'Mobile', 'Android', 'iPhone', 'iPad', 'iPod',
        'BlackBerry', 'Windows Phone', 'Opera Mini',
        'IEMobile', 'Kindle', 'webOS', 'Symbian'
    ];

    foreach ($mobileKeywords as $keyword) {
        if (stripos($userAgent, $keyword) !== false) {
            return true;
        }
    }

    return false;
}
}
