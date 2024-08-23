<?php
/** op-skeleton-2024:/asset/git/update.php
 *
 * Update is fetch and rebase to main and submodule repositories.
 *
 * <pre>
 * ```sh
 * php git.php asset/git/update.php remote=origin branch=2024
 * ```
 * </pre>
 *
 * @created    2024-08-23
 * @version    1.0
 * @package    op-skeleton-2024
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

//	Check booted.
if(!function_exists('OP') ){
	echo "Usage: php git.php asset/git/update.php";
	exit(__LINE__);
}

//	Get request.
$remote = OP()->Request('remote') ?? 'origin';
$branch = OP()->Request('branch') ?? _OP_APP_BRANCH_;

/* @var $git \OP\UNIT\Git */
$git = OP()->Unit('Git');

//	Parent repository.
$git->Remote()->Fetch($remote);
$git->Rebase($remote, $branch);

//	Get submodule names
$names = trim(`git config --get-regexp submodule\..*\.active | grep true | sed 's/^submodule\.//;s/\.active true$//'`);

//	Generate git submodule config.
$configs = [];
foreach(explode("\n", $names) as $name){
	$url    = trim(`git config -f .gitmodules --get submodule.{$name}.url`    ?? '');
	$path   = trim(`git config -f .gitmodules --get submodule.{$name}.path`   ?? '');
	$branch = trim(`git config -f .gitmodules --get submodule.{$name}.branch` ?? '');
	$follow = trim(`git config -f .gitmodules --get submodule.{$name}.follow` ?? '');

	//	...
	$configs[$name] = [
		'url'    => $url,
		'path'   => $path,
		'branch' => $branch,
		'follow' => $follow,
	];
}

//	Get git root.
$git_root = RootPath('git');

//	Fetch submodules.
foreach($configs as $name => $config){
	//	...
	$path   = $config['path'];

	//	...
	chdir($git_root . $path);

	//	...
	$git->Remote()->Fetch($remote);
}

//	Rebase submodules.
foreach($configs as $name => $config){
	//	...
	$path   = $config['path'];
	$branch = $config['branch'];

	//	...
	chdir($git_root . $path);

	//	...
	$git->Rebase($remote, $branch);
}
