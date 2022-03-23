/**
 * Obfuscate all asset file names in the build (dist) directory.
 */

const { readFileSync, renameSync } = require('fs')
const { basename, extname } = require('path')
const glob = require('glob')
const replace = require('replace-in-file')
const crypto = require('crypto')
const hashids = new (require('hashids/cjs'))()

const buildDir = 'public/dist'
const assetsDir = `${buildDir}/assets`

/**
 * Generate hashed filename based on the file content and index.
 * @param   {string} filePath
 * @param   {number} index A unique index starting from 0.
 * @returns {string}       Hashed file name.
 */
const getHashedFileName = (filePath, index) => {
   const ext = extname(filePath)
   const fileBuffer = readFileSync(filePath)
   const hash = crypto.createHash('sha1')
   hash.update(fileBuffer)
   const hashsum = hash.digest('base64url')
   const hashid = hashids.encode(index)
   return `${hashid}${hashsum}${ext}`
}

const searchReplace = {
   /**
    * Hash map of search-n-replace phrases. Example:
    * {
    *    ...
    *    'app.e36a82d5.js': 'k5sOtmjTMsjPCz0A601rjaRzOju2W.js',
    *    'vendor.14d2a6c2.js': '1Ku5UlkmRvjHsUDq-4cNXd13rbkbX.js'
    *    ...
    * }
    */
}

// Populate the hash map with the name and hashed name for all asset file.
glob.sync(`${assetsDir}/*.*`).forEach((filePath, index) => {
   const fileName = basename(filePath)
   searchReplace[fileName] = getHashedFileName(filePath, index)
})

/**
 * Perform search-n-replace operations within the content of all files in the build directory.
 */
replace.sync({
   files: `${buildDir}/**/*.*`,
   from: Object.keys(searchReplace).map((key) => RegExp(key.replace(/\./g, '\\.'), 'g')),
   to: Object.values(searchReplace),
})

/**
 * Rename all asset files
 * Example: app.e36a82d5.js => k5sOtmjTMsjPCz0A601rjaRzOju2W.js
 */
Object.keys(searchReplace).forEach((file) => {
   const from = file
   const to = searchReplace[file]
   renameSync(`${assetsDir}/${from}`, `${assetsDir}/${to}`)
})
