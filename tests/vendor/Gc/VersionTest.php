<?php
namespace Gc;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:53:23.
 */
class VersionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Version
     */
    protected $_object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->_object = new Version;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Gc\Version::compareVersion
     * @todo   Implement testCompareVersion().
     */
    public function testCompareVersion()
    {
        $this->assertEquals('0', Version::compareVersion(Version::VERSION));
    }

    /**
     * @covers Gc\Version::getLatest
     * @todo   Implement testGetLatest().
     */
    public function testGetLatest()
    {
        $this->assertEquals('0.1b', Version::getLatest());
    }

    /**
     * @covers Gc\Version::isLatest
     * @todo   Implement testIsLatest().
     */
    public function testIsLatest()
    {
        $this->assertEquals(TRUE, Version::isLatest());
    }
}
