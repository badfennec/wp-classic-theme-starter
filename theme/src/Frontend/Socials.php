<?php

namespace Badfennec\Frontend;

use Badfennec\Features\Options;
use Badfennec\Utils\SVG;
use Badfennec\Utils\ACF;

if ( ! defined( 'ABSPATH' ) )
    die();

class Socials extends Options {

	static $socialList = null;

	/**
	 * Get a social item by its slug
	 * @param string $slug The social media slug
	 * @return array|false The social item data or false if not found
	 */
    private static function get_item( string $slug ) : array|false
	{
		if( @self::$socials[$slug] ){
			if( $url = ACF::get_field($slug, 'option') ){
				return [
					'url'	=>	$url, 
					'icon'	=> 	SVG::get( self::$socials[$slug]['svg'] ), 
					'name' 	=> 	self::$socials[$slug]['name']
				];
			}
		}

		return false;
	}
	
	/**
	 * Get all configured social items
	 * @return array List of social items with their data
	 */
	public static function get(): array
	{
		if( self::$socialList === null ){

			self::$socialList = [];
			
			foreach( self::$socials as $k => $s){
				if( $social = self::get_item($k) ){
					self::$socialList[] = $social;
				}				
			}
		}
		
		return self::$socialList;
	}
}