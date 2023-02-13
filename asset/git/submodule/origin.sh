
 ## op-app-skeleton-2020-nep:/asset/git/submodule/origin.sh
 #
 # @created    ????
 # @version    1.0
 # @package    op-app-skeleton-2020-nep
 # @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 # @copyright  Tomoaki Nagahara All right reserved.
 #

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

# layout
cd asset/layout
for name in *; do
	# Check file or directory.
	if [ -f $name ] ; then
		continue
	fi

	cd $name
	git remote add origin repo:~/repo/op/layout/$name.git
	cd ..
done
cd ../..

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
cd ../..

# Fetch origin
git submodule foreach git fetch origin
