<?php
namespace WPSP\routes;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseRoute;
use WPSP\app\Http\Controllers\AjaxController;
use WPSPCORE\Traits\AjaxRouteTrait;

class AjaxRoute extends BaseRoute {

	use AjaxRouteTrait, InstancesTrait;

	/*
	 *
	 */

	public function __construct() {
		$this->mainPath      = Funcs::instance()->_getMainPath();
		$this->rootNamespace = Funcs::instance()->_getRootNamespace();
		$this->prefixEnv     = Funcs::instance()->_getPrefixEnv();
		parent::__construct();
	}

	/*
	 *
	 */

	public function apis(): void {
		$this->post('wpsp_handle_database', [AjaxController::class, 'handleDatabase'], false, true, null, [
//			[AdministratorCapability::class, 'handle'],
//			[FrontendMiddleware::class, 'handle']
		]);

		$this->get('demo_ajax_get', [AjaxController::class, 'demoAjaxGet'], false, true, null, [
//			[AdministratorCapability::class, 'handle']
		]);
	}

}