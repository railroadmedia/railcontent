# Musora Center

A simple but elegant content, user, and e-commerce management solution.

## Project setup

in *app/musora-web-platform/app/Modules/MusoraCenter/frontend* run

```
cd /app/musora-web-platform/app/Modules/MusoraCenter/frontend;
nvm install v14.15.2
nvm use 
npm install
```

Copy the `.env.example` file and make **2 new files** named `.env.dev` and `.env.production`. 
Then add the stripe public keys for both environments from 1Password.

## Bundling for local development
```
cd /app/musora-web-platform/app/Modules/MusoraCenter/frontend; 
npm run build;r mwp artisan vendor:publish --tag=public --force
```

## Bundling for production
```
cd /app/musora-web-platform/app/Modules/MusoraCenter/frontend; 
npm run build;r mwp artisan vendor:publish --tag=public --force```

## Creating a new patch version
```
./app/musora/frontend/version.sh
```

The version script will:
 - increment the patch number by 1 
 - build the app for production
 - create a new tag with the version number
 - create a new commit with the version number
 
 Now push, don't forget to also push the tag to github
 
 ## Deploying to production
 ```
 r musora deploy production
 ```

## ESLint

If you are using the PHPStorm or WebStorm IDEs, you can turn on the ESLint code hinting by going into:

**Settings -> Languages & Frameworks -> Javascript -> Code Quality Tools -> ESLint -> Manual ESLint Configuration**

![ESLint Config](https://dmmior4id2ysr.cloudfront.net/docs/eslint-config-musora.jpg)

You can create a script to automatically format your code to the ESlint Configuration.

**Settings -> Tools -> External Tools -> Create New**

![ESLint Autoformat](https://dmmior4id2ysr.cloudfront.net/docs/eslint-autoformat-musora.jpg)
