<?php
/** op-skeleton-2020:/config.php
 *
 * @created   2019-04-09   asset:/config/app.php
 * @moved     2019-11-20   asset:/config/app.php --> asset:/config/env.php
 * @moved     2019-12-12   asset:/config/env.php --> asset:/config.php
 * @moved     2019-12-12   asset:/config.php     --> app:/config.php
 * @version   1.0
 * @package   op-skeleton-2020
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

 /** namespace
 *
 * @created   2019-04-09
 */
namespace OP;

/*
//	Seed
$seed = __FILE__;

//	Calc App ID.
$app_id = substr(md5($seed), 0, 8);

//	Set App ID.
Env::AppID($app_id);
*/

//	ci.php or git.php is skip.
$basename = basename($_SERVER['SCRIPT_NAME']);
if( $basename === 'ci.php' or $basename === 'git.php' ){
	return;
}

//	Get admin config.
$config = Config::Get('admin');

//	Set Admin IP-Address and Admin E-Mail Address.
foreach( [Env::_ADMIN_IP_, Env::_ADMIN_MAIL_] as $key ){
	//	...
	if( empty($config[$key]) ){
		//	...
		if(!include(__DIR__.'/bootstrap/app/config-admin.phtml') ){
			exit(2);
		}
	}
}
