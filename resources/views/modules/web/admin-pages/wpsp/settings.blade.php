@extends('modules.web.admin-pages.layout')

@section('title')
    {{ wpsp_trans('messages.settings') }}
@endsection

@section('content')
    <form method="POST">
        <input name="action" value="save_settings" type="hidden"/>
        <div id="poststuff" class="row gx-2">
            <div class="col">
                <div class="meta-box-sortables ui-sortable">
                    <div class="postbox">

                        <div class="postbox-header">
                            <h2 class="hndle ui-sortable-handle">{{ wpsp_trans('messages.settings') }}</h2>
                            <div class="handle-actions">
                                <button type="button" class="handlediv" aria-expanded="true">
                                    <span class="toggle-indicator"></span>
                                </button>
                            </div>
                        </div>

                        <div class="inside form-table w-auto">

                            <div class="input-group mt-2 mb-3">
                                <label for="wpsp_settings[setting_1]">
                                    {{ wpsp_trans('messages.title') }}:
                                    <input type="text" id="wpsp_settings[setting_1]" name="wpsp_settings[setting_1]" class="w-100 mt-2" value="{{ $settings['setting_1'] ?? '' }}"/>
                                </label>
                            </div>

                            <div class="input-group">
                                <label for="wpsp_settings[setting_2]">
                                    {{ wpsp_trans('messages.title') }}:
                                    <input type="text" id="wpsp_settings[setting_2]" name="wpsp_settings[setting_2]" class="w-100 mt-2" value="{{ $settings['setting_2'] ?? '' }}"/>
                                </label>
                            </div>

                        </div>

                    </div>
                    <button type="submit" class="button button-primary">{{ wpsp_trans('messages.save_changes') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection