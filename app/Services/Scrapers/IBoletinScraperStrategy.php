<?php


namespace App\Services\Scrapers;


interface IBoletinScraperStrategy
{
    public function downloadFilesFromInternet();

    public function getFiles();
}