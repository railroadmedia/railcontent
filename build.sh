#!/bin/bash

cd /app/musora-web-platform

/commands/bash/railenvironmentmanager.sh mwp composer i

/home/.nvm/nvm.sh use 16
yarn pp
yarn mp

echo 'Done!'
