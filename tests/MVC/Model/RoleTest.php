<?php
/**
 * @author  Florian Petruschke <florian.petruschke@gmail.com>
 * @date    22.03.16  -  08:22
 * @version 1.0
 */

namespace emptyProjectSilex\Model;
require_once __DIR__ . '/../../../app/MVC/Model/Role.php';


class RoleTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateRole()
    {
        $testRole = new Role();
        $testRole->setName('TESTER');
        $this->assertEquals('TESTER', $testRole->getName());

        $roleIds = array($testRole->getId());
        $this->assertEquals(1, count($roleIds));
    }
}
