<?php

elgg_register_simplecache_view('css/roles/ui');
elgg_register_css('roles.ui.css', elgg_get_simplecache_url('css', 'roles/ui'));

elgg_register_simplecache_view('js/roles/ui');
elgg_register_js('roles.ui.js', elgg_get_simplecache_url('js', 'roles/ui'));