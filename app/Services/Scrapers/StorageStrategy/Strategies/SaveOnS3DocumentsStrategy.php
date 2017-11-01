<?php

namespace App\Services\Scrapers\StorageStrategy\Strategies;


use App\Chunk;
use App\Services\Scrapers\StorageStrategy\IStorageDocumentStrategy;
use App\Services\ScrapingService;
use Carbon\Carbon;
use Storage;

class SaveOnS3DocumentsStrategy implements IStorageDocumentStrategy
{
	const DOCUMENTS_STORAGE_DIRECTORY = 'documents';
	const URL_HASH_FUNCTION = 'md5';

	public function fileExists(string $originalUrl): bool
	{
		$storePath = $this->getStorePathForUrl($originalUrl);
		$fullUrlPath = $this->getFullUrlPath($storePath);

		return Chunk::where('url', $fullUrlPath)->first() != null;
	}

	public function saveDocument(string $content, string $originalUrl): string
	{
		$storePath = $this->getStorePathForUrl($originalUrl);
		Storage::disk('s3')->put($storePath, $content);

		return $this->getFullUrlPath($storePath);
	}

	private function getStorePathForUrl($originUrl)
	{
		$hash = $this->hashUrl($originUrl);
		$dateString = (Carbon::now())->format('Ymd');
		$directory = self::DOCUMENTS_STORAGE_DIRECTORY;
		$extension = ScrapingService::PDF_EXTENSION;

		return sprintf('%s/%s-%s.%s', $directory, $hash, $dateString, $extension);

	}

	/**
	 * @param $url
	 *
	 * @return string
	 */
	private function hashUrl($url): string
	{
		return hash(self::URL_HASH_FUNCTION, $url);
	}

	/**
	 * @param $storePath
	 *
	 * @return string
	 */
	private function getFullUrlPath($storePath): string
	{
		return Storage::disk('s3')->url($storePath);
	}
}