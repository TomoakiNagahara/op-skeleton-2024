<?php
/** op-app-skeleton-2020-nep:/asset/git/remote/upstream.php
 *
 * <pre>
 * ```sh
 * php git.php asset/git/remote/upstream.php config=.gitmodules display=1 debug=0 test=1
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
$config  = OP::Request('config')  ?? '.gitmodules';
$display = OP::Request('display') ?? 1;
$test    = OP::Request('test')    ?? 1;

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
	if( $git->Remote()->isExists('upstream') ){
		D("This remote name is already exists. (upstream)");
		continue;
	}

	//	...
	if( $test ){
		D("git remote add upstream {$url}");
	}else{
		$git->Remote()->Add('upstream',$url);
	}
}
