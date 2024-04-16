<?php
/** op-skeleton-2024:/asset/git/init.php
 *
 * Init the onepiece-framework.
 *
 * <pre>
 * ```sh
 * php asset/git/init.php
 * ```
 * </pre>
 *
 * @created    2024-04-16
 * @version    1.0
 * @package    op-skeleton-2024
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

//	Get git root.
$git_root = trim(`git rev-parse --show-toplevel`);

//	Change directory to git root.
chdir($git_root);

//	Clone submodules.
`git submodule update --init --recursive`;

//	Set local hooks.
`git config core.hooksPath assets/git/hooks/`;
