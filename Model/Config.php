<?php
/**
 * Copyright © Magefan (support@magefan.com). All rights reserved.
 * Please visit Magefan.com for license details (https://magefan.com/end-user-license-agreement).
 */

declare(strict_types=1);

namespace Magefan\GoogleTagManager\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    /**
     * General config
     */
    public const XML_PATH_EXTENSION_ENABLED = 'mfgoogletagmanager/general/enabled';
    public const XML_PATH_ACCOUNT_ID = 'mfgoogletagmanager/general/account_id';
    public const XML_PATH_CONTAINER_ID = 'mfgoogletagmanager/general/container_id';
    public const XML_PATH_PUBLIC_ID = 'mfgoogletagmanager/general/public_id';

    /**
     * Analytics config
     */
    public const  XML_PATH_ANALYTICS_ENABLE = 'mfgoogletagmanager/analytics/enable';
    public const  XML_PATH_ANALYTICS_MEASUREMENT_ID = 'mfgoogletagmanager/analytics/measurement_id';

    /**
     * Product attributes config
     */
    public const XML_PATH_ATTRIBUTES_PRODUCT = 'mfgoogletagmanager/attributes/product';
    public const XML_PATH_ATTRIBUTES_BRAND = 'mfgoogletagmanager/attributes/brand';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * Config constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Retrieve true if module is enabled
     *
     * @param string|null $storeId
     * @return bool
     */
    public function isEnabled(string $storeId = null): bool
    {
        return $this->getConfig(self::XML_PATH_EXTENSION_ENABLED, $storeId) &&
            $this->getPublicId($storeId);
    }

    /**
     * Retrieve GTM account ID
     *
     * @param string|null $storeId
     * @return string
     */
    public function getAccountId(string $storeId = null): string
    {
        return (string)$this->getConfig(self::XML_PATH_ACCOUNT_ID, $storeId);
    }

    /**
     * Retrieve GTM container ID
     *
     * @param string|null $storeId
     * @return string
     */
    public function getContainerId(string $storeId = null): string
    {
        return (string)$this->getConfig(self::XML_PATH_CONTAINER_ID, $storeId);
    }

    /**
     * Retrieve GTM public ID
     *
     * @param string|null $storeId
     * @return string
     */
    public function getPublicId(string $storeId = null): string
    {
        return (string)$this->getConfig(self::XML_PATH_PUBLIC_ID, $storeId);
    }

    /**
     * Retrieve true if analytics enabled
     *
     * @param string|null $storeId
     * @return bool
     */
    public function isAnalyticsEnabled(string $storeId = null): bool
    {
        return (bool)$this->getConfig(self::XML_PATH_ANALYTICS_ENABLE, $storeId);
    }

    /**
     * Retrieve Google Analytics measurement ID
     *
     * @param string|null $storeId
     * @return string
     */
    public function getMeasurementId(string $storeId = null): string
    {
        return (string)$this->getConfig(self::XML_PATH_ANALYTICS_MEASUREMENT_ID, $storeId);
    }

    /**
     * Retrieve Magento product attribute
     *
     * @param string|null $storeId
     * @return string
     */
    public function getProductAttribute(string $storeId = null): string
    {
        return (string)$this->getConfig(self::XML_PATH_ATTRIBUTES_PRODUCT, $storeId);
    }

    /**
     * Retrieve Magento product brand attribute
     *
     * @param string|null $storeId
     * @return string
     */
    public function getBrandAttribute(string $storeId = null): string
    {
        return (string)$this->getConfig(self::XML_PATH_ATTRIBUTES_BRAND, $storeId);
    }

    /**
     * Retrieve store config value
     *
     * @param string $path
     * @param string|null $storeId
     * @return mixed
     */
    public function getConfig(string $path, string $storeId = null)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE, $storeId);
    }
}
