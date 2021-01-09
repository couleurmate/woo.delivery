<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$origin_attribute = null;
$brand_attribute = null;
$unit_weight_attribute = null;

foreach ($product->get_attributes() as $attribute) {
    if ($attribute->get_name() === 'pa_origin') {
        $origin_attribute = $attribute;
    }
    if ($attribute->get_name() === 'pa_brand') {
        $brand_attribute = $attribute;
    }
    if ($attribute->get_name() === 'pa_unit_weight') {
        $unit_weight_attribute = $attribute;
    }
}

$origins = array();
$brands = array();
$weights = array();

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

if ($unit_weight_attribute) {
    foreach ($unit_weight_attribute->get_terms() as $term) {
        $weights[] = $term->name;
    }
}

$price_per_kg = null;

if (count($weights) > 0) {
    $weight = current($weights);
    if (1 === preg_match('/([0-9]+)/', $weight, $matches)) {
        $grams = $matches[1];
        $price_per_kg = ($product->get_price() * 1000) / $grams;
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
        <td class="aurayonbio__after-item-table__price-per-kg">
            <?php if (null !== $price_per_kg) : ?>
                <?php echo wc_price($price_per_kg) ?>/kg
            <?php else : ?>
                &nbsp;
            <?php endif; ?>
        </td>
    </tr>
</table>

