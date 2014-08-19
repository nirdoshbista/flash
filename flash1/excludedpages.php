<?php

$files = $_GET['files'];

file_put_contents('excludedpages.txt',str_replace(",","\n",$files));
