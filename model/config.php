<?php
    /**
     * ETML
     * Auteur	   : Mirko Sale
     * Date		   : 28.02.2022
     * Description : Fichier de constantes pour la connexion à la base de données
     */

    $DB_SERVER = "localhost";
    $DB_NAME = "db_recipe";
    $DB_USER = "dbUser_recipe";
    $DB_PASSWORD = ".Etml-";


/*    // https://github.com/sendinblue/APIv3-php-library
    // Configure API key authorization: api-key
    $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('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');
    // Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
    // $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api-key', 'Bearer');
    // Configure API key authorization: partner-key
    $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('partner-key', 'YOUR_API_KEY');
    // Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
    // $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('partner-key', 'Bearer');

    $apiInstance = new SendinBlue\Client\Api\AccountApi(
        // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
        // This is optional, `GuzzleHttp\Client` will be used as default.
        new GuzzleHttp\Client(),
        $config
    );

    try {
        $result = $apiInstance->getAccount();
        print_r($result);
    } catch (Exception $e) {
        echo 'Exception when calling AccountApi->getAccount: ', $e->getMessage(), PHP_EOL;
    }
     $mailin = new Mailin('mirko.sale@eduvaud.ch', 'bmSjUZhA3q7OkaPH');
        $mailin->
        addTo('mirko.sale@eduvaud.ch', 'Mirko Sale')->
        setFrom('mirko.sale@eduvaud.ch', 'Mirko Sale')->
        setReplyTo('mirko.sale@eduvaud.ch','Mirko Sale')->
        setSubject('Email')->
        setText('Bonjour')->
        setHtml('<strong>Bonjour</strong>');
        $res = $mailin->send();
        /*
        Le message de succès sera renvoyé sous cette forme:
        {'result' => true, 'message' => 'Email envoyé'}
    */
?>