#!/bin/sh

../vendor/bin/drush state:set system.maintenance_mode 1
sleep 10
../vendor/bin/drush cr
../vendor/bin/drush state:set system.maintenance_mode 0
