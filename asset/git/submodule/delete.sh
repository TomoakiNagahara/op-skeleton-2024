
 ## op-app-skeleton-2020-nep:/asset/git/submodule/delete.sh
 #
 # @created    ????
 # @version    1.0
 # @package    op-app-skeleton-2020-nep
 # @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 # @copyright  Tomoaki Nagahara All right reserved.
 #

# path
PATH=${1}

# Check path.
if [ -z "$PATH" ]; then
  echo 'Empty path. --> sh asset/git/submodule/delete.sh asset/unit/name'
  exit 1
fi

# Do
git stash save
git submodule deinit $PATH
git rm $PATH
rm -rf .git/modules/$PATH
git stash pop
