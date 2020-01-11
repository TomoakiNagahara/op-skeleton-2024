
git submodule foreach git fetch
git submodule foreach git checkout 2020
git submodule foreach git rebase origin/2020
git submodule foreach git push origin 2020
