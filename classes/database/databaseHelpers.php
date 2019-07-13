<?php


interface databaseHelpers
{
    public function __construct();
    public function getData(string $query ,array $parameters = []);
    public function setData(string $query ,array $parameters = []);
    public function getDataAsObject(string $query ,array $parameters = []);
}