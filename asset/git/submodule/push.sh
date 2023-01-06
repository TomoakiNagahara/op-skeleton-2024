
# Remote name
REMOTE=${1}
# Branch name
BRANCH=${2}

# Check argument.
if [ -z $REMOTE ]; then
  echo 'Empty remote name. --> sh asset/git/submodule/push.sh origin 2022'
  exit 1
fi
if [ -z "$BRANCH" ]; then
  echo 'Empty branch name. --> sh asset/git/submodule/push.sh origin 2022'
  exit 1
fi

# Push
git submodule foreach git push $REMOTE $BRANCH
