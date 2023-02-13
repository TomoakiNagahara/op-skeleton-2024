
 ## op-app-skeleton-2020-nep:/asset/git/submodule/rename.sh
 #
 # @created    ????
 # @version    1.0
 # @package    op-app-skeleton-2020-nep
 # @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 # @copyright  Tomoaki Nagahara All right reserved.
 #

# Change remote name and location

# Source name
A=${1:-origin}

# Distnation name
B=${2:-upstream}

# Rename origin name.
git submodule foreach git remote rename $A $B
