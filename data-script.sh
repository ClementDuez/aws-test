#!/bin/sh
set -e -x

apt-get --yes --quiet update
apt-get --yes --quiet install git puppet-common

mv /etc/puppet /etc/puppet.orig
git clone git://github.com/jakzal/puppet-symfony.git /etc/puppet

puppet apply /etc/puppet/manifests/init.pp