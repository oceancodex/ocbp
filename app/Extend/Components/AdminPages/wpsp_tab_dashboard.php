<?php

namespace WPSP\app\Extend\Components\AdminPages;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseAdminPage;

class wpsp_tab_dashboard extends BaseAdminPage {

	use InstancesTrait;

	public mixed $menu_title            = 'Tab: Dashboard';
//	public mixed $page_title            = 'Tab: Dashboard';
	public mixed $capability            = 'manage_options';
//	public mixed $menu_slug             = 'wpsp-dashboard';
	public mixed $icon_url              = 'dashicons-admin-generic';
//	public mixed $position              = 1;
	public mixed $isSubAdminPage        = true;
	public mixed $parent_slug           = 'wpsp';
//	public mixed $removeFirstSubmenu    = false;

//	private mixed $checkDatabase        = null;
	private mixed $table                = null;
	private mixed $currentTab           = null;
	private mixed $currentPage          = null;

	/*
	 *
	 */

	public function customProperties(): void {
//		$this->menu_title     = '';
//		$this->page_title     = '';
//		$this->capability     = '';
//		$this->menu_slug      = '';
//		$this->icon_url       = '';
//		$this->position       = '';
//		$this->isSubAdminPage = false;
//		$this->parent_slug    = '';

		$this->currentTab   = $this->request->get('tab');
		$this->currentPage  = $this->request->get('page');
		$this->page_title   = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.dashboard')) . ' - ' . Funcs::config('app.name');
	}

	/*
	 *
	 */

//	public function init($path = null): void {
//		// You must call to parent method "init" if you want to custom it.
//		parent::init();
//	}

	public function beforeInit(): void {}

	public function afterInit(): void {
//		if ($this->currentPage == $this->menu_slug) {
//			// Check database version and maybe redirect.
//			$this->checkDatabase = Funcs::instance()->_getAppMigration()->checkDatabaseVersion();
//			if (!$this->checkDatabase['result'] && $this->currentPage == $this->getMenuSlug() && $this->currentTab !== 'database') {
//				$url = Funcs::instance()->_buildUrl($this->getParentSlug(), [
//					'page' => $this->getMenuSlug(),
//					'tab'  => 'database',
//				]);
//				wp_redirect($url);
//			}
//		}
	}

	public function afterLoad($adminPage): void {
//		if ($this->request->get('tab') == 'table') {
//			$this->table = new \WPSP\app\Extend\Components\ListTables\Settings();
//		}
	}

//	public function screenOptions($adminPage): void {
//		if ($this->request->get('tab') == 'table') {
//			parent::screenOptions($adminPage);
//		}
//	}

	/*
	 *
	 */

	public function index(): void {
		echo '123';
//		if ($this->request->get('updated') && $this->parent_slug !== 'options-general.php' && $this->request->get('tab') !== 'table') {
//			Funcs::notice(Funcs::trans('Updated successfully', true), 'success');
//		}
//
//		$requestParams = $this->request->query->all();
//		$menuSlug      = $this->getMenuSlug();
//
//		$table = $this->table;
//
//		echo '<div class="wrap"><h1>Admin page: "wpsp_dashboard"</h1></div>';
	}

	public function update(): void {
//		$tab = $this->request->get('tab');
//		if ($tab !== 'table') {
//			$settings = $this->request->get('settings');
//
////			$existSettings = Cache::getItemValue('settings');
//			$existSettings = SettingsModel::query()->where('key','settings')->first();
//			$existSettings = json_decode($existSettings['value'] ?? '', true);
//			$existSettings = array_merge($existSettings ?? [], $settings ?? []);
//
//			// Save settings into cache.
////			Cache::set('settings', function() use ($existSettings) {
////				return $existSettings;
////			});
//
//			// Delete license information cache.
//			Cache::delete('license_information');
//
//			// Save settings into database.
//			SettingsModel::updateOrCreate([
//				'key' => 'settings',
//			], [
//				'value' => json_encode($existSettings),
//			]);
//
//			wp_safe_redirect(wp_get_raw_referer() . '&updated=true');
//		}
	}

	/*
	 *
	 */

	public function styles(): void {
//		wp_enqueue_style(
//			Funcs::config('app.short_name') . '-admin',
//			Funcs::instance()->_getPublicUrl() . '/css/admin.min.css',
//			null,
//			Funcs::instance()->_getVersion()
//		);
	}

	public function scripts(): void {
//		wp_enqueue_script(
//			Funcs::config('app.short_name') . '-database',
//			Funcs::instance()->_getPublicUrl() . '/js/modules/web/admin-pages/wpsp/Database.min.js',
//			null,
//			Funcs::instance()->_getVersion(),
//			true
//		);
	}

	public function localizeScripts(): void {
//		wp_localize_script(
//			Funcs::config('app.short_name') . '-database',
//			Funcs::config('app.short_name') . '_localize',
//			[
//				'ajax_url'   => admin_url('admin-ajax.php'),
//				'nonce'      => wp_create_nonce(Funcs::config('app.short_name')),
//				'public_url' => Funcs::instance()->_getPublicUrl(),
//			]
//		);
	}

}