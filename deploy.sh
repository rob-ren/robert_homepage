#!/usr/bin/env bash
eb use robertHomepage-env
statics_cache_control="public,max-age=86400"
eb deploy

git_hash=`git rev-parse HEAD`
echo $git_hash