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

namespace OCA\OwnBackup\Controller;

use OCA\OwnBackup\Service\BackupService;
use OCP\IRequest;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;

class PageController extends Controller {


	private $userId;
	private $backupService;

	public function __construct($AppName, IRequest $request, BackupService $backupService, $UserId){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
		$this->backupService = $backupService;
	}

	/**
	 * @NoCSRFRequired
	 */
	public function index() {
		$timestampList = $this->backupService->fetchBackupTimestamps();

		$dateTimeFormater = \OC::$server->query('DateTimeFormatter');
		$dateHash = [];
		foreach( $timestampList as $timestamp )
		{
			$dateHash[$timestamp] = $dateTimeFormater->formatDateTime( $timestamp );
		}

		$params = [
			'backupDateHash' => $dateHash
		];

		return new TemplateResponse('ownbackup', 'main', $params);  // templates/main.php
	}

	/**
	 * Restores tables of array $tables
	 *
	 * @param array $tables
	 * @return DataResponse
	 */
	public function doRestoreTables( array $tables )
	{
		// TODO: implement restoring of tables

		$message = "Sent tables: " . count( $tables );
		return new DataResponse(['message' => $message]);
	}

	/**
	 * Fetches the backup table names of a timestamp
	 *
	 * @param int $timestamp
	 * @return DataResponse
	 */
	public function doFetchTables( $timestamp )
	{
		$tableList = $this->backupService->fetchTablesFromBackupTimestamp( $timestamp );
		return new DataResponse(['tables' => $tableList]);
	}


}