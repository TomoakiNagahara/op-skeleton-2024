<?php
/** op-app-skeleton-2020-nep:/asset/git/fetch.php
 *
 * <pre>
 * ```sh
 * php git.php asset/git/fetch.php remote=orign display=1 debug=0
 * ```
 * </pre>
 *
 * @created    2023-02-15
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
$remote  = OP::Request('remote')  ?? 'origin';

/* @var $git UNIT\Git */
$git = OP::Unit('Git');

//	...
$configs = $git->SubmoduleConfig();

//	...
foreach( $configs as $config ){
	//	...
	$meta = 'git:/'.$config['path'];
	$path = OP::MetaPath($meta);
	if(!chdir($path) ){
		throw new \Exception("chdir was failed. ({$meta}, {$path})");
	}
	if( $display ){ D("Change Directory: {$meta}"); }

	//	...
	$git->Fetch($remote);
}

//	...
$meta = 'git:/';
$path = OP::MetaPath($meta);
if(!chdir($path) ){
	throw new \Exception("chdir was failed. ({$meta}, {$path})");
}
if( $display ){ D("Change Directory: {$meta}"); }

//	...
$git->Fetch($remote);
