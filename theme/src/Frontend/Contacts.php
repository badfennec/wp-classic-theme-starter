<?php

namespace BadFennec\Frontend;

use BadFennec\Utils\ACF;
use BadFennec\Utils\SVG;
use BadFennec\Features\Options;

if ( ! defined( 'ABSPATH' ) )
    die();

class Contacts {

    static $contacts = null;

    public static function get(): array
    {

        if( self::$contacts === null ){

            if( $phone = ACF::get_field( Options::$contacts['phone']['acf'], 'option' ) )
				self::$contacts['phone'] = '<a href = "tel:'. str_replace([' ', '.', '-'], '', $phone ) .'">'. $phone .'</a>';

			if( $email = ACF::get_field( Options::$contacts['email']['acf'], 'option' ) )
				self::$contacts['email'] = '<a href = "mailto:'. str_replace(' ', '', $email ) .'">'. $email .'</a>';

			if( $address = ACF::get_field( Options::$contacts['address']['acf'], 'option' ) )
				self::$contacts['address'] = esc_attr( $address );

			if( $whatsapp = ACF::get_field( Options::$contacts['whatsapp']['acf'], 'option' ) )
				self::$contacts['whatsapp'] = '<a aria-label = "whatsapp" href = "https://wa.me/'. str_replace(' ', '', $whatsapp ) .'">'. SVG::get('whatsapp') .'</a>';

            
        }

        return self::$contacts;
    }

}

