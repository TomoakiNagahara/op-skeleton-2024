
# Branch name
REMOTE=${1:-origin}
BRANCH=${2:-2022}

# Update git submodules
git submodule foreach git add .
git submodule foreach git stash save
git submodule foreach git checkout         $BRANCH
git submodule foreach git fetch    $REMOTE
git submodule foreach git rebase   $REMOTE/$BRANCH
git submodule foreach git stash pop
git submodule foreach git reset

# Update parent repository
git add .
git stash    save
git checkout master
git fetch
git rebase   master/$BRANCH
git stash  pop
git reset 

# Necessary?
git submodule update --remote
