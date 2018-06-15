const wpPot = require('wp-pot')

wpPot({
  destFile: 'languages/coldbox.pot',
  domain: 'coldbox',
  package: 'Coldbox',
  src: [
    '*.php',
    'parts/**.php',
    'parts/czr/**.php',
    'parts/tgm/**.php',
    'page-template/**.php'
  ],
  team: 'Toshihiro Kanai (mirucon) <i@miruc.co>'
})
