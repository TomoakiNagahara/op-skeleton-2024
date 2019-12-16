<?php
/**
 * app-skeleton-2020-nep:/app.php
 *
 * @created   2014-02-24
 * @updated   2016-11-22
 * @updated   2019-11-18
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
	/** Include Application environment config.
	 *
	 * @created   2016-11-22   Creation config.php at app-skeleton.
	 * @updated   2017-??-??   Generate _config.php at app-skeleton2.
	 * @updated   2019-12-16   Rebirth
	 */
	foreach(['config.php','_config.php'] as $file){
		if( file_exists($file) ){
			call_user_func(function($file){
				include($file);
			}, $file);
		}
	}

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
