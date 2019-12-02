<?php

namespace UKFast\SDK\eCloud;

use UKFast\SDK\eCloud\Entities\Appliance;
use UKFast\SDK\eCloud\Entities\ApplianceVersion;
use UKFast\SDK\eCloud\Entities\Appliance\Version\Data;
use UKFast\SDK\Page;

class ApplianceClient extends Client
{
    const MAP = [
        'id' => 'id',
        'name' => 'name',
        'logo_uri' => 'logoUri',
        'description' => 'description',
        'documentation_uri' => 'documentationUri',
        'publisher' => 'publisher',
        'created_at' => 'createdAt',
    ];

    /**
     * Gets a paginated response of Pods
     *
     * @param int $page
     * @param int $perPage
     * @param array $filters
     * @return Page
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPage($page = 1, $perPage = 15, $filters = [])
    {
        $filters = $this->friendlyToApi($filters, self::MAP);
        $page = $this->paginatedRequest('v1/appliances', $page, $perPage, $filters);
        $page->serializeWith(function ($item) {
            return new Appliance($item);
        });
        return $page;
    }

    /**
     * Gets an individual Pod
     *
     * @param int $id
     * @return Appliance
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getById($id)
    {
        $response = $this->get('v1/appliances/' . $id);
        $body = $this->decodeJson($response->getBody()->getContents());
        return new Appliance($body->data);
    }

    /**
     * Gets the latest appliance version
     *
     * @param int $id
     * @return ApplianceVersion
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getVersion($id)
    {
        $response = $this->get('v1/appliances/' . $id . '/version');
        $body = $this->decodeJson($response->getBody()->getContents());
        return new ApplianceVersion($body->data);
    }

    /**
     * Gets the latest appliance version data
     *
     * @param int $id
     * @return Data
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getData($id)
    {
        $response = $this->get('v1/appliances/' . $id . '/data');
        $body = $this->decodeJson($response->getBody()->getContents());
        return new Data($body->data);
    }
}
