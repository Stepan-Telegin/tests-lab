<?php
$envFile = __DIR__ . '/../.env.test';
if (file_exists($envFile)) {
    foreach (parse_ini_file($envFile, false, INI_SCANNER_RAW) as $k => $v) {
        $_ENV[$k] = $v;
        putenv("$k=$v");
    }
}