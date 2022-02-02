#!/bin/bash

sed -e 's/\t/","/g' -i airforce-list.csv --in-place \
&& sed -e 's/.*/"&/g' -i airforce-list.csv --in-place \
&& sed -e 's/$/"/g' -i airforce-list.csv --in-place \
&& sed -e 's/""/"/g' -- airforce-list.csv --in-place

