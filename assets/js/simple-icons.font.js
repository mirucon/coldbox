const path = require('path')

module.exports = {
  files: [
    path.resolve(__dirname, '../../node_modules/simple-icons/icons/feedly.svg'),
    path.resolve(__dirname, '../../node_modules/simple-icons/icons/hatenabookmark.svg'),
  ],
  fontName: 'simple-icons',
  classPrefix: 'si-',
  baseSelector: '.si',
  types: ['eot', 'woff', 'woff2', 'ttf'],
  fileName: './fonts/[fontname].[ext]',
  cssTemplate: 'webfonts-generator-template.hbs',
}
