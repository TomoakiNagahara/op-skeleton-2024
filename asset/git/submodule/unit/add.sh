
 ## op-app-skeleton-2020-nep:/asset/git/submodule/unit/add.sh
 #
 # @created    ????
 # @version    1.0
 # @package    op-app-skeleton-2020-nep
 # @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 # @copyright  Tomoaki Nagahara All right reserved.
 #

# branch name
UNIT=${1}
BRANCH=${2:-2022}
URL=https://github.com/onepiece-framework/op-unit-$UNIT.git
PATH=asset/unit/$UNIT

# Add git submodule
git submodule add      $URL $PATH
git submodule init
git submodule update
git submodule checkout $BRANCH
