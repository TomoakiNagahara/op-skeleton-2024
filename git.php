<?php
/** op-app-skeleton-2020-nep:/git.php
 *
 # <pre>
 # How to use: `php git.php asset/git/remote.php`
 # </pre>
 #
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

/**	Execute time.
 *
 */
define('_OP_APP_START_', microtime(true));

//	...
$exit = 0;

//	...
try {
	//	...
	include(__DIR__.'/asset/init.php');

	//	...
	$endpoint = $_SERVER['argv'][1];

	//	...
	if( strpos($endpoint, 'asset/git/') !== 0 ){
		throw new \Exception("This end point is not `asset/git/` path. ({$endpoint})");
	}

	//	...
	include($endpoint);

}catch( \Throwable $e ){
	//	...
	$message = $e->getMessage();

	//	...
	echo "\n\n";
	echo "Exception: {$message}\n\n";
	foreach( $e->getTrace() as $trace){
		echo ' * '.OP::DebugBacktraceToString($trace)."\n";
	}
	echo "\n";

	//	...
	$exit = __LINE__;
}

//	exit
exit($exit);
