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
mkdir -p dist/assets/fonts/fontawesome/
mkdir -p dist/assets/fonts/fontawesome/fonts/
mkdir -p dist/assets/fonts/simple-icons/
mkdir -p dist/assets/fonts/simple-icons/fonts

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

cp assets/img/*.*                              dist/assets/img/
cp -r assets/fonts/fontawesome/fonts/          dist/assets/fonts/fontawesome/
cp assets/fonts/fontawesome/font-awesome.css   dist/assets/fonts/fontawesome/
cp -r assets/fonts/simple-icons/fonts/         dist/assets/fonts/simple-icons/
cp assets/js/min/*.js                          dist/assets/js/min/
cp assets/js/*.js                              dist/assets/js/
cp assets/css/*.min.css                        dist/assets/css/
cp assets/html/*.html                          dist/assets/html/

rm dist/assets/js/czr-scripts.babel.js
