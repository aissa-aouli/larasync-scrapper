<?php

namespace Larasync\Scrapper\Navigation;

interface Navigator
{
    /**
     * @param array $config - Optional array to override initial configuration set in config/puppeteer.php
     * @return mixed
     */
    public function openPage(array $config);
}
