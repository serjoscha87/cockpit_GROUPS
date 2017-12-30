<?php

//die(__DIR__);

require_once(__DIR__ . '/Controller/Groups.php');

/**
 * Helpers
 */
// because auto-load not ready yet
//include(__DIR__.'/Helper/Admin.php');
//$app->helpers['admin']  = 'Cockpit\\Helper\\Admin';
// init + load i18n
//$app('i18n')->locale = 'en';

/*
  if ($user = $app->module('cockpit')->getUser()) {

  $locale = isset($user['i18n']) ? $user['i18n'] : $app->retrieve('i18n', 'en');

  if ($translationspath = $app->path("#config:cockpit/i18n/{$locale}.php")) {
  $app('i18n')->locale = $locale;
  $app('i18n')->load($translationspath, $locale);
  }
  }

  $app->bind('/cockpit.i18n.data', function() {
  $this->response->mime = 'js';
  $data = $this('i18n')->data($this('i18n')->locale);
  return 'if (i18n) { i18n.register('.(count($data) ? json_encode($data):'{}').'); }';
  });
 */

/**
 * register assets
 */
/*
  $assets = [

  // polyfills
  'assets:polyfills/es6-shim.js',
  'assets:polyfills/dom4.js',
  'assets:polyfills/fetch.js',
  'assets:polyfills/document-register-element.js',
  'assets:polyfills/web-animations.min.js',
  'assets:polyfills/pointer-events.js',

  // libs
  'assets:lib/moment.js',
  'assets:lib/jquery.js',
  'assets:lib/lodash.js',
  'assets:lib/riot/riot.js',
  'assets:lib/riot/riot.bind.js',
  'assets:lib/riot/riot.view.js',
  'assets:lib/uikit/js/uikit.min.js',
  'assets:lib/uikit/js/components/notify.min.js',
  'assets:lib/uikit/js/components/tooltip.min.js',
  'assets:lib/uikit/js/components/lightbox.min.js',
  'assets:lib/uikit/js/components/sortable.min.js',
  'assets:lib/uikit/js/components/sticky.min.js',
  'assets:lib/mousetrap.js',
  'assets:lib/storage.js',
  'assets:lib/i18n.js',

  // app
  'assets:app/js/app.js',
  'assets:app/js/app.utils.js',
  'assets:app/js/codemirror.js',
  'cockpit:assets/components.js',
  'cockpit:assets/cockpit.js',

  'assets:app/css/style.css',
  ];

  // load custom css style
  if ($app->path('config:cockpit/style.css')) {
  $assets[] = 'config:cockpit/style.css';
  }

  $app['app.assets.base'] = $assets;
 */

/*
$assets[] = 'groups/assets/css/groups.css';
$app['app.assets.base'] = $assets;*/

//$app['app.assets.base'] = array_merge($app['app.assets.base'], [$app->baseUrl('groups:assets/css/groups.css')]);
$app['app.assets.base'] = array_merge($app['app.assets.base'], [sprintf("%s/%s",__DIR__,'assets/css/groups.css')]);

/*
echo '<pre>';
die(print_r($app['app.assets.base']));
*/

/**
 * register routes
 */
//$app->bindClass('Cockpit\\Controller\\Groups', 'groups');

$app->bind('/groups', function() {

   /* if ($this['cockpit.start'] && $this->module('cockpit')->getUser()) {
     $this->reroute($this['cockpit.start']);
     } */

   //$this->bindClass('Cockpit\\Controller\\Groups', 'groups');


   return $this->invoke('Cockpit\\Controller\\Groups', 'groups');
});

//$app->bindClass('Cockpit\\Controller\\Base', 'cockpit');
$app->bindClass('Cockpit\\Controller\\Groups', 'groups');


/**
 * on admint init
 */
$app->on('admin.init', function() {

   //$this->path('groups', 'addons/Groups/');

   /*if ($this->module('cockpit')->hasaccess('cockpit', 'groups')) {
      // add to modules menu
      $this('admin')->addMenuItem('modules', [
          'label' => 'Groups',
          'icon' => 'addons/Groups/assets/icons/accounts.svg',
          'route' => '/groups',
          'active' => strpos($this['route'], '/groups') === 0
      ]);
   }*/
}, 0);

/*
$app->on('app.layout.header', function() {
   return '<'
});
 */



/**
 * listen to app search to filter accounts
 */
// TODO JB: implement this!
/*$app->on('cockpit.search', function($search, $list) {

   if (!$this->module('cockpit')->hasaccess('cockpit', 'accounts')) {
      return;
   }

   foreach ($this->storage->find('cockpit/accounts') as $a) {

      if (strripos($a['name'] . ' ' . $a['user'], $search) !== false) {
         $list[] = [
             'icon' => 'user',
             'title' => $a['name'],
             'url' => $this->routeUrl('/accounts/account/' . $a['_id'])
         ];
      }
   }
});*/

//$this->on('cockpit.menu.main', function() {
$this->on('cockpit.menu.aside', function() {
   /*$cols = $this->module('collections')->getCollectionsInGroup();
   $collections = [];
   foreach ($cols as $collection) {
      if ($collection['in_menu'])
         $collections[] = $collection;
   }*/
   //if (count($collections)) {
   if ($this->module('cockpit')->hasaccess('cockpit', 'groups')) {
      //$this->renderView("groups:views/partials/menu.php", compact('collections'));
      $this->renderView("groups:views/groups/menu.php");
   }
});

// dashboard widgets
/*
  $app->on("admin.dashboard.widgets", function($widgets) {

  $title   = $this("i18n")->get("Groups");

  $widgets[] = [
  "name"    => "groups",
  "content" => $this->view("cockpit:views/widgets/datetime.php", compact('title')),
  "area"    => 'main'
  ];

  }, 100);
 */

/**
 * handle error pages
 */
/*
  $app->on("after", function() {

  switch ($this->response->status) {
  case 500:

  if ($this['debug']) {

  if ($this->req_is('ajax')) {
  $this->response->body = json_encode(['error' => json_decode($this->response->body, true)]);
  } else {
  $this->response->body = $this->render("cockpit:views/errors/500-debug.php", ['error' => json_decode($this->response->body, true)]);
  }

  } else {

  if ($this->req_is('ajax')) {
  $this->response->body = '{"error": "500", "message": "system error"}';
  } else {
  $this->response->body = $this->view("cockpit:views/errors/500.php");
  }
  }

  $this->trigger("cockpit.request.error", ['500']);
  break;

  case 401:

  if ($this->req_is('ajax')) {
  $this->response->body = '{"error": "401", "message":"Unauthorized"}';
  } else {
  $this->response->body = $this->view("cockpit:views/errors/401.php");
  }

  $this->trigger("cockpit.request.error", ['401']);
  break;

  case 404:

  if ($this->req_is('ajax')) {
  $this->response->body = '{"error": "404", "message":"File not found"}';
  } else {

  if (!$this->module('cockpit')->getUser()) {
  $this->reroute('/auth/login');
  }

  $this->response->body = $this->view("cockpit:views/errors/404.php");
  }

  $this->trigger("cockpit.request.error", ['404']);
  break;
  }


  // send some debug information
  // back to client (visible in the network panel)
  if ($this['debug'] && !headers_sent()) {

  //some system info

  $DURATION_TIME = microtime(true) - COCKPIT_START_TIME;
  $MEMORY_USAGE  = memory_get_peak_usage(false)/1024/1024;

  header('COCKPIT_DURATION_TIME: '.$DURATION_TIME.'sec');
  header('COCKPIT_MEMORY_USAGE: '.$MEMORY_USAGE.'mb');
  header('COCKPIT_LOADED_FILES: '.count(get_included_files()));
  }
  });
 */

// load package info
//$app['cockpit'] = json_decode($app('fs')->read('#root:package.json'), true);
// init app helper
$app('admin')->init();
