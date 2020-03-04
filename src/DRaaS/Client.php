<?php

namespace UKFast\SDK\DRaaS;

use UKFast\SDK\Client as BaseClient;
use UKFast\SDK\DRaaS\Entities\ComputeResources;

class Client extends BaseClient
{
    protected $basePath = 'draas/';

    /**
     * @return SolutionClient
     */
    public function solutions()
    {
        return (new SolutionClient($this->httpClient))->auth($this->token);
    }

    /**
     * @return ComputeResourcesClient
     */
    public function computeResources()
    {
        return (new ComputeResourcesClient($this->httpClient))->auth($this->token);
    }

    /**
     * @return BackupResourcesClient
     */
    public function backupResources()
    {
        return (new BackupResourcesClient($this->httpClient))->auth($this->token);
    }

    /**
     * @return IopsTiersClient
     */
    public function iops()
    {
        return (new IopsTiersClient($this->httpClient))->auth($this->token);
    }
}
