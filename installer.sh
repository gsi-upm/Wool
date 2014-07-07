#!/bin/bash
echo "...Installing Wool..."
WOOL_DIR=$(pwd)
echo $WOOL_DIR
cd ~
mkdir core
git clone https://github.com/fuel/core.git
cd core
rm -rf .git 
cd ..
cp -r core WOOL_DIR
exit
