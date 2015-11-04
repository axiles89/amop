<?php
$projectRoot = __DIR__ . DIRECTORY_SEPARATOR;

$directoryList = array(
    array($projectRoot . 'web/image', 0655),
    array($projectRoot . 'web/image/avatar', 0655),
);

foreach ($directoryList as $directory) {
    $chmod = 0655;
    if (is_array($directory)) {
        $chmod = $directory[1];
        $directory = $directory[0];
    }

    if (!file_exists($directory)) {
        mkdir($directory);
        echo 'Created directory ' . $directory . ' ' . PHP_EOL;
        chmod($directory, $chmod);
    }
}