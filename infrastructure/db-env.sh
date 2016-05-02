#!/bin/bash

sudo apt-get install software-properties-common -y 
sudo apt-get install python-software-properties -y
sudo LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php -y
sudo apt-get update -y
sudo apt-get purge php5-common -y
sudo apt-get install php7.0 php7.0-fpm php7.0-mysql -y
sudo apt-get --purge autoremove -y

sudo apt-get update -y
sudo apt-get install -y git php-curl mysql-client curl vim

git clone https://github.com/ITMT-430/photoshare.git

export DEBIAN_FRONTEND=noninteractive
sudo -E apt-get -q -y install mysql-server

mysql -u user -p < photoshare/php/127_0_0_1.sql
