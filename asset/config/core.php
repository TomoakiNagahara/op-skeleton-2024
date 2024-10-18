<?php
/** op-skeleton-2022:/asset/config/core.php
 *
 * @created   2022-10-04
 * @version   1.0
 * @package   op-skeleton-2022
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** Does not used.
 *
 */
$config = [
	'name' =>[
		'asset'    => 'asset',
		'endpoint' => 'index.php',
	],
	'dir' => [
		'core'     => 'asset:/core/',
		'unit'     => 'asset:/nunit/',
		'layout'   => 'asset:/layout/',
		'develop'  => 'asset:/develop/',
		'template' => 'asset:/template/',
		'config'   => 'asset:/config/',
		'cache'    => 'asset:/cache/',
	],
];

//	...
return $config;
