<?php 
namespace Hartviglarsen\Todo;

use Backend;
use System\Classes\PluginBase;

/**
 * Todo Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     * @access public
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Todo',
            'description' => 'Just a simple todo widget',
            'author'      => 'Hartviglarsen',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register report widgets
     * 
     * @return array
     * @access public
     */
    public function registerReportWidgets()
    {
        return [
            'Hartviglarsen\Todo\ReportWidgets\Todo' => [
                'label' => 'Todo',
                'context' => 'dashboard'
            ]
        ];
    }
}
