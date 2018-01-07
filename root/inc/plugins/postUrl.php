<?php
/**
    ===============================================================
    @author     : Mateusz 'Snake_' Ciećka;    
    @version    : 2.0 ;
    @mybb       : compatibility MyBB 1.8.x;
    @description: -
    @homepage   : http://polski-freeroam.pl 
    ===============================================================
 **/

if(!defined('IN_MYBB')) {
    die('Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.');
}

$plugins->add_hook('postbit', ['postUrl', 'postUrl_change']);

function postUrl_info()
{
    return [
		'name'			=> 'Post URL',
		'description'	=> 'Dodatek podmienia link do danego posta, po kliknięciu ukazuje się modal z linkami (BBCode, HTML).',
		'website'		=> 'http://mybboard.pl',
		'author'		=> 'Mateusz "Snake_" Ciećka',
		'authorsite'	=> 'http://polski-freeroam.pl',
		'version'		=> '2.0',
        'codename'      => '',
		'compatibility' => '18*'
	];
}

function postUrl_activate()
{
    require_once('postUrl.install.php');
    postUrlActivator::activate();
}

function postUrl_deactivate()
{
    require_once('postUrl.install.php');
    postUrlActivator::deactivate();
}

class postUrl
{
	// change post url to popup
    public static function postUrl_change(&$post)
    {
    	global $mybb, $templates, $postcounter;
    	
		$post_number = my_number_format($postcounter);

		$url = $mybb->settings['bburl'] . '/' . $post['postlink'] . '#pid' . $post['pid'];

		$urlBBCode = '[url=' . $url . ']RE: ' . $post['subject'] . '[/url]';

		$urlHTML = "<a href=" . $url . ">RE: " . $post['subject'] . "</a>";

    	eval('$post[\'posturl\'] = "' . $templates->get('postUrl_modal') . '";');   
	}
}
