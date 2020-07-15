<?php
/**
 * app-skeleton-2020-nep:/asset/bootstrap.php
 *
 * @creation  2018-03-27
 * @version   1.0
 * @package   app-skeleton-2019-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @creation  2019-02-23
 */
namespace OP;

//	...
call_user_func(function(){
	try{
		//	Bootstrap the onepiece-framework's core.
		$path = __DIR__.'/core/Bootstrap.php';
		if(!file_exists($path) ){
			require(__DIR__.'/bootstrap/app/gitsubmodule.phtml');
		}
		require($path);

		/** Real path.
		 *
		 */
		RootPath('real', realpath(dirname($_SERVER['SCRIPT_FILENAME'])));

		/** The document root is directly under the FQDN.
		 *
		 */
		RootPath('doc'  , $_SERVER['DOCUMENT_ROOT']);

		/** About the app directory.
		 *
		 * Care should be taken if the directory is a link.
		 * A link is called an alias on Mac and a shortcut on Windows.
		 * "SCRIPT_FILENAME" is path of URL.
		 * Web Application needs a link path.
		 * Don't be generate real path.
		 */
		$app_root = dirname($_SERVER['SCRIPT_FILENAME']);
		RootPath('app'  , $app_root);

		/** Asset root would including application asset.
		 *  core, unit, template, layout, config
		 *
		 * @updated   2019-12-16   Correspond link.
		 */
		//	Check if the asset directory is under the app root.
		if( strpos(__DIR__, realpath($app_root)) === 0 ){
			//	The asset directory is under the app root.
			$asset_root = $app_root . '/' . basename(__DIR__);
		}else{
			//	The asset directory is not under the app root.
			$asset_root = __DIR__;
		}
		RootPath('asset', $asset_root);

		/** The onepiece-framework's core is under the asset root.
		 *
		 * @updated   2019-12-16
		 */
		RootPath('op'   , $asset_root . '/core');

		//	Check if symbolic link.
		if( is_link(rtrim(ConvertPath('app:/'),'/')) ){
			// Register real path.
			RootPath('link' , dirname(__DIR__));
		}

		//	Check mbstring installed.
		if(!function_exists('mb_language') ){
			define('_OP_APP_BOOTSTRAP_', 'mbstring');
			require(__DIR__.'/bootstrap/php/module.phtml');
		}

		//	Check openssl installed.
		if(!defined('OPENSSL_VERSION_NUMBER') ){
			define('_OP_APP_BOOTSTRAP_', 'openssl');
			require(__DIR__.'/bootstrap/php/module.phtml');
		};

		//	Checking rewrite setting.
		if( 'app.php' !== basename($_SERVER['SCRIPT_FILENAME']) ){
			//	Has not been setting rewrite.
			require(__DIR__.'/bootstrap/op/rewrite.php');
		}

	} catch ( \Throwable $e ){
		$file    = $e->getFile();
		$line    = $e->getLine();
		$message = $e->getMessage();
		exit("$file #$line, $message");
	};
});
