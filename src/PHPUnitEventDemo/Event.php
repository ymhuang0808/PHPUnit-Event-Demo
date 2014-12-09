<?php
namespace PHPUnitEventDemo;


class Event
{
    public $id;
    public $name;
    public $start_date;
    public $end_date;
    public $deadline;
    public $attendee_limit;
    public $attendees = array();
    
    public function __construct($id, $name, $start_date, $end_date, $deadline, $attendee_limit)
    {
        $this->id = $id;
        $this->name = $name;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->deadline = $deadline;
        $this->attendee_limit = $attendee_limit;
    }
    
    public function reserve($user)
    {       
        // 報名人數是否超過限制 
        if ($this->attendee_limit > $this->getAttendeeNumber()) {
            if (array_key_exists($user->id, $this->attendees)) {
                throw new \PHPUnitEventDemo\EventException(
                    'Duplicated reservation',
                    \PHPUnitEventDemo\EventException::DUPLICATED_REGISTRATION
                );
            }

            // 使用者報名
            $this->attendees[$user->id] = $user;
            
            return true;
        }
        
        return false;
    }
    
    public function getAttendeeNumber()
    {   
        // 取得報名人數
        return sizeof($this->attendees);
    }
    
    public function unreserve($user)
    {
        
        // 使用者取消報名
        unset($this->attendees[$user->id]);
    }
}
