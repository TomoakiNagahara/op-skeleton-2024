<?php
/**
 * app-skeleton-2020-nep:/asset/config/app.php
 *
 * @created   2019-02-20
 * @version   1.0
 * @package   app-skeleton-2020-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** Overwrite to X-Powered-By.
 *
 * @created   2023-01-20
 */
header("X-Powered-By: The onepiece-framework", true);

/** Return config array.
 *
 * @created   2019-12-12
 * @return    array        $config
 */
return [
	'title'     => 'onepiece-framework app skeleton 2020',
	'copyright' => 'Copyright 2009 All right reserved.',
	'app.phtml' =>  OP\Env::isAdmin() ? true: false,
];
