<?php
require_once(__DIR__ . '/Controller/Groups.php');

/**
 * register assets
 */
$app['app.assets.base'] = array_merge($app['app.assets.base'], [
    'groups:assets/css/groups.css',
    'groups:assets/js/groups.js',
]);

/**
 * register routes
 */
$app->bind('/groups', function() {
   return $this->invoke('Cockpit\\Controller\\Groups', 'groups');
});
$app->bindClass('Cockpit\\Controller\\Groups', 'groups');

/**
 * on admint init
 */
$app->on('admin.init', function() {}, 0);

/**
 * listen to app search to filter accounts
 */
$app->on('cockpit.search', function($search, $list) {

    if (!$this->module('cockpit')->hasaccess('cockpit', 'groups')) {
        return;
    }

    foreach ($this->storage->find('cockpit/groups') as $a) {

        if (strripos($a['group'], $search) !== false) {
            $list[] = [
                'icon' => 'users',
                'title' => $a['group'],
                'url' => $this->routeUrl('/groups/group/' . $a['_id'])
            ];
        }
    }
});

/*
 * add menu entry if the user has access to group stuff
 */
$this->on('cockpit.menu', function() {
    if ($this->module('cockpit')->hasaccess('cockpit', 'groups')) {
        $this->renderView("groups:views/partials/menu.php", ['module' => $this->module('groups')]);
    }
});

/*
 * dashboard widget
 */
$app->on("admin.dashboard.widgets", function($widgets) {
    if ($this->module('cockpit')->hasaccess('cockpit', 'groups')) {
        $title = $this("i18n")->get("Groups");
        $groups = $this->storage->find('cockpit/groups')->toArray();

        $widgets[] = [
            "name" => "groups",
            "content" => $this->view("groups:views/partials/widget.php", compact('title', 'groups')),
            "area" => 'main'
        ];
    }
}, 100);

// ...
$app('admin')->init();
