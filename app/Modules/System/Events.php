<?php
/**
 * Events - all Module's specific Events are defined here.
 *
 * @author Virgil-Adrian Teaca - virgil@giulianaeassociati.com
 * @version 3.0
 */


/** Define Events. */

Event::listen('backend.menu', function($user) {
    $items = array(
        array(
            'uri'    => 'admin/dashboard',
            'title'  => __d('system', 'Dashboard'),
            'icon'   => 'dashboard',
            'weight' => 0,
        ),
        array(
            'uri'    => 'admin/videos',
            'title'  => __d('system', 'Videos'),
            'icon'   => 'file-video-o',
            'weight' => 1,
        ),
        array(
            'uri'    => 'admin/audios',
            'title'  => __d('system', 'Audios'),
            'icon'   => 'headphones',
            'weight' => 2,
        )
    );

    if ($user->hasRole('administrator')) {
        $items[] = array(
            'uri'    => 'admin/settings',
            'title'  => __d('system', 'Settings'),
            'icon'   => 'gears',
            'weight' => 0,
        );
    }

    return $items;
});
