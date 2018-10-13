<?php
require_once __DIR__.'/../vendor/autoload.php';

use \Tonolucro\Delivery\Merchant\Http\Auth;
use \Tonolucro\Delivery\Merchant\Http\Environment;
use \Tonolucro\Delivery\Merchant\Http\Query;
use \Tonolucro\Delivery\Merchant\Merchant;

try{

    $dotenv = new \Dotenv\Dotenv(__DIR__);
    $dotenv->load();
    $token = getenv('TOKEN');

    /**
     * Factory dos recursos da API
     */
    $manager = new Merchant(
        new Auth(
            $token //Ver https://developers.tonolucro.com/merchant/autenticacao
        ),
        new Environment\Sandbox() //new Environment\Production()
    );

    /**
     * Inst�ncia do recurso
     */
    $resource = $manager->getProductGroupResource();

    /**
     * Search
     */
    $query = new Query();
    $query->addFilter( $resource::title, 'Pamonha com Sal');
    $query->addSort( $resource::title, $query::SORT_ASC);
    $query->setPage(0, 1);

    $data = $resource->search($query);

    print_r($data);

    foreach ($data['items'] as $i => $item) {

        $get = $resource->get( $item['id'] );
        print_r($get);

    }


}catch (Exception $ex){
    die($ex->getMessage());
}
