import { test, expect } from '@playwright/test';
import axe from 'axe-core';

// Exercise the shipped highlighter and CSS together, so dependency updates are
// checked without relying on a snapshot of highlight.js's generated markup.
test('highlighted code remains readable across token colors', async ({ page }) => {
  const samples = {
    javascript: '// A comment\nconst answer = 42;\nfunction greet(name) {\n  return "Hello " + name;\n}',
    php: '<?php\n$label = "Hello";\necho $label;',
    xml: '<article id="example">Hello</article>',
    css: '.example { color: red; }\n#example { display: block; }',
    diff: '-removed\n+added',
  };
  const escape = text => text.replaceAll('&', '&amp;').replaceAll('<', '&lt;').replaceAll('>', '&gt;');
  const markup = Object.entries(samples).map(([language, text]) =>
    `<pre class="language-${language}" data-contrast-sample>${escape(text)}</pre>`).join('');
  await page.route('**/coldbox-fixture/', async route => {
    const response = await route.fetch();
    const html = await response.text();
    expect(html).toContain('const answer = 42;');
    await route.fulfill({ response, body: html.replace(
      /<pre\b[^>]*><code\b[^>]*>const answer = 42;<\/code><\/pre>/, markup) });
  });
  await page.goto('/coldbox-fixture/', { waitUntil: 'domcontentloaded' });
  const blocks = page.locator('[data-contrast-sample]');
  await expect(blocks).toHaveCount(Object.keys(samples).length);
  for (const block of await blocks.all()) await expect(block).toHaveClass(/hljs/);
  for (const token of ['number', 'keyword', 'variable', 'comment', 'meta', 'string', 'name']) {
    expect(await blocks.locator(`.hljs-${token}`).count(), token).toBeGreaterThan(0);
  }
  await page.evaluate(() => document.fonts.ready);
  await page.addScriptTag({ content: axe.source });
  const result = await page.evaluate(async () => {
    const result = await axe.run('[data-contrast-sample]', { runOnly: ['color-contrast'] });
    return { violations: result.violations, incomplete: result.incomplete, passes: result.passes.length };
  });
  expect(result.violations).toEqual([]);
  expect(result.incomplete).toEqual([]);
  expect(result.passes).toBeGreaterThan(0);
});
