import { build, transform } from 'esbuild';
import { cpSync, mkdirSync, readFileSync, readdirSync, rmSync, writeFileSync } from 'node:fs';
import { resolve } from 'node:path';
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
for (const [name, files] of Object.entries(scripts)) {
  await build({ stdin: { contents: files.map(file => `import './assets/js/${file}.js';`).join('\n'), resolveDir: process.cwd() },
    bundle: true, minify: true, format: 'iife', target, outfile: `assets/js/min/${name}.js` });
}
// Preserve the old cascade: Font Awesome, the two extra icons, then theme styles.
await build({ stdin: { contents: "@import './node_modules/@fortawesome/fontawesome-free/css/all.min.css';\n@import './styles/icons.css';\n@import './styles/style.css';", loader: 'css', resolveDir: process.cwd() },
  bundle: true, minify: true, target, outfile: 'assets/css/style.min.css',
  loader: { '.woff2': 'file', '.ttf': 'file', '.svg': 'dataurl' }, assetNames: '../fonts/[name]' });
for (const name of ['editor-style', 'page-style', 'czr-style']) {
  const result = await transform(readFileSync(`styles/${name}.css`, 'utf8'), { loader: 'css', minify: true, target });
  writeFileSync(`assets/css/${name}.min.css`, result.code);
}
for (const name of readdirSync('.').filter(name => name.endsWith('.php') || name === 'style.css')) cpSync(name, `dist/${name}`);
for (const name of ['parts', 'page-templates', 'assets/css', 'assets/fonts', 'assets/img', 'assets/icons', 'assets/js/min']) cpSync(name, `dist/${name}`, { recursive: true });
for (const name of ['readme.txt', 'screenshot.jpg', 'CHANGELOG.md', 'accessibility.txt']) cpSync(name, `dist/${name}`);
mkdirSync('dist/licenses', { recursive: true });
cpSync('node_modules/@fortawesome/fontawesome-free/LICENSE.txt', 'dist/licenses/Font-Awesome.txt');
cpSync('node_modules/highlight.js/LICENSE', 'dist/licenses/highlight.js.txt');
// Existing translations are optional and extracted separately; build needs no WP/network.
try { cpSync('languages', 'dist/languages', { recursive: true, filter: path => !path.endsWith('.gitkeep') }); } catch (error) { if (error.code !== 'ENOENT') throw error; }
const files = readdirSync('dist', { recursive: true });
assert(files.includes('assets/js/min/scripts.js') || files.includes('assets\\js\\min\\scripts.js'));
assert(!files.some(name => /(?:node_modules|vendor|tests|\.map$|\.babel\.js$)/.test(name)), 'Development files must not ship');
console.log(`Built installable theme (${files.length} entries).`);
