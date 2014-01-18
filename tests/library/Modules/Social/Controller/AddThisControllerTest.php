<?php
/**
 * This source file is part of GotCms.
 *
 * GotCms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * GotCms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with GotCms. If not, see <http://www.gnu.org/licenses/lgpl-3.0.html>.
 *
 * PHP Version >=5.3
 *
 * @category Gc_Tests
 * @package  Modules
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Social\Controller;

use Social\Module;
use Gc\Event\StaticEventManager;
use Gc\Registry;
use Gc\Module\Model as ModuleModel;
use Gc\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-12-06 at 14:00:49.
 *
 * @group Modules
 * @category Gc_Tests
 * @package  Modules
 */
class AddThisControllerTest extends AbstractHttpControllerTestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    public function setUp()
    {
        $this->init();
        ModuleModel::install(Registry::get('Application')->getServiceManager()->get('CustomModules'), 'Social');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    public function tearDown()
    {
        StaticEventManager::resetInstance();
        ModuleModel::uninstall(
            Registry::get('Application')->getServiceManager()->get('CustomModules')->getModule('Social'),
            ModuleModel::fromName('Social')
        );
        parent::tearDown();
    }

    /**
     * Test
     *
     * @return void
     */
    public function testIndexAction()
    {
        $this->dispatch('/admin/module/social/addthis');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Social');
        $this->assertControllerName('AddThisController');
        $this->assertControllerClass('AddThisController');
        $this->assertMatchedRouteName('module/social/addthis');
    }

    /**
     * Test
     *
     * @return void
     */
    public function testIndexActionWithValidPostData()
    {
        $postData = array(
            'widget-0' => array(
                'name' => 'test',
                'identifier' => 'test',
                'settings' => 'large_toolbox',
                'custom_string' => '',
                'chosen_list' => '',
            )
        );

        $this->dispatch(
            '/admin/module/social/addthis',
            'POST',
            $postData
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Social');
        $this->assertControllerName('AddThisController');
        $this->assertControllerClass('AddThisController');
        $this->assertMatchedRouteName('module/social/addthis');
    }

    /**
     * Test
     *
     * @return void
     */
    public function testIndexActionWithInvalidPostData()
    {
        $postData = array(
            'widget-0' => array(
                'name' => '',
                'identifier' => '',
                'settings' => '',
                'custom_string' => '',
                'chosen_list' => '',
            )
        );

        $this->dispatch(
            '/admin/module/social/addthis',
            'POST',
            $postData
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Social');
        $this->assertControllerName('AddThisController');
        $this->assertControllerClass('AddThisController');
        $this->assertMatchedRouteName('module/social/addthis');
    }

    /**
     * Test
     *
     * @return void
     */
    public function testAddWidgetActionWithValidPostData()
    {
        $postData = array(
            'widget-add' => array(
                'name' => 'test',
                'identifier' => 'testazadazdazd',
                'settings' => 'fb_tw_p1_sc',
                'custom_string' => '',
                'chosen_list' => '',
            )
        );

        $this->dispatch(
            '/admin/module/social/addthis/add-widget',
            'POST',
            $postData
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Social');
        $this->assertControllerName('AddThisController');
        $this->assertControllerClass('AddThisController');
        $this->assertMatchedRouteName('module/social/addthis/add-widget');
    }

    /**
     * Test
     *
     * @return void
     */
    public function testAddWidgetActionWithInvalidPostData()
    {
        $postData = array(
            'widget-add' => array(
                'name' => '',
                'identifier' => '',
                'settings' => '',
                'custom_string' => '',
                'chosen_list' => '',
            )
        );

        $this->dispatch(
            '/admin/module/social/addthis/add-widget',
            'POST',
            $postData
        );
        $this->assertResponseStatusCode(200);


        $this->assertModuleName('Social');
        $this->assertControllerName('AddThisController');
        $this->assertControllerClass('AddThisController');
        $this->assertMatchedRouteName('module/social/addthis/add-widget');
    }

    /**
     * Test
     *
     * @return void
     */
    public function testConfigActionWithValidPostData()
    {
        $postData = array(
            'config' => array (
                'language' => 'fr',
                'data_ga_property_id' => 'azdazd',
                'profile_id' => '',
                'show_stats' => '1',
                'password' => '',
                'username' => '',
                'data_track_clickback' => '1',
                'data_track_addressbar' => '1',
                'json_config' => NULL,
            ),
        );

        $this->dispatch(
            '/admin/module/social/addthis/config',
            'POST',
            $postData
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Social');
        $this->assertControllerName('AddThisController');
        $this->assertControllerClass('AddThisController');
        $this->assertMatchedRouteName('module/social/addthis/config');
    }

    /**
     * Test
     *
     * @return void
     */
    public function testConfigActionWithInvalidPostData()
    {
        $postData = array(
            'config' => array (
                'language' => '',
                'data_ga_property_id' => 'azdazd',
                'profile_id' => '',
                'show_stats' => '1',
                'password' => '',
                'username' => '',
                'data_track_clickback' => '1',
                'data_track_addressbar' => '1',
                'json_config' => NULL,
            ),
        );

        $this->dispatch(
            '/admin/module/social/addthis/config',
            'POST',
            $postData
        );
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Social');
        $this->assertControllerName('AddThisController');
        $this->assertControllerClass('AddThisController');
        $this->assertMatchedRouteName('module/social/addthis/config');
    }
}
