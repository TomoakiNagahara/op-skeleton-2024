<?php
/** op-skeleton-2020:/app.php
 *
 * @created   2014-02-24
 * @updated   2016-11-22
 * @updated   2019-11-18
 * @version   1.0
 * @package   op-skeleton-2020
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** Declare strict
 *
 * @created   2022-11-01
 */
declare(strict_types=1);

/** namespace
 *
 * @created   2019-12-12
 */
namespace OP;

/**	Execute time.
 *
 * @created
 * @moved     2019-12-12   asset:/app.php --> app:/app.php
 * @changed   2019-01-03   $st --> _OP_APP_START_
 */
define('_OP_APP_START_', microtime(true));

/** Launch onepiece-framework core.
 *
 * @created  2019-11-18
 */
require('asset/init.php');

/** Launch application.
 *
 * @created
 * @moved     2019-12-12   asset:/app.php --> app:/app.php
 */
try {

	//	Launch application.
	OP()->App()->Auto();

} catch ( \Throwable $e ){
	Notice::Set($e);
}

//	Output for developers.
OP::Template('app.phtml');
