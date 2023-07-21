<?php
/** op-app-skeleton-2020-nep:/asset/git/push.php
 *
 * <pre>
 * ```sh
 * php git.php asset/git/push.php remote=origin display=1 debug=1
 * ```
 * </pre>
 *
 * @created    2023-02-15
 * @version    1.0
 * @package    op-app-skeleton-2020-nep
 * @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/** Declare strict
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP;

//  ...
if(!function_exists('OP') ){
    echo "Usage: php git.php asset/git/push.php remote=origin display=1 debug=1\n";
    exit(__LINE__);
}

//	...
$display = OP::Request('display') ?? 1;
$remote  = OP::Request('remote')  ?? 'origin';
$force   = OP::Request('force')    ? true: false;
$output  = null;
$status  = null;

/* @var $git UNIT\Git */
$git = OP::Unit('Git');

//	...
$configs = $git->SubmoduleConfig();

//	...
foreach( $configs as $config ){
	//	...
	$meta = 'git:/'.$config['path'];
	$path = OP::MetaPath($meta);
	if(!chdir($path) ){
		throw new \Exception("chdir was failed. ({$meta}, {$path})");
	}
	if( $display ){ D("Change Directory: {$meta}"); }

	//	...
	$branch = $config['branch'] ?? 'master';

    // ...
    if(!$git->Switch($branch) ){
        echo "Change branch was failed. ({$branch})\n";
        continue;
    }

    //  ...
    exec("./cicd remote={$remote} branch={$branch}", $output, $status);
    if( $status ){
        echo join("\n", $output);
    }

    //  ...
    $git->Push($remote, $branch, $force);
}

//	...
$meta = 'git:/';
$path = OP::MetaPath($meta);
if(!chdir($path) ){
	throw new \Exception("chdir was failed. ({$meta}, {$path})");
}
if( $display ){ D("Change Directory: {$meta}"); }

//	...
$branch = OP::Request('branch') ?? 'master';
$git->Switch($branch);
`php ci.php`;
$git->Push($remote, $branch, $force);
