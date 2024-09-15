<?php
/** op-skeleton-2025:/asset/git/pick.php
 *
 * Automatically cherry pick.
 *
 * <pre>
 * ```sh
 * php git.php asset/git/pick.php path=asset/core branch=2025 file=asset/config/ skip=WIP,DEV test=1
 * ```
 * </pre>
 *
 * @created    2024-09-15
 * @version    1.0
 * @package    op-skeleton-2025
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

//	Usage
$usage = "Usage: php git.php asset/git/pick.php path=asset/core branch=2025 file=asset/config/ skip=WIP,DEV test=1\n";

//	Check booted.
if(!function_exists('OP') ){
	echo $usage;
	exit(__LINE__);
}

/* @var $git \OP\UNIT\Git */
$git = OP()->Unit('Git');

//	Get request.
$test   = OP()->Request('test','1');
$file   = OP()->Request('file');
$path   = OP()->Request('path');
$branch = OP()->Request('branch');

//	Check request value.
if( empty($path) or empty($branch) ){
	echo $usage;
	exit(__LINE__);
}

//	Change directory to request path.
if(!chdir( $path = OP()->MetaPath("git:/{$path}") )){
	echo "Change directory is failed. path={$path}";
	exit(__LINE__);
}

//	Get current branch name.
if(!$current_branch = trim(`git branch --show-current` ?? '') ){
	echo "Get current branch is failed. path={$path}";
	exit(__LINE__);
}

//	Get commit id list.
$list = trim(`git rev-list {$current_branch}..{$branch} -- {$file}` ?? '');

//	Pick by commit id.
foreach( array_reverse(explode("\n", $list)) as $commit_id ){
	//	...
	$comment = trim(`git log --format=%B -n 1 {$commit_id}` ?? '');

	//	...
	$io = isPick($current_branch, $commit_id) ? 'true': 'false';

	//	...
	if( $test ){
	//	$commit_id = substr($commit_id, 0, 8);
		echo "{$io}:{$commit_id} $comment\n";
		continue;
	}

	//	...
	if( $io === 'false' ){
		continue;
	}

	//	...
	if(!$git->Commit()->Pick($commit_id) ){
		echo "Pick is failed.\n";
		break;
	}
}

/** If return value is true then pick.
 *
 * @created    2024-09-16
 * @param      string     $current_branch
 * @param      string     $commit_id
 * @return    ?bool       true is pick
 */
function isPick($current_branch, $commit_id) : bool
{
	//	...
	static $_skip;
	if( $_skip ){
		$_skip = OP()->Request('skip');
		$_skip = strtolower($_skip);
		$_skip = ' wip,'.$_skip;
	}

	//	Get comment by commit id.
	$comment = trim(`git log --format=%B -n 1 {$commit_id}` ?? '');

	//	Get flag position.
	if(!$pos = strpos($comment, ':') ){
		echo "This commit is not correct: $commit_id, $comment";
		return false;
	}

	//	Get commit flag.
	$flag = substr($comment, 0, $pos);
	$flag = strtolower($flag);

	//	Check if match skip flag.
	if( strpos($flag, $_skip) !== false ){
		return false;
	}

	//	Pick if just 3 characters.
	if( $pos === 3 ){
		return true;
	}

	//	Check the flag if year.
	if( OP()->IsInt($flag) ){
		//	And the branch is year too.
		if( OP()->IsInt($current_branch) ){
			return $flag <= $current_branch ? true: false;
		}else{
			return false;
		}
	} // End of flag check.

	//	Pick if flag equal branch name.
	if( $flag === $current_branch ){
		return true;
	}

	//	Default false.
	return false;
}
