<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

#Caching Routes
$route['cache/clear'] = 'cache/deleteFileCache';

#Login Routes
$route['login/validate'] = 'login/validateLogin';

#Logout Routes
$route['logout'] = 'logout/destroy';

#Guest Modules
	$route['forgot-password'] = 'guest/forgotPassword'; 
	$route['forgot-password/send'] = 'guest/processGetForgotPasswordLink'; 
	$route['forgot-password/reset/(:any)'] = 'guest/passwordResetForm/$1'; 
	$route['forgot-password/process/reset'] = 'guest/processResetPassword'; 
	
	#AjAX
	$route['ajax/profile/check-username/(:any)'] = 'guest/ajaxCheckUsername/$1';
	$route['ajax/user/check-username'] = 'guest/ajaxAddUserCheckUsername';
	
	$route['ajax/profile/check-email/(:any)'] = 'guest/ajaxCheckEmail/$1';
	$route['ajax/user/check-email'] = 'guest/ajaxAddUserCheckEmail';		
	
#Admin Modules

	#Profile
	$route['admin/profile'] = 'admin/profile'; 
	$route['admin/profile/update/info'] = 'admin/processUpdateProfile';
	$route['admin/profile/update/avatar'] = 'admin/processUpdateAvatar';
	$route['admin/profile/update/password'] = 'admin/processUpdatePassword';
	$route['admin/profile/update/username'] = 'admin/processUpdateUsername';

	#Users
	$route['admin/user/add'] = 'admin/addUser';
	$route['admin/user/add/info'] = 'admin/processAddUser';
	$route['admin/users'] = 'admin/users';
	$route['admin/user/(:num)'] = 'admin/userDetails/$1';
	$route['admin/user/update/info'] = 'admin/processUpdateUserInfo';
	$route['admin/user/update/avatar'] = 'admin/processUpdateUserAvatar';
	$route['admin/user/update/password'] = 'admin/processUpdateUserPassword';
	$route['admin/user/update/username'] = 'admin/processUpdateUserUsername';
	$route['admin/user/delete'] = 'admin/processDeleteUserInfo';
	
	#Settings
	$route['admin/settings'] = 'admin/settings';
	$route['admin/settings/update'] = 'admin/processUpdateSettings';
	


#User Module

	$route['user/profile'] = 'user/profile'; 
	$route['user/profile/update/info'] = 'user/processUpdateProfile';
	$route['user/profile/update/avatar'] = 'user/processUpdateAvatar';
	$route['user/profile/update/password'] = 'user/processUpdatePassword';
	$route['user/profile/update/username'] = 'user/processUpdateUsername';