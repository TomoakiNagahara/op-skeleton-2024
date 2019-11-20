<?php
/**
 * app-skeleton-2019-nep:/asset/config/env.php
 *
 * @created   2019-04-09
 * @version   1.0
 * @package   app-skeleton-2019-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

 /** namespace
 *
 * @created   2019-04-09
 */
namespace OP;

//	Seed
$seed = __FILE__;

//	Calc App ID.
$app_id = substr(md5($seed), 0, 8);

//	Set App ID.
Env::AppID($app_id);
