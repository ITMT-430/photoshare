#!/bin/bash

export DEBIAN_FRONTEND=noninteractive
sudo apt-get update -y
apache2 git php5 php5-curl mysql-client curl vim php5-mysql
sudo -E apt-get -q -y install mysql-server

git clone https://github.com/ITMT-430/photoshare.git

mysql -u user -p < photoshare/php/127_0_0_1.sql

mysql -u user -p < photoshare_430.sql
