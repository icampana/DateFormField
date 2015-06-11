<?php
/**
 * @package   ImpressPages
 */

namespace Plugin\DateFormField;


class Event
{
    public static function ipBeforeController()
    {
        if (ipIsManagementState()) {
            //just add js and css
            ipAddJs('assets/initDateField.js');
            ipAddCss('Ip/Internal/Core/assets/js/jquery-ui/jquery-ui.css');
        }
    }
}
