#!/usr/bin/env bash

set -e

if [[ "false" != "$TRAVIS_PULL_REQUEST" ]]; then
    echo "Not deploying pull requests."
    exit
fi

if [[ "master" != "$TRAVIS_BRANCH" ]]; then
    echo "Not on the 'master' branch."
    exit
fi

if [[ "7.2" != "$TRAVIS_PHP_VERSION" ]]; then
    echo "Deploy only works on PHP 7.2."
    exit
fi
 
git clone -b dist --quiet "https://github.com/${TRAVIS_REPO_SLUG}.git" dist
npm run build
cd dist
git add -A
git commit -m "Update from travis $TRAVIS_COMMIT"
git push --quiet "https://${GH_TOKEN}@github.com/${TRAVIS_REPO_SLUG}.git" dist 2> /dev/null