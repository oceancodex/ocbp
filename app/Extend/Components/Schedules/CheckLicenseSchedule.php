<?php

namespace WPSP\app\Extend\Components\Schedules;

use WPSP\app\Extend\Components\License\License;
use WPSP\app\Extend\Instances\Cache\Cache;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseSchedule;

class CheckLicenseSchedule extends BaseSchedule {

	use InstancesTrait;

	public function init(): void {
		$appShortName  = Funcs::config('app.short_name');
		$settings      = Cache::getItemValue($appShortName . '_settings');
		$checkLicense  = License::checkLicense($settings['license_key'] ?? null, true);
	}

}