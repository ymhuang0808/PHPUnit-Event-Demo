<?php
class EventTest extends PHPUnit_Framework_TestCase
{
    private $event;
    private $user;

    public function setUp()
    {
        $eventId = 1;
        $eventName = '活動1';
        $eventStartDate = '2014-12-24 12:00:00';
        $eventEndDate = '2014-12-24 13:30:00';
        $eventDeadline = '2014-12-23 23:59:59';
        $eventAttendeeLimit = 10;
        $this->event = new \PHPUnitEventDemo\Event($eventId, $eventName, $eventStartDate, 
            $eventEndDate, $eventDeadline, $eventAttendeeLimit);

        $userId = 1;
        $userName = 'User1';
        $userEmail = 'user1@openfoundry.org';
        $this->user = new \PHPUnitEventDemo\User($userId, $userName, $userEmail);
    }

    public function tearDown()
    {
        $this->event = null;
        $this->user = null;
    }

    public function testReserve()
    {
        // 測試報名
        
        // 使用者報名活動
        $this->event->reserve($this->user);
        
        $expectedNumber = 1;
        
        // 預期報名人數
        $this->assertEquals($expectedNumber, $this->event->getAttendeeNumber());
        
        // 報名清單中有已經報名的人
        $this->assertContains($this->user, $this->event->attendees);
        
        return [$this->event, $this->user];
    }
    
    /**
     *  @depends testReserve
     */
    public function testUnreserve($objs)
    {
        // 測試取消報名
        $event = $objs[0];
        $user = $objs[1];
        
        // 使用者取消報名
        $event->unreserve($user);
        
        $unreserveExpectedCount = 0;
        
        // 預期報名人數
        $this->assertEquals($unreserveExpectedCount, $event->getAttendeeNumber());
        
        // 報名清單中沒有已經取消報名的人
        $this->assertNotContains($user, $event->attendees);
    }
    
    /**
     *  @dataProvider eventsDataProvider
     */
    public function testAttendeeLimitReserve($eventId, $eventName, $eventStartDate, 
        $eventEndDate, $eventDeadline, $attendeeLimit)
    {
        // 測試報名人數限制
        $event = new \PHPUnitEventDemo\Event($eventId, $eventName, $eventStartDate, 
            $eventEndDate, $eventDeadline, $attendeeLimit);
        $userNumber = 6;
        
        // 建立不同使用者報名
        for ($userCount = 1; $userCount <= $userNumber; $userCount++) {
            $userId = $userCount;
            $userName = 'User ' . $userId;
            $userEmail = 'user' . $userId . '@openfoundry.org';
            $user = new \PHPUnitEventDemo\User($userId, $userName, $userEmail);
            
            $reservedResult = $event->reserve($user);
            
            // 報名人數是否超過
            if ($userCount > $attendeeLimit) {
                
                // 無法報名
                $this->assertFalse($reservedResult);
            } else {
                $this->assertTrue($reservedResult);
            }
        }
    }
    
    public function eventsDataProvider()
    {
        $eventId = 1;
        $eventName = "活動1";
        $eventStartDate = '2014-12-24 12:00:00';
        $eventEndDate = '2014-12-24 13:00:00';
        $eventDeadline = '2014-12-23 23:59:59';
        $eventAttendeeLimitNotFull = 5;
        $eventAttendeeFull = 10;
        
        $eventsData = array(
            array(
                $eventId,
                $eventName,
                $eventStartDate,
                $eventEndDate,
                $eventDeadline,
                $eventAttendeeLimitNotFull
            ) ,
            array(
                $eventId,
                $eventName,
                $eventStartDate,
                $eventEndDate,
                $eventDeadline,
                $eventAttendeeFull
            )
        );
        
        return $eventsData;
    }

    /**
     * @expectedException \PHPUnitEventDemo\EventException
     * @expectedExceptionMessage Duplicated reservation
     * @expectedExceptionCode 1
     */
    public function testDuplicatedReservationWithException()
    {
        // 測試重複報名，預期丟出異常

        // 同一個使用者報名兩次
        $this->event->reserve($this->user);
        $this->event->reserve($this->user);
    }
}
