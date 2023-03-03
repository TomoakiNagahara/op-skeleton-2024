<?php
/** op-app-skeleton-2020-nep:/asset/config/cd.php
 *
 * @created   2023-01-15
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
	'github' => [
		'secret' => $_SERVER['_GITHUB_WEBHOOK_SECRET_'] ?? 'my secret key',
	],
];

//	...
return $config;
