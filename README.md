# Groups Management UI Addon for Cockpit

Cockpit: https://github.com/agentejo/cockpit

**Changelog**

_Feb 2019:_ 
  - Now there is a "MongoDB Patch" branch (https://github.com/serjoscha87/cockpit_GROUPS/tree/mongodb-patch). Thanks to panosru.

_Sep 2018:_  
  - when configuring ACLs the groups available will be shrinked to a smaller and less space using layout  
  - added singleton to group ACL config mask  
  - Now a group password can be set due the group creation "process"
  - added some more ACLs for management of singletons
  - added shrink view of group cards for singletons and collections
  - when creating a new group now by default the group vars are set

**Screenshot** (a bit outdated):

![Groups Management UI Addon for Cockpit](https://raw.githubusercontent.com/serjoscha87/cockpit_GROUPS/7d6c2f807602186f785ffdb7b064fce62dbffc06/cockpit_groups.jpg)

## Installation

put the "Groups" dir of this repository to < your-docroot >/cockpit/addons/.

## Other projects according to cockpit
https://github.com/serjoscha87/cockpit_GroupBoundAssets  
https://github.com/serjoscha87/cockpit_ApiTester
