<?php
/**
 * Created by autumn.
 * Date: 2017-4-3
 * Time: 23:15
 */

namespace app\services;


class ArithmeticService
{
    const HP = 19;
    const LEFT_DZ = 8.4;
    const LEFT_THLP = 12.5;
    const LEFT_AA = 100;
    const RIGHT_SZ = 4.5;
    const RIGHT_HL = 20;
    const RIGHT_JG = 246;


    public $cb;
    public $bet;
    public $throughTimes;
    public $throughIncrease;
    public $yl;
    public $timeYl;
    public $type;
    public $_data;




    public function __construct($bet)
    {
        $this->bet = $bet;
        $this->cb = $bet;
        $this->throughTimes = 1;
        $this->throughIncrease = 1;
    }


    public function calculateData()
    {
        if($this->type == null){
            return false;
        }
        $this->_data[] = [$this->throughTimes,$this->bet,$this->cb,$this->bet * $this->type - $this->cb];

        $f = true;
        while($f){
            $this->throughTimes++;
            $i=0;
            $flag = 1;

            while ($flag) {
                if(($this->bet+$this->throughIncrease * $i) * ($this->type -1) - $this->cb >= $this->throughTimes * $this->timeYl){
                    $flag = 0;
                    if($this->bet + $this->throughIncrease * $i >=1000){
                        $this->bet = 1000;
                    }else{
                        $this->bet +=$i*$this->throughIncrease;
                    }
                }else{
                    if ($this->bet + $this->throughIncrease * $i >= 1000) {
                        $this->bet = 1000;
                    }
                }
                $i++;
            }

            $this->cb = $this->bet + $this->cb;
            $this->yl = $this->bet * $this->type - $this->cb;
            if($this->yl < 0){
                break;
            }
            $this->_data[] = [$this->throughTimes,$this->bet,$this->cb,$this->yl];
        }
    }


    /**
     * @return mixed
     */
    public function getBet()
    {
        return $this->bet;
    }

    /**
     * @param mixed $bet
     */
    public function setBet($bet)
    {
        $this->bet = $bet;
    }

    /**
     * @return mixed
     */
    public function getThroughIncrease()
    {
        return $this->throughIncrease;
    }

    /**
     * @param mixed $throughIncrease
     */
    public function setThroughIncrease($throughIncrease)
    {
        $this->throughIncrease = $throughIncrease;
    }

    /**
     * @return mixed
     */
    public function getTimeYl()
    {
        return $this->timeYl;
    }

    /**
     * @param mixed $timeYl
     */
    public function setTimeYl($timeYl)
    {
        $this->timeYl = $timeYl;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->_data;
    }


}