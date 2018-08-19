import highlight from 'highlight.js/lib/highlight'

import css from 'highlight.js/lib/languages/css'
import http from 'highlight.js/lib/languages/http'
import javascript from 'highlight.js/lib/languages/javascript'
import ruby from 'highlight.js/lib/languages/ruby'
import bash from 'highlight.js/lib/languages/bash'
import ini from 'highlight.js/lib/languages/ini'
import makefile from 'highlight.js/lib/languages/makefile'
import php from 'highlight.js/lib/languages/php'
import sql from 'highlight.js/lib/languages/sql'
import cs from 'highlight.js/lib/languages/cs'
import diff from 'highlight.js/lib/languages/diff'
import json from 'highlight.js/lib/languages/json'
import markdown from 'highlight.js/lib/languages/markdown'
import perl from 'highlight.js/lib/languages/perl'
import powershell from 'highlight.js/lib/languages/powershell'
import cpp from 'highlight.js/lib/languages/cpp'
import java from 'highlight.js/lib/languages/java'
import python from 'highlight.js/lib/languages/python'
import objectivec from 'highlight.js/lib/languages/objectivec'
import xml from 'highlight.js/lib/languages/xml'

highlight.registerLanguage('css', css)
highlight.registerLanguage('http', http)
highlight.registerLanguage('javascript', javascript)
highlight.registerLanguage('ruby', ruby)
highlight.registerLanguage('bash', bash)
highlight.registerLanguage('ini', ini)
highlight.registerLanguage('makefile', makefile)
highlight.registerLanguage('php', php)
highlight.registerLanguage('sql', sql)
highlight.registerLanguage('cs', cs)
highlight.registerLanguage('diff', diff)
highlight.registerLanguage('json', json)
highlight.registerLanguage('markdown', markdown)
highlight.registerLanguage('perl', perl)
highlight.registerLanguage('powershell', powershell)
highlight.registerLanguage('cpp', cpp)
highlight.registerLanguage('java', java)
highlight.registerLanguage('python', python)
highlight.registerLanguage('objectivec', objectivec)
highlight.registerLanguage('xml', xml)

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
