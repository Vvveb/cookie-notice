<?php

/**
 * Vvveb
 *
 * Copyright (C) 2023  Ziadin Givan
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
*/

/*
Name: Cookie Notice
Slug: cookie-notice
Category: content
Url: https://www.vvveb.com
Description: Show cookie notice for visitors
Author: givanz
Version: 0.1
Thumb: cookie-notice.svg
Author url: https://www.vvveb.com
Settings: /admin/index.php?module=editor/editor&url=/plugins/cookie-notice/notice.html&template=/plugins/cookie-notice/notice.html
*/

use function Vvveb\__;
use Vvveb\System\Core\View;
use Vvveb\System\Event;
use function Vvveb\url;

if (! defined('V_VERSION')) {
	die('Invalid request!');
}

class CookieNoticePlugin {
	function admin() {
		//add admin menu item
		$admin_path = \Vvveb\adminPath();
		$publicPath = \Vvveb\publicUrlPath();
		$url        = url(['module' => 'editor/editor', 'url' => $publicPath . '/plugins/cookie-notice/notice.html', 'template' => '/plugins/cookie-notice/notice.html']);

		Event::on('Vvveb\Controller\Base', 'init-menu', __CLASS__, function ($menu) use ($admin_path, $url) {
			$menu['plugins']['items']['cookie-notice'] = [
				'name'     => __('Cookie notice'),
				'url'      => $url,
				'icon-img' => PUBLIC_PATH . 'plugins/cookie-notice/cookie-notice.svg',
			];

			return [$menu];
		});
	}

	function app() {
		$view     = View::getInstance();
		$template = $view->getTemplateEngineInstance();
		$template->loadTemplateFile(__DIR__ . '/app/template/common.tpl');
	}

	function __construct() {
		//don't show the notice in editor
		if (Vvveb\isEditor()) {
			return;
		}

		if (APP == 'admin') {
			$this->admin();
		} else {
			if (APP == 'app') {
				$this->app();
			}
		}
	}
}

$cookieNoticePlugin = new CookieNoticePlugin();
