<?php namespace GeneaLabs\LaravelModelCaching\Traits;

trait CachePrefixing
{
    protected function getCachePrefix() : string
    {
        return "genealabs:laravel-model-caching:"
            . $this->getDatabaseConnectionName() . ":"
            . $this->getDatabaseName() . ":"
            . (config("laravel-model-caching.cache-prefix")
                ? config("laravel-model-caching.cache-prefix", "") . ":"
                : "");
    }

    protected function getDatabaseConnectionName() : string
    {
        return $this->query->connection->getName();
    }

    protected function getDatabaseName() : string
    {
        if ($this->query->connection instanceof \Jenssegers\Mongodb\Connection) {
            return $this->query->connection->getMongoDB()->getDatabaseName();
        }

        return $this->query->connection->getDatabaseName();
    }
}
