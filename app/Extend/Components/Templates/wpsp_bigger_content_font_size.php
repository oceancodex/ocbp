<?php

namespace WPSP\app\Extend\Components\Templates;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseTemplates;

class wpsp_bigger_content_font_size extends BaseTemplates {

	use InstancesTrait;

	public $label = 'Custom page template: wpsp-bigger-content-font-size';
//	public $path  = null;

	public function customProperties(): void {
//		$this->path = Constants::getResourcesPath(). '/views/modules/web/templates/' . $this->name . '.blade.php';
	}

}