<?php
/** op-app-skeleton-2020-nep:/cd.php
 *
 # <pre>
 # How to use: `php cd.php upstream master`
 # </pre>
 #
 * @created    2023-02-05
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
	OP::Unit('CD')->Auto();

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
