
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
