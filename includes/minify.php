<?php
function sanitize_output($buffer) {

    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/(\s)+/s',         // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );

    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}
ob_start("sanitize_output");

function clearBrowserCache() { 
    header("Pragma: no-cache"); 
    header("Cache: no-cache"); 
    header("Cache-Control: no-cache, must-revalidate"); 
    header("Expires: Mon, 9 Jul 1995 05:00:00 GMT"); 
} 
clearstatcache();
clearBrowserCache();