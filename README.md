Roles UI
========

Admin interface for managing roles. This is an add-on for ArckInteractive's
Roles framework: https://github.com/arckinteractive/Roles


## Features

* User-friendly interface for creating roles and managing role permissions
* Autocomplete inputs for registered actions, events, hooks, menus and views
* For you reference, the configuration array for each role is displayed on the
permissions - you can copy paste those into another roles config hook


## Notes

* The plugin uses autocomplete inputs, which accept custom values. This allows
to define custom rules for items that could not be identified from configured
hook and event handlers
* Due to the complexity of the Elgg menu API, not all menu items will be
available in the autocomplete. Feel free to add custom values
* Extend rules for menus can not be configured using this plugin