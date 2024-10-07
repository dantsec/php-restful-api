<?php

/**
 * Initializes the application by setting up autoloading.
 */
spl_autoload_register(function ($class) {
    $prefix = 'RestfulAPI\\';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

	$baseDir = __DIR__ . '/../app/';

	if (strncmp($prefix, $class, strlen($prefix)) !== 0 ) {
		return;
	}

	$class_name = str_replace($prefix, '', $class);

	$classPath = str_replace('\\', '/', $class_name);

	$file = $baseDir . $classPath . '.php';

	if (file_exists($file)) {
		require $file;
		return;
	}
});
