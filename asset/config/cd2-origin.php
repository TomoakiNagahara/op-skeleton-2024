<?php
/** op-skeleton-2024:/config/cd2-github.php
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
$branch = '2024';

//	...
$config = [];
$config['path']      = "/www/workspace/{$branch}/origin/";
$config['origin']    = "https://github.com/TomoakiNagahara/op-skeleton-{$branch}.git";
$config['upstream']  = "https://github.com/onepiece-framework/op-skeleton-{$branch}.git";
$config['github']    = 'TomoakiNagahara'; // GitHub account (user name)
$config['branch']    = $branch; // This is parent branch. Each submodules branch is .gitmodules.
$config['gitmodules']=[ // Which .gitmodules file.
	'origin'   => 'github',
	'upstream' => 'origin',
];
$config['display']   = '0';
$config['debug']     = '0';
$config['version']   = '74, 80, 81, 82'; // PHP version to inspect.

//	...
return $config;
