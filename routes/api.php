<?php

$files =glob(__DIR__."/api/*.php");

foreach ($files as $file) {
    require_once $file;
}
   