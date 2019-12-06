<?php
/**
 * app-skeleton-2019-nep:/asset/bootstrap.php
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
		require(__DIR__.'/core/Bootstrap.php');

		//	Checking rewrite setting.
		if( 'app.php' !== basename($_SERVER['SCRIPT_FILENAME']) ){
			//	Has not been setting rewrite.
			require(__DIR__.'/bootstrap/op/rewrite.php');
		}

		//	Check mbstring installed.
		if(!function_exists('mb_language') ){
			$module = 'mbstring';
			require(__DIR__.'/bootstrap/php/index.phtml');
		}

		//	Check openssl installed.
		if(!defined('OPENSSL_VERSION_NUMBER') ){
			$module = 'openssl';
			require(__DIR__.'/bootstrap/php/index.phtml');
		};

		/** About the app directory.
		 *
		 * Care should be taken if the directory is a link.
		 * A link is called an alias on Mac and a shortcut on Windows.
		 * "SCRIPT_FILENAME" is path of URL.
		 * Web Application needs a link path.
		 * Don't be generate real path.
		 */
		RootPath('doc'  , $_SERVER['DOCUMENT_ROOT']);
		RootPath('app'  , dirname($_SERVER['SCRIPT_FILENAME']));
		RootPath('asset', __DIR__);
		RootPath('op'   , __DIR__.'/core');

		//	Check if symbolic link.
		if( is_link(rtrim(ConvertPath('app:/'),'/')) ){
			// Register real path.
			RootPath('link' , dirname(__DIR__));
		}

		//	Load env config.
		call_user_func(function(){
			include(__DIR__."/config/env.php");
		});

		//	IDE notice.
		if( false ){
			var_dump($module);
		};
	} catch ( \Throwable $e ){
		$file    = $e->getFile();
		$line    = $e->getLine();
		$message = $e->getMessage();
		exit("$file #$line, $message");
	};
});
