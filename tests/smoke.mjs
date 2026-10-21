import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import { resolve } from 'node:path';
import { fileURLToPath } from 'node:url';
import { runCLI } from '@wp-playground/cli';

const root = resolve(fileURLToPath(new URL('..', import.meta.url)));
const addon = JSON.parse(readFileSync(resolve(root, 'package.json'))).name === 'coldbox-addon';
const slug = addon ? 'coldbox-addon' : 'coldbox';
const steps = [];
if (addon) steps.push({ step: 'installTheme', themeData: { resource: 'url', url: 'https://downloads.wordpress.org/theme/coldbox.1.9.5.zip' }, options: { activate: true } });
else steps.push({ step: 'activateTheme', themeFolderName: 'coldbox' });
if (addon) steps.push({ step: 'activatePlugin', pluginPath: 'coldbox-addon/coldbox-addon.php' });
steps.push({ step: 'runPHP', code: `<?php require '/wordpress/wp-load.php';
wp_insert_post(array('post_title'=>'Coldbox smoke fixture','post_content'=>'<p>Smoke fixture content.</p>','post_status'=>'publish'));
` });
// This endpoint exists only in the disposable test runtime, never in the package.
steps.push({ step: 'writeFile', path: '/wordpress/_coldbox-test.php', data: readFileSync(new URL('fixture.php', import.meta.url), 'utf8') });

const server = await runCLI({
  command: 'server', wp: process.env.WP_VERSION || 'latest', php: process.env.PHP_VERSION || '8.3',
  port: 0, workers: 1, verbosity: 'quiet',
  mount: [{ hostPath: resolve(root, 'dist'), vfsPath: `/wordpress/wp-content/${addon ? 'plugins' : 'themes'}/${slug}` }],
  blueprint: { constants: { WP_DEBUG: true, WP_DEBUG_LOG: true, WP_DEBUG_DISPLAY: false }, steps }
});
try {
  async function page(path, status = 200) {
    console.log(`GET ${path}`);
    const response = await fetch(new URL(path, server.serverUrl));
    const html = await response.text();
    assert.equal(response.status, status, `${path}: HTTP ${response.status}`);
    assert.doesNotMatch(html, /Fatal error|There has been a critical error/i, path);
    return html;
  }
  const info = JSON.parse(await page('/_coldbox-test.php'));
  console.log(`WordPress ${info.wp}; PHP ${info.php}; ${slug}`);
  assert.equal(info.theme, 'coldbox');
  if (addon) assert.ok(info.plugins.includes('coldbox-addon/coldbox-addon.php'));
  const post = `/?p=${info.post}`;
  const home = await page('/');
  assert.match(home, /Coldbox smoke fixture/);
  assert.match(await page(post), /Smoke fixture content/);
  assert.match(await page('/?page_id=2'), /Sample Page/);
  assert.match(await page('/?s=Coldbox'), /Coldbox smoke fixture/);
  await page('/?p=999999', 404);
  // Check the actual generated assets, not only PHP returning HTTP 200.
  for (const match of home.matchAll(/(?:src|href)=["']([^"']+\/wp-content\/themes\/coldbox\/[^"']+\.(?:css|js)(?:\?[^"']*)?)["']/g)) {
    const url = new URL(match[1].replaceAll('&amp;', '&'));
    assert.ok((await page(url.pathname + url.search)).length > 10, url.pathname);
  }
  if (addon) {
    assert.match(await page(post), /rel="amphtml"/);
    assert.match(await page(`${post}&amp=1`), /<html[^>]*(?:⚡|\bamp\b)/);
    assert.doesNotMatch(await page(`${post}&amp[]=1`), /<html[^>]*(?:⚡|\bamp\b)/);
    await page('/_coldbox-test.php?mode=amp-off');
    assert.ok(!/rel="amphtml"/.test(await page(post)), 'Disabled/excluded AMP must not be advertised');
    assert.doesNotMatch(await page(`${post}&amp=1`), /<html[^>]*(?:⚡|\bamp\b)/);
    await page('/_coldbox-test.php?mode=amp-excluded');
    assert.ok(!/rel="amphtml"/.test(await page(post)), 'Disabled/excluded AMP must not be advertised');
    await page('/_coldbox-test.php?mode=verification');
    const verified = await page('/');
    assert.match(verified, /name="google-site-verification" content="coldbox-test/);
    assert.doesNotMatch(verified, /<script>coldboxInjected/);
    assert.doesNotMatch(await page('/_coldbox-test.php?mode=customizer'), /amp_ads_have_been_moved/);
  } else {
    const about = await page('/_coldbox-test.php?mode=about');
    assert.match(about, /Getting Started/);
    assert.ok(!/Coldbox Ads Extension|mailto:|feel free to get in touch|Need Help\?/i.test(about.split('Changelog')[0]), 'Current About page must not solicit support or advertise Ads');
    const notices = await page('/_coldbox-test.php?mode=notices');
    assert.doesNotMatch(notices, /notice-coldbox-ads-extension/);
  }
  const log = JSON.parse(await page('/_coldbox-test.php')).log;
  assert.equal(log, '', `PHP debug log is not empty:\n${log}`);
  console.log('PASS: pages, assets, settings and PHP debug log');
} catch (error) {
  const result = await fetch(new URL('/_coldbox-test.php', server.serverUrl));
  console.error((await result.json()).log);
  throw error;
} finally {
  await server[Symbol.asyncDispose]();
}
