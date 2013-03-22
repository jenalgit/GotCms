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
 * @package  ZfModules
 * @author   Pierre Rambaud (GoT) http://rambaudpierre.fr
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Module\Controller;

use Gc\Module\Model as ModuleModel;
use Gc\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\Db\Sql;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-03-14 at 19:50:22.
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group    ZfModules
 * @category Gc_Tests
 * @package  ZfModules
 */
class IndexControllerTest extends AbstractHttpControllerTestCase
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
    }

    /**
     * Test
     *
     * @covers Module\Controller\IndexController::indexAction
     *
     * @return void
     */
    public function testIndexAction()
    {
        $this->dispatch('/admin/module');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Module');
        $this->assertControllerName('ModuleController');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('module');
    }

    /**
     * Test
     *
     * @covers Module\Controller\IndexController::installAction
     *
     * @return void
     */
    public function testInstallAction()
    {
        $this->dispatch('/admin/module/install');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Module');
        $this->assertControllerName('ModuleController');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('moduleinstall');
    }

    /**
     * Test
     *
     * @covers Module\Controller\IndexController::installAction
     *
     * @return void
     */
    public function testInstallActionWithInvalidPostData()
    {
        $this->dispatch(
            '/admin/module/install',
            'POST',
            array(
                'module' => ''
            )
        );
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Module');
        $this->assertControllerName('ModuleController');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('moduleinstall');
    }

    /**
     * Test
     *
     * @covers Module\Controller\IndexController::installAction
     * @covers Module\Controller\IndexController::loadBootstrap
     *
     * @return void
     */
    public function testInstallActionWithValidPostData()
    {
        $this->dispatch(
            '/admin/module/install',
            'POST',
            array(
                'module' => 'Sitemap'
            )
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Module');
        $this->assertControllerName('ModuleController');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('moduleinstall');

        ModuleModel::fromName('Sitemap')->delete();
    }

    /**
     * Test
     *
     * @covers Module\Controller\IndexController::uninstallAction
     *
     * @return void
     */
    public function testUninstallActionWithInvalidData()
    {
        $this->dispatch(
            '/admin/module/uninstall/id/99999'
        );
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Module');
        $this->assertControllerName('ModuleController');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('moduleUninstall');
    }

    /**
     * Test
     *
     * @covers Module\Controller\IndexController::uninstallAction
     * @covers Module\Controller\IndexController::loadBootstrap
     *
     * @return void
     */
    public function testUninstallAction()
    {
        $module_model = ModuleModel::fromArray(
            array(
                'name' => 'Sitemap'
            )
        );

        $module_model->save();

        $this->dispatch(
            '/admin/module/uninstall/id/' . $module_model->getId()
        );
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Module');
        $this->assertControllerName('ModuleController');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('moduleUninstall');

        $module_model->delete();
    }

    /**
     * Test
     *
     * @covers Module\Controller\IndexController::editAction
     *
     * @return void
     */
    public function testEditAction()
    {
        $module_model = ModuleModel::fromArray(
            array(
                'name' => 'Sitemap'
            )
        );

        $module_model->save();
        $select = new Sql\Select();
        $select->from('user_acl_resource')
            ->columns(array('id'))
            ->where->equalTo('resource', 'Modules');
        $insert = new Sql\Insert();
        $insert->into('user_acl_permission')
            ->values(
                array(
                    'permission' => $module_model->getName(),
                    'user_acl_resource_id' => $module_model->fetchOne($select),
                )
            );

        $module_model->execute($insert);

        $insert = new Sql\Insert();
        $insert->into('user_acl')
            ->values(
                array(
                    'user_acl_permission_id' => $module_model->getLastInsertId('user_acl_permission'),
                    'user_acl_role_id' => 1, //Administrator role
                )
            );
        $module_model->execute($insert);

        $this->dispatch(
            '/admin/module/' . $module_model->getId()
        );
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Module');
        $this->assertControllerName('ModuleController');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('moduleEdit');

        $module_model->delete();
    }
}
