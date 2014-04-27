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

* Once enabled, configuration arrays for roles (defined in other plugins) will
be completely ignored.
* The plugin uses autocomplete inputs, which accept custom values. This allows
to define custom rules for items that could not be identified from configured
hook and event handlers
* Due to the complexity of the Elgg menu API, not all menu items will be
available in the autocomplete. Feel free to add custom values
* Extend rules for menus can not be configured using this plugin


## Installing with Composer

roles_ui can be included in your Elgg project by require from the project's
root composer.json.

Support for composer in Elgg is an experimental feature pioneered by [@Srokap](https://github.com/Srokap/ "Paweł Sroka").

Provisional config to include roles_ui into your project:
```json
{
	"require": {
		"hypejunction/roles-ui" : "@stable"
	}
}
```
## Screenshots ##

![alt text](https://raw.github.com/hypeJunction/roles_ui/master/screenshots/roles_ui.png "Admin Interface")
![alt text](https://raw.github.com/hypeJunction/roles_ui/master/screenshots/user_hover.png "User Hover Menu Popup")