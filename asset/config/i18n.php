<?php
/**
 * app-skeleton-2020-nep:/asset/config/i18n.php
 *
 * @created   2020-01-17
 * @version   1.0
 * @package   app-skeleton-2020-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

//	...
$from = OP\Env::Locale();
$to   = OP\Env::Get('locale');
$url  = "//onepiece-framework.com/en:US/i18n/js";

//	...
return [
	'from' => $from,
	'to'   => $to,
	'url'  => $url,
];
