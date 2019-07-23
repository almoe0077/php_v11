<?php
/**
 * Created by PhpStorm.
 * User: r.maertel
 * Date: 22.07.2019
 * Time: 14:29
 */

class mensch {
    protected $name;
    protected $alter;
    protected $wohnort;
    protected $verheiratet;

    public function __construct($n, $a, $w, $v) {
        $this->name = $n;
        $this->alter = $a;
        $this->wohnort = $w;
        $this->verheiratet = $v;
    }
}