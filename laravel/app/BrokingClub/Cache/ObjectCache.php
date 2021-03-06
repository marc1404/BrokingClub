<?php
namespace BrokingClub\Cache;
/**
 * Project: BrokingClub | ObjectCache.php
 * Author: Simon - www.triggerdesign.de
 * Date: 30.04.2015
 * Time: 18:08
 */

abstract class ObjectCache {

    public static $statistics = ['hit'=> 0, 'miss' => 0];

    protected $values = [];

    public function getOrStore($id, $closure){
        if($this->has($id)) return $this->get($id);

        $value = $closure();
        $this->store($id, $value);

        return $value;
    }

    public function store($id, $value){
        $this->values[$id] = $value;

        return $value;
    }

    public function get($id){
        if(!$this->has($id)){
            $this->addMiss();
            return null;
        }

        $this->addHit();
        return $this->values[$id];
    }

    public function remove($id){
        unset($this->values[$id]);
    }

    public function has($id){
        if(!isset($this->values[$id])){
            return false;
        }

        return true;
    }

    protected function addHit(){
        static::$statistics['hit']++;
    }

    protected function addMiss(){
        static::$statistics['miss']++;
    }


} 