
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
