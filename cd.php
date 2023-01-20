<?php
/** op-app-skeleton-2020-nep:/cd.php
 *
 * @created   2022-11-21
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
 */
if(!$_SERVER['REQUEST_TIME_FLOAT'] ?? null ){
	$_SERVER['REQUEST_TIME_FLOAT'] = microtime(true);
}

/*
//	MIME
header('Content-Type: text/plain; charset=UTF-8');

//	...
require_once('asset/core/include/json.php');
*/

//	MIME
Env::MIME('text/plain');

//	GitHub -> repository -> Settings -> Webhooks
if( true ){
	//	...
	$action    = OP::Request('action');
	$signature = OP::Request('X-Hub-Signature');
	$account   = OP::Request('repository')['owner']['login'] ?? null;

	//	...
	if( $secret = OP::Config('cd')['github']['secret'] ?? null ){
		$hash   = 'sha1='.hash_hmac('sha1', file_get_contents("php://input"), $secret);
	}else{
		$hash   = null;
	}

	//	...
	if( $signature !== $hash ){
		$message = "Signature is unmatch.";
		echo $message;
		return;
	}

	//	...
	switch( $action ){
		//	GitHub action
		case 'completed':
			if( $cd = $_SERVER['_OP_CD_'] ?? null ){
				echo `{$cd}`;
			}else{
				OP::Notice('GitHub WebHook: $_SERVER[_OP_CD_] is empty.');
			}
			break;

		//	op-cd
		case 'update':
		//	`sh asset/git/submodule/update.sh`;
			break;

		default:
	}
}

/*
//	...
if( null ){
	//	...
	if(!apcu_store('account', $account) ){
		echo "Store account is fail. ({$account})\n";
		exit(__LINE__);
	}
}else{
	//	...
	if(!$account = apcu_fetch('account') ){
		echo "Fetch account is fail.\n";
		exit(__LINE__);
	}
}
*/

//	...
echo $account;
