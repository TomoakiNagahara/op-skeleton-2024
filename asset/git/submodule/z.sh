
# Change root remote name
if [ ${1} ] ; then
	git remote add origin ${1}
fi

# WebPack
cd webpack
git remote add origin repo:~/repo/op/module/webpack.git
cd ..

# Core
cd asset/core
git remote add origin repo:~/repo/op/core/7.git
cd ../..

# Asset
cd asset
for module in 'testcase' 'reference' 'develop'
do
	cd $module
	git remote add origin repo:~/repo/op/module/$module.git
	cd ..
done
cd ..

# Unit
cd asset/unit
for unit in *; do
	# Check file or directory.
	if [ -f $unit ] ; then
		continue
	fi

	cd $unit
	git remote add origin repo:~/repo/op/unit/$unit.git
	cd ..
done
