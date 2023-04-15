Xhprof
===

Xhprof is hierarchical profiling tool.
PHP 7.0 higher uses tideways.

Official
https://www.php.net/manual/en/book.xhprof.php

Issue
https://github.com/TomoakiNagahara/op-app-skeleton-2022/issues/9

# Install

 1. `sudo port install php-tideways_xhprof`
 2. `sudo port install go`
 3. `export GOPATH=$HOME/go`
 4. `export PATH=$GOPATH/bin:$PATH`
 5. `go install github.com/tideways/toolkit`

# Run

 1. `ch app:/`
 2. `php dev.php`

# CLI Profile

 1. `toolkit analyze-xhprof ./*.xhprof`
 2. `toolkit generate-xhprof-graphviz ./*.xhprof`
 3. `dot -Tpng callgraph.dot > callgraph.png`
 4. `open callgraph.png`
