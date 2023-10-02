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
$route['default_controller'] = 'u';
$route['404_override'] = 'e/error_404';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = "u/login";
$route['register'] = "u/register";
$route['forget'] = "u/forget";
$route['reset/password/(:any)'] = "u/reset_password/$1";
$route['user'] = "u/dashboard";
$route['settings'] = "u/settings";
$route['ticket/list'] = "u/tickets";
$route['ticket/create'] = "u/create_ticket";
$route['ticket/view/(:any)'] = "u/view_ticket/$1";
$route['account/list'] = "u/accounts";
$route['account/create'] = "u/create_account";
$route['account/view/(:any)'] = "u/view_account/$1";
$route['account/settings/(:any)'] = "u/account_settings/$1";
$route['domain/checker'] = "u/domain_checker";
$route['domain/checker/(:any)'] = "u/domain_checker/$1";
$route['ssl/list'] = "u/ssl";
$route['ssl/create'] = "u/create_ssl";
$route['ssl/view/(:any)'] = "u/view_ssl/$1";
$route['upgrade'] = "u/upgrade";
$route['dns/lookup'] = "u/dns_lookup";
$route['whois/lookup'] = "u/whois_lookup";
$route['user/activate/(:any)'] = "e/activate/$1";
$route['404'] = "e/error_404";
$route['400'] = "e/error_400";
$route['503'] = "e/error_503";
$route['500'] = "e/error_500";
$route['about'] = "e/about";
$route['update'] = "e/update";
$route['license'] = "e/license";
$route['tos'] = "e/tos";
$route['admin/login'] = "a/login";
$route['admin/register'] = "a/register";
$route['admin/forget'] = "a/forget";
$route['admin/reset/password/(:any)'] = "a/reset_password/$1";
$route['admin'] = "a/dashboard";
$route['admin/settings'] = "a/settings";
$route['api/settings'] = "a/api_settings";
$route['email/templates'] = "a/email_templates";
$route['email/edit/(:any)'] = "a/edit_email/$1";
$route['admin/ticket/list'] = "a/tickets";
$route['admin/ticket/view/(:any)'] = "a/view_ticket/$1";
$route['client/list'] = "a/clients";
$route['client/view/(:any)'] = "a/view_client/$1";
$route['domain/list'] = "a/domains";
$route['admin/account/list'] = "a/accounts";
$route['admin/account/view/(:any)'] = "a/view_account/$1";
$route['admin/account/settings/(:any)'] = "a/account_settings/$1";
$route['admin/ssl/list'] = "a/ssl";
$route['admin/ssl/view/(:any)'] = "a/view_ssl/$1";