<?php

namespace BadFennec\Features;

class Options {
    static $main = 'badfennec-options';

    static $socials = array(
		'badfennec_opt_facebook' => array(
			'name'	=> 	'Facebook',
			'svg'	=>	'facebook',
		),
		'badfennec_opt_twitter_x' => array(
			'name'	=> 	'X',
			'svg'	=>	'twitter-x',
		),	
		'badfennec_opt_threads' => array(
			'name'	=> 	'Threads',
			'svg'	=>	'threads',
		),	
		'badfennec_opt_linkedin' => array(
			'name'	=> 	'LinkedIn',
			'svg'	=>	'linkedin',
		),	
		'badfennec_opt_instagram' => array(
			'name'	=> 	'Instagram',
			'svg'	=>	'instagram',
		),		
		'badfennec_opt_youtube' => array(
			'name'	=> 	'Youtube',
			'svg'	=>	'youtube',
		),
		'badfennec_opt_vimeo' => array(
			'name'	=> 	'Vimeo',
			'svg'	=>	'vimeo',
		),		
		'badfennec_opt_twitch' => array(
			'name'	=> 	'Twitch',
			'svg'	=>	'twitch',
		),
		'badfennec_opt_tiktok' => array(
			'name'	=> 	'TikTok',
			'svg'	=>	'tiktok',
		),
	);
	
	static $contacts = array(
		'address' => array(
            'acf'   =>	'badfennec_opt_address',
			'name'	=> 	'Address',
		),
		'google_map' => array(
            'acf'   =>	'badfennec_opt_google_map',
			'name'	=> 	'Google map',
		),
		'phone' => array(
            'acf'   =>	'badfennec_opt_phone',
			'name'	=> 	'Phone',
		),
		'fax' => array(
            'acf'   =>	'badfennec_opt_fax',
			'name'	=> 	'Fax',
		),
		'email' => array(
            'acf'   =>	'badfennec_opt_email',
			'name'	=> 	'Email',
		),
		'messenger' => array(
            'acf'   =>	'badfennec_opt_messenger',
			'name'	=> 	'Messenger',
        ),
        'whatsapp' => array(
            'acf'   =>	'badfennec_opt_whatsapp',
			'name'	=> 	'WhatsApp',
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