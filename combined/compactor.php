<?php
require_once('./vendor/technosophos/PHPCompressor/src/lib/compactor.php');

$source = "./combined/sources.php";
$target = "./combined/semaltblocker.combined.php";

print "Compacting semalt-blocker";

$compactor = new Compactor($target);

// Use filters like this (Useable for things like stripping debug-only logging):
$compactor->setFilter(function ($in)
{
    $in = preg_replace('/require "src\/Domainparser\.php";/','',$in);
    $in = preg_replace('/require "src\/Semalt\.php";/','',$in);
    $in = preg_replace('/\'\.\/\.\.\/domains\'/','"domains"',$in);
    return $in;
});
$compactor->compactAll($source);

$compactor->report();
$compactor->close();
