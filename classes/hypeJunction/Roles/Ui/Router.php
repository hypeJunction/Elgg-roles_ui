<?php

namespace hypeJunction\Roles\Ui;

use ElggRole;

class Router {

	/**
	 * Set entity URL
	 *
	 * @param string $hook "entity:url"
	 * @param string $type "object"
	 * @param string $return URL
	 * @param array $params Hook params
	 * @return array
	 */
	public static function setURL($hook, $type, $return, $params) {

		$entity = elgg_extract('entity', $params);
		if (!$entity instanceof ElggRole) {
			return;
		}

		return elgg_normalize_url("admin/roles/permissions?role=$entity->name");
	}
}