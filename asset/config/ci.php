<?php
/** op-app-skeleton-2020-nep:/asset/config/ci.php
 *
 * @created   2022-10-12
 * @version   1.0
 * @package   op-app-skeleton-2020-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** Return config array.
 *
 * @return    array        $config
 */
$config = [
	'execute' => true,
	'testcase' => [
		'execute'   => true,
		'root'    => 'http://local.workspace.com/2022/_develop/testcase/',
	],
	'git' => [
		'display' => '1',
		'debug'   => '1',
	],
];

//	...
return $config;
