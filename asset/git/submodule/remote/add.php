<?php
/** op-app-skeleton-2020-nep:/asset/git/remote/add.php
 *
 * <pre>
 * ```sh
 * php git.php asset/git/remote/add.php config=.gitmodules name=upstream display=1 debug=0 test=1
 * ```
 * </pre>
 *
 * @created    2023-02-13
 * @version    1.0
 * @package    op-app-skeleton-2020-nep
 * @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/** Declare strict
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP;

//	...
$display = OP::Request('display') ?? 1;
$test    = OP::Request('test')    ?? 1;
$config  = OP::Request('config');
$name    = OP::Request('name');

//	...
foreach( ['config','name'] as $key ){
	if( empty(${$key}) ){
		throw new \Exception("This value is empty. ({$key})");
	}
}

//	...
if( $test === '' ){
	$test = '1';
}
//	...
if( $test ){
	$display = $test;
	D('This is test mode. (test=1)');
}

/* @var $git UNIT\Git */
$git = OP::Unit('Git');

//	...
$configs = $git->SubmoduleConfig($config);

//	...
foreach( $configs as $config ){
	//	...
	$url  = $config['url'];
	$meta = 'git:/'.$config['path'];
	$path = OP::MetaPath($meta);
	if(!chdir($path) ){
		throw new \Exception("chdir was failed. ($path)");
	}
	if( $display ){ D("Change Directory: $meta"); }

	//	...
	if( $git->Remote()->isExists($name) ){
		D("This remote name is already exists. ({$name})");
		continue;
	}

	//	...
	if( $test ){
		D("git remote add {$name} {$url}");
	}else{
		$git->Remote()->Add($name, $url);
	}
}
