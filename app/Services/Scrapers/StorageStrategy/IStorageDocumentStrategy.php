<?php


namespace App\Services\Scrapers\StorageStrategy;


interface IStorageDocumentStrategy
{
	/**
	 * @param $originalUrl
	 *
	 * @return bool
	 */
	public function fileExists(string $originalUrl): bool;

	/**
	 * @param $content
	 * @param $originalUrl
	 *
	 * @return string
	 */
	public function saveDocument(string $content, string $originalUrl): string;
}