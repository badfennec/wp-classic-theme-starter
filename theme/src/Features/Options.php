<?php

namespace BadFennec\Features;

class Options {
    static $main = 'badfennec-options';

    static $socials = array(
		'badfennec_opt_facebook' => array(
			'name'	=> 	'Facebook',
			'fa'	=>	'fa-brands fa-facebook-f',
			'svg'	=>	'facebook',
		),
		'badfennec_opt_twitter_x' => array(
			'name'	=> 	'X',
			'fa'	=>	'fa-brands fa-twitter',
			'svg'	=>	'twitter-x',
		),	
		'badfennec_opt_threads' => array(
			'name'	=> 	'Threads',
			'fa'	=>	'fa-brands fa-threads',
			'svg'	=>	'threads',
		),	
		'badfennec_opt_linkedin' => array(
			'name'	=> 	'LinkedIn',
			'fa'	=>	'fa-brands fa-linkedin-in',
			'svg'	=>	'linkedin',
		),	
		'badfennec_opt_instagram' => array(
			'name'	=> 	'Instagram',
			'fa'	=>	'fa-brands fa-instagram',
			'svg'	=>	'instagram',
		),		
		'badfennec_opt_youtube' => array(
			'name'	=> 	'Youtube',
			'fa'	=>	'fa-brands fa-youtube',
			'svg'	=>	'youtube',
		),
		'badfennec_opt_vimeo' => array(
			'name'	=> 	'Vimeo',
			'fa'	=>	'fa-brands fa-vimeo-v',
			'svg'	=>	'vimeo',
		),		
		'badfennec_opt_twitch' => array(
			'name'	=> 	'Twitch',
			'fa'	=>	'fa-brands fa-twitch',
			'svg'	=>	'twitch',
		),
		'badfennec_opt_tiktok' => array(
			'name'	=> 	'TikTok',
			'fa'	=>	'fa-brands fa-tiktok',
			'svg'	=>	'tiktok',
		),
	);
	
	static $contacts = array(
		'address' => array(
            'acf'   =>	'badfennec_opt_address',
			'name'	=> 	'Address',
			'fa'	=>	'fas fa-map-marker-alt',
		),
		'google_map' => array(
            'acf'   =>	'badfennec_opt_google_map',
			'name'	=> 	'Google map',
			'fa'	=>	'fas fa-map-marker-alt',
		),
		'phone' => array(
            'acf'   =>	'badfennec_opt_phone',
			'name'	=> 	'Phone',
			'fa'	=>	'fas fa-phone',
		),
		'fax' => array(
            'acf'   =>	'badfennec_opt_fax',
			'name'	=> 	'Fax',
			'fa'	=>	'fas fa-phone',
		),
		'email' => array(
            'acf'   =>	'badfennec_opt_email',
			'name'	=> 	'Email',
			'fa'	=>	'fas fa-envelope',
		),
		'messenger' => array(
            'acf'   =>	'badfennec_opt_messenger',
			'name'	=> 	'Messenger',
			'fa'	=>	'fa-brands fa-facebook-messenger',
        ),
        'whatsapp' => array(
            'acf'   =>	'badfennec_opt_whatsapp',
			'name'	=> 	'WhatsApp',
			'fa'	=>	'fa-brands fa-whatsapp',
        ),
	);
	
	static $fisc = array(
		'badfennec_opt_pi'	=>	array(
			'name'	=> 	'VAT',
			'type'	=>	'text'	
		),
        'badfennec_opt_rea'	=>	array(
            'name'	=> 	'REA',
            'type'	=>	'text'	
        ),
	);
}