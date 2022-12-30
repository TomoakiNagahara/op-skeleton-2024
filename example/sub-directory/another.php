<?php
/** op-app-skeleton-2020-nep:/end-point/sub-directory/index.php
 *
 * @created   2022-12-30
 * @version   1.0
 * @package   op-app-skeleton-2020-nep
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

//	Dump.
D($args);

//	...
if( $args[0] === 'load' ){

}

//	...
$args = [];
$args['int']   =  1;
$args['str']   = '1';
$args['bool']  = true;
$args['null']  = null;
$args['assoc'] = ['foo'=>'bar'];
