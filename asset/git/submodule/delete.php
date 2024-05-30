<?php
/** op-skeleton-2024:/asset/git/submodule/delete.php
 *
 * @created    2024-05-29
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

//	Usage
$usage = 'php git.php asset/git/submodule/delete.php path=asset/unit/name'.PHP_EOL;

//  ...
if(!function_exists('OP') ){
	echo "Usage: {$usage}";
	exit(__LINE__);
}

//	...
$path = OP()->Request('path');

//	...
if( empty($path) ){
	echo "path was empty: {$usage}";
	exit(__LINE__);
}

//	...
if(!file_exists($path) ){
	echo "This path is not exist. ({$path})";
	exit(__LINE__);
}

//	Backup and Recovery original .gitmodules file.
`mv .gitmodules _gitmodules`;
`git checkout .gitmodules`;
//	Uninstall submodule.
`git submodule deinit {$path}`;
`git rm {$path}`;
`rm -rf .git/modules/{$path}`;
//	Recovery backup .gitmodules file.
`rm .gitmodules`;
`mv _gitmodules .gitmodules`;
