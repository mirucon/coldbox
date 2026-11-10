import { build, transform } from 'esbuild';
import { marked } from 'marked';
import { cpSync, mkdirSync, readFileSync, readdirSync, rmSync, statSync, writeFileSync } from 'node:fs';
import { dirname, extname, resolve } from 'node:path';
import assert from 'node:assert/strict';
import { fileURLToPath } from 'node:url';

// Fixed output paths; never remove anything outside this checkout's build output.
process.chdir(fileURLToPath(new URL('..', import.meta.url)));
for (const dir of ['dist', 'assets/css', 'assets/fonts', 'assets/js/min']) {
  rmSync(resolve(dir), { recursive: true, force: true });
  mkdirSync(dir, { recursive: true });
}
const target = ['chrome120', 'edge120', 'firefox121', 'safari16.4'];
const scripts = {
  scripts: ['cd-scripts.babel'], hljs: ['hljs'], hljs_web: ['hljs_web'],
  'scripts+hljs': ['cd-scripts.babel', 'hljs'],
  'scripts+hljs_web': ['cd-scripts.babel', 'hljs_web'],
};
const bundledLibrarySources = new Set();
for (const [name, files] of Object.entries(scripts)) {
  const res = await build({ stdin: { contents: files.map(file => `import './assets/js/${file}.js';`).join('\n'), resolveDir: process.cwd() },
    bundle: true, minify: true, metafile: true, format: 'iife', target, outfile: `assets/js/min/${name}.js` });
  for (const input of Object.keys(res.metafile.inputs)) {
    if (input.startsWith('node_modules/') && /\.(?:js|css)$/.test(input)) bundledLibrarySources.add(input);
  }
}
// Preserve the old cascade: Font Awesome, the two extra icons, then theme styles.
const cssRes = await build({ stdin: { contents: "@import './node_modules/@fortawesome/fontawesome-free/css/all.css';\n@import './styles/icons.css';\n@import './styles/style.css';", loader: 'css', resolveDir: process.cwd() },
  bundle: true, minify: true, metafile: true, target, outfile: 'assets/css/style.min.css',
  loader: { '.woff2': 'file', '.ttf': 'file', '.svg': 'dataurl' }, assetNames: '../fonts/[name]' });
for (const input of Object.keys(cssRes.metafile.inputs)) {
  if (input.startsWith('node_modules/') && /\.(?:js|css)$/.test(input)) bundledLibrarySources.add(input);
}
for (const name of ['editor-style', 'page-style', 'czr-style']) {
  const result = await transform(readFileSync(`styles/${name}.css`, 'utf8'), { loader: 'css', minify: true, target });
  writeFileSync(`assets/css/${name}.min.css`, result.code);
}
for (const name of readdirSync('.').filter(name => name.endsWith('.php') || name === 'style.css')) cpSync(name, `dist/${name}`);
// Ship editable CSS/JS sources (both theme and bundled libraries) alongside minified assets per WP.org theme requirements.
for (const name of ['parts', 'page-templates', 'styles', 'assets/css', 'assets/fonts', 'assets/img', 'assets/icons', 'assets/js']) cpSync(name, `dist/${name}`, { recursive: true });
for (const input of bundledLibrarySources) {
  const dest = `dist/assets/lib/${input.slice('node_modules/'.length)}`;
  mkdirSync(dirname(dest), { recursive: true });
  cpSync(input, dest);
}
for (const name of ['readme.txt', 'screenshot.jpg', 'CHANGELOG.md', 'accessibility.txt']) cpSync(name, `dist/${name}`);
// Generate the admin-page history from the single maintained Markdown source.
mkdirSync('assets/html', { recursive: true });
writeFileSync('assets/html/CHANGELOG.html', marked.parse(readFileSync('CHANGELOG.md', 'utf8')));
mkdirSync('dist/assets/html', { recursive: true });
cpSync('assets/html/CHANGELOG.html', 'dist/assets/html/CHANGELOG.html');
mkdirSync('dist/licenses', { recursive: true });
cpSync('node_modules/@fortawesome/fontawesome-free/LICENSE.txt', 'dist/licenses/Font-Awesome.txt');
cpSync('node_modules/highlight.js/LICENSE', 'dist/licenses/highlight.js.txt');
// Existing translations are optional and extracted separately; build needs no WP/network.
try { cpSync('languages', 'dist/languages', { recursive: true, filter: path => !path.endsWith('.gitkeep') }); } catch (error) { if (error.code !== 'ENOENT') throw error; }
// Normalize all text files in dist/ to LF so Windows checkouts never produce mixed CRLF/LF packages for WP.org SVN.
const textExts = new Set(['.php', '.css', '.js', '.txt', '.md', '.html', '.svg', '.pot']);
for (const rel of readdirSync('dist', { recursive: true })) {
  const full = `dist/${rel}`;
  if (statSync(full).isFile() && textExts.has(extname(full).toLowerCase())) {
    writeFileSync(full, readFileSync(full, 'utf8').replace(/\r\n/g, '\n'));
  }
}
const files = readdirSync('dist', { recursive: true }).map(name => name.replaceAll('\\', '/'));
assert(files.includes('assets/js/min/scripts.js') && files.includes('assets/js/cd-scripts.babel.js') && files.includes('styles/style.css'));
assert(files.includes('assets/lib/@fortawesome/fontawesome-free/css/all.css') && files.includes('assets/lib/highlight.js/es/core.js'));
assert(!files.some(name => /(?:^|\/)(?:node_modules|vendor|tests)(?:\/|$)|\.map$/.test(name)), 'Development files must not ship');
console.log(`Built installable theme (${files.length} entries).`);
