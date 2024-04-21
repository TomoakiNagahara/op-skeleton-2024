
## Hook the hooks
#
# @created    2024-04-21
# @version    1.0
# @package    op-skeleton-2024
# @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
# @copyright  Tomoaki Nagahara All right reserved.

# Is the hook-the-hooks already running?
if [ -v HOOK_THE_HOOKS ]; then
	exit 0;
fi

# Init
HOOK_THE_HOOKS="1"
GIT_ROOT=`git rev-parse  --show-toplevel`
HOOK_NAME=$1

# Local hooks
LOCAL_HOOK_PATH="${GIT_ROOT}/.git/hooks/${HOOK_NAME}"
if [ -e "$LOCAL_HOOK_PATH" ]; then
	echo "Execute --> ${LOCAL_HOOK_PATH}"
	source "$LOCAL_HOOK_PATH"
fi

# Global hooks
GLOBAL_HOOKS_PATH=`git config --get --global core.hooksPath`
if [[ "$GLOBAL_HOOKS_PATH" == "~"* ]]; then
	GLOBAL_HOOKS_PATH=$(echo "$GLOBAL_HOOKS_PATH" | sed "s/^~//")
	GLOBAL_HOOKS_PATH=$(echo "$GLOBAL_HOOKS_PATH" | sed "s/\/$//")
	GLOBAL_HOOKS_PATH="${HOME}${GLOBAL_HOOKS_PATH}/${HOOK_NAME}"
fi
if [ -e "$GLOBAL_HOOKS_PATH" ]; then
	echo "Execute --> ${GLOBAL_HOOKS_PATH}"
	source "$GLOBAL_HOOKS_PATH"
fi

# Unset
unset "$HOOK_THE_HOOKS"
