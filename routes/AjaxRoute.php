<?php
namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSP\app\Http\Controllers\AjaxController;
use WPSPCORE\Traits\AjaxRouteTrait;

class AjaxRoute extends BaseRoute {

	use AjaxRouteTrait;

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