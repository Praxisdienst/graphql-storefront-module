<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\GraphQL\Storefront\Product\DataType;

use OxidEsales\Eshop\Core\Model\BaseModel as EshopBaseModel;
use OxidEsales\GraphQL\Base\DataType\ShopModelAwareInterface;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

/**
 * @Type()
 */
final class ProductScalePrice implements ShopModelAwareInterface
{
    /** @var EshopBaseModel */
    private $scalePrice;

    public function __construct(
        EshopBaseModel $scalePrice
    ) {
        $this->scalePrice = $scalePrice;
    }

    public function getEshopModel(): EshopBaseModel
    {
        return $this->scalePrice;
    }

    /**
     * Whether the scale price is
     * - a new absolute price (you can query that in the `absolutePrice` field)
     * - or a percentage discount (you can query that in the `discount` field)
     *
     * @Field()
     */
    public function isAbsoluteScalePrice(): bool
    {
        return $this->getAbsolutePrice() !== null;
    }

    /**
     * @Field()
     */
    public function getAbsolutePrice(): ?float
    {
        $price = (float) $this->scalePrice->getRawFieldData('oxaddabs');

        if ($price === 0.0) {
            return null;
        }

        return $price;
    }

    /**
     * @Field
     */
    public function getDiscount(): ?float
    {
        $percentage = (float) $this->scalePrice->getRawFieldData('oxaddperc');

        if ($percentage === 0.0) {
            return null;
        }

        return $percentage;
    }

    /**
     * @Field()
     */
    public function getAmountFrom(): int
    {
        return (int) $this->scalePrice->getRawFieldData('oxamount');
    }

    /**
     * @Field()
     */
    public function getAmountTo(): int
    {
        return (int) $this->scalePrice->getRawFieldData('oxamountto');
    }

    /**
     * @return class-string
     */
    public static function getModelClass(): string
    {
        return EshopBaseModel::class;
    }
}
