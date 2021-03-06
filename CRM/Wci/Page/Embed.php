<?php
/*
 +--------------------------------------------------------------------+
 | CiviCRM Widget Creation Interface (WCI) Version 1.0                |
 +--------------------------------------------------------------------+
 | Copyright Zyxware Technologies (c) 2014                            |
 | Copyright (C) 2014 David Thompson <davet@gnu.org>                  |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM WCI.                                |
 |                                                                    |
 | CiviCRM WCI is free software; you can copy, modify, and distribute |
 | it under the terms of the GNU Affero General Public License        |
 | Version 3, 19 November 2007.                                       |
 |                                                                    |
 | CiviCRM WCI is distributed in the hope that it will be useful,     |
 | but WITHOUT ANY WARRANTY; without even the implied warranty of     |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License along with this program; if not, contact Zyxware           |
 | Technologies at info[AT]zyxware[DOT]com.                           |
 +--------------------------------------------------------------------+
*/

require_once 'CRM/Core/Page.php';

class CRM_Wci_Page_Embed extends CRM_Core_Page {
  function run() {
    $license_text = '
/**
 * @licstart The following is the entire license notice for the
 *   JavaScript code in this page.
 *
 * Copyright (C) 2014 Zyxware Technologies.
 *
 * This JavaScript is part of the CiviCRM WCI extension for
 * CiviCRM. This JavaScript is free software: you can
 * redistribute it and/or modify it under the terms of the GNU
 * Affero General Public License as published by the Free
 * Software Foundation, either version 3 of the License, or (at
 * your option) any later version.
 *
 * The code is distributed WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE.  See the GNU Affero General Public License
 * for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this program.  If not, see
 * <http://www.gnu.org/licenses/>.
 *
 * @licend The above is the entire license notice for the
 *   JavaScript code in this page
 */
';

    $wciembed_js = '
// Cleanup functions for the document ready method
if ( document.addEventListener ) {
    DOMContentLoaded = function() {
        document.removeEventListener( "DOMContentLoaded", DOMContentLoaded, false );
        onReady();
    };
} else if ( document.attachEvent ) {
    DOMContentLoaded = function() {
        // Make sure body exists, at least, in case IE gets a little overzealous
        if ( document.readyState === "complete" ) {
            document.detachEvent( "onreadystatechange", DOMContentLoaded );
            onReady();
        }
    };
}
if ( document.readyState === "complete" ) {
    // Handle it asynchronously to allow scripts the opportunity to delay ready
    setTimeout( onReady, 1 );
}

// Mozilla, Opera and webkit support this event
if ( document.addEventListener ) {
    // Use the handy event callback
    document.addEventListener( "DOMContentLoaded", DOMContentLoaded, false );
    // A fallback to window.onload, that will always work
    window.addEventListener( "load", onReady, false );
    // If IE event model is used
} else if ( document.attachEvent ) {
    // ensure firing before onload,
    // maybe late but safe also for iframes
    document.attachEvent("onreadystatechange", DOMContentLoaded);

    // A fallback to window.onload, that will always work
    window.attachEvent( "onload", onReady );
}

function onReady( ) {
  document.getElementById("widgetwci").innerHTML = wciwidgetcode;
}';

    $config = CRM_Core_Config::singleton();

    $embedId = CRM_Utils_Request::retrieve('id', 'Positive', CRM_Core_DAO::$_nullObject);
    $preview = CRM_Utils_Request::retrieve('preview', 'Positive', CRM_Core_DAO::$_nullObject);

    $output  = $license_text;
    $output .= 'var wciwidgetcode =  ' . CRM_Wci_WidgetCode::get_widget_code($embedId, $preview) . ';';
    $output .= $wciembed_js;

    header('Content-Type: text/javascript');
    echo $output;
    CRM_Utils_System::civiExit();
  }
}
