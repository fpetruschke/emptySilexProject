<?php
/**
 * @author  Florian Petruschke <florian.petruschke@gmail.com>
 * @date    22.03.16  -  07:25
 * @version 1.0
 */

namespace emptyProjectSilex\Model;
require_once __DIR__ . '/../../../app/MVC/Model/User.php';


class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateUser()
    {
        $testUser = new User();

        $now = new \DateTime('now');

        $testUser->setName('Mustermann');
        $testUser->setFirstname('Max');
        $testUser->setContraction("MAXMU");
        $testUser->setCallthrough('40');
        $testUser->setEMail('max.muster@mustermax.de');
        $testUser->setUsername('max.mustermann');
        $testUser->setPassword('musterpassword');
        $testUser->setCreatedAt($now);

        $this->assertEquals('Mustermann', $testUser->getName());
        $this->assertEquals('Max', $testUser->getFirstname());
        $this->assertEquals('MAXMU', $testUser->getContraction());
        $this->assertEquals('40', $testUser->getCallthrough());
        $this->assertEquals('max.muster@mustermax.de', $testUser->getEMail());
        $this->assertEquals('max.mustermann', $testUser->getUsername());
        $this->assertEquals('musterpassword', $testUser->getPassword());
        $this->assertEquals($now, $testUser->getCreatedAt());

        $testUser->setRole(1);
        $this->assertEquals(1, $testUser->getRole());
        $testUser->setRole('1');
        $this->assertEquals(1, $testUser->getRole());

        $testUser->setCreatedBy(1);
        $this->assertEquals(1, $testUser->getCreatedBy());
        $testUser->setCreatedBy('1');
        $this->assertEquals(1, $testUser->getCreatedBy());
    }
}
