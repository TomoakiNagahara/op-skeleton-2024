<?php
/**
 * app-skeleton-2020-nep:/asset/app.php
 *
 * @created   2018-03-27
 * @version   1.0
 * @package   app-skeleton-2019-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @created   2019-02-20
 */
namespace OP;

//	...
try {

	//	Bootstrap - Initialize onepiece-framework application.
	require('bootstrap.php');

} catch ( \Throwable $e ){
	Notice::Set($e);
	require('bootstrap/op/failed.phtml');
}
