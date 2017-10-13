<?php


namespace App\Services;


class FileSplitService
{
	const MAX_DOCUMENT_CONTENT_LENGTH = 6500;

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
		$reducedContent = preg_replace('/\\s+/',' ', $trimContent);

		$textLength = strlen($reducedContent);

		if ($textLength < $this->maxChunkLength) {
			return [$reducedContent];
		}

		$chunks = [];
		$remainingContent = $reducedContent;

		$remainingContentLength = strlen($remainingContent);
		while ($remainingContentLength > $this->maxChunkLength) {
			$suggestedChunk = substr($remainingContent,0, $this->maxChunkLength);
			$newLineIndex = strrpos($suggestedChunk, " ");
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