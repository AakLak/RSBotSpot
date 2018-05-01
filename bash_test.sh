#!/bin/bash
python3 proxy_scraper.py
git add .
git commit -m "update proxy list"
git push origin master
