<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class DateTimeExtended extends DateTime {

    # ref start date is odd
    const REF_START = '2013-W43-1';

    protected function isOdd(DateTime $dt)
    {
        $ref = new DateTime(self::REF_START);
        return floor($dt->diff($ref)->days / 7) % 2 == 0;
    }

    public function getCurrentPeriodStart()
    {
        $dt = new DateTime($this->format('o-\WW-1'));
        if (!$this->isOdd($dt)) {
            $dt->modify('-1 week');
        }
        return $dt;
    }

    public function getCurrentPeriodEnd()
    {
        $dt = new DateTime($this->format('o-\WW-7'));
        if ($this->isOdd($dt)) {
            $dt->modify('+1 week');
        }
        return $dt;
    }

    public function getPreviousPeriodStart()
    {
        $dt = $this->getCurrentPeriodStart();
        return $dt->modify('-2 week');
    }

    public function getPreviousPeriodEnd()
    {
        $dt = $this->getCurrentPeriodEnd();
        return $dt->modify('-2 week');
    }

}
?>