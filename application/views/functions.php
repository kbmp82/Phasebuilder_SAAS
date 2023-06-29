<?php

//write to console function for Chrome
function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>alert( 'Debug Objects: " . $output . "' );</script>";
}

//proxy switch

function change_proxy(){

$proxies = array(); // Declaring an array to store the proxy list

$user_agents = array(); //declaring an array to store user agents

$proxy_details = array();

//adding user agents

$user_agents [] = 'Chrome 10.0.613.0 (64 bit) useragent=Mozilla/5.0 (X11; U; Linux x86_64; en-US) AppleWebKit/534.15 (KHTML, like Gecko) Chrome/10.0.613.0 Safari/534.15';

$user_agents [] = 'Chrome 10.0.613.0 (Ubuntu 32 bit) useragent=Mozilla/5.0 (X11; U; Linux i686; en-US) AppleWebKit/534.15 (KHTML, like Gecko) Ubuntu/10.10 Chromium/10.0.613.0 Chrome/10.0.613.0 Safari/534.15';

$user_agents [] = 'Chrome 12.0.703.0 (Ubuntu 64 bit) useragent=Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.24 (KHTML, like Gecko) Ubuntu/10.10 Chromium/12.0.703.0 Chrome/12.0.703.0 Safari/534.24';

$user_agents [] = 'Chrome 13.0.782.20 (64 bit) useragent=Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/13.0.782.20 Safari/535.1';

$user_agents [] = 'Chrome 13.0.782.41 (Slackware 13.37 64 bit) useragent=Mozilla/5.0 Slackware/13.37 (X11; U; Linux x86_64; en-US) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/13.0.782.41';

$user_agents [] = 'Chrome 14.0.825.0 (Ubuntu 11.04) useragent=Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.1 (KHTML, like Gecko) Ubuntu/11.04 Chromium/14.0.825.0 Chrome/14.0.825.0 Safari/535.1';

$user_agents [] = 'Chrome 15.0.874.120 (Ubuntu 11.10) useragent=Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.2 (KHTML, like Gecko) Ubuntu/11.10 Chromium/15.0.874.120 Chrome/15.0.874.120 Safari/535.2';

$user_agents [] = 'Chrome 19.0.1084.9 (64 bit) useragent=Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.9 Safari/536.5';

$user_agents [] = 'Chrome 20.0.1132.57 (CrOS) useragent=Mozilla/5.0 (X11; CrOS i686 2268.111.0) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.57 Safari/536.11';

$user_agents [] = 'Chrome 22.0.1229.56 (64 bit) useragent=Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.4 (KHTML like Gecko) Chrome/22.0.1229.56 Safari/537.4';

$user_agents [] = 'Chrome 28.0.1478.0 (32 bit) useragent=Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1478.0 Safari/537.36';

$user_agents [] = 'Chrome 36.0.1985.138 (CrOS) useragent=Mozilla/5.0 (X11; CrOS x86_64 5841.83.0) AppleWebKit/537.36 (KHTML like Gecko) Chrome/36.0.1985.138 Safari/537.36';

$user_agents [] = 'Chrome 4.0.237.0 (Debian) useragent=Mozilla/5.0 (X11; U; Linux i686; en-US) AppleWebKit/532.4 (KHTML, like Gecko) Chrome/4.0.237.0 Safari/532.4 Debian';

$user_agents [] = 'Chrome 4.0.277.0 useragent=Mozilla/5.0 (X11; U; Linux i686; en-US) AppleWebKit/532.8 (KHTML, like Gecko) Chrome/4.0.277.0 Safari/532.8';

$user_agents [] = 'Chrome 5.0.309.0 useragent=Mozilla/5.0 (X11; U; Linux x86_64; en-US) AppleWebKit/532.9 (KHTML, like Gecko) Chrome/5.0.309.0 Safari/532.9';

$user_agents [] = 'Chrome 7.0.514 (64 bit) useragent=Mozilla/5.0 (X11; U; Linux x86_64; en-US) AppleWebKit/534.7 (KHTML, like Gecko) Chrome/7.0.514.0 Safari/534.7';

$user_agents [] = 'Chrome 9.1.0.0 (Ubuntu 64 bit) useragent=Mozilla/5.0 (X11; U; Linux x86_64; en-US) AppleWebKit/540.0 (KHTML, like Gecko) Ubuntu/10.10 Chrome/9.1.0.0 Safari/540.0';

$user_agents [] = 'Firefox 0.8 useragent=Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.6) Gecko/20040614 Firefox/0.8';

$user_agents [] = 'Firefox 10.0.1 (64 bit) useragent=Mozilla/5.0 (X11; Linux x86_64; rv:10.0.1) Gecko/20100101 Firefox/10.0.1';

$user_agents [] = 'Firefox 11.0 (32 bit) useragent=Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1.16) Gecko/20120421 Gecko Firefox/11.0';

$user_agents [] = 'Firefox 12.0 (32 bit) useragent=Mozilla/5.0 (X11; Linux i686; rv:12.0) Gecko/20100101 Firefox/12.0';

$user_agents [] = 'Firefox 14.0.1 (Ubuntu 64 bit) useragent=Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:14.0) Gecko/20100101 Firefox/14.0.1';

$user_agents [] = 'Firefox 16.0 (32 bit) useragent=Mozilla/5.0 (X11; Linux i686; rv:16.0) Gecko/20100101 Firefox/16.0';

$user_agents [] = 'Firefox 19.0 (Slackware 13 32 bit) useragent=Mozilla/5.0 (X11; U; Linux i686; rv:19.0) Gecko/20100101 Slackware/13 Firefox/19.0';

$user_agents [] = 'Firefox 2.0.0.12 (Ubuntu 7.10) useragent=Mozilla/5.0 (X11; U; Linux x86_64; sv-SE; rv:1.8.1.12) Gecko/20080207 Ubuntu/7.10 (gutsy) Firefox/2.0.0.12';

$user_agents [] = 'Firefox 20.0 (32 bit) useragent=Mozilla/5.0 (X11; Linux i686; rv:20.0) Gecko/20100101 Firefox/20.0';

$user_agents [] = 'Firefox 20.0 (Ubuntu 64 bit) useragent=Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:20.0) Gecko/20100101 Firefox/20.0';

$user_agents [] = 'Firefox 25.0 (32 bit) useragent=Mozilla/5.0 (X11; Linux i686; rv:25.0) Gecko/20100101 Firefox/25.0';

$user_agents [] = 'Firefox 28.0 (32 bit) useragent=Mozilla/5.0 (X11; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0';

$user_agents [] = 'Firefox 3.0.12 - (Ubuntu karmic 9.10) useragent=Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.0.11) Gecko/2009060309 Ubuntu/9.10 (karmic) Firefox/3.0.11';

$user_agents [] = 'Firefox 3.5.2 - Shiretoko (Ubuntu 9.04) useragent=Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1.2) Gecko/20090803 Ubuntu/9.04 (jaunty) Shiretoko/3.5.2';

$user_agents [] = 'Firefox 3.5.3 (Mint 8) useragent=Mozilla/5.0 (X11; U; Linux x86_64; en-US; rv:1.9.1.3) Gecko/20091020 Linux Mint/8 (Helena) Firefox/3.5.3';

$user_agents [] = 'Firefox 3.5.5 useragent=Mozilla/5.0 (X11; U; Linux x86_64; en-US; rv:1.9.1.5) Gecko/20091107 Firefox/3.5.5';

$user_agents [] = 'Firefox 3.6.9 (Gentoo 64 bit) useragent=Mozilla/5.0 (X11; U; Linux x86_64; en-US; rv:1.9.2.9) Gecko/20100915 Gentoo Firefox/3.6.9';

$user_agents [] = 'Firefox 3.8 (Ubuntu/9.25) useragent=Mozilla/5.0 (X11; U; Linux i686; pl-PL; rv:1.9.0.2) Gecko/20121223 Ubuntu/9.25 (jaunty) Firefox/3.8';

$user_agents [] = 'Firefox 32.0 (32 bit) useragent=Mozilla/5.0 (X11; Linux i686; rv:32.0) Gecko/20100101 Firefox/32.0';

$user_agents [] = 'Firefox 35.0 (Ubuntu 64 bit) useragent=Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:35.0) Gecko/20100101 Firefox/35.0';

$user_agents [] = 'Firefox 4.0.1 (32 bit) useragent=Mozilla/5.0 (X11; Linux i686; rv:2.0.1) Gecko/20100101 Firefox/4.0.1';

$user_agents [] = 'Firefox 4.0.1 (32 on 64 bit) useragent=Mozilla/5.0 (X11; Linux i686 on x86_64; rv:2.0.1) Gecko/20100101 Firefox/4.0.1';

$user_agents [] = 'Firefox 4.0.1 (64 bit) useragent=Mozilla/5.0 (X11; Linux x86_64; rv:2.0.1) Gecko/20100101 Firefox/4.0.1';

$user_agents [] = 'Firefox 4.0b6pre (32 bit) useragent=Mozilla/5.0 (X11; Linux i686; rv:2.0b6pre) Gecko/20100907 Firefox/4.0b6pre';

$user_agents [] = 'Firefox 4.2a1pre (64 bit) useragent=Mozilla/5.0 (X11; Linux x86_64; rv:2.2a1pre) Gecko/20100101 Firefox/4.2a1pre';

$user_agents [] = 'Firefox 5.0 (32 bit) useragent=Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0';

$user_agents [] = 'Firefox 6.0 (32 bit) useragent=Mozilla/5.0 (X11; Linux i686; rv:6.0) Gecko/20100101 Firefox/6.0';

$user_agents [] = 'Firefox 7.0a1 (64 bit) useragent=Mozilla/5.0 (X11; Linux x86_64; rv:7.0a1) Gecko/20110623 Firefox/7.0a1';

$user_agents [] = 'Firefox 8.0 (32 bit) useragent=Mozilla/5.0 (X11; Linux i686; rv:8.0) Gecko/20100101 Firefox/8.0';

$user_agents [] = 'Chrome 14.0.835.186 (OS X 10_7_2 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.186 Safari/535.1';

$user_agents [] = 'Chrome 15.0.874.54 (OS X 10_6_8 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/535.2 (KHTML, like Gecko) Chrome/15.0.874.54 Safari/535.2';

$user_agents [] = 'Chrome 16.0.912.36 (OS X 10_6_8 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.36 Safari/535.7';

$user_agents [] = 'Chrome 19.0.1063.0 (OS X 10_8_0 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_0) AppleWebKit/536.3 (KHTML, like Gecko) Chrome/19.0.1063.0 Safari/536.3';

$user_agents [] = 'Chrome 22.0.1229.79 (OS X 10_8_2 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/537.4 (KHTML like Gecko) Chrome/22.0.1229.79 Safari/537.4';

$user_agents [] = 'Chrome 26.0.1410.63 (OS X 10_8_4 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.31 (KHTML like Gecko) Chrome/26.0.1410.63 Safari/537.31';

$user_agents [] = 'Chrome 28.0.1469.0 (OS X 10_8_3 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 1083) AppleWebKit/537.36 (KHTML like Gecko) Chrome/28.0.1469.0 Safari/537.36';

$user_agents [] = 'Chrome 32.0.1664.3 (OS X 10_9_0 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1664.3 Safari/537.36';

$user_agents [] = 'Chrome 36.0.1944.0 (OS X 10_9_2 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1944.0 Safari/537.36';

$user_agents [] = 'Chrome 4.0.302.2 (OS X 10_5_8 Intel) useragent=Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_8; en-US) AppleWebKit/532.8 (KHTML, like Gecko) Chrome/4.0.302.2 Safari/532.8';

$user_agents [] = 'Chrome 41.0.2227.1 (OS X 10_10_1) Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.1 Safari/537.36';

$user_agents [] = 'Chrome 6.0.464 (OS X 10_6_4 Intel) useragent=Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; en-US) AppleWebKit/534.3 (KHTML, like Gecko) Chrome/6.0.464.0 Safari/534.3';

$user_agents [] = 'Chrome 9.0.597.15 (OS X 10_6_5 Intel) useragent=Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_5; en-US) AppleWebKit/534.13 (KHTML, like Gecko) Chrome/9.0.597.15 Safari/534.13';

$user_agents [] = 'Firefox 0.9 (OS X Mach) useragent=Mozilla/5.0 (Macintosh; U; Mac OS X Mach-O; en-US; rv:2.0a) Gecko/20040614 Firefox/3.0.0';

$user_agents [] = 'Firefox 10.0.1 (OS X 10.6 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2; rv:10.0.1) Gecko/20100101 Firefox/10.0.1';

$user_agents [] = 'Firefox 16.0 (OS X 10.8 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:16.0) Gecko/20120813 Firefox/16.0';

$user_agents [] = 'Firefox 20.0 (OS X 10.7 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:20.0) Gecko/20100101 Firefox/20.0';

$user_agents [] = 'Firefox 21.0 (OS X 10.8 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:21.0) Gecko/20100101 Firefox/21.0';

$user_agents [] = 'Firefox 25.0 (OS X 10.6 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:25.0) Gecko/20100101 Firefox/25.0';

$user_agents [] = 'Firefox 3.0.3 (OS X PPC) useragent=Mozilla/5.0 (Macintosh; U; PPC Mac OS X 10.5; en-US; rv:1.9.0.3) Gecko/2008092414 Firefox/3.0.3';

$user_agents [] = 'Firefox 3.5 (OS X 10.5 Intel) useragent=Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; en-US; rv:1.9.1) Gecko/20090624 Firefox/3.5';

$user_agents [] = 'Firefox 3.6 (OS X 10.5 PPC) useragent=Mozilla/5.0 (Macintosh; U; PPC Mac OS X 10.5; en-US; rv:1.9.2.15) Gecko/20110303 Firefox/3.6.15';

$user_agents [] = 'Firefox 3.6 (OS X 10.6 Intel) useragent=Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.6; en-US; rv:1.9.2.14) Gecko/20110218 AlexaToolbar/alxf-2.0 Firefox/3.6.14';

$user_agents [] = 'Firefox 35.0 (OS X 10.9 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10.9; rv:35.0) Gecko/20100101 Firefox/35.0';

$user_agents [] = 'Firefox 4.0.1 (OS X 10.6 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:2.0.1) Gecko/20100101 Firefox/4.0.1';

$user_agents [] = 'Firefox 5.0 (OS X 10.6 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0';

$user_agents [] = 'Firefox 9.0 (OS X 10.6 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:9.0) Gecko/20100101 Firefox/9.0';

$user_agents [] = 'MSIE 5.15 (OS 9) useragent=Mozilla/4.0 (compatible; MSIE 5.15; Mac_PowerPC)';

$user_agents [] = 'Opera 10.61 (id as 9.8) (OS X Intel) useragent=Opera/9.80 (Macintosh; Intel Mac OS X; U; en) Presto/2.6.30 Version/10.61';

$user_agents [] = 'Opera 11.00 (id as 9.8) (OS X Intel) useragent=Opera/9.80 (Macintosh; Intel Mac OS X 10.4.11; U; en) Presto/2.7.62 Version/11.00';

$user_agents [] = 'Opera 11.52 (id as 9.8) (OS X Intel) useragent=Opera/9.80 (Macintosh; Intel Mac OS X 10.6.8; U; fr) Presto/2.9.168 Version/11.52';

$user_agents [] = 'Opera 9.0 (OS X PPC) useragent=Opera/9.0 (Macintosh; PPC Mac OS X; U; en)';

$user_agents [] = 'Opera 9.20 (OS X Intel) useragent=Opera/9.20 (Macintosh; Intel Mac OS X; U; en)';

$user_agents [] = 'Opera 9.64 (OS X PPC) useragent=Opera/9.64 (Macintosh; PPC Mac OS X; U; en) Presto/2.1.1';

$user_agents [] = 'Safari 125.8 (OS X PPC) useragent=Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/125.2 (KHTML, like Gecko) Safari/125.8';

$user_agents [] = 'Safari 312.3 (OS X PPC) useragent=Mozilla/5.0 (Macintosh; U; PPC Mac OS X; fr-fr) AppleWebKit/312.5 (KHTML, like Gecko) Safari/312.3';

$user_agents [] = 'Safari 419.3 (OS X PPC) useragent=Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3';

$user_agents [] = 'Safari 531.21.10 (OS X 10_6_2 Intel) useragent=Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_2; en-us) AppleWebKit/531.21.8 (KHTML, like Gecko) Version/4.0.4 Safari/531.21.10';

$user_agents [] = 'Safari 533.19.4 (OS X 10_6_5 Intel) useragent=Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_5; de-de) AppleWebKit/534.15 (KHTML, like Gecko) Version/5.0.3 Safari/533.19.4';

$user_agents [] = 'Safari 533.20.27 (OS X 10_6_6 Intel) useragent=Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_6; en-us) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27';

$user_agents [] = 'Safari 534.20.8 (OS X 10_7 Intel) useragent=Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_7; en-us) AppleWebKit/534.20.8 (KHTML, like Gecko) Version/5.1 Safari/534.20.8';

$user_agents [] = 'Safari 534.55.3 (OS X 10_7_3 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_3) AppleWebKit/534.55.3 (KHTML, like Gecko) Version/5.1.3 Safari/534.53.10';

$user_agents [] = 'Safari 534.57.2 (5.1.7) (OS X 10_6_8 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.13+ (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2';

$user_agents [] = 'Safari 536.26.17 (6) (OS X 10_7_5 Intel) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/536.26.17 (KHTML like Gecko) Version/6.0.2 Safari/536.26.17';

$user_agents [] = 'Safari 7 537.78.1 (OS X 10_9_5) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_5) AppleWebKit/537.78.1 (KHTML like Gecko) Version/7.0.6 Safari/537.78.1';

$user_agents [] = 'Safari 7.0.3 537.75.14 (OS X 10_9_3) useragent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A';

$user_agents [] = 'Safari 85 (OS X PPC) useragent=Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/125.2 (KHTML, like Gecko) Safari/85.8';

$user_agents [] = 'Chrome 10.0.648.204 (FreeBSD 64) useragent=Mozilla/5.0 (X11; U; FreeBSD x86_64; en-US) AppleWebKit/534.16 (KHTML, like Gecko) Chrome/10.0.648.204 Safari/534.16';

$user_agents [] = 'Chrome 19.0.1084.56 (FreeBSD 64) useragent=Mozilla/5.0 (X11; FreeBSD amd64) AppleWebKit/536.5 (KHTML like Gecko) Chrome/19.0.1084.56 Safari/536.5';

$user_agents [] = 'Chrome 22.0.1229.79 (FreeBSD 64) useragent=Mozilla/5.0 (X11; FreeBSD amd64) AppleWebKit/537.4 (KHTML like Gecko) Chrome/22.0.1229.79 Safari/537.4';

$user_agents [] = 'Chrome 27.0 (NetBSD) useragent=Mozilla/5.0 (X11; NetBSD) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36';

$user_agents [] = 'Chrome 4.0.207.0 (FreeBSD) useragent=Mozilla/5.0 (X11; U; FreeBSD i386; en-US) AppleWebKit/532.0 (KHTML, like Gecko) Chrome/4.0.207.0 Safari/532.0';

$user_agents [] = 'Chrome 5.0.359.0 (OpenBSD 32) useragent=Mozilla/5.0 (X11; U; OpenBSD i386; en-US) AppleWebKit/533.3 (KHTML, like Gecko) Chrome/5.0.359.0 Safari/533.3';

$user_agents [] = 'Firefox 16.0 (NetBSD 64) useragent=Mozilla/5.0 (X11; NetBSD amd64; rv:16.0) Gecko/20121102 Firefox/16.0';

$user_agents [] = 'Firefox 28.0 (OpenBSD 64) useragent=Mozilla/5.0 (X11; OpenBSD amd64; rv:28.0) Gecko/20100101 Firefox/28.0';

$user_agents [] = 'Firefox 3.1b3 (SunOs) useragent=Mozilla/5.0 (X11; U; SunOS i86pc; en-US; rv:1.9.1b3) Gecko/20090429 Firefox/3.1b3';

$user_agents [] = 'Firefox 3.5 (OpenBSD) useragent=Mozilla/5.0 (X11; U; OpenBSD i386; en-US; rv:1.9.1) Gecko/20090702 Firefox/3.5';

$user_agents [] = 'Firefox 3.6.8 (FreeBSD) useragent=Mozilla/5.0 (X11; U; FreeBSD i386; de-CH; rv:1.9.2.8) Gecko/20100729 Firefox/3.6.8';

$user_agents [] = 'Firefox 5.0 (FreeBSD 64) useragent=Mozilla/5.0 (X11; FreeBSD amd64; rv:5.0) Gecko/20100101 Firefox/5.0';

$user_agents [] = 'Chrome 10.0.601.0 (Win 7) useragent=Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.14 (KHTML, like Gecko) Chrome/10.0.601.0 Safari/534.14';

$user_agents [] = 'Chrome 11.0.672.2 (Win 7) useragent=Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.20 (KHTML, like Gecko) Chrome/11.0.672.2 Safari/534.20';

$user_agents [] = 'Chrome 12.0.712.0 (Win 7 64) useragent=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534.27 (KHTML, like Gecko) Chrome/12.0.712.0 Safari/534.27';

$user_agents [] = 'Chrome 13.0.782.24 (Win 7 64) useragent=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/13.0.782.24 Safari/535.1';

$user_agents [] = 'Chrome 15.0.874.120 (Vista) useragent=Mozilla/5.0 (Windows NT 6.0) AppleWebKit/535.2 (KHTML, like Gecko) Chrome/15.0.874.120 Safari/535.2';

$user_agents [] = 'Chrome 16.0.912.36 (Win 7 64) useragent=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.36 Safari/535.7';

$user_agents [] = 'Chrome 18.6.872.0 (Win 7) useragent=Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535.2 (KHTML, like Gecko) Chrome/18.6.872.0 Safari/535.2 UNTRUSTED/1.0 3gpp-gba UNTRUSTED/1.0';

$user_agents [] = 'Chrome 19.0.1061.1 (Win 8 - NT 6.2) useragent=Mozilla/5.0 (Windows NT 6.2) AppleWebKit/536.3 (KHTML, like Gecko) Chrome/19.0.1061.1 Safari/536.3';

$user_agents [] = 'Chrome 20.0.1090.0 (Win 8) useragent=Mozilla/5.0 (Windows NT 6.2) AppleWebKit/536.6 (KHTML, like Gecko) Chrome/20.0.1090.0 Safari/536.6';

$user_agents [] = 'Chrome 20.0.1092.0 (Win 7) useragent=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/536.6 (KHTML, like Gecko) Chrome/20.0.1092.0 Safari/536.6';

$user_agents [] = 'Chrome 22.0.1207.1 (Win 7 - 64 bit) useragent=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/22.0.1207.1 Safari/537.1';

$user_agents [] = 'Chrome 28.0.1469.0 (Win 7 - 64 bit) useragent=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML like Gecko) Chrome/28.0.1469.0 Safari/537.36';

$user_agents [] = 'Chrome 28.0.1469.0 (Win 8 - 64 bit) useragent=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML like Gecko) Chrome/28.0.1469.0 Safari/537.36';

$user_agents [] = 'Chrome 32.0.1667.0 (Win 8 - 64 bit) useragent=Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1667.0 Safari/537.36';

$user_agents [] = 'Chrome 36.0.1985.67 (Win 8 - 64 bit) useragent=Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.67 Safari/537.36';

$user_agents [] = 'Chrome 37.0.2049.0 (Win 8.1 - 64 bit) useragent=Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2049.0 Safari/537.36';

$user_agents [] = 'Chrome 4.0.249.0 (Win 7) useragent=Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/532.5 (KHTML, like Gecko) Chrome/4.0.249.0 Safari/532.5';

$user_agents [] = 'Chrome 41.0.2228.0 (Win 7 - 32 bit) useragent=Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36';

$user_agents [] = 'Chrome 5.0.310.0 (Server 2003) useragent=Mozilla/5.0 (Windows; U; Windows NT 5.2; en-US) AppleWebKit/532.9 (KHTML, like Gecko) Chrome/5.0.310.0 Safari/532.9';

$user_agents [] = 'Chrome 7.0.514.0 (Win XP) useragent=Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/534.7 (KHTML, like Gecko) Chrome/7.0.514.0 Safari/534.7';

$user_agents [] = 'Chrome 9.0.601.0 (Vista) useragent=Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) AppleWebKit/534.14 (KHTML, like Gecko) Chrome/9.0.601.0 Safari/534.14';

$user_agents [] = 'Firefox 10.0.1 (Win 7 64) useragent=Mozilla/5.0 (Windows NT 6.1; WOW64; rv:10.0.1) Gecko/20100101 Firefox/10.0.1';

$user_agents [] = 'Firefox 12.0 (Win 7 32) useragent=Mozilla/5.0 (Windows NT 6.1; rv:12.0) Gecko/20120403211507 Firefox/12.0';

$user_agents [] = 'Firefox 14.0.1 (Win Vista) useragent=Mozilla/5.0 (Windows NT 6.0; rv:14.0) Gecko/20100101 Firefox/14.0.1';

$user_agents [] = 'Firefox 15.0a1 (Win 7 64) useragent=Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0) Gecko/20120427 Firefox/15.0a1';

$user_agents [] = 'Firefox 16.0 (Win 8 64) useragent=Mozilla/5.0 (Windows NT 6.2; Win64; x64; rv:16.0) Gecko/16.0 Firefox/16.0';

$user_agents [] = 'Firefox 19.0 (Win 8 32) useragent=Mozilla/5.0 (Windows NT 6.2; rv:19.0) Gecko/20121129 Firefox/19.0';

$user_agents [] = 'Firefox 20.0 (Win 8 32) useragent=Mozilla/5.0 (Windows NT 6.2; rv:20.0) Gecko/20121202 Firefox/20.0';

$user_agents [] = 'Firefox 21.0 (Win 7 32) useragent=Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20130401 Firefox/21.0';

$user_agents [] = 'Firefox 25.0 (Win 7 64) useragent=Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:25.0) Gecko/20100101 Firefox/25.0';

$user_agents [] = 'Firefox 29.0 (Win 7 64 bit) useragent=Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:25.0) Gecko/20100101 Firefox/29.0';

$user_agents [] = 'Firefox 3.0.10 (Win XP) useragent=Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10';

$user_agents [] = 'Firefox 3.0.11 (Vista) .NET useragent=Mozilla/5.0 (Windows; U; Windows NT 6.0; en-GB; rv:1.9.0.11) Gecko/2009060215 Firefox/3.0.11 (.NET CLR 3.5.30729)';

$user_agents [] = 'Firefox 3.0.2pre (Win XP 64) useragent=Mozilla/5.0 (Windows; U; Windows NT 6.0 x64; en-US; rv:1.9pre) Gecko/2008072421 Minefield/3.0.2pre';

$user_agents [] = 'Firefox 3.5.6 (Vista) useragent=Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6 GTB5';

$user_agents [] = 'Firefox 3.6.8 (XP) useragent=Mozilla/5.0 (Windows; U; Windows NT 5.1; tr; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 ( .NET CLR 3.5.30729; .NET4.0E)';

$user_agents [] = 'Firefox 31.0 (Win XP) useragent=Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';

$user_agents [] = 'Firefox 35.0 (Win 7 64 bit) useragent=Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:35.0) Gecko/20100101 Firefox/35.0';

$user_agents [] = 'Firefox 36.0 (Win 8.1 32 bit) useragent=Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0';

$user_agents [] = 'Firefox 4.01 (Win 7 32) useragent=Mozilla/5.0 (Windows NT 6.1; rv:2.0.1) Gecko/20100101 Firefox/4.0.1';

$user_agents [] = 'Firefox 4.01 (Win 7 64) useragent=Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:2.0.1) Gecko/20100101 Firefox/4.0.1';

$user_agents [] = 'Firefox 5.0 (XP) useragent=Mozilla/5.0 (Windows NT 5.1; rv:5.0) Gecko/20100101 Firefox/5.0';

$user_agents [] = 'Firefox 6.0a2 (Win 7 64) useragent=Mozilla/5.0 (Windows NT 6.1; WOW64; rv:6.0a2) Gecko/20110622 Firefox/6.0a2';

$user_agents [] = 'Firefox 7.0.1 (Win 7 64) useragent=Mozilla/5.0 (Windows NT 6.1; WOW64; rv:7.0.1) Gecko/20100101 Firefox/7.0.1';

$user_agents [] = 'MSIE 10 - compat mode (Win 7 64) useragent=Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/6.0)';

$user_agents [] = 'MSIE 10 - standard mode (Win 7 64) useragent=Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)';

$user_agents [] = 'MSIE 10.6 - (Win 7 32) useragent=Mozilla/5.0 (compatible; MSIE 10.6; Windows NT 6.1; Trident/5.0; InfoPath.2; SLCC1; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET CLR 2.0.50727) 3gpp-gba UNTRUSTED/1.0';

$user_agents [] = 'MSIE 11.0 - (Win 7 64) useragent=Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0)';

$user_agents [] = 'MSIE 11.0 - (Win 8.1 32) useragent=Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0)';

$user_agents [] = 'MSIE 11.0 (compatibility mode IE 7)- (Win 8.1 32) useragent=Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.3; Trident/7.0; .NET4.0E; .NET4.0C)';

$user_agents [] = 'MSIE 5.5 (Win 2000) useragent=Mozilla/4.0 (compatible; MSIE 5.5; Windows NT 5.0 ) appcodename= appname=Microsoft Internet Explorer appversion=4.0 (compatible; MSIE 5.5; Windows NT 5.0)';

$user_agents [] = 'MSIE 5.5 (Win ME) useragent=Mozilla/4.0 (compatible; MSIE 5.5; Windows 98; Win 9x 4.90)';

$user_agents [] = 'MSIE 6 (Win XP) useragent=Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1) appcodename= appname=Microsoft Internet Explorer appversion=4.0 (Compatible; MSIE 6.0; Windows NT 5.1)';

$user_agents [] = 'MSIE 7 (Vista) useragent=Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0) appcodename=Mozilla appname=Microsoft Internet Explorer appversion=4.0 (compatible; MSIE 7.0; Windows NT 6.0)';

$user_agents [] = 'MSIE 8 - compat mode (Vista) useragent=Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; Trident/4.0)';

$user_agents [] = 'MSIE 8 - standard mode (Vista) useragent=Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)';

$user_agents [] = 'MSIE 8 - standard mode (Win 7) useragent=Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0)';

$user_agents [] = 'MSIE 8 - standard mode (Win XP) useragent=Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET CLR 2.0.50727; .NET CLR 3.0.04506.648; .NET CLR 3.5.21022; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)';

$user_agents [] = 'MSIE 9 - compat mode (Vista) useragent=Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; Trident/5.0)';

$user_agents [] = 'MSIE 9 - standard mode (NT 6.2 32 Win 8) useragent=Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.2; Trident/5.0)';

$user_agents [] = 'MSIE 9 - standard mode (NT 6.2 64 Win 8) useragent=Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.2; WOW64; Trident/5.0)';

$user_agents [] = 'MSIE 9 - standard mode (Win 7) useragent=Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)';

$user_agents [] = 'MSIE 9 - standard mode (with Zune plugin) (NT 6.1 Win 7) useragent=Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; SLCC2; Media Center PC 6.0; InfoPath.3; MS-RTC LM 8; Zune 4.7)';

$user_agents [] = 'Opera 10.10 (id as 9.8) (Server 2003) useragent=Opera/9.80 (Windows NT 5.2; U; en) Presto/2.2.15 Version/10.10';

$user_agents [] = 'Opera 11.01 (id as 9.8) (Win 7) useragent=Opera/9.80 (Windows NT 6.1; U; en) Presto/2.7.62 Version/11.01';

$user_agents [] = 'Opera 11.10 (id as 9.8) (Win XP) useragent=Opera/9.80 (Windows NT 5.1; U; zh-tw) Presto/2.8.131 Version/11.10';

$user_agents [] = 'Opera 12.00 (id as 9.8) (Win 7) useragent=Opera/9.80 (Windows NT 6.1; U; es-ES) Presto/2.9.181 Version/12.00';

$user_agents [] = 'Opera 12.14 (id as 9.8) (Win Vista) useragent=Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14';

$user_agents [] = 'Opera 12.16 (id as 9.8) (Win 7) useragent=Opera/9.80 (Windows NT 6.1; WOW64) Presto/2.12.388 Version/12.16';

$user_agents [] = 'Opera 14.0.1116.4 (Webkit 537.36) (Win 7) useragent=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.12 Safari/537.36 OPR/14.0.1116.4';

$user_agents [] = 'Opera 15.0.1147.24 (Webkit 537.36) (Win 7) useragent=Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.29 Safari/537.36 OPR/15.0.1147.24 (Edition Next)';

$user_agents [] = 'Opera 18.0.1284.49 (Webkit 537.36) (Win 8) useragent=Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.57 Safari/537.36 OPR/18.0.1284.49';

$user_agents [] = 'Opera 19.0.1326.56 (Webkit 537.36) (Win 7) useragent=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.76 Safari/537.36 OPR/19.0.1326.56';

$user_agents [] = 'Opera 20.0.1387.91 (Webkit 537.36) (Win 7 64 bit) useragent=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36 OPR/20.0.1387.91';

$user_agents [] = 'Opera 7.5 (Win ME) useragent=Opera/7.50 (Windows ME; U) [en]';

$user_agents [] = 'Opera 7.5 (Win XP) useragent=Opera/7.50 (Windows XP; U)';

$user_agents [] = 'Opera 7.51 (Win XP) useragent=Opera/7.51 (Windows NT 5.1; U) [en]';

$user_agents [] = 'Opera 8.0 (Win 2000) useragent=Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0; en) Opera 8.0 appcodename= appname=Microsoft Internet Explorer appversion=4.0 (compatible; MSIE 6.0; Windows NT 5.0; en)';

$user_agents [] = 'Opera 9.25 - (Vista) useragent=Opera/9.25 (Windows NT 6.0; U; en)';

$user_agents [] = 'Safari 531.21.10 (Win XP) useragent=Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/531.21.8 (KHTML, like Gecko) Version/4.0.4 Safari/531.21.10';

$user_agents [] = 'Safari 533.17.8 (Server 2003/64 bit) useragent=Mozilla/5.0 (Windows; U; Windows NT 5.2; en-US) AppleWebKit/533.17.8 (KHTML, like Gecko) Version/5.0.1 Safari/533.17.8';

$user_agents [] = 'Safari 533.19.4 (Win 7) useragent=Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.19.4 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5';

$user_agents [] = 'Safari 6.0 (Win 8) useragent=Mozilla/5.0 (Windows; U; Windows NT 6.2; es-US ) AppleWebKit/540.0 (KHTML like Gecko) Version/6.0 Safari/8900.00';

$user_agents [] = 'Safari 7.0 (Win 7) useragent=Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.71 (KHTML like Gecko) WebVideo/1.0.1.10 Version/7.0 Safari/537.71';

// Adding list of proxies to the $proxies array

$proxies[] = '209.54.37.3:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.47:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.51:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.65:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.76:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.77:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.79:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.81:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.95:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.97:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.98:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.99:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.101:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.102:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.103:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.114:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.117:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.123:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.137:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.158:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.159:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.162:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.171:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.173:60099:kbrown:eERbNsXv';

$proxies[] = '209.54.37.184:60099:kbrown:eERbNsXv';



// Choose a random proxy

if (isset($proxies)) {  // If the $proxies array contains items, then



    $proxy = $proxies[array_rand($proxies)];

     $proxy_details = explode(":",$proxy);

    $user_agent = $user_agents[array_rand($user_agents)];

    $chosen_proxy['proxy'] =  $proxy_details[0];

     $chosen_proxy['port'] =  $proxy_details[1];

    $chosen_proxy['auth'] =  $proxy_details[2].":".$proxy_details[3];

    $chosen_proxy['user_agent'] =  $user_agent;

    return $chosen_proxy;

}

}

 //call amazon API

function call_azon_api($site_kwd, $azon_tag, $secret_key, $access_key_id) {



sleep(2);



// The region you are interested in

$endpoint = "webservices.amazon.com";



$uri = "/onca/xml";



$params = array(

    "Service" => "AWSECommerceService",

    "Operation" => "ItemSearch",

    "AWSAccessKeyId" => "{$access_key_id}",

    "AssociateTag" => "{$azon_tag}",

    "SearchIndex" => "All",

    "Keywords" => "{$site_kwd}",

    "ResponseGroup" => "Large,OfferFull"

);



// Set current timestamp if not set

if (!isset($params["Timestamp"])) {

    $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');

}



// Sort the parameters by key

ksort($params);



$pairs = array();



foreach ($params as $key => $value) {

    array_push($pairs, rawurlencode($key)."=".rawurlencode($value));

}



// Generate the canonical query

$canonical_query_string = join("&", $pairs);



// Generate the string to be signed

$string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;



// Generate the signature required by the Product Advertising API

$signature = base64_encode(hash_hmac("sha256", $string_to_sign, $secret_key, true));



// Generate the signed URL

$request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);



echo $request_url;

}

//save url content

function scrape_url_content($url_to_scrape) {

$ch = curl_init();  // Initialise a cURL handle

// Set any other cURL options that are required

curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);

curl_setopt($ch, CURLOPT_TIMEOUT, 400); //timeout in seconds

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

curl_setopt($ch, CURLOPT_URL, $url_to_scrape);

$results = curl_exec($ch);  // Execute a cURL request

curl_close($ch);    // Closing the cURL handle

return $results;

}

//get search results

function find_search_count($find_substring) {

     if (strlen($find_substring) < 1) {

           return (0);

            }else {

            if(strpos($find_substring,"of ") !== false) {

                    $substring =  (get_string_between($find_substring, "of ", " result"));

                }

                else {



                    $substring = substr($find_substring,0,strpos($find_substring," result"));

                }

            }



    return($substring);

}

function get_string_between($string, $start, $end){

    $string = ' ' . $string;

    $ini = strpos($string, $start);

    if ($ini == 0) return '';

    $ini += strlen($start);

    $len = strpos($string, $end, $ini) - $ini;

    return substr($string, $ini, $len);

}




?>