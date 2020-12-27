
# Change remote name and location

# Source name
A=${2:-origin}

# Distnation name
B=${1:-github}

# Change root remote name
git remote rename $A $B

# Rename origin name.
git submodule foreach git remote rename $A $B
