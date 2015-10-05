<?php

/**
 * ownCloud - ownbackup
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Patrizio Bekerle <patrizio@bekerle.com>
 * @copyright Patrizio Bekerle 2015
 */

namespace OCA\OwnBackup;

use OCA\OwnBackup\AppInfo\Application;
use OCA\OwnBackup\Controller\AdminController;

$app = new Application();
$container = $app->getContainer();
$response = $container->query(AdminController::class)->index();
return $response->render();