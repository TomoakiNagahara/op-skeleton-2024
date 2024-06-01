<?php
/** op-skeleton-2020:/example/sub-directory/index.php
 *
 * @created   2022-12-30
 * @version   1.0
 * @package   op-skeleton-2020
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** Declare strict
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP;

//	Get Smart URL arguments.
$args = OP()->Router()->Args();

//	Get 1st Smart URL argument.
$argument = $args[0] ?? null;

//	...
if( $argument == 'another' ){
	OP::Template('another.phtml', ['passed_smart_url_args' => $args]);
}else{
	OP::Template('index.phtml');
}
