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

		//	Entry point file is app.php. This file path is in $_SERVER['SCRIPT_FILENAME'].
		$app_root = dirname($_SERVER['SCRIPT_FILENAME']);

		//	Entry each root directory.
		RootPath('asset', __DIR__);
		RootPath('op'   , __DIR__.'/core');
		RootPath('doc'  , $_SERVER['DOCUMENT_ROOT']);
		RootPath('app'  , $app_root);

		//	Alias root.
		$alias_root = $_SERVER['DOCUMENT_ROOT'] . explode('?',$_SERVER['REQUEST_URI'])[0];
		if( $app_root.'/' !== $alias_root ){
			RootPath('alias', $alias_root);
		};

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
