<?php

namespace WPSP\app\Extend\Components\Templates;

use WPSPCORE\Base\BaseTemplates;

class wpsp_bigger_content_font_size extends BaseTemplates {

	public mixed $templateLabel         = 'Custom page template: wpsp-bigger-content-font-size';
//	public mixed $templatePath          = null;

	public function customProperties(): void {
//		$this->templatePath = Constants::getResourcesPath(). '/views/modules/web/templates/' . $this->templateName . '.blade.php';
	}

}