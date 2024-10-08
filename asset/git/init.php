<?php
/** op-skeleton-2024:/asset/git/init.php
 *
 * Init the onepiece-framework.
 *
 * <pre>
 * ```sh
 * php asset/git/init.php
 * ```
 * </pre>
 *
 * @created    2024-04-16
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

//	Get git root.
$git_root = trim(`git rev-parse --show-toplevel`);

//	Set hooks path.
$hooks_path = "{$git_root}/asset/git/hooks/";

//	Change directory to git root.
chdir($git_root);

//	Clone submodules.
`git submodule init`;
`git submodule update --recursive`;

//	Set local hooks.
`git config core.hooksPath {$hooks_path}`;

//	Set local hooks to submodules.
`git submodule foreach git config core.hooksPath {$hooks_path}`;

//	Get submodule configs.
$configs = include(__DIR__.'/include/GetSubmoduleConfig.php');

//	Switch branch.
foreach( $configs as $config ){
	//	...
	$path   = $config['path'];
	$branch = $config['branch'] ?? 'master';

	//	...
	chdir($git_root);
	chdir($path);
	echo getcwd() ." --> {$branch}". PHP_EOL;

	//	...
	if(!Execute("git show-ref --verify refs/remotes/origin/{$branch}") ){
		echo "\n * This branch has not been exist: {$branch} \n\n";
		continue;
	}

	//	...
	$commit_id = trim(`git rev-list --max-parents=0 HEAD` ?? '');
	Execute("git stash save");
	Execute("git stash clear");
	Execute("git checkout {$commit_id} -b root");
	Execute("git branch -D {$branch}");
	Execute("git checkout origin/{$branch} -b {$branch}");
	Execute("git branch -D root");
}

/** Execute command.
 *
 * @created    2024-10-08
 * @param      string     $comand
 * @return     bool
 */
function Execute(string $comand) : bool
{
	/* @var $output array */
	/* @var $status int   */
	exec("{$comand} 2>&1", $output, $status);

	//	...
	if( $status ){
		echo "\n{$comand} --> {$status}\n\n";
		echo join("\n", $output) . PHP_EOL . PHP_EOL;
	}

	//	...
	return empty($status) ? true: false;
}
