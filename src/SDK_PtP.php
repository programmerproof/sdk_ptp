<?php
namespace PlaceToPay\SDK_PtP;

use \SoapClient;

/* Clase para comunicarce a Place To Pay, Julián Andrés Baquero Rico segquerenquer@gmail.com*/
class SDK_PtP
{
	/* url del webservice */
	private static $WSDL = 'https://test.placetopay.com/soap/pse/?wsdl';

	/* codificacion para el webservice */
	private static $ENCODING = 'UTF-8';

	/* instancia del objeto de \SoapClient */
	private $soapClient;

	/* array que contiene: login = identificador de acceso, tran_key => una llave de transaccion, cache = Sistema de cache a utilizar */
	private $config;

	/**contiene los datos de configuracion de acceso*/
	function __construct($config){
		$this->config = $config;
		$this->soapClient = new \SoapClient(self::$WSDL, array('encoding' => self::$ENCODING));
	}//end __construct method

	/*retorna los bancos disponibles*/
	public function getBankList()
	{
		/*Consume el servicio para obtener las bancos*/
	    $result = $this->soapClient->getBankList($this->authentication());
	    $banks = $result->getBankListResult->item;

        return is_array($banks) ? $banks : null;
	}//end 

	/*retorna la creacion de la transaccion */
	public function createTransaction($transaction){
		$param = $this->authentication();
		$param['transaction'] = $transaction;

	    $result = $this->soapClient->createTransaction($param);
	    $transaction = $result->createTransactionResult;

	    return is_object($transaction) ? $transaction : null;
	}//end createTransaction method

	/* retorna la creacion de la transaccion */
	public function createTransactionMultiCredit($transaction){
		$param = $this->authentication();
		$param['transaction'] = $transaction;

	    $result = $this->soapClient->createTransactionMultiCredit($param);
	    $transaction = $result->createTransactionMultiCreditResult;

	    return is_object($transaction) ? $transaction : null;
	}//end createTransactionMultiCredit method
	
	/* retorna la informacion de la transaccion */
	public function getTransactionInformation($transactionID){
		$param = $this->authentication();
		$param['transactionID'] = $transactionID;

		/*Consume el servicio para obtener la información de la transacción */
	    $result = $this->soapClient->getTransactionInformation($param);
	    $informacion = $result->getTransactionInformationResult;

        return is_object($informacion) ? $informacion : null;
	}//end getTransactionInformation method

	/* obtiene el método config con los datos de autenticación, 
	 se encarga de preparar los datos del atributo config para la autenticación del webservice. 
	 Retorna los valores de autenticación*/
	private function authentication(){
		//semilla para el consumo del webservice
		$seed = date('c');
		//llave transaccional para el consumo del webservice
		$tranKey = sha1($seed . $this->config['tran_key'],false);

		//identificador para el consumo del API
		$authentication['login'] = $this->config['login'];
		//llave para el consumo del API
		$authentication['tranKey'] = $tranKey;
		//semilla para el consumo del API en el proceso del hash * por SHA1 del tranKey, ISO 8601
		$authentication['seed'] = $seed;

		return array('auth' => $authentication);
	}//end authentication method
}