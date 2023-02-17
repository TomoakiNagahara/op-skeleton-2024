<?php
/** op-app-skeleton-2020-nep:/asset/git/rebase.php
 *
 * <pre>
 * ```sh
 * php git.php asset/git/rebase.php branch=master display=1 debug=0
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
$exit    = 0;
$display = OP::Request('display') ?? 1;
$debug   = OP::Request('debug')   ?? 0;
$remote  = OP::Request('remote');

//	...
if(!$remote ){
	$remote = 'origin';
}

/* @var $git UNIT\Git */
$git = OP::Unit('Git');

//	...
$configs = $git->SubmoduleConfig();
if( $debug ){
	D($configs);
}

//	Submodules
foreach( $configs as $config ){
	//	...
	$meta = 'git:/'.$config['path'];
	$path = OP::MetaPath($meta);
	if(!chdir($path) ){
		throw new \Exception("chdir was failed. ({$meta}, {$path})");
	}
	if( $display ){ D("Change Directory: {$meta}"); }

	//	...
	if(!$git->Status() ){
		D("Working tree is not clean. ($meta)");
		$exit = __LINE__;
		continue;
	}

	//	...
	$branch = $config['branch'] ?? 'master';

	//	...
	echo $git->Fetch($remote);
	echo $git->Rebase($remote, $branch);
}

//	Git root.
$meta = 'git:/';
$path = OP::MetaPath($meta);
if(!chdir($path) ){
	throw new \Exception("chdir was failed. ({$meta}, {$path})");
}
if( $display ){ D("Change Directory: {$meta}"); }

//	...
if( $git->Status() ){
	$git->Fetch($remote);
	$git->Rebase($remote, OP::Request('branch') ?? 'master');
}else{
	D("Working tree is not clean. ($meta)");
	$exit = __LINE__;
}

//	...
exit($exit);
