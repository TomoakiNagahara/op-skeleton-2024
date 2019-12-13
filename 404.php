<?php
/**
 * app-skeleton-2020-nep:/404.php
 *
 * @creation  2018-10-30
 * @version   1.0
 * @package   app-skeleton-2019-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @creation  2019-02-18
 */
namespace OP;

/* @var $app     UNIT\App     */
/* @var $webpack UNIT\WebPack */

//	Change http status code.
http_response_code(404);

//	...
if( date('m', Env::Time()) == '10' ){
	$path = '404_halloween.phtml';
}else{
	$path = '404_notfound.phtml';
	Unit::Singleton('WebPack')->Auto( ConvertPath('app:/webpack/css/common/404.css') );
}

//	Display 404 page.
$app->Template($path);

//	404 Error notice.
if( Config::Get('notfound')['execute'] ?? null ){
	Unit::Singleton('NotFound')->Auto();
}else{
	throw new \Exception("404 Error");
}
