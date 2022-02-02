#!/bin/bash

sed -e 's/\t/","/g' -i $1 --in-place \
&& sed -e 's/.*/"&/g' -i $1 --in-place \
&& sed -e 's/$/"/g' -i $1 --in-place \
&& sed -e 's/""/"/g' -- $1 --in-place

