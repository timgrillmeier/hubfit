<?php

/**
 * Environment Configuration
 *
 * If running in a local Lando envrionment for development,
 * load the local config. Otherwise, load the
 * production config.
 *
 * !! WARNING !!
 * Never, ever, track production configuration in version control,
 * this is a security risk.
 *
 */

if (!empty(getenv('LANDO_APP_NAME'))) {
    require_once('wp-config-local.php');
} else {
    require_once('wp-config-prod.php');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';