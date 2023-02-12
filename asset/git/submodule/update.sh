
# Branch name
REMOTE=${1:-origin}
BRANCH=${2:-2022}

# This file is update submodules. Does not need main repository push.
# git add .
# git stash  save
# git checkout master
# git fetch  origin
# git rebase origin/master
# git stash  pop
# git reset 

# Update git submodules
git submodule foreach git add .
git submodule foreach git stash save
git submodule foreach git checkout         $BRANCH
git submodule foreach git fetch    $REMOTE
git submodule foreach git rebase   $REMOTE/$BRANCH
git submodule foreach git stash pop
git submodule foreach git reset

# Update main repository
git fetch
git rebase $REMOTE/$BRANCH
