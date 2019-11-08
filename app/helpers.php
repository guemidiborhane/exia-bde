<?php
function get_gravatar( $email, $s = 48, $d = 'mp', $r = 'g', $img = false) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    return $url;
}
