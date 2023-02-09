<?php
/** op-app-skeleton-2020-nep:/ci.php
 *
 # <pre>
 # How to use: `php ci.php`
 #
 # This file does not git stash save.
 # You can inspect code before committing.
 # </pre>
 #
 * @created   2022-10-09 | op-app-skeleton-2020-nep:/asset/ci.php
 * @moved     2022-10-31 | op-module-develop:/selfcheck/action.php
 * @moved     2022-10-31 | op-app-skeleton-2020-nep:/ci.php
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

/**	Execute time.
 *
 * @created
 * @moved     2019-12-12   asset:/app.php --> app:/app.php
 * @changed   2019-01-03   $st --> _OP_APP_START_
 */
define('_OP_APP_START_', microtime(true));

//	...
$exit = 0;

//	...
try {
	//	...
	include(__DIR__.'/asset/init.php');

	//	...
	Env::AppID('self-check');

	//	...
	$skip      = 0;
	$display   = OP::Request('display') ?? 1;
	$submodule = OP::Request('submodule');
	$app_root  = OP::MetaPath('app:/');
	$unit_root = OP::MetaPath('unit:/');
	$configs   = CI::SubmoduleConfig();
	$configs['op-app-skeleton'] = [
		'path'   => '',
		'url'    => '',
		'branch' => _OP_APP_BRANCH_,
	];

	//	Each submodules.
	foreach( $configs as $key => $config ){
		//	Specify submodule.
		if( $submodule and $submodule !== $config['path'] ){
			continue;
		}

		//	Get Unit path.
		$path = $config['path'];
		if( $display ){ D("{$key} is {$path}"); }

		//	Change Unit directory.
		if(!chdir($app_root.$path) ){
			throw new \Exception("Change directory failed. ({$app_root}{$path})");
		}

		//	Check .ci_skip
		if( file_exists('.ci_skip') ){
			if( $skip > 10 ){
				throw new \Exception("CI skip is {$skip}. Can not over 10.");
			}
			$skip++;
			if( $display ){ D("SKIP: {$key} is found .ci_skip file."); }
			continue;
		}

		//	Specify submodule.
		if(!$submodule ){
			//	Check Commit ID.
			if( CI::CheckCommitID($path) ){
				if( $display ){ D( CI::CurrentBranchName().' is skiping ID='.CI::CurrentCommitID()); }
				continue;
			}
		}

		//	Get each Class path.
		$list = glob("{$app_root}{$path}/*.class.php");

		//	Each class file.
		foreach( $list as $file ){
			//	Under bar file.
			if( $file[0] === '_' ){
				continue;
			}

			//	Switch namespace.
			$namespace = (0 === strpos($file, $unit_root)) ? 'OP\UNIT\\': 'OP\\';

			//	Instantiate Object from class.
			$class = $namespace.basename($file, '.class.php');
			$obj = new $class();

			//	Do CI.
			$obj = new $class();
			if(!method_exists($obj,'CI') ){
				throw new \Exception("{$class} not use OP_CI.");
			}
			$obj->CI();
		}

		//	Do testcase.
		OP::Template('core:/include/ci_testcase.php', $config);

		//	Save Commit ID.
		CI::SaveCommitID($path);
	}

	//	Display of skip count.
	if( $skip ){
		D("CI skipped is {$skip}.");
	}

	/*
	//	...
	chdir( RootPath('op') );

	//	Target can be specified.
	if( $target = OP()->Request('target') ){
		$list = [$target];
	}else{
		$list = glob('*.class.php');
	}

	//	Do each target file.
	foreach( $list as $file ){
		//	...
		if( $file[0] === '_' ){
			continue;
		}

		//	...
		$class = 'OP\\'.basename($file, '.class.php');

		//	...
		$obj = new $class();
		if(!method_exists($obj,'CI') ){
			throw new \Exception("{$class} not use OP_CI.");
		}
		$obj->CI();
	}
	*/

} catch ( \Throwable $e ){
	//	...
	$message = $e->getMessage();
	/*
	$file    = $e->getFile();
	$file    = OP()->MetaPath()->Encode($file);
	*/

	//	...
	echo "\n\n";
	echo "Exception: ".$message."\n\n";
	foreach( $e->getTrace() as $trace){
		echo ' * '.OP::DebugBacktraceToString($trace)."\n";
	}
	echo "\n";

	//	...
	$exit = __LINE__;
} // catch

//	If display is on.
if( OP()->Request('display') ?? 1 ){
	//	...
	OP()->Sandbox('template:/app.phtml');
} // Execute time, Usage memory

//	exit
exit($exit);
