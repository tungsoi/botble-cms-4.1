<?php

use Botble\Base\Facades\DashboardMenuFacade;
use Botble\Base\Facades\PageTitleFacade;
use Botble\Base\Supports\Editor;
use Botble\Base\Supports\PageTitle;
use Illuminate\Support\Facades\DB;

if (!function_exists('table_actions')) {
    /**
     * @param $edit
     * @param $delete
     * @param $item
     * @param string $extra
     * @return string
     * @throws Throwable
     */
    function table_actions($edit, $delete, $item, $extra = null): string
    {
        return view('core/base::elements.tables.actions', compact('edit', 'delete', 'item', 'extra'))->render();
    }
}

if (!function_exists('anchor_link')) {
    /**
     * @param $link
     * @param $name
     * @param array $options
     * @return string
     *
     * @throws Throwable
     */
    function anchor_link($link, $name, array $options = []): string
    {
        $options = Html::attributes($options);
        return view('core/base::elements.tables.link', compact('link', 'name', 'options'))->render();
    }
}

if (!function_exists('table_checkbox')) {
    /**
     * @param $id
     * @return string
     *
     * @throws Throwable
     */
    function table_checkbox($id): string
    {
        return view('core/base::elements.tables.checkbox', compact('id'))->render();
    }
}

if (!function_exists('check_database_connection')) {
    /**
     * @return boolean
     */
    function check_database_connection(): bool
    {
        try {
            DB::connection(config('database.default'))->reconnect();
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}

if (!function_exists('language_flag')) {
    /**
     * @param $flag
     * @param $name
     *
     * @return string
     */
    function language_flag($flag, $name = null): string
    {
        return Html::image(url(BASE_LANGUAGE_FLAG_PATH . $flag . '.png'), $name, ['title' => $name]);
    }
}

if (!function_exists('render_editor')) {
    /**
     * @param $name
     * @param null $value
     * @param bool $withShortCode
     * @param array $attributes
     * @return string
     *
     * @throws Throwable
     */
    function render_editor($name, $value = null, $withShortCode = false, array $attributes = []): string
    {
        $editor = new Editor;

        return $editor->render($name, $value, $withShortCode, $attributes);
    }
}

if (!function_exists('is_in_admin')) {
    /**
     * @return bool
     */
    function is_in_admin(): bool
    {
        $isInAdmin = request()->segment(1) === config('core.base.general.admin_dir');

        return apply_filters(IS_IN_ADMIN_FILTER, $isInAdmin);
    }
}

if (!function_exists('page_title')) {
    /**
     * @return PageTitle
     */
    function page_title()
    {
        return PageTitleFacade::getFacadeRoot();
    }
}

if (!function_exists('dashboard_menu')) {
    /**
     * @return \Botble\Base\Supports\DashboardMenu
     */
    function dashboard_menu()
    {
        return DashboardMenuFacade::getFacadeRoot();
    }
}

if (!function_exists('html_attribute_element')) {
    /**
     * @param $key
     * @param $value
     * @return string
     */
    function html_attribute_element($key, $value)
    {
        if (is_numeric($key)) {
            return $value;
        }

        // Treat boolean attributes as HTML properties
        if (is_bool($value) && $key != 'value') {
            return $value ? $key : '';
        }

        if (!empty($value)) {
            return $key . '="' . e($value) . '"';
        }

        return '';
    }
}

if (!function_exists('html_attributes_builder')) {
    /**
     * @param array $attributes
     * @return string
     */
    function html_attributes_builder(array $attributes): string
    {
        $html = [];

        foreach ((array)$attributes as $key => $value) {
            $element = html_attribute_element($key, $value);

            if (!empty($element)) {
                $html[] = $element;
            }
        }

        return count($html) > 0 ? ' ' . implode(' ', $html) : '';
    }
}

if (!function_exists('get_cms_version')) {
    /**
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    function get_cms_version(): string
    {
        try {
            return trim(get_file_data(core_path('/VERSION'), false));
        } catch (Exception $exception) {
            return '3.7';
        }
    }
}

if (!function_exists('platform_path')) {
    /**
     * @return string
     */
    function platform_path($path = null): string
    {
        return base_path('platform/' . $path);
    }
}

if (!function_exists('core_path')) {
    /**
     * @return string
     */
    function core_path($path = null): string
    {
        return platform_path('core/' . $path);
    }
}

if (!function_exists('package_path')) {
    /**
     * @return string
     */
    function package_path($path = null): string
    {
        return platform_path('packages/' . $path);
    }
}
