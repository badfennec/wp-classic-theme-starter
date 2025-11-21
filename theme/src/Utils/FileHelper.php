<?php

namespace Badfennec\Utils;

if ( ! defined( 'ABSPATH' ) )
    die();

class FileHelper {

    public static function get_file_timestamp( string $file_path ): int
    {
        $full_path = THEME_DIR . '/' . ltrim( $file_path, '/' );

        if ( file_exists( $full_path ) ) {
            return filemtime( $full_path );
        }

        return time();
    }
}