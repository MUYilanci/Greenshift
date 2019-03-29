<?php 
	$menuItems = [
		"admin" => [
				array('home', 'Home', 'L'),
				array('dashboard', 'Dashboard', 'L'),
                array('package', 'Packages', 'L'),
				array('usermanagement', 'Manage Users', 'R'),
				array('logout', 'Logout', 'R')
		],
		"instructor" => [
            array('home', 'Home', 'L'),
            array('schedule', 'Schedule', 'L'),
            array('availability', 'Availability', 'L'),
            array('logout', 'Logout', 'R')
		],
        "student" => [
            array('home', 'Home', 'L'),
            array('inplannen', 'inplannen', 'L'),
            array('logout', 'Logout', 'R')
        ],
		"guest" => [
				array('home', 'Home', 'L'),
				array('login', 'Login', 'R')
		]
	];
