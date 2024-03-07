#!/bin/bash

cd /app/musora-web-platform

/commands/bash/railenvironmentmanager.sh mwp composer i

/home/.nvm/nvm.sh use 20
yarn pp
yarn mp
yarn build-storybook

echo 'Done!'
