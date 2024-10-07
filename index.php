<?php
/** op-skeleton-2020:/index.php
 *
 * @created   2019-02-18
 * @version   1.0
 * @package   op-skeleton-2020
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** Declare strict
 *
 * @created   2022-12-30
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP;

 /************************************************/
//	.htaccess file has not been initialized.	//
if( defined('_OP_NAME_SPACE_') === false ){
	include('app.php');
	exit(__FILE__.' #'.__LINE__);
}
//	You should leave this logic. It's for you.	//
/***********************************************/

//	Get SmartURL arguments.
$args = OP::Router()->Args();

//	Does if has arguments?
if( empty($args) ){

	/** Welcome page file is in "asset/template" directory.
	 *
	 */
	OP::Template('welcome.phtml');

}else if( $args[0] === 'cd.php' ){

	/** cd.php file is in current directory.
	 *
	 */
	OP::Template('cd.php');

}else{

	/** 404.php file is in current directory.
	 *
	 */
	OP::Template('404.php');

}
