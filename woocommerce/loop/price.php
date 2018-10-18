<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

$origin_attribute = null;
$brand_attribute = null;
foreach ($product->attributes as $attribute) {
    if ($attribute->get_name() === 'pa_origin') {
        $origin_attribute = $attribute;
    }
    if ($attribute->get_name() === 'pa_brand') {
        $brand_attribute = $attribute;
    }
}

$origins = array();
$brands = array();

if ($origin_attribute) {
    foreach ($origin_attribute->get_terms() as $term) {
        $origins[] = $term->name;
    }
}

if ($brand_attribute) {
    foreach ($brand_attribute->get_terms() as $term) {
        $brands[] = $term->name;
    }
}

?>

<table class="aurayonbio__after-item-table">
    <tr>
        <td class="aurayonbio__after-item-table__origin">
            <?php echo implode(', ', $origins) ?>
        </td>
        <td>
            <?php if ( $price_html = $product->get_price_html() ) : ?>
                <span class="price"><?php echo $price_html; ?></span>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td class="aurayonbio__after-item-table__brand">
            <?php echo implode(', ', $brands) ?>
        </td>
        <td>&nbsp;</td>
    </tr>
</table>

