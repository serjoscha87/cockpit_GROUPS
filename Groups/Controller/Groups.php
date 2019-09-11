<?php

namespace Cockpit\Controller;

class Groups extends \Cockpit\AuthController {

    public function index() {

        if (!$this->module('cockpit')->hasaccess('cockpit', 'groups')) {
            return $this->helper('admin')->denyRequest();
        }

        $current = $this->user["_id"];
        $groups = $this->module('cockpit')->getGroups();

        return $this->render('groups:views/index.php', compact('current', 'groups'));
    }

    public function info() {
        return $this->render('groups:views/info.php', ['markdown' => $this->module('cockpit')->markdown]);
    }

    public function group($gid = null) {

        if (!$gid) {
            $gid = $this->group["_id"];
        }

        if (!$this->module('cockpit')->hasaccess('cockpit', 'groups')) {
            return $this->helper('admin')->denyRequest();
        }

        $group = $this->app->storage->findOne("cockpit/groups", ["_id" => $gid]);

        if (!$group) {
            return false;
        }

        $fields = $this->app->retrieve('config/groups/fields', null);

        return $this->render('groups:views/group.php', compact('group', 'gid', 'fields'));
    }

    public function create() {

        $collections = $this->module('collections')->collections();

        // defaults for the creation of a new group
        $group = [
            'group' => '', // group name
            'password' => '',
            'vars' => [
                [
                    'key' => 'finder.path',
                    'val' => '/storage',
                    'info' => null
                ],
                [
                    'key' => 'finder.allowed_uploads',
                    'val' => '*',
                    'info' => $file_extensions_info_text = 'list of file extensions like so: >>jpg jpeg png<< (without the brackets). Using asterisk (*) enables ALL fileextensions'
                ],
                [
                    'key' => 'assets.path',
                    'val' => '/storage/assets',
                    'info' => null
                ],
                [
                    'key' => 'assets.allowed_uploads',
                    'val' => '*',
                    'info' => $file_extensions_info_text
                ],
                [
                    'key' => 'assets.max_upload_size',
                    'val' => 0,
                    'info' => 'Maximum size for the file in BYTES (0 = no limit)'
                ],
                [
                    'key' => 'media.path',
                    'val' => '/storage/media',
                    'info' => null
                ]
            ],
            'admin' => false,
            'cockpit' => [
                'finder' => true,
                'rest' => true,
                'backend' => true
            ]
        ];

        return $this->render('groups:views/group.php', compact('group', 'collections'));
    }

    public function save() {

        if ($data = $this->param("group", false)) {

            $data["_modified"] = time();

            if (!isset($data['_id'])) {
                $data["_created"] = $data["_modified"];
            }

            $this->app->storage->save("cockpit/groups", $data);

            return json_encode($data);
        }

        return false;
    }

    public function remove() {

        if ($data = $this->param("group", false)) {

            // can't delete own group
            if ($data["_id"] != $this->user["_id"]) {

                $this->app->storage->remove("cockpit/groups", ["_id" => $data["_id"]]);

                return '{"success":true}';
            }
        }

        return false;
    }

    public function find() {

        $options = $this->param('options', []);

        $groups = $this->storage->find("cockpit/groups", $options)->toArray(); // get groups from db
        $count = (!isset($options['skip']) && !isset($options['limit'])) ? count($groups) : $this->storage->count("cockpit/groups", isset($options['filter']) ? $options['filter'] : []);
        $pages = isset($options['limit']) ? ceil($count / $options['limit']) : 1;
        $page = 1;

        if ($pages > 1 && isset($options['skip'])) {
            $page = ceil($options['skip'] / $options['limit']) + 1;
        }

        return compact('groups', 'count', 'pages', 'page');
    }

}
