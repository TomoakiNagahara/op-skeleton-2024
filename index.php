<?php
/**
 * app-skeleton-2019-nep:/index.php
 *
 * @created   2019-02-18
 * @version   1.0
 * @package   app-skeleton-2019-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
/* @var $app \OP\UNIT\App */

/** namespace
 *
 */
namespace OP;

 /************************************************/
//	.htaccess file has not been initialized.	//
if(!isset($app) or !is_subclass_of($app, 'IF_APP') ){
	include(__DIR__.'/app.php');
	exit(__FILE__.' #'.__LINE__);
}
//	You should leave this logic. It's for you.	//
/***********************************************/

//	Get SmartURL arguments.
$args = $app->Args();

//	Does if has arguments?
if( empty($args) ){
	//	Access is top page.
	//	Welcome page is in asset/template directory.
	$app->Template('welcome.phtml');
}else{
	//	Execute 404.php
	$app->Template('404.php');
}
