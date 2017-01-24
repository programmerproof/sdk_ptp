# sdk_ptp

Libreria para comunicarce para conectarse al webservice Place To Pay

## Requerimientos

- PHP >= 5.0

## Instalación

Se Instala vía composer

composer require place_to_pay/sdk-ptp

## Configuración

Al crearce la instanciación del objeto: PlaceToPay\SDK_PtP\SDK_PtP debe pasar un array de la siguiente forma:

php
	$config = array(
		"login" => "",
		"tran_key" => ""
	)

	$obj = new SDK_PtP($config);



### 1. Datos Place To Pay
1. login: autenticación
2. tran_key: Llave
  
## Versión
v1.0.0

## Licencia
[MIT License](LICENSE)

# Documentación

#### Ejemplo

> Consumir el webservice PtP

## Métodos disponibles
	
Los metodos se encuentran con el namespace: PlaceToPay\SDK_PtP\SDK_PtP

#### getBankList()

Obtiene la lista de los bancos

Valor devuelto: Devuelve un array con objetos

#### createTransaction()

Solicita la creacion de una transacción

Parametros: Nombre, Tipo, Descripción |
Valor devuelto: Devuelve la creacion de la transacción

#### createTransactionMultiCredit()

Solicita la creacion de una transacción con dispersión de fondos

Parametros: Nombre, Tipo, Descripción
Valor devuelto: Devuelve la creacion de la transacción

#### getTransactionInformation()

Obtiene la información de una transacción

Parametros: Nombre, Tipo, Descripción
Valor devuelto: Devuelve la informacion de la transacción