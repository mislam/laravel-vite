const { writeFileSync, copyFileSync } = require('fs')
const { resolve, basename } = require('path')
const glob = require('glob')
const replace = require('replace-in-file')
require('dotenv').config()

const faviconDir = 'resources/favicon'
const buildDir = 'public/dist'
const assetsDir = `${buildDir}/assets`
const assetPath = assetsDir.replace(/^public/, '')

// Copy all files from favicon directory to asset directory
glob.sync(`${faviconDir}/*.*`).forEach((filePath) => {
   copyFileSync(filePath, resolve(assetsDir, basename(filePath)))
})

// Update few values in `site.webmanifest` and `browserconfig.xml`
replace.sync({
   files: [`${assetsDir}/site.webmanifest`, `${assetsDir}/browserconfig.xml`],
   from: [RegExp('\\/favicon', 'g'), RegExp('Laravel', 'g'), 'http://localhost'],
   to: [assetPath, process.env.APP_NAME, process.env.APP_URL],
})

// Append favicon entries to the end of `manifest.json`
const manifest = require(resolve(`${buildDir}/manifest.json`))
Object.assign(manifest, {
   'apple-touch-icon-png': { file: 'assets/apple-touch-icon.png' },
   'favicon-32x32-png': { file: 'assets/assets/favicon-32x32.png' },
   'favicon-16x16-png': { file: 'assets/favicon-16x16.png' },
   'site-webmanifest': { file: 'assets/site.webmanifest' },
   'safari-pinned-tab-svg': { file: 'assets/safari-pinned-tab.svg' },
   'favicon-ico': { file: 'assets/favicon.ico' },
   'browserconfig-xml': { file: 'assets/browserconfig.xml' },
})
writeFileSync(`${buildDir}/manifest.json`, JSON.stringify(manifest))
