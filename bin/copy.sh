#!/usr/bin/env bash
mkdir -p dist/
mkdir -p dist/parts/
mkdir -p dist/parts/tgm/
mkdir -p dist/parts/czr/
mkdir -p dist/page-templates/
mkdir -p dist/languages/
mkdir -p dist/assets/css/
mkdir -p dist/assets/fonts/
mkdir -p dist/assets/img/
mkdir -p dist/assets/html/
mkdir -p dist/assets/js/
mkdir -p dist/assets/js/min/
mkdir -p dist/assets/fonts/

cp *.php                    dist/
cp *.css                    dist/
cp readme.txt               dist/
cp screenshot.jpg           dist/
cp CHANGELOG.md             dist/
cp parts/*.php              dist/parts/
cp parts/tgm/*.php          dist/parts/tgm/
cp parts/czr/*.php          dist/parts/czr/
cp page-templates/*.php     dist/page-templates/
cp languages/coldbox.pot    dist/languages/

cp assets/img/*.*       dist/assets/img/
cp assets/fonts/*.*     dist/assets/fonts/
cp assets/js/*.js       dist/assets/js/
cp assets/css/*.min.css dist/assets/css/
cp assets/html/*.html   dist/assets/html/

rm dist/assets/js/czr-scripts.babel.js
