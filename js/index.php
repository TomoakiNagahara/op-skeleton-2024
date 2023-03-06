<?php
/** op-app-skeleton-2020-nep:/js/index.php
 *
 * @created   2023-01-22
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
foreach( glob('*.js') as $file ){
	//	...
	if( $file === 'index.js' ){
		//	Why?
		continue;
	}

	//	...
	if( $file[0] === '.' or $file[0] === '_' ){
		continue;
	}

	//	...
	echo OP::Template($file);
}
