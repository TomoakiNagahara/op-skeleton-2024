<?php
/**
 * app-skeleton-2019-nep:/asset/app.php
 *
 * @creation  2018-03-27
 * @version   1.0
 * @package   app-skeleton-2019-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @creation  2019-02-20
 */
namespace OP;

//	...
try {
	//	Execute time.
	$st = microtime(true);

	//	Bootstrap - Initialize onepiece-framework application.
	require(__DIR__.'/bootstrap.php');

	//	Load configuration files.
	require(__DIR__.'/config.php');

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
	require(__DIR__.'/bootstrap/op/failed.phtml');
}
