<?php
/**
 * app-skeleton-2020-nep:/app.php
 *
 * @created   2019-11-18
 * @version   1.0
 * @package   app-skeleton-2019-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

 /** namespace
 *
 * @created   2019-12-12
 */
namespace OP;

/**	Execute time.
 *
 * @created
 * @moved     2019-12-12   asset:/app.php --> app:/app.php
 */
$st = microtime(true);

/** Launch onepiece-framework core.
 *
 * @created  2019-11-18
 */
require('asset/app.php');

/** Launch application.
 *
 * @created
 * @moved     2019-12-12   asset:/app.php --> app:/app.php
 */
try {
	//	Application environment config.
	require('config.php');

	/* @var $app IF_APP */
	$app = Unit::Singleton('App');

	//	Launch application.
	$app->Auto();

	//	Output memory usage.
	if( Env::isAdmin() and (Env::Mime() === 'text/html') ){
		$app->Template('app.phtml',['st'=>$st]);
	};

} catch ( \Throwable $e ){
	Notice::Set($e);
}
