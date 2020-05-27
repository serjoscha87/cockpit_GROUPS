# Groups Management UI Addon for Cockpit

Cockpit: https://github.com/agentejo/cockpit

**NOTE:** I've updated this addon to work with cockpit versions AFTER the big menu overhaul.
If you are running an older cockpit installation BEFORE that menu overhaul you might want to install an older version of this addon. 
You can get it here: https://github.com/serjoscha87/cockpit_GROUPS/releases/tag/v1.0
Please note that this old version won't be supplied with fixes. You are better off updating cockpit to the latest release.

**Changelog**

_27th May 2020:_ 
  - Finally fixed https://github.com/serjoscha87/cockpit_GROUPS/issues/11 (so now you are able (again) to edit group's settings/config vars)
  - ... and made some more improvements:
    - removed the "info" tile-button + page from the navigation overlay (the git info is now placed down at the end of the groups-addon page)
    - added a new information table in the creator / editor view for groups. This table described some possible config values, their default values / recommended values & a small description for some fields
    - made the layout of group-editor/creator view a bit more fluent
    - added some more text-notes for all you out there struggeling with groups & ACLs
    - removed the filter dropdown at the group overview for its not used yet
    - addon-navigation-tile highlighting now works 

_11th Sep 2019:_ 
  - Updated for the most current cockpit version **as of today** (commit cef5ee6c16d780b81ba3edc0b4a18129de3452fe)
    - added one new var ("media.path") in the group creation form
    - "Also create" ... now works again (including the password field)
    - "Also create a Collection..." got the possibility to set the new/duped collection's name 
    - Addon now integrates with the new cockpit menu

_Feb 2019:_ 
  - Now there is a "MongoDB Patch" branch (https://github.com/serjoscha87/cockpit_GROUPS/tree/mongodb-patch). Thanks to panosru.

_Sep 2018:_  
  - when configuring ACLs the groups available will be shrinked to a smaller and less space using layout  
  - added singleton to group ACL config mask  
  - Now a group password can be set due the group creation "process"
  - added some more ACLs for management of singletons
  - added shrink view of group cards for singletons and collections
  - when creating a new group now by default the group vars are set

**Screenshot**:

![Groups Management UI Addon for Cockpit](https://raw.githubusercontent.com/serjoscha87/cockpit_GROUPS/4512ca5915f28b8fc057a73b5dbc599105d81042/groups_addon.jpg)

## Installation

put the "Groups" dir of this repository to < your-docroot >/cockpit/addons/.

## Other projects according to cockpit
https://github.com/serjoscha87/cockpit_GroupBoundAssets  
https://github.com/serjoscha87/cockpit_ApiTester
