
#! /bin/bash

# get the project directory path
PROJECT_DIR=${1}
# get the project repository
PROJECT_REPO=${2}
# get the commit hash
COMMIT_HASH=${3:-master}




# scaffold the directories in case they do not exist
cd /var/www
mkdir -p tmp
mkdir -p ${PROJECT_DIR}
# rm -rf /var/www/tmp/${PROJECT_DIR}_repo_checkout
mkdir -p tmp/${PROJECT_DIR}_repo_checkout

# fetch the commit from the repo
# fetch the repo itself it don't exist
if [ ! -d "repos/${PROJECT_DIR}" ]; then
	mkdir -p repos/${PROJECT_DIR}
	git clone ${PROJECT_REPO} repos/${PROJECT_DIR}
fi
cd repos/${PROJECT_DIR}

# fetch the latest changes on all branches from the GitHub repo
echo "Fetching the latest changes....."
git fetch --all


# checkout the repository to the document root
echo "Checking out the working directory....."
git checkout ${COMMIT_HASH}
git --work-tree="/var/www/tmp/${PROJECT_DIR}_repo_checkout" checkout HEAD -- .

echo "Doing the switcheroo....."
# make the switch
cd /var/www
if [ -d "${PROJECT_DIR}" ]; then
	mv ${PROJECT_DIR} tmp/${PROJECT_DIR}_old
fi
mv tmp/${PROJECT_DIR}_repo_checkout ${PROJECT_DIR}
cd ${PROJECT_DIR}
ln -s ../media/${PROJECT_DIR} media
rm -rf ../tmp/${PROJECT_DIR}_old

echo ""
echo "okay doke."
