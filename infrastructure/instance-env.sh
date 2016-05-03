#!/bin/bash


export DEBIAN_FRONTEND=noninteractive
sudo apt-get update -y
sudo apt-get install -y apache2 git php5 php5-curl mysql-client curl vim php5-mysql
sudo -E apt-get -q -y install mysql-server

sudo curl -sS https://getcomposer.org/installer | sudo php &> /tmp/getcomposer.txt

sudo php composer.phar require aws/aws-sdk-php &> /tmp/runcomposer.txt

git clone https://github.com/ITMT-430/photoshare.git

sudo mv photoshare/* /var/www/html
cd /var/www/html/navrozwork
sudo mv signin.html ../
sudo mv signup.html ../
sudo mv style1.css ../
sudo mv style2.css
sudo mv *.jpg ../
