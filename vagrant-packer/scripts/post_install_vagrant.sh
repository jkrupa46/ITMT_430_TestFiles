#!/bin/bash 
set -e
set -v

# http://superuser.com/questions/196848/how-do-i-create-an-administrator-user-on-ubuntu
# http://unix.stackexchange.com/questions/1416/redirecting-stdout-to-a-file-you-dont-have-write-permission-on
# This line assumes the user you created in the preseed directory is vagrant
echo "%admin  ALL=NOPASSWD: ALL" | sudo tee -a /etc/sudoers.d/init-users
sudo groupadd admin
sudo usermod -a -G admin vagrant

# Installing vagrant keys
wget --no-check-certificate 'https://raw.github.com/mitchellh/vagrant/master/keys/vagrant.pub'
sudo mkdir -p /home/vagrant/.ssh
sudo chown -R vagrant:vagrant /home/vagrant/.ssh
cat ./vagrant.pub >> /home/vagrant/.ssh/authorized_keys
sudo chown -R vagrant:vagrant /home/vagrant/.ssh/authorized_keys
echo "All Done!"

##################################################
# Add User customizations below here
##################################################

sudo apt-get update -y

export DEBIAN_FRONTEND=noninteractive
FIRSTPASS="mariadb-server mysql-server/root_password password $DBPASS"
SECONDPASS="mariadb-server mysql-server/root_password_again password $DBPASS"
echo $FIRSTPASS | sudo debconf-set-selections
echo $SECONDPASS | sudo debconf-set-selections

#echo "192.168.33.10 dbhost.example.com dbhost" | sudo tee -a /etc/hosts
#echo "192.168.33.11 webhost.example.com webhost" | sudo tee -a /etc/hosts

sudo apt-get install -y firewalld
sudo systemctl enable firewalld

sudo firewall-cmd --permanent --add-rich-rule='rule family="ipv4" source address="127.0.0.1" port protocol="tcp" port="3306" accept'
sudo firewall-cmd --permanent --add-service=ssh
sudo firewall-cmd --permanent --add-port=22/tcp
sudo firewall-cmd --permanent --add-port=80/tcp
sudo firewall-cmd --permanent --add-port=443/tcp
sudo firewall-cmd --reload

sudo apt-get install -y mysql-server php php-mysql git apache2

#sudo sed -i 's/127.0.0.1/0.0.0.0/g' /etc/mysql/mysql.conf.d/mysqld.cnf
sudo systemctl restart mysql

git clone https://github.com/jkrupa46/ITMO556.git
cd ITMO556
mysql -u root -p$DBPASS < create.sql
mysql -u root -p$DBPASS < create-user-with-grants.sql
mysql -u root -p$DBPASS < insert.sql

#echo "192.168.33.10 dbhost.example.com dbhost" | sudo tee -a /etc/hosts
#echo "192.168.33.11 webhost.example.com webhost" | sudo tee -a /etc/hosts

git clone https://github.com/jkrupa46/ITMT_430_TestFiles.git
sudo mv ITMT_430_TestFiles/* /var/www/html

sudo systemctl enable apache2
sudo rm /var/www/html/index.html
sudo systemctl restart apache2

sudo openssl req -new -newkey rsa:4096 -x509 -sha256 -days 365 -nodes -out /etc/ssl/certs/MyCertificate.crt -keyout /etc/ssl/private/MyKey.key -subj "/C=US/ST=IL/L=Chicago/O=Untitled Logistics/OU= /CN= "

sudo touch /etc/apache2/sites-available/untitledlogistics.com.conf

sudo echo "<VirtualHost 192.168.33.10:80>
ServerName www.untitledlogistics1.com
Redirect permanent / https://192.168.33.10
</VirtualHost>

<VirtualHost 192.168.33.10:443>
DocumentRoot /var/www/html/
SSLEngine On
SSLCertificateFile /etc/ssl/certs/MyCertificate.crt
SSLCertificateKeyFile /etc/ssl/private/MyKey.key
SSLCaCertificateFile /etc/ssl/certs/ca-certificates.crt
ServerName www.untitledlogistics1.com
</VirtualHost>" | sudo tee -a /etc/apache2/sites-available/untitledlogistics.com.conf

cd /etc/apache2/sites-available

sudo a2enmod ssl

sudo a2ensite untitledlogistics.com.conf

sudo systemctl restart apache2

sudo echo "username='logistics-tracking-ayz'
password='70210f093ae4df7947b8ccfe4a8181a8'" | sudo tee -a /var/www/.env 

cd /var/www

sudo apt-get install -y composer
sudo composer require vlucas/phpdotenv

sudo systemctl restart apache2

sudo echo "" | sudo tee -a /etc/mysql/mysql.cnf
sudo echo "[mysqld]" | sudo tee -a /etc/mysql/mysql.cnf
sudo echo "early-plugin-load=keyring_file.so" | sudo tee -a /etc/mysql/mysql.cnf

sudo systemctl restart mysql

cd ~/ITMO556

mysql -u root -p$DBPASS < encryption.sql

sudo systemctl restart mysql
