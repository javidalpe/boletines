<?php


namespace App\Services\Scrapers\StorageStrategy;


use App\Publication;
use App\Services\Scrapers\StorageStrategy\Strategies\DoNotSaveDocumentsStrategy;
use App\Services\Scrapers\StorageStrategy\Strategies\SaveOnS3DocumentsStrategy;
use App\Services\ScrapingService;

class StorageStrategyFactory
{

	/**
	 * @param Publication $publication
	 *
	 * @return IStorageDocumentStrategy
	 */
	public function getStorageStrategyForPublication(Publication $publication) : IStorageDocumentStrategy
	{
		switch ($publication->id)
		{
			case ScrapingService::DIARI_OFICIAL_DE_LA_GENERALITAT_DE_CATALUNYA:
				return new SaveOnS3DocumentsStrategy();
			default:
				return new DoNotSaveDocumentsStrategy();
		}
	}
}