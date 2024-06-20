const fs = require('fs-extra');
const path = require('path');

// Define the source and destination directories
const srcDir = path.resolve(__dirname, 'build');
const destDir = path.resolve(__dirname, '../../public/sanity');

// Ensure the destination directory exists
fs.ensureDirSync(destDir);

// Copy the build files to the destination directory
fs.copy(srcDir, destDir)
  .then(() => console.log('Build files copied successfully!'))
  .catch(err => console.error('Error copying build files:', err));
