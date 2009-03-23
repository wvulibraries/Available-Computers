#!/bin/bash

FOO=`hostname`

curl "http://systemsdev.lib.wvu.edu/availableComputers/updateStats.php?type=logoff&name=$FOO"