
 ## op-skeleton-2020:/asset/git/submodule/unit/add.sh
 #
 # @created    ????
 # @version    1.0
 # @package    op-skeleton-2020
 # @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 # @copyright  Tomoaki Nagahara All right reserved.
 #

# branch name
UNIT=${1}
unit=$(echo "$UNIT" | tr 'A-Z' 'a-z')
BRANCH=${2:-2022}
URL=https://github.com/onepiece-framework/op-unit-$unit.git
DIR=asset/unit/$unit

# Validation
if [ -z "$UNIT" ]; then
  echo 'Empty unit name. --> sh asset/git/submodule/unit/add.sh {unit_name}'
  exit 1
fi

# Add git submodule
#`git submodule add      $URL $PATH`
git submodule add --force -b $BRANCH $URL $DIR
#echo "git submodule init     $PATH"
#echo "git submodule update   $PATH"
#echo "git submodule checkout $BRANCH"
