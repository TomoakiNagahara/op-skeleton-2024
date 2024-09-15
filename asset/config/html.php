<?php
/** op-skeleton-2023:/asset/config/html.php
 *
 * @created		2023-12-27
 * @version		1.0
 * @package		op-skeleton-2023
 * @author		Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright	Tomoaki Nagahara All right reserved.
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
$title = OP()->Config('html')['title'] ?? '';

/** Return config array.
 *
 * @return    array        $config
 */
return [
	/*
	'lang'    => 'en',
	'charset' => 'utf-8',
	*/

	//	This is used in the title tag.
	'title'   => $title,

	//	This is assigned by OP()->Content().
	'content' => null,
];
