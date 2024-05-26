

# user name
USER_NAME=${1}

# Check argument.
if [ -z "$USER_NAME" ]; then
  echo 'Empty github accout name: sh asset/git/submodule/github.sh [YOUR ACCOUNT NAME]'
  exit 1
fi

# Copy backup.
cp .gitmodules .gitmodules_original

# Replace
sed -i -e "s/onepiece-framework/${USER_NAME}/g" .gitmodules

# Sync
git submodule sync
