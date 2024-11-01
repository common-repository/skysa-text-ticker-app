<?php
/*
Plugin Name: Skysa Text Ticker App
Plugin URI: http://wordpress.org/extend/plugins/skysa-text-ticker-app
Description: Displays a Ticker (Scroll Message) of any text you choose.
Version: 1.4
Author: Skysa
Author URI: http://www.skysa.com
*/

/*
*************************************************************
*                 This app was made using the:              *
*                       Skysa App SDK                       *
*    http://wordpress.org/extend/plugins/skysa-app-sdk/     *
*************************************************************
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
MA  02110-1301, USA.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) exit;

// Skysa App plugins require the skysa-req subdirectory,
// and the index file in that directory to be included.
// Here is where we make sure it is included in the project.
include_once dirname( __FILE__ ) . '/skysa-required/index.php';


// TEXT TICKER APP
$GLOBALS['SkysaApps']->RegisterApp(array( 
    'id' => '501daf9038761',
    'label' => 'Text Ticker',
	'options' => array(
        'data' => array(
            'label' => 'Scrolling Message',
            'info' => 'What is the message you want to scroll? (text only)',
			'type' => 'textarea',
			'value' => 'Scrolling Message',
			'size' => '40|5'
        ),
        'option3' => array(
            'label' => 'Link URL',
			'info' => 'Enter a URL to navigate to when the scrolling message is clicked. (leave blank if you do not want the message to be clickable)',
			'type' => 'text',
			'value' => '',
			'size' => '40|1'
        ),
        'option2' => array(
            'label' => 'Ticker Width',
			'info' => 'How wide do you want the ticker to display on your bar?',
			'type' => 'selectbox',
			'value' => '100px|150px|200px|250px|300px|400px|500px|600px',
			'size' => '10|1'
        ),
        'option1' => array(
            'label' => 'Scroll Speed',
			'info' => 'How do you want the message to scroll?',
			'type' => 'selectbox',
			'value' => 'Normal|Fast|None',
			'size' => '10|1'
        )
	),
    'html' => '<div id="$button_id" class="bar-button SKYUI-menuoff SKYUI-Mod-Button-Ticker" speed="$app_option1" name="Text Ticker App (WordPress)"><span class="label" style="width: $app_option2; display: block; overflow: hidden;"><span class="label-inner">$app_data</span></span></div>',
    'js' => "
        var clickURL = '\$app_option3';
        if(clickURL != ''){
            clickURL = clickURL.split('//');
            if(clickURL.length > 1){
                clickURL = clickURL.join('//');
            }
            else{
                clickURL = 'http://' + clickURL[0];
            }
            S.on('click',function(){if(clickURL.search(window.location.host) != -1){window.location.href = clickURL;}else{window.open(clickURL);}});
            S.load('cssStr','#\$button_id {cursor: pointer !important;}');
        }
        S.require('js',S.domain+'/js/modjs/ticker.js');
        S.require('css',S.domain+'/css/apps/ticker.css');
     "
));
?>