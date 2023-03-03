<?php
/** op-app-skeleton-2020-nep:/webhook/index.php
 *
 * @created    2022-11-21
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

//	...
$args = OP()->Router()->Args();

//	...
if( $file = $args[0] ?? null ){
	OP()->Template("{$file}.php");
}
