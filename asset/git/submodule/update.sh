
# Branch name
REMOTE=${1:-origin}
BRANCH=${2:-2020}

# Update git submodules
git submodule foreach git fetch
git submodule foreach git checkout         $BRANCH
git submodule foreach git rebase   $REMOTE/$BRANCH
git submodule foreach git push     $REMOTE $BRANCH
