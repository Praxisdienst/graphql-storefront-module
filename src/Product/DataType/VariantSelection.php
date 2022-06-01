<?php

declare(strict_types=1);

namespace OxidEsales\GraphQL\Storefront\Product\DataType;

use OxidEsales\Eshop\Application\Model\Selection as EshopSelectionModel;
use OxidEsales\Eshop\Core\Registry;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

/**
 * @Type()
 */
final class VariantSelection
{
    /** @var EshopSelectionModel */
    private EshopSelectionModel $selection;

    /**
     * Selection constructor.
     */
    public function __construct(EshopSelectionModel $selection)
    {
        $this->selection = $selection;
    }

    /**
     * @Field()
     */
    public function getValue(): string
    {
        return (string) $this->selection->getValue();
    }

    /**
     * @Field()
     */
    public function getName(): string
    {
        return (string) $this->selection->getName();
    }

    /**
     * @Field()
     */
    public function isActive(): bool
    {
        return (bool) $this->selection->isActive();
    }

    /**
     * @Field()
     */
    public function isDisabled(): bool
    {
        return (bool) $this->selection->isDisabled();
    }
}
