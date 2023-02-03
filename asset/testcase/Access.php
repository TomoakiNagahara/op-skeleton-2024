<?php
/** op-app-skeleton-2020-nep:/asset/testcase/Asset.php
 *
 * @created   2023-01-08
 * @version   1.0
 * @package   op-app-skeleton-2020-nep
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
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
$urls = [];
$temp = 'http://' . $_SERVER['HTTP_HOST'] . ConvertURL('app:/') . 'asset/testcase/';
$exts = ['dat','log','csv','sql','md'];
foreach( $exts as $ext ){
	$urls[] = $temp.'security.'.$ext;
}
$urls[] = 'http://' . $_SERVER['HTTP_HOST'] . ConvertURL('app:/') . 'asset/unit/app/';
D($urls);

//	...
foreach( $urls as $url ){
	//	...
	$result = `curl -I {$url}`;

	//	...
	$pos = strpos($result, "\r\n");
	$str = substr($result, 0, $pos);
	switch( $str ){
		case 'HTTP/1.1 403 Forbidden':
		case 'HTTP/1.1 404 Not Found':
			$io = 'OK';
			break;
		default:
			$io = 'NG';
			Notice::Set("This URL is not 403 Forbidden. ({$url})");
	}

	//	...
	Html("{$io}: {$str} - {$url}");
}

//	...
return;

//	...
$url    = "http://{$_SERVER['HTTP_HOST']}" . RootPath('app') . 'asset';
$result = `curl -I {$url}`;
if( strpos($result, 'HTTP/1.1 200 OK') !== 0 ){
	Notice::Set("Could be accessed this URL. ($url)");
}else{
	D($url);
}
