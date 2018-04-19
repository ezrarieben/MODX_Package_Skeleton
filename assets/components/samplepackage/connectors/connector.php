<?php
/**
* MODX CONST DEFENITIONS ONLY FOR DEVELOPING MUST REMOVE AFTER
* define('MODX_CORE_PATH', '/var/www/html/core/');
* define('MODX_CONFIG_KEY', 'config');
*/


$web = 'web/';
// Allow anonymous users for web processors and restrict actions to that folder including subfolders with restricted chars
if (isset($_REQUEST['action']) && strpos($_REQUEST['action'], $web) === 0) {
    $_REQUEST['action'] = $web . preg_replace('#[^a-z0-9/_-]#i', '', substr($_REQUEST['action'], strlen($web)));
    define('MODX_REQP', false);
}

include_once dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';

$corePath = $modx->getOption('samplepackage.core_path',null,$modx->getOption('core_path').'components/samplepackage/');

require_once $corePath.'model/samplepackage/samplepackage.class.php';

$modx->samplepackage = new SamplePackage($modx);
$modx->lexicon->load('samplepackage:default');

// Set HTTP_MODAUTH for web processors
if (defined('MODX_REQP') && MODX_REQP === false) {
    $_SERVER['HTTP_MODAUTH'] = $modx->user->getUserToken($modx->context->get('key'));
}

// Handle request
$path = $modx->samplepackage->getOption('processorsPath', $modx->samplepackage->options, $corePath.'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));
