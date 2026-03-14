<?php
$status = opcache_get_status();
echo "OPcache Hits: " . $status['opcache_statistics']['hits'] . "\n";
echo "Cached Scripts: " . $status['opcache_statistics']['num_cached_scripts'] . "\n";
