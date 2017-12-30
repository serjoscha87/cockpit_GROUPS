<?php

$app->path('groups', 'addons/Groups/');

// Auth Api
$this->module("cockpit")->extend([

    "getGroups" => function() use($app) {

        $groups__all_fields = $this->app->storage->find("cockpit/groups"); // why the heck does ['fields' => ['...']] result in nothing more then the ID per row returned?!
        $groups = [];
        foreach($groups__all_fields as $i => $row) {
           $groups[] = $row['group'];
        }

        $groups = array_merge(['admin'], $groups);

        return array_unique($groups);
    }

]);

$groups_data = $app->storage->find("cockpit/groups");
foreach ($groups_data as $i => $row) {
    $isSuperAdmin = isset($row['admin']) ? $row['admin'] : false;
    $vars = isset($row['vars'])?$row['vars']:[];

    $group_name = $row['group'];

    // add the group its self
    $app('acl')->addGroup($group_name, $isSuperAdmin, $vars);

    // add the assigned acls for the group
    $acls_filtered = [
        'cockpit' => @$row['cockpit'],
        'collections' => @$row['collections'],
        'regions' => @$row['regions'],
        'forms' => @$row['forms']
    ];
    if (!$isSuperAdmin && is_array($acls_filtered)) {
        foreach (array_filter($acls_filtered) as $resource => $actions) {
            foreach ($actions as $action => $allow) {
                if ($allow) {
                    $app('acl')->allow($group_name, $resource, $action);
                }
            }
        }
    }

}

/*
// REST
if (COCKPIT_API_REQUEST) {

    // INIT REST API HANDLER
    include_once(__DIR__.'/rest-api.php');

    $this->on('cockpit.rest.init', function($routes) {
        $routes['cockpit'] = 'Cockpit\\Controller\\RestApi';
    });
}
*/

/*
if (COCKPIT_ADMIN) {

    $this->bind("/api.js", function() {

        $token                = $this->param('token', '');
        $this->response->mime = 'js';

        $apiurl = ($this->req_is('ssl') ? 'https':'http').'://';

        if (!in_array($this->registry['base_port'], ['80', '443'])) {
            $apiurl .= $this->registry['base_host'].":".$this->registry['base_port'];
        } else {
            $apiurl .= $this->registry['base_host'];
        }

        $apiurl .= $this->routeUrl('/api');

        return $this->view('cockpit:views/api.js', compact('token', 'apiurl'));
    });
}
*/

// ADMIN
if (COCKPIT_ADMIN && !COCKPIT_API_REQUEST) {

    include_once(__DIR__.'/admin.php');
}

/*
// WEBHOOKS
include_once(__DIR__.'/webhooks.php');
*/