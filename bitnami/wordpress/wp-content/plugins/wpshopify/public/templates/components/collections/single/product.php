<?php

/*

@description   Single product on single collection page

@version       1.0.5
@since         1.0.49
@path          templates/components/collections/single/product.php

@docs          https://wpshop.io/docs/templates/collections/single/product

*/

if (!defined('ABSPATH')) {
   exit();
}

use WP_Shopify\DB\Images;
use WP_Shopify\Factories\Money_Factory;
use WP_Shopify\CPT;

$Money = Money_Factory::build();
$image = Images::get_image_details_from_product($data->product);

// Needed for backwards compatibility. post_name is now used since version 1.2.8.
$post_name = CPT::get_post_name($data);
?>

<li
  itemscope
  itemtype="https://schema.org/Offer"
  class="wps-col wps-col-3 wps-collection-single-product">

  <a
    href="<?= apply_filters('wps_products_link', esc_url(home_url() . '/' . $data->settings->url_products . '/' . $post_name), $data->product) ?>"
    class="wps-collections-product-link"
    title="<?php esc_attr_e($data->product->title . ' ' . $data->product->product_id . ' ' . $data->product->product_type, WP_SHOPIFY_PLUGIN_TEXT_DOMAIN); ?>">

    <img
      itemprop="image"
      src="<?= esc_url($image->src) ?>" alt="<?php esc_attr_e($image->alt, WP_SHOPIFY_PLUGIN_TEXT_DOMAIN); ?>" class="wps-products-img" />

    <h2
      itemprop="name"
      class="wps-collections-product-title wps-products-title">
      <?php esc_html_e($data->product->title, WP_SHOPIFY_PLUGIN_TEXT_DOMAIN); ?>
    </h2>

		<?php do_action('wps_product_single_header_price_before', $data->product); ?>

    <h3
			itemprop="offers"
			itemscope
			itemtype="https://schema.org/Offer"
			class="wps-products-price"
			data-wps-is-showing-compare-at="<?= $data->product->show_compare_at ?>"
			data-wps-is-showing-local="<?= $data->product->show_local ?>">

			<?php if (!empty($data->product->variants)) { ?>

				<div class="wps-price-wrapper <?= $data->product->show_local ? 'wps-is-loading-content' : '' ?>">
	      	<?= $Money->format_price($data->product->variants[0]->price, $data->product->product_id) ?>
				</div>

			<?php } ?>

    </h3>

		<?php do_action('wps_product_single_header_price_after', $data->product); ?>

  </a>

</li>
