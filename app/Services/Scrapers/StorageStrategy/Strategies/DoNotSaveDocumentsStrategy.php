<?php


namespace App\Services\Scrapers\StorageStrategy\Strategies;


use App\Chunk;
use App\Services\Scrapers\StorageStrategy\IStorageDocumentStrategy;

class DoNotSaveDocumentsStrategy implements IStorageDocumentStrategy
{

	public function fileExists(string $originalUrl): bool
	{
		return Chunk::where('url', $originalUrl)->first() != null;
	}

	public function saveDocument(string $content, string $originalUrl): string
	{
		return $originalUrl;
	}
}