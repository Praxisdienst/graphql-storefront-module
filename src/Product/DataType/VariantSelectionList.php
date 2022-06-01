<?php

declare(strict_types=1);

namespace OxidEsales\GraphQL\Storefront\Product\DataType;

use OxidEsales\Eshop\Application\Model\VariantSelectList as EshopVariantSelectionListModel;
use OxidEsales\GraphQL\Storefront\Product\DataType\Selection;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;
use TheCodingMachine\GraphQLite\Types\ID;

/**
 * @Type()
 */
final class VariantSelectionList
{
    /** @var EshopVariantSelectionListModel */
    private EshopVariantSelectionListModel $variantSelectList;

    /**
     * constructor
     */
    public function __construct(EshopVariantSelectionListModel $selectionList)
    {
        $this->variantSelectList = $selectionList;
    }

    /**
     * @Field()
     */
    public function getLabel(): string
    {
        return (string) $this->variantSelectList->getLabel();
    }

    /**
     *  @Field()
     */
    public function getActiveSelection(): ?VariantSelection
    {
        if ($activeSelection = $this->variantSelectList->getActiveSelection()) {
            return new VariantSelection($activeSelection);
        }

        return null;
    }

    /**
     * @Field()
     *
     * @return VariantSelection[]
     */
    public function getFields(): array
    {
        $fields = [];

        foreach ($this->variantSelectList->getSelections() as $field) {
            $fields[] = new VariantSelection($field);
        }

        return $fields;
    }
}
