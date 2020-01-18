<?php

return [
    'args' => [
        '--no-sandbox',
        '--disable-setuid-sandbox',
        '--disable-gpu',
        '--window-size=1920x1080',
        '--disable-dev-shm-usage',
        '--disable-accelerated-2d-canvas',
//                '--blink-settings=imagesEnabled=false'
        '--window-position=0,0',
        '--ignore-certifcate-errors',
        '--ignore-certifcate-errors-spki-list',
    ],
    'headless' => true,
    'userDataDir' => '/home/headless-chromium/',
];
