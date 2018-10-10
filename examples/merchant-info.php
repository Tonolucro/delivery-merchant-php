<?php
require_once __DIR__.'/../vendor/autoload.php';

use \Tonolucro\Delivery\Merchant\Http\Auth;
use \Tonolucro\Delivery\Merchant\Merchant;
use \Tonolucro\Delivery\Merchant\Http\Environment;

try{
    /**
     * Token de autentica��o
     * Ver https://developers.tonolucro.com/merchant/autenticacao
     */
    $auth = new Auth(
        'XXX'
    );

    /**
     * Factory dos recursos da API
     */
    $manager = new Merchant(
        $auth,
        new Environment\Sandbox() //new Environment\Production()
    );

    /**
     * Inst�ncia do recurso /Merchant
     */
    $resource = $manager->getMerchantResource();

    /**
     * M�todo: https://developers.tonolucro.com/merchant/merchant#informacoes
     */
    $data = $resource->getInfo();

    /**
     * Navegue no array de informa��es
     */
    print_r($data);

}catch (Exception $ex){
    die($ex->getMessage());
}
