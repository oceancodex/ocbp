<?php

namespace WPSP\app\Extend\Components\AdminPages;

use Symfony\Contracts\Cache\ItemInterface;
use WPSP\app\Extend\Components\License\License;
use WPSP\app\Extend\Instances\Cache\Cache;
use WPSP\app\Extend\Instances\Cache\RateLimiter;
use WPSP\app\Models\SettingsModel;
use WPSP\app\Models\VideosModel;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseAdminPage;

class wpsp extends BaseAdminPage {

	use InstancesTrait;

	public  $menu_title                  = 'WPSP Settings';
//	public  $page_title                  = 'WPSP';
	public  $capability                  = 'edit_posts';
//	public  $menu_slug                   = 'wpsp';
	public  $icon_url                    = 'dashicons-admin-generic';
	public  $position                    = 2;
//	public  $parent_slug                 = 'options-general.php';
//	public  $callback_index              = true;
//	public  $is_submenu_page             = false;
	public  $remove_first_submenu        = true;
//	public  $urls_highlight_current_menu = null;

	private $checkDatabase               = null;
	private $table                       = null;
	private $currentTab                  = null;
	private $currentPage                 = null;

	/*
	 *
	 */

	public function customProperties(): void {
//		$this->menu_title                  = '';
//		$this->page_title                  = '';
//		$this->capability                  = '';
//		$this->menu_slug                   = '';
//		$this->icon_url                    = '';
//		$this->position                    = '';
//		$this->parent_slug                 = '';
//	    $this->callback_index              = false;
//		$this->is_submenu_page             = true;
//	    $this->remove_first_submenu        = false;
//		$this->urls_highlight_current_menu = [];

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
		try {
			if ($this->currentPage == $this->menu_slug) {
				// Check database version and maybe redirect.
				$this->checkDatabase = Funcs::instance()->_getAppMigration()->checkDatabaseVersion();
				if (empty($this->checkDatabase['result']) && $this->currentPage == $this->getMenuSlug() && $this->currentTab !== 'database') {
					$url = Funcs::instance()->_buildUrl($this->getParentSlug(), [
						'page' => $this->getMenuSlug(),
						'tab'  => 'database',
					]);
					wp_redirect($url);
				}
			}
		}
		catch (\Exception|\Throwable $e) {
			Funcs::debug($e->getMessage());
		}
	}

	public function afterLoad($adminPage): void {
		if ($this->request->get('tab') == 'table') {
			$this->table = new \WPSP\app\Extend\Components\ListTables\Settings();
		}
	}

	public function screenOptions($adminPage): void {
		if ($this->request->get('tab') == 'table') {
			parent::screenOptions($adminPage);
		}
	}

	/*
	 *
	 */

	public function index(): void {
		if ($this->request->get('updated') && $this->parent_slug !== 'options-general.php' && $this->request->get('tab') !== 'table') {
			Funcs::notice(Funcs::trans('Updated successfully', true), 'success');
		}

		try {
			$requestParams = $this->request->query->all();
			$menuSlug      = $this->getMenuSlug();
//		    $checkLicense  = License::checkLicense();

			// Test cache.
//			$cacheTest = Cache::get('cache-test', function(ItemInterface $item) {
//				$item->expiresAfter(60);
//				return 'This is a cached value';
//			});
//			echo '<pre style="z-index: 9999; position: relative; clear: both;">'; print_r($cacheTest); echo '</pre>';

			$table = $this->table;

			echo Funcs::view('modules.web.admin-pages.wpsp.main', compact(
				'requestParams',
				'menuSlug',
//			    'checkLicense',
				'table'
			))->with([
				'checkDatabase' => $this->checkDatabase,
			]);
		}
		catch (\Exception|\Throwable $e) {
			echo '<div class="wrap"><div class="notice notice-error"><p>'.$e->getMessage().'</p></div></div>';
		}
	}

	public function update(): void {
		try {
			$tab = $this->request->get('tab');
			if ($tab !== 'table') {
				$settings = $this->request->get('settings');

//			    $existSettings = Cache::getItemValue('settings');
				$existSettings = SettingsModel::query()->where('key','settings')->first();
				$existSettings = json_decode($existSettings['value'] ?? '', true);
				$existSettings = array_merge($existSettings ?? [], $settings ?? []);

				// Save settings into cache.
//			    Cache::set('settings', function() use ($existSettings) {
//			    	return $existSettings;
//			    });

				// Delete license information cache.
				Cache::delete('license_information');

				// Save settings into database.
				SettingsModel::updateOrCreate([
					'key' => 'settings',
				], [
					'value' => json_encode($existSettings),
				]);
			}
		}
		catch (\Exception|\Throwable $e) {
			Funcs::debug($e->getMessage());
		}

		wp_safe_redirect(wp_get_raw_referer() . '&updated=true');
	}

	/*
	 *
	 */

	public function styles(): void {
		wp_enqueue_style(
			Funcs::config('app.short_name') . '-admin',
			Funcs::instance()->_getPublicUrl() . '/css/admin.min.css',
			null,
			Funcs::instance()->_getVersion()
		);
		wp_enqueue_style(
			Funcs::config('app.short_name') . '-bootstrap-grid',
			Funcs::instance()->_getPublicUrl() . '/plugins/bootstrap/css/bootstrap-grid.min.css',
			null,
			Funcs::instance()->_getVersion()
		);
		wp_enqueue_style(
			Funcs::config('app.short_name') . '-bootstrap-utilities',
			Funcs::instance()->_getPublicUrl() . '/plugins/bootstrap/css/bootstrap-utilities.min.css',
			null,
			Funcs::instance()->_getVersion()
		);
	}

	public function scripts(): void {
		wp_enqueue_script(
			Funcs::config('app.short_name') . '-database',
			Funcs::instance()->_getPublicUrl() . '/js/modules/web/admin-pages/wpsp/Database.min.js',
			null,
			Funcs::instance()->_getVersion(),
			true
		);
	}

	public function localizeScripts(): void {
		wp_localize_script(
			Funcs::config('app.short_name') . '-database',
			Funcs::config('app.short_name') . '_localize',
			[
				'ajax_url'   => admin_url('admin-ajax.php'),
				'nonce'      => wp_create_nonce(Funcs::config('app.short_name')),
				'public_url' => Funcs::instance()->_getPublicUrl(),
			]
		);
	}

}