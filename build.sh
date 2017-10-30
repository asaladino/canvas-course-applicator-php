#!/usr/bin/env bash

rm -R build/release
rm build/release.zip
mkdir build/release
cp run.php build/release/
cp README.md build/release/
cp -a libs build/release/
mkdir build/release/config
cp config/config-sample.json build/release/config/config.json
mkdir build/release/assets
zip -r build/release.zip build/release/