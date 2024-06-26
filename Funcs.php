<?php
namespace WPSP;

class Funcs extends \WPSPCORE\Funcs {

	const PREFIX_ENV = 'WPSP_';

	private static ?Funcs $instance = null;

	/**
	 * Instance.
	 *
	 * @return Funcs|null
	 */

	public static function instance(): ?Funcs {
		if (!self::$instance) {
			self::$instance = new self(
				__DIR__,
				__NAMESPACE__,
				self::PREFIX_ENV
			);
		}
		return self::$instance;
	}

	/**
	 * Static functions.
	 */

	public static function asset($path, $secure = null): string {
		return self::instance()->_asset($path, $secure);
	}

	public static function view($viewName, $data = [], $mergeData = []): \Illuminate\Contracts\View\View {
		return self::instance()->_view($viewName, $data, $mergeData);
	}

	public static function trans($string, $wordpress = false) {
		return self::instance()->_trans($string, $wordpress);
	}

	public static function config($key = null, $default = null) {
		return self::instance()->_config($key, $default);
	}

	public static function notice($message = '', $type = 'info', $dismiss = true): void {
		self::instance()->_notice($message, $type, $dismiss);
	}

	/*
	 *
	 */

	public static function env($var, $addPrefix = false, $default = null): ?string {
		return self::instance()->_env($var, $addPrefix, $default);
	}

	public static function debug($message = '', $print = false, bool $varDump = false): void {
		self::instance()->_debug($message, $print, $varDump);
	}

	public static function locale(): string {
		return self::instance()->_locale();
	}

	public static function response($success = false, $data = [], $message = '', $code = 204): array {
		return self::instance()->_response($success, $data, $message, $code);
	}

}