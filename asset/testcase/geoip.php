<?php
/** op-module-testcase:/php/geoip.php
 *
 * @created   2019-12-27
 * @version   1.0
 * @package   op-module-testcase
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

//	...
$debug = [];

//	...
$target = OP::Request('target') ?? null;

//	...
if( $target ){
	$debug['target'] = $target;
}else if( Env::isLocalhost() ){
	$target = $debug['host_name']   = 'onepiece-framework.com';
}else{
	$target = $debug['remote_addr'] = $_SERVER['REMOTE_ADDR'];
}

//	...
$debug['country_code'] = geoip_country_code_by_name($target);

//	...
D( $debug );
