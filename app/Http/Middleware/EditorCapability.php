<?php

namespace WPSP\app\Http\Middleware;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseMiddleware;
use Symfony\Component\HttpFoundation\Request;
use WP_REST_Request;

class EditorCapability extends BaseMiddleware {

	use InstancesTrait;

	/**
	 * @param Request|WP_REST_Request $request
	 *
	 * @return bool
	 */
	public function handle($request): bool {
		return current_user_can('editor');
	}

}
