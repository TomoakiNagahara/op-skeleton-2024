<?php
/** op-skeleton-2024:/config/cd2-nuro.php
 *
 * @created    2023-01-02
 * @moved      2023-02-05 from op-cd1
 * @copied     2024-05-28 from op-cd2
 * @copied     2024-??-??
 * @version    1.0
 * @package    op-cd2
 * @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright  Tomoaki Nagahara All right reserved.
 */

//	...
require_once(__DIR__.'/op.php');

//	...
$user_name = 'TomoakiNagahara';
$host_name = 'nuro';
$repo_name = _OP_APP_BRANCH_;
$repo_path = "~/repo/op/skeleton/{$repo_name}.git";

//	...
$config = [];
$config['path']      = "/www/workspace/{$repo_name}/{$host_name}/";
$config['origin']    = "{$repo_path}";
$config['upstream']  = "{$host_name}:{$repo_path}";
$config['github']    = "{$user_name}";
$config['branch']    = "{$repo_name}";
$config['gitmodules']=[
	'origin'   => 'local',
	'upstream' => $host_name,
	'hostname' => $host_name,
];
$config['display']   = '0';
$config['debug']     = '0';
$config['version']   = '74, 80, 81, 82, 83'; // The PHP version to inspect.

//	...
return $config;
