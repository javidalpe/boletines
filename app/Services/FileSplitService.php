<?php


namespace App\Services;


class FileSplitService
{
	const MAX_DOCUMENT_CONTENT_LENGTH = 5000;

	const MIN_DOCUMENT_LENGTH = 5;
	private $maxChunkLength;
	private $minChunkLength;

	/**
	 * FileSplitService constructor.
	 *
	 * @param $maxChunckLength
	 * @param $minChunckLength
	 */
	public function __construct($maxChunckLength = null, $minChunckLength = null)
	{
		$this->maxChunkLength = $maxChunckLength ?? self::MAX_DOCUMENT_CONTENT_LENGTH;
		$this->minChunkLength = $minChunckLength ?? self::MIN_DOCUMENT_LENGTH;
	}


	public function splitDocument($content)
	{
		$trimContent = trim($content);

		$textLength = strlen($trimContent);

		if ($textLength < $this->maxChunkLength) {
			return [$trimContent];
		}

		$chunks = [];
		$remainingContent = $trimContent;

		$remainingContentLength = strlen($remainingContent);
		while ($remainingContentLength > $this->maxChunkLength) {
			$suggestedChunk = substr($remainingContent,0, $this->maxChunkLength);
			$newLineIndex = strrpos($suggestedChunk, "\n");
			if ($newLineIndex) {
				$to = $newLineIndex;
				$from = $newLineIndex + 1;
			} else {
				$to = $this->maxChunkLength;
				$from = $this->maxChunkLength;
			}

			$chunks[] = trim(substr($remainingContent,0, $to));
			$remainingContent = substr($remainingContent, $from);
			$remainingContentLength = strlen($remainingContent);
		}

		if (strlen($remainingContent) >= $this->minChunkLength) {
			$chunks[] = trim($remainingContent);
		}

		return $chunks;
	}
}