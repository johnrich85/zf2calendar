<?php
/**
 * Created by JetBrains PhpStorm.
 * User: John
 * Date: 14/12/13
 * Time: 20:46
 * To change this template use File | Settings | File Templates.
 */
namespace Calendar\Renderers;

interface CalendarRendererInterface {
    public function __construct($calendar, $phpRenderer);

    public function render();
}