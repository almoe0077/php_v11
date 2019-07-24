<?php
/**
 * Created by PhpStorm.
 * User: r.maertel
 * Date: 22.07.2019
 * Time: 14:34
 */

class stadt {
    protected $name;
    protected $einwohner;
    protected $land;

    public function __construct($n, $e, $l) {
        $this->name = $n;
        $this->einwohner = $e;
        $this->land = $l;
    }

    /**
     * @return String Name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return Int Einwohner
     */
    public function getEinwohner() {
        return $this->einwohner;
    }

    /**
     * @return String Land
     */
    public function getLand() {
        return $this->land;
    }

}
