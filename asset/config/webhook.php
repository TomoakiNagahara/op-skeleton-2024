<?php
/** op-app-skeleton-2020:/asset/config/webhook.php
 *
 * @created    2023-03-07
 * @version    1.0
 * @package    op-app-skeleton-2020
 * @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/** Return config array.
 *
 * @return    array        $config
 */
return [
	'github' => [
		'secret'    => $_SERVER['_GITHUB_WEBHOOK_SECRET_'] ?? 'my secret key',
		'develop'   => [
			'whoami',
			'echo $PATH',
			'ls -la',
		],
		'completed' => [
			"sudo -u developer /opt/local/bin/php82 --version",
			"sudo -u developer /opt/local/bin/php82 ci.php display=1 debug=1",
			"sudo -u developer /opt/local/bin/php82 cd.php display=1 debug=1 remote=upstream",
		],
	],
];
