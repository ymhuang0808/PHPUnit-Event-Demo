<?php

class EventTest extends PHPUnit_Framework_TestCase
{
    public function testReserve()
    {
        $id = 1; 
        $name = '活動1';
        $start_date = '2014-12-24 18:00:00';
        $end_date = '2014-12-24 20:00:00';
        $deadline = '2014-12-23 23:59:59';
        $attendee_limit = 10;

        $event = new \PHPUnitEventDemo\Event($id, $name, $start_date, 
            $end_date, $deadline, $attendee_limit);
        $user = new \PHPUnitEventDemo\User(1, 'User1', 'user1@openfoundry.org');

        // 使用者報名活動
        $event->reserve($user);
        
        // 預期報名人數
        $this->assertEquals(1, $event->getAttendeeNumber());
        // 報名清單中有已經報名的人
        $this->assertContains($user, $event->attendees);
    }
}
