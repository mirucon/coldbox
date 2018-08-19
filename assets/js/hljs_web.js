import highlight from 'highlight.js/lib/highlight'

import css from 'highlight.js/lib/languages/css'
import javascript from 'highlight.js/lib/languages/javascript'
import ruby from 'highlight.js/lib/languages/ruby'
import bash from 'highlight.js/lib/languages/bash'
import php from 'highlight.js/lib/languages/php'
import sql from 'highlight.js/lib/languages/sql'
import diff from 'highlight.js/lib/languages/diff'
import json from 'highlight.js/lib/languages/json'
import markdown from 'highlight.js/lib/languages/markdown'
import python from 'highlight.js/lib/languages/python'
import xml from 'highlight.js/lib/languages/xml'
import stylus from 'highlight.js/lib/languages/stylus'
import scss from 'highlight.js/lib/languages/scss'
import typescript from 'highlight.js/lib/languages/typescript'

highlight.registerLanguage('css', css)
highlight.registerLanguage('javascript', javascript)
highlight.registerLanguage('ruby', ruby)
highlight.registerLanguage('bash', bash)
highlight.registerLanguage('php', php)
highlight.registerLanguage('sql', sql)
highlight.registerLanguage('diff', diff)
highlight.registerLanguage('json', json)
highlight.registerLanguage('markdown', markdown)
highlight.registerLanguage('python', python)
highlight.registerLanguage('xml', xml)
highlight.registerLanguage('stylus', stylus)
highlight.registerLanguage('scss', scss)
highlight.registerLanguage('typescript', typescript)

document.addEventListener('DOMContentLoaded', () => {
  const codeTags = document.querySelectorAll('pre code')
  const preTags = document.querySelectorAll('pre')
  const tags = [...codeTags, ...preTags]
  if (tags) {
    for (const tag of tags) {
      highlight.highlightBlock(tag)
    }
  }
})
