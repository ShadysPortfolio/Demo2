<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly. 
/**
 *
 * Options, Metabox, Taxonomy
 * 
 * @author Codevz
 * @link http://codevz.com/
 *
 */
if ( ! class_exists( 'Codevz_Options' ) ) {
	class Codevz_Options extends Codevz {

		// SK switcher
		public static $sk_advanced;

		public function __construct() {

			// Advanced SK switcher
			self::$sk_advanced = '<div class="cz_advanced_tab"><span class="cz_s cz_active">' . esc_html__( 'Simple', 'xtra' ) . '</span><span class="cz_a">' . esc_html__( 'Advanced', 'xtra' ) . '</span></div>';

			// Options & Metabox
			if ( class_exists( 'CSF' ) ) {
				CSF_Customize::instance( self::options(), Codevz::$options_id );
				CSF_Metabox::instance( self::metabox() );

				// Taxonomy Meta
				$tax_meta = array();
				foreach ( self::post_types( array( 'post' ) ) as $cpt ) {
					$tax_meta[] = array(
						'id'       => 'codevz_cat_meta',
						'taxonomy' => ( $cpt === 'post' ) ? 'category' : $cpt . '_cat',
						'fields'   => array(
							array(
							  'id'    => 'color',
							  'type'  => 'color_picker',
							  'title' => esc_html__( 'Color Scheme', 'xtra' )
							)
						)
					);
				}
				CSF_Taxonomy::instance( $tax_meta );
			}

			// Save customize settings
			add_action( 'customize_save_after', array( __CLASS__, 'codevz_customize_save_after' ) );

			// Enqueue inline styles
			if ( ! isset( $_POST['vc_inline'] ) ) {
				add_action( 'wp_enqueue_scripts', function() {
					$handle = wp_style_is( 'codevz-plugin' ) ? 'codevz-plugin' : 'codevz-style';
					$extra_css = '';

					// Woocommerce
					if ( function_exists( 'is_woocommerce' ) ) {
						$extra_css .= "/* Woo */" . '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{text-align: center}.woo-col-2.woocommerce ul.products li.product, .woo-col-2.woocommerce-page ul.products li.product, .woo-related-col-2.woocommerce ul.products .related li.product, .woo-related-col-2.woocommerce-page ul.products .related li.product {width: 48.05%}.woo-col-3.woocommerce ul.products li.product, .woo-col-3.woocommerce-page ul.products li.product, .woo-related-col-3.woocommerce ul.products .related li.product, .woo-related-col-3.woocommerce-page ul.products .related li.product {width: calc(100% / 3 - 2.6%)}.woo-col-5.woocommerce ul.products li.product, .woo-col-5.woocommerce-page ul.products li.product {width: calc(100% / 5 - 3.2%)}.woo-col-6.woocommerce ul.products li.product, .woo-col-6.woocommerce-page ul.products li.product {width: calc(100% / 6 - 3.2%)}.woocommerce-error, .woocommerce-info, .woocommerce-message {line-height: 2.6}.rtl .woocommerce-error,.rtl .woocommerce-info,.rtl .woocommerce-message{padding:15px 70px !important;margin:0 0 30px !important}.quantity{position:relative}input[type=number]::-webkit-inner-spin-button,input[type=number]::-webkit-outer-spin-button{-webkit-appearance:none;margin:0}input[type=number]{-moz-appearance:textfield}.quantity input{width:45px;height:42px;line-height:1.65;float:left;display:block;padding:0;margin:0;padding-left:20px;border:1px solid rgba(167, 167, 167, 0.3)}.quantity input:focus{outline:0}.quantity-nav{float:left;position:relative;height:41px;margin:0 0 0 -11px}.rtl .quantity-nav{float:left;margin:0 0 0 25px}.quantity-button{position:relative;cursor:pointer;border-left:1px solid rgba(167, 167, 167, 0.3);width:25px;text-align:center;color:inherit;font-size:14px;line-height:1.5;transform:translateX(-100%)}.quantity-button.quantity-up{position:absolute;height:50%;top:0;border-bottom:1px solid rgba(167, 167, 167, 0.3)}.quantity-button.quantity-down{position:absolute;bottom:-1px;height:50%}.woocommerce .quantity .qty {margin:0 10px 0 0;padding: 10px 16px !important;width: 80px;text-align:left}.rtl .woocommerce .quantity .qty{margin:0 0 0 10px}.woocommerce-Tabs-panel h2 {display: none !important}.woocommerce-checkout #payment ul.payment_methods li img{display:inline-block}.woocommerce nav.woocommerce-pagination ul li{border: 0 !important}.woocommerce a.remove{border-radius:2px}.cross-sells{display: none}.post-type-archive-product h1.page-title,.woocommerce #comments.content{display:none}.woocommerce ul.products li.product .star-rating{margin: 10px auto 0}.outofstock .button{display: none !important}#order_review_heading{margin:30px 0 20px}.woocommerce .woocommerce-ordering,.woocommerce .woocommerce-result-count{box-sizing:border-box;margin:0 0 2em}.woocommerce span.onsale,.woocommerce ul.products li.product .onsale{z-index:9;background:#fff;border-radius:100%;display:inline-block;padding:0;position:absolute;top:20px;left:20px;right:auto;margin:0;color:initial;line-height:4em;width:4em;height:4em;font-size:16px;font-weight:600;min-height:initial;box-shadow:0 0 30px rgba(17,17,17,.06)}.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span{line-height: 3em}.woocommerce ul.products li.product .button{margin: 20px auto 0;display:table}.woocommerce ul.products li.product .button:before{font-family:FontAwesome;content:"\f07a";position:static;transform:initial;display:inline;background:none !important;margin-right:10px}.woocommerce ul.products li.product .button.loading:after{margin-top:3px}.woocommerce a.added_to_cart{position:absolute;bottom:-28px;left:50%;margin:0;font-size:12px;transform:translateX(-50%);letter-spacing:2px}.woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce ul.products li.product h3 {font-size:22px}.woocommerce ul.products li.product:hover .button{opacity:1}.woocommerce ul.products li.product .price{background:#fff;border-radius:30px;display:inline-block;padding:4px 16px;position:absolute;top:20px;right:20px;color:#262626;font-weight:bold}.woocommerce ul.products li.product .price del{font-size:.7em;display:inline-block}.woocommerce .product_meta{font-size:13px}.woocommerce div.product form.cart,.woocommerce div.product p.cart{margin:2em 0}.woocommerce ul.products li.product h3{font-size:16px;width:85%}.woocommerce div.product .woocommerce-tabs .panel{padding:30px;border:1px solid rgba(167,167,167,.2);border-radius:0 2px 2px}.woocommerce div.product .woocommerce-tabs ul.tabs{padding:0 0 0 5px;margin:0 0 -1px}.woocommerce div.product .woocommerce-tabs ul.tabs li{opacity:.6;border:1px solid rgba(167,167,167,.2);background: rgba(167, 167, 167, 0.1);border-radius:2px 2px 0 0;border-bottom:0}.woocommerce div.product .woocommerce-tabs ul.tabs li.active{opacity:1}.woocommerce div.product .woocommerce-tabs ul.tabs:before,.woocommerce nav.woocommerce-pagination ul{border:0}.woocommerce div.product .woocommerce-tabs ul.tabs li.active:after,.woocommerce div.product .woocommerce-tabs ul.tabs li.active:before{box-shadow:none;display:none}.woocommerce table.shop_table td{padding:16px 20px}.woocommerce table.shop_table th{padding: 20px}#add_payment_method #payment,.woocommerce-cart #payment,.woocommerce-checkout #payment{background:0 0;padding:10px}#add_payment_method #payment ul.payment_methods,.woocommerce-cart #payment ul.payment_methods,.woocommerce-checkout #payment ul.payment_methods{border-bottom:1px solid rgba(167,167,167,.2)}.woocommerce-error,.woocommerce-info,.woocommerce-message{background-color:rgba(167,167,167,.1);border:0}td.product-subtotal,td.product-total,tr.cart-subtotal td{font-size:14px}tr.order-total td{font-size:18px;font-weight:700}.woocommerce ul.products li.product .price ins{text-decoration:none}.woocommerce nav.woocommerce-pagination ul li a:focus,.woocommerce nav.woocommerce-pagination ul li a:hover,.woocommerce nav.woocommerce-pagination ul li span.current{color:#fff !important}.woocommerce nav.woocommerce-pagination ul li span.current{border:0}.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span {font-size: 14px !important}#add_payment_method .cart-collaterals .cart_totals table td,#add_payment_method .cart-collaterals .cart_totals table th,.woocommerce-cart .cart-collaterals .cart_totals table td,.woocommerce-cart .cart-collaterals .cart_totals table th,.woocommerce-checkout .cart-collaterals .cart_totals table td,.woocommerce-checkout .cart-collaterals .cart_totals table th{vertical-align:middle}#add_payment_method #payment,.woocommerce form.checkout_coupon,.woocommerce form.login,.woocommerce form.register,.woocommerce-cart #payment,.woocommerce-checkout #payment{border:1px solid rgba(167,167,167,.2);border-radius:0}.woocommerce #coupon_code{padding:12px;width:auto}.woocommerce p #coupon_code{width:100%!important}.woocommerce input.button:disabled,.woocommerce input.button:disabled[disabled]{color:#fff}.woocommerce input.button{padding:12px 30px}#add_payment_method #payment div.payment_box,.woocommerce-cart #payment div.payment_box,.woocommerce-checkout #payment div.payment_box{background-color:rgba(167,167,167,.1)}#add_payment_method #payment div.payment_box:before,.woocommerce-cart #payment div.payment_box:before,.woocommerce-checkout #payment div.payment_box:before{top:-14px;border-bottom-color:rgba(167,167,167,.1)}.woocommerce-thankyou-order-received{font-size:20px;background:#eafff1;color:#17ac4d;padding:20px;border-radius:2px}.woocommerce .product_title{font-size:30px}.woocommerce-product-rating{font-size:12px}.woocommerce ul.order_details li {line-height: 3;margin-right: 3em}.calculated_shipping h2 {font-size: 24px;margin: 0 0 20px;opacity: .4}.related.products li{margin-bottom:0!important}#add_payment_method #payment ul.payment_methods li input,.woocommerce form .form-row .input-checkbox,.woocommerce-cart #payment ul.payment_methods li input,.woocommerce-checkout #payment ul.payment_methods li input{width:auto;display:inline-block}#payment label{display:inline}.about_paypal{margin:0 10px}.showcoupon{font-weight:900}.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current {background: #353535;color: #8a7e88}.woocommerce-MyAccount-navigation ul {list-style-type: none;margin: 0}.woocommerce-MyAccount-navigation ul {list-style-type: none;margin: 0}.woocommerce-MyAccount-navigation a, .woocommerce-account .addresses .title .edit, .woocommerce-account ul.digital-downloads li .count {padding: 10px 20px;display: block;background: rgba(167, 167, 167, 0.06);margin: 0 20px 6px 0;border-radius: 2px}.woocommerce-MyAccount-navigation a:hover, .woocommerce-MyAccount-navigation .is-active a {background: rgba(167, 167, 167, 0.2);color: #fff}.edit-account .input.woocommerce-Button.button {margin: 20px 0 0}.woocommerce ul.product_list_widget li img {float: left;margin: 0 20px 0 0;width: 80px}.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content{background-color: #e9e9e9}.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle{background-color:#a7a7a7}.woocommerce div.product div.images .woocommerce-product-gallery__image:nth-child(n+2){width: calc(20% - 10px)}#comments .commentlist li .avatar{padding: 0 !important;border-radius: 100% !important;width: 40px !important;box-shadow: 1px 10px 10px rgba(167, 167, 167, 0.3) !important;border:0 !important;top:25px !important;left:20px !important}.woocommerce #reviews #comments ol.commentlist li .comment-text {padding: 30px !important}.woocommerce table.shop_table td, .woocommerce-cart .cart-collaterals .cart_totals tr th {border-top: 1px solid rgba(167, 167, 167, 0.2) !important}.product_meta a{font-weight:bold;background:rgba(167, 167, 167, 0.12);padding:0px 8px;border-radius:2px;margin:4px 0;display:inline-block}span.tagged_as{display:block}#add_payment_method table.cart img, .woocommerce-cart table.cart img,.woocommerce-checkout table.cart img{width:80px !important}.cart_totals h2,.woocommerce-additional-fields > h3,.woocommerce-billing-fields > h3,#order_review_heading{font-size:24px;padding:0 0 0 2px}.woocommerce-review-link{display:none}.woocommerce ul.products li.product .woocommerce-loop-product__link{display:block}label.woocommerce-form__label.woocommerce-form__label-for-checkbox.inline{margin: 0 20px}from.woocommerce-product-search input{float: left;width: 61%;margin-right: 5%}from.woocommerce-product-search button{width: 34%;padding: 12px 0}.woocommerce div.product .woocommerce-tabs ul.tabs li.active a{color: #111}.rtl ul.products li.product .button:before{margin-left:10px !important}.comment-form-rating p:nth-child(3){display:none !important}.woocommerce ul.products li.product a img{max-width: 100% !important;max-height: 100% !important}.woocommerce #respond input#submit.added::after, .woocommerce a.button.added::after, .woocommerce button.button.added::after, .woocommerce input.button.added::after{vertical-align: middle}.rtl .woocommerce div.product form.cart div.quantity{margin:0 -25px 0 20px}.rtl .woocommerce-product-gallery{direction:ltr}.pswp__ui{width:100%;height:100%}.pswp__button--arrow--left, .pswp__button--arrow--right{position:absolute !important}.woocommerce div.product div.images .flex-control-thumbs li{width: calc(100% / 4 - 10px);margin: 20px 5px}';
					}

					// DWQA
					if ( function_exists( 'dwqa' ) ) {
						$extra_css .= "/* DWQA */" . '.dwqa-questions-list {border: 1px solid #ebebeb;margin: 30px 0 0;border-radius: 10px}.dwqa-questions-list .dwqa-question-item {border: 0;border-bottom: 1px solid #ebebeb}.dwqa-questions-list .dwqa-question-item .dwqa-question-stats{margin-top:-24px;right:14px}.dwqa-questions-list .dwqa-question-item .dwqa-question-stats span {margin-top: -4px;min-width: 40px;height: 50px;border: 1px solid #ebebeb;border-radius: 10px;padding: 5px 10px 0;color: #868686}.dwqa-question-filter a {opacity: .6;margin: 0 20px 0 0}.dwqa-question-filter a.active{opacity:1;font-weight:bold}.wp-core-ui .button-group.button-small .button, .wp-core-ui .button.button-small {display: none;width: auto}.wp-switch-editor {cursor: pointer;opacity: .6;margin: 10px 10px 0 0 !important;padding: 0 2px !important;background: none !important;color: #111 !important}.html-active.wp-core-ui .button{display:inline-block !important;margin: 2px}.tmce-active .switch-tmce, .html-active .switch-html{opacity: 1;font-weight: bold}.mce-panel{border: 0 solid rgba(165, 165, 165, 0.2) !important;background-color: #f9f9f9 !important}.dwqa-container p:first-child {margin-bottom: 40px !important}label[for="question_title"]{font-size:20px;font-weight: 500}#wp-question-content-wrap {position: relative}.wp-editor-tabs {position: absolute;right: 0;z-index: 2;top: 0}.dwqa-captcha:before {content:"";clear: both;width: 100%;display: block}.dwqa-captcha {display: block;width: 100%}.dwqa-questions-list .dwqa-question-meta span{opacity: .7}.dwqa-status{opacity: 1 !important}.dwqa-question-title{font-size:18px;font-weight: 500}.dwqa-questions-list .dwqa-question-item .avatar{vertical-align: middle}.dwqa-question-footer .dwqa-question-status{font-size: 0}.dwqa-answers-title{margin:40px 0 10px;font-weight:500;font-size:18px}.dwqa-container p,.quicktags-toolbar{text-align:left}.single-dwqa-question .dwqa-container p{margin:0 0 30px !important;line-height:40px;font-size:18px}.single-dwqa-question .dwqa-container p:last-child{margin-bottom:0 !important}.single-dwqa-question .dwqa-question-item a,.dwqa-answer-item .dwqa-answer-meta a{text-transform: capitalize}.single .dwqa-question-footer {margin-bottom:-10px;margin-top:30px;opacity: .8}.dwqa-answer-form-title{padding:20px 0 14px;font-size:18px;font-weight:500;border:0}.single-dwqa-question .dwqa-question-item, .single-dwqa-question .dwqa-answer-item {background: rgba(167, 167, 167, 0.03);padding: 30px !important;border: 1px solid #ebebeb;border-radius: 10px;margin:0 0 20px 68px}.dwqa-answers-title, .dwqa_delete_question, .dwqa_delete_answer{display: none}.single-dwqa-question .dwqa-question-vote,.single-dwqa-question .dwqa-answer-vote {top: 90px;left:-62px}.single-dwqa-question .dwqa-question-item .avatar,.single-dwqa-question .dwqa-answer-item .avatar {left:-70px;top: 20px;max-width:48px !important}.dwqa-questions-list .dwqa-question-item .avatar{max-width:48px !important}.single-dwqa-question .dwqa-pick-best-answer{left:-64px}.dwqa-question-item .dwqa-status-closed {background: #222 !important;box-shadow:none !important}.dwqa-question-item .dwqa-status-answered, .dwqa-staff {background: #4e71fe !important;box-shadow:none !important}.dwqa-question-item .dwqa-status-open {background: #e67e22 !important;box-shadow:none !important}.dwqa-question-item .dwqa-status-resolved {background: #00cc47 !important;box-shadow:none !important}.dwqa-question-item .dwqa-status-closed:after,.dwqa-question-item .dwqa-status-answered:after,.dwqa-question-item .dwqa-status-open:after,.dwqa-question-item .dwqa-status-resolved:after{color: #fff !important}.dwqa-question-content, .dwqa-answer-content{padding: 0 40px 0 0}.single-dwqa-question .dwqa-question-item,.dwqa-answer-item{min-height:initial !important}.dwqa-ask-question a{padding: 6px 30px !important;font-size: 14px !important}.dwqa-pagination a, .dwqa-pagination span {padding: 1px 12px;border: 1px solid #ebebeb;margin: 30px 2px 0;border-radius: 4px}span.dwqa-page-numbers.dwqa-current{opacity: .6}.dwqa-search .dwqa-autocomplete{box-shadow: 1px 8px 32px rgba(17, 17, 17, 0.12);border-radius:20px;overflow:hidden}.dwqa-search .dwqa-autocomplete li{border-bottom: 1px solid rgba(221, 221, 221, 0.4)}';
					}

					// Dark
					if ( Codevz::option( 'dark' ) ) {
						$extra_css .= "/* Dark */" . 'body{background-color:#222;color:#fff}.layout_1{background:#191919}a,.woocommerce-error, .woocommerce-info, .woocommerce-message{color:#fff}input,textarea,select,.nice-select{color: #000}.sf-menu li li a,.sf-menu .cz > h6{color: #000}.cz_quote_arrow blockquote{background:#272727}.search_style_icon_dropdown .outer_search, .cz_cart_items {background: #000;color: #c0c0c0 !important}.woocommerce div.product .woocommerce-tabs ul.tabs li.active a {color: #111}#bbpress-forums li{background:none!important}#bbpress-forums li.bbp-header,#bbpress-forums li.bbp-header,#bbpress-forums li.bbp-footer{background:#141414!important;color:#FFF;padding:10px 20px!important}.bbp-header a{color:#fff}.subscription-toggle,.favorite-toggle{padding: 1px 20px !important;}span#subscription-toggle{color: #000}#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a{background:#1D1E20!important;color:#FFF;opacity:1}#bbpress-forums li.bbp-body ul.forum,#bbpress-forums li.bbp-body ul.topic{padding:10px 20px!important}.bbp-search-form{margin:0 0 12px!important}.bbp-form .submit{margin:0 auto 20px}div.bbp-breadcrumb,div.bbp-topic-tags{line-height:36px}.bbp-breadcrumb-sep{padding:0 6px}#bbpress-forums li.bbp-header ul{font-size:14px}.bbp-forum-title,#bbpress-forums .bbp-topic-title .bbp-topic-permalink{font-size:16px;font-weight:700}#bbpress-forums .bbp-topic-started-by{display:inline-block}#bbpress-forums p.bbp-topic-meta a{margin:0 4px 0 0;display:inline-block}#bbpress-forums p.bbp-topic-meta img.avatar,#bbpress-forums ul.bbp-reply-revision-log img.avatar,#bbpress-forums ul.bbp-topic-revision-log img.avatar,#bbpress-forums div.bbp-template-notice img.avatar,#bbpress-forums .widget_display_topics img.avatar,#bbpress-forums .widget_display_replies img.avatar{margin-bottom:-2px;border:0}span.bbp-admin-links{color:#4F4F4F}span.bbp-admin-links a{color:#7C7C7C}.bbp-topic-revision-log-item *{display:inline-block}#bbpress-forums .bbp-topic-content ul.bbp-topic-revision-log,#bbpress-forums .bbp-reply-content ul.bbp-topic-revision-log,#bbpress-forums .bbp-reply-content ul.bbp-reply-revision-log{border-top:1px dotted #474747;padding:10px 0 0;color:#888282}.bbp-topics,.bbp-replies,.topic{position:relative}#subscription-toggle,#favorite-toggle{float:right;line-height:34px;color:#DFDFDF;display:block;border:1px solid #DFDFDF;padding:0;margin:0;font-size:12px;border:0!important}.bbp-user-subscriptions #subscription-toggle,.bbp-user-favorites #favorite-toggle{position:absolute;top:0;right:0;line-height:20px}.bbp-reply-author br{display:none}#bbpress-forums li{text-align:left}li.bbp-forum-freshness,li.bbp-topic-freshness{width:23%}.bbp-topics-front ul.super-sticky,.bbp-topics ul.super-sticky,.bbp-topics ul.sticky,.bbp-forum-content ul.sticky{background-color:#2C2C2C!important;border-radius:0!important;font-size:1.1em}#bbpress-forums div.odd,#bbpress-forums ul.odd{background-color:#0D0D0D!important}div.bbp-template-notice a{display:inline-block}div.bbp-template-notice a:first-child,div.bbp-template-notice a:last-child{display:inline-block}#bbp_topic_title,#bbp_topic_tags{width:400px}#bbp_stick_topic_select,#bbp_topic_status_select,#display_name{width:200px}#bbpress-forums #bbp-your-profile fieldset span.description{color:#FFF;border:#353535 1px solid;background-color:#222!important;margin:16px 0}#bbpress-forums fieldset.bbp-form{margin-bottom:40px}.bbp-form .quicktags-toolbar{border:1px solid #EBEBEB}.bbp-form .bbp-the-content,#bbpress-forums #description{border-width:1px!important;height:200px!important}#bbpress-forums #bbp-single-user-details{width:100%;float:none;border-bottom:1px solid #080808;box-shadow:0 1px 0 rgba(34,34,34,0.8);margin:0 0 20px;padding:0 0 20px}#bbpress-forums #bbp-user-wrapper h2.entry-title{margin:-2px 0 20px;display:inline-block;border-bottom:1px solid #FF0078}#bbpress-forums #bbp-single-user-details #bbp-user-navigation a{padding:2px 8px}#bbpress-forums #bbp-single-user-details #bbp-user-navigation{display:inline-block}#bbpress-forums #bbp-user-body,.bbp-user-section p{margin:0}.bbp-user-section{margin:0 0 30px}#bbpress-forums #bbp-single-user-details #bbp-user-avatar{margin:0 20px 0 0;width:auto;display:inline-block}#bbpress-forums div.bbp-the-content-wrapper input{width:auto!important}input#bbp_topic_subscription{width:auto;display:inline-block;vertical-align:-webkit-baseline-middle}.widget_display_replies a,.widget_display_topics a{display:inline-block}.widget_display_replies li,.widget_display_forums li,.widget_display_views li,.widget_display_topics li{display:block;border-bottom:1px solid #282828;line-height:32px;position:relative}.widget_display_replies li div,.widget_display_topics li div{font-size:11px}.widget_display_stats dt{display:block;border-bottom:1px solid #282828;line-height:32px;position:relative}.widget_display_stats dd{float:right;margin:-40px 0 0;color:#5F5F5F}#bbpress-forums div.bbp-topic-content code,#bbpress-forums div.bbp-reply-content code,#bbpress-forums div.bbp-topic-content pre,#bbpress-forums div.bbp-reply-content pre{background-color:#FFF;padding:12px 20px;max-width:96%;margin-top:0}#bbpress-forums div.bbp-forum-author img.avatar,#bbpress-forums div.bbp-topic-author img.avatar,#bbpress-forums div.bbp-reply-author img.avatar{border-radius:100%}#bbpress-forums li.bbp-header,#bbpress-forums li.bbp-footer,#bbpress-forums li.bbp-body ul.forum,#bbpress-forums li.bbp-body ul.topic,div.bbp-forum-header,div.bbp-topic-header,div.bbp-reply-header{border-top:1px solid #252525!important}#bbpress-forums ul.bbp-lead-topic,#bbpress-forums ul.bbp-topics,#bbpress-forums ul.bbp-forums,#bbpress-forums ul.bbp-replies,#bbpress-forums ul.bbp-search-results,#bbpress-forums fieldset.bbp-form,#subscription-toggle,#favorite-toggle{border:1px solid #252525!important}#bbpress-forums div.bbp-forum-header,#bbpress-forums div.bbp-topic-header,#bbpress-forums div.bbp-reply-header{background-color:#1A1A1A!important}#bbpress-forums div.even,#bbpress-forums ul.even{background-color:#161616!important}.bbp-view-title{display:block}div.fixed_contact,i.backtotop,i.fixed_contact,.ajax_search_results{background:#151515}.nice-select{background-color:#fff;color:#000}.nice-select .list{background:#fff}.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,.woocommerce div.product .woocommerce-tabs ul.tabs li a{color: #fff}.woocommerce #reviews #comments ol.commentlist li .comment-text{border-color:rgba(167, 167, 167, 0.2) !important}.woocommerce div.product .woocommerce-tabs ul.tabs li.active{background:rgba(167, 167, 167, 0.2)}.reviews_tab{margin:0 !important;background-color:rgba(167, 167, 167, 0.1) !important}.woocommerce div.product .woocommerce-tabs ul.tabs li::before,.woocommerce div.product .woocommerce-tabs ul.tabs li::after{display:none!important}#comments .commentlist li .avatar{box-shadow: 1px 10px 10px rgba(167, 167, 167, 0.1) !important}';
					}

					// Theme styles
					if ( is_customize_preview() ) {
						wp_add_inline_style( $handle, $extra_css . self::css_out( 1 ) );
					} else {
						$ts = get_transient( Codevz::$transient . 'theme_styles' );
						$fonts = (array) get_transient( Codevz::$transient . 'theme_styles_fonts' );
						if ( ! $ts || ! $fonts ) {
							$ts = self::css_out();
							set_transient( Codevz::$transient . 'theme_styles', $ts, MONTH_IN_SECONDS );
						}
						wp_add_inline_style( $handle, $extra_css . $ts );

						// Fonts
						foreach ( $fonts as $font ) {
							Codevz::enqueue_font( $font );
						}
					}

					// Single page CSS
					if ( is_singular() && isset( Codevz::$post->ID ) ) {
						$meta = get_post_meta( Codevz::$post->ID, 'codevz_single_page_css', 1 );
						if ( $meta ) {
							wp_add_inline_style( $handle, str_replace( 'Array', '', $meta ) );
						}
					}

					// Options json for customize preview
					if ( is_customize_preview() ) {
						self::codevz_wp_footer_options_json();
					}
				}, 999 );
			}

			// Update single page CSS
			add_action( 'save_post', array( __CLASS__, 'codevz_save_post' ) );

      // Default Options
      add_action( 'init', function() {
        if ( empty( get_option( Codevz::$options_id ) ) ) {
          $defaults = array(
  'layout' => 'right',
  'primary' => 'primary',
  'secondary' => 'secondary',
  'responsive' => true,
  'responsive_breakpoint_2' => '960px',
  'responsive_breakpoint_3' => '420px',
  'css' => 'body.home.blog .page_cover { display: none; } body.home.blog .page_content { margin-top: 40px }',
  'site_color' => '#0045a0',
  '_css_widgets' => 'background-color:rgba(255,255,255,0.01);border-style:solid;border-width:1px;border-color:#d8d8d8;',
  '_css_widgets_headline' => 'font-size:20px;font-weight:700;',
  '_css_logo_css' => 'CDVZtext-transform:uppercase;CDVZ',
  'social_color_mode' => 'cz_social_colored_bg_hover',
  '_css_menu_a_hover_before_header_1' => '_class_menu_fx:cz_menu_fx_left_to_right;',
  'menus_indicator_header_1' => 'fa fa-angle-down',
  'menus_indicator2_header_1' => 'fa fa-angle-right',
  'header_2_left' => 
  array(
    0 => 
    array(
      'element' => 'logo',
      'element_id' => 'header_2_left',
      'logo_width' => '140px',
      'margin' => 
      array(
        'top' => '25px',
        'right' => '',
        'bottom' => '25px',
        'left' => '',
      ),
    ),
  ),
  'header_2_right' => 
  array(
    0 => 
    array(
      'element' => 'search',
      'element_id' => 'header_2_right',
      'search_type' => 'icon_dropdown',
      'search_placeholder' => 'Type a keyword ...',
      'sk_search_con' => 'background-color:#0045a0;margin-left:-3px;',
      'sk_search_ajax' => 'margin-top:15px;border-style:none;border-radius:5px;box-shadow:none;',
      'sk_search_icon' => 'font-size:14px;color:#ffffff;background-color:#0045a0;padding:3px;border-radius:0px;',
      'sk_search_icon_in' => 'color:#000000;',
      'margin' => 
      array(
        'top' => '34px',
        'right' => '',
        'bottom' => '',
        'left' => '10px',
      ),
    ),
    1 => 
    array(
      'element' => 'menu',
      'element_id' => 'header_2_right',
      'inview_position_widget' => 'inview_left',
      'margin' => 
      array(
        'top' => '34px',
        'right' => '0px',
        'bottom' => '',
        'left' => '0px',
      ),
    ),
  ),
  '_css_container_header_2' => 'border-style:solid;border-bottom-width:1px;border-color:#cccccc;',
  '_css_menu_a_header_2' => 'font-size:14px;letter-spacing:0px;padding:5px 10px 6px;margin:0px 12px;',
  '_css_menu_a_hover_header_2' => 'color:#ffffff;',
  '_css_menu_a_hover_before_header_2' => '_class_menu_fx:cz_menu_fx_unroll_h;border-width:0px;',
  'menus_indicator_header_2' => 'fa fa-angle-down',
  '_css_menu_ul_header_2' => 'background-color:#0045a0;width:260px;margin:1px 12px 1px 24px;border-radius:0px;box-shadow:0px 9px 20px rgba(0,0,0,0.13);',
  '_css_menu_ul_a_header_2' => 'font-size:14px;color:#cecece;',
  '_css_menu_ul_a_hover_header_2' => 'color:#ffffff;',
  'menus_indicator2_header_2' => 'fa fa-angle-right',
  'menus_indicator_header_3' => 'fa fa-angle-down',
  'menus_indicator2_header_3' => 'fa fa-angle-right',
  'smart_sticky' => true,
  '_css_container_header_5' => 'background-color:#ffffff;',
  'menus_indicator_header_5' => 'fa fa-angle-down',
  'menus_indicator2_header_5' => 'fa fa-angle-right',
  'header_4_left' => 
  array(
    0 => 
    array(
      'element' => 'logo',
      'element_id' => 'header_4_left',
      'logo_width' => '120px',
      'margin' => 
      array(
        'top' => '20px',
        'right' => '',
        'bottom' => '20px',
        'left' => '',
      ),
    ),
  ),
  'header_4_right' => 
  array(
    0 => 
    array(
      'element' => 'menu',
      'element_id' => 'header_4_right',
      'menu_type' => 'offcanvas_menu_right',
      'sk_menu_icon' => 'font-size:18px;color:#ffffff;background-color:#000000;padding:3px;border-radius:0px;',
      'inview_position_widget' => 'inview_right',
      'margin' => 
      array(
        'top' => '28px',
        'right' => '',
        'bottom' => '',
        'left' => '',
      ),
    ),
  ),
  '_css_container_header_4' => 'border-style:solid;border-width:0 0 1px;border-color:#f4f4f4;',
  '_css_menu_a_header_4' => 'color:rgba(0,0,0,0.6);',
  '_css_menu_a_hover_header_4' => 'color:#0045a0;',
  'menus_indicator_header_4' => 'fa fa-angle-down',
  '_css_menu_ul_a_header_4' => 'color:#606060;',
  '_css_menu_ul_a_hover_header_4' => 'color:#3f51b5;',
  'menus_indicator2_header_4' => 'fa fa-angle-down',
  'page_cover' => 'title',
  'page_title' => '8',
  'breadcrumbs_home_icon' => 'fa fa-home',
  'breadcrumbs_separator' => 'fa fa-angle-right',
  '_css_page_title' => 'background-color:#0045a0;padding-top:10px;padding-bottom:8px;border-style:solid;border-width:0 0 1px;border-color:#f4f4f4;',
  '_css_page_title_color' => 'font-size:24px;color:#ffffff;padding-bottom:10px;',
  '_css_page_title_breadcrumbs_color' => 'color:#e8e8e8;',
  '_css_breadcrumbs_inner_container' => 'margin-top:7px;margin-right:10px;',
  '_css_footer' => 'background-color:#0045a0;padding-top:60px;padding-bottom:50px;',
  '_css_footer_widget' => 'color:#ffffff;padding:10px 10px 10px 10px;',
  '_css_footer_a' => 'font-size:13px;color:#ffffff;line-height: 2;',
  '_css_footer_a_hover' => 'color:#c6c6c6;',
  'footer_2_center' => 
  array(
    0 => 
    array(
      'element' => 'icon',
      'element_id' => 'footer_2_center',
      'menu_location' => 'primary',
      'it_text' => 'Copyright %year% Xtra Theme. All Rights Reserved',
      'it_link' => '',
      'sk_it' => 'font-size:15px;color:rgba(255,255,255,0.8);',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'margin' => 
      array(
        'top' => '30px',
        'right' => '',
        'bottom' => '25px',
        'left' => '',
      ),
    ),
  ),
  '_css_container_footer_2' => 'background-color:#0045a0;',
  '_css_backtotop' => 'color:#ffffff;background-color:#0045a0;border-style:none;border-width:0px;border-radius:10px;',
  '_css_cf7_beside_backtotop' => 'color:#0045a0;margin-right:3px;border-style:none;border-radius:50px 0 0 50px ;box-shadow:0px 0px 10px rgba(0,0,0,0.15);',
  'meta_data_post' => 
  array(
    0 => 'image',
    1 => 'mbot',
    2 => 'cats',
    3 => 'tags',
    4 => 'author_box',
    5 => 'next_prev',
  ),
  'related_post' => 'You May Also Like ...',
  'slug_portfolio' => 'projects',
  'title_portfolio' => 'Projects',
  'cat_portfolio' => 'projects/cat',
  'tags_portfolio' => 'projects/tags',
  'tags_title_portfolio' => 'Tags',
  'meta_data_portfolio' => 
  array(
    0 => 'date',
    1 => 'cats',
    2 => 'tags',
  ),
  'related_portfolio' => 'You May Also Like ...',
  'primary_portfolio' => 'primary',
  'secondary_portfolio' => 'secondary',
  'page_coverportfolio' => '1',
  'page_titleportfolio' => '1',
  '_css_footer_widget_headlines' => 'color:#ffffff;font-size:28px;font-weight:100;border-style:solid;border-width:0 0 1px;',
  'page_cover_portfolio' => '1',
  '_css_woo_products_thumbnails' => 'border-style:solid;border-width:3px;border-color:#0045a0;border-radius:10px;',
  'page_title_portfolio' => '1',
  'page_cover_product' => '1',
  'page_title_product' => '1',
  'woo_col' => '4',
  '_css_woo_products_title' => 'margin-top:25px;',
  '_css_woo_products_stars' => 'display:none;',
  '_css_woo_products_add_to_cart' => 'font-size:13px;font-weight:400;background-color:#0045a0;border-radius:99px;position:absolute;bottom:62px;left:calc(50% - 75px );',
  '_css_woo_products_onsale' => 'font-size:10px;color:#ffffff;font-weight:400;background-color:#079700;top:10px;left:10px;',
  '_css_woo_products_price' => 'font-size:14px;color:#0045a0;background-color:rgba(255,255,255,0.01);top:5px;right:5px;',
  '_css_woo_product_price' => 'color:#0045a0;font-weight:700;',
  '_css_woo_buttons' => 'color:#ffffff;background-color:#0045a0;',
  '_css_woo_buttons_hover' => 'color:#0045a0;background-color:rgba(0,69,160,0.1);',
  'posts_per_page_portfolio' => '6',
  'cf7_beside_backtotop_icon' => 'fa fa-comments-o',
  'readmore' => 'Read More',
  'readmore_icon' => 'fa fa-angle-right',
  '_css_tags_categories_hover' => 'color:#ffffff;background-color:#0045a0;',
  '_css_pagination_li' => 'font-size:14px;color:rgba(0,0,0,0.75);margin-right:3px;border-radius:0px;',
  '_css_pagination_hover' => 'color:#ffffff;',
  '_css_menu_ul_ul_header_2' => 'margin-top:-15px;margin-left:62px;',
  'related_post_col' => 's4',
  'related_post_ppp' => '3',
  '_css_readmore' => 'color:rgba(255,255,255,0.8);border-radius:0px;',
  '_css_readmore_hover' => 'color:#ffffff;background-color:#0045a0;',
  'columns_portfolio' => '3',
  'template_style_portfolio' => '1',
  'related_portfolio_col' => 's4',
  'related_portfolio_ppp' => '3',
  'woo_template' => '1',
  'woo_related_col' => '3',
  '_css_woo_products_add_to_cart_hover' => 'background-color:#079700;',
  '_css_post_avatar' => 'padding:2px;border-style:solid;border-width:1px;border-color:#cccccc;border-radius:5px;box-shadow:none;CDVZwidth:42pxCDVZ',
  '_css_post_author' => 'font-size:14px;color:#000370;font-weight:600;',
  '_css_post_date' => 'font-size:12px;font-style:italic;',
  '_css_post_title' => 'font-size:28px;font-weight:500;',
  '_css_menu_ul_indicator_a_header_2' => '_class_indicator:fa fa-angle-right;color:#ffffff;',
  '_css_menu_indicator_a_header_2' => '_class_indicator:fa fa-angle-down;',
  '_css_sticky_post' => 'background-color:rgba(0,69,160,0.04);margin-bottom:40px;border-style:solid;border-width:2px;border-color:#000370;border-radius:10px;',
  '_css_overall_post' => 'padding-bottom:40px;margin-bottom:40px;border-style:solid;',
  '_css_post_meta_overall' => 'border-width:0px 0px 0px 6px;border-color:#0045a0;display:inline-block;',
  '_css_related_posts_sec_title' => 'font-size:22px;',
  '_css_single_comments_title' => 'font-size:22px;',
  '_css_next_prev_icons' => 'color:#ffffff;background-color:#000000;border-radius:0px;',
  '_css_next_prev_icons_hover' => 'color:#ffffff;background-color:#0045a0;',
  '_css_next_prev_titles' => 'margin-right:8px;margin-left:8px;',
  '_css_all_headlines' => 'font-family:Abril Fatface;',
  'breakpoint_2' => '768px',
  'breakpoint_3' => '480px',
  'post_excerpt' => '20',
  'prev_post' => 'Previous',
  'next_post' => 'Next',
  'related_posts_post' => 'Related Posts ...',
  'comments' => 'Comments',
  'cols_portfolio' => 's4',
  'related_posts_portfolio' => 'Related Posts ...',
  '_css_inner_title' => 'font-size:32px;',
  '_css_single_title' => 'font-size:32px;',
  '_css_single_mbot' => 'color:#727272;',
  '_css_single_mbot_i' => 'color:#000370;',
  'primary_buddypress' => 'primary',
  'secondary_buddypress' => 'secondary',
  'page_cover_buddypress' => '1',
  'page_title_buddypress' => '1',
  'lazyload' => true,
  'remove_query_args' => true,
  'vc_disable_modules' => 
  array(
    0 => 'vc_wp_search',
    1 => 'vc_wp_meta',
    2 => 'vc_wp_recentcomments',
    3 => 'vc_wp_calendar',
    4 => 'vc_wp_pages',
    5 => 'vc_wp_tagcloud',
    6 => 'vc_wp_custommenu',
    7 => 'vc_wp_text',
    8 => 'vc_wp_posts',
    9 => 'vc_wp_categories',
    10 => 'vc_wp_archives',
    11 => 'vc_wp_rss',
  ),
  'backtotop' => 'fa fa-angle-up',
);
          update_option( Codevz::$options_id, $defaults );
          delete_transient( Codevz::$transient . 'theme_styles' );
          self::codevz_customize_save_after();
        }
      }); // init

		}

		/**
		 *
		 * Get list of post types created via customizer
		 * 
		 * @return array
		 *
		 */
		public static function post_types( $a = array() ) {
			$a = array_merge( $a, (array) get_option( 'codevz_post_types' ) );
			$a[] = 'portfolio';

			return $a;
		}

		/**
		 *
		 * Update single page CSS as metabox 'codevz_single_page_css'
		 * 
		 * @return string
		 * 
		 */
		public static function codevz_save_post( $post_id = '' ) {
      if ( empty( $post_id ) || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ) {
        return;
      }

			$meta = self::css_out( 0, Codevz::meta( $post_id ) );
			update_post_meta( $post_id, 'codevz_single_page_css', $meta );
		}

		/**
		 *
		 * Generate styles when customizer saves
		 * 
		 * @return array
		 *
		 */
		public static function css_out( $is_customize_preview = 0, $single_page = 0 ) {
			$out = $dynamic = $dynamic_tablet = $dynamic_mobile ='';
			$fonts = array();

			// Options
			$opt = $single_page ? (array) $single_page : (array) get_option( Codevz::$options_id );

			// Generating styles
			foreach ( $opt as $id => $val ) {
				if ( $val && Codevz::contains( $id, '_css_' ) ) {
					if ( is_array( $val ) || Codevz::contains( $val, '[' ) ) {
						continue;
					}

					// Temp fix for live customizer fonts generation
					if ( $is_customize_preview ) {
						if ( Codevz::contains( $val, 'font-family' ) ) {
							$fonts[]['font'] = $val;
						}
						continue;
					}

					// CSS Selector
					$selector = Codevz::contains( $id, '_css_page_body_bg' ) ? 'html,body' : self::get_selector( $id );
					if ( $single_page ) {
						$page_id = '.cz-page-' . get_the_ID();
						$selector = ( $selector === 'html,body' ) ? 'body' . $page_id : $page_id . ' ' . $selector;
					}

					// Fix custom css
					$val = str_replace( 'CDVZ', '', $val );

					// Set font family
					if ( Codevz::contains( $val, 'font-family' ) ) {
						$fonts[]['font'] = $val;

						// Extract font + params && Fix font for CSS
						$font = $o_font = Codevz::get_string_between( $val, 'font-family:', ';' );
						$font = str_replace( '=', ':', $font );
						
						if ( Codevz::contains( $font, ':' ) ) {
							$font = explode( ':', $font );
							if ( ! empty( $font[0] ) ) {
								$val = str_replace( $o_font, "'" . $font[0] . "'", $val );
							}
						} else {
							$val = str_replace( $font, "'" . $font . "'", $val );
						}
					}

					// Remove unwanted in css
					if ( Codevz::contains( $val, '_class_' ) ) {
						$val = preg_replace( '/_class_[\s\S]+?;/', '', $val );
					}

					// Append to out
					if ( ! empty( $val ) && ! empty( $selector ) ) {
						if ( Codevz::contains( $id, '_tablet' ) ) {
							$dynamic_tablet .= $selector . '{' . $val . '}';
						} else if ( Codevz::contains( $id, '_mobile' ) ) {
							$dynamic_mobile .= $selector . '{' . $val . '}';
						} else {
							$dynamic .= $selector . '{' . $val . '}';
						}
					}
				}
			}

			// Final out
			if ( ! $is_customize_preview ) {
				$dynamic = $dynamic ? "\n\n/* Dynamic " . ( $single_page ? 'Single' : '' ) . " */" . $dynamic : '';
				if ( $single_page && Codevz::option( 'responsive' ) ) {
					$dynamic .= $dynamic_tablet ? '@media screen and (max-width:' . ( !Codevz::option( 'breakpoint_2' ) ? '768px' : Codevz::option( 'breakpoint_2' ) ) . '){' . $dynamic_tablet . '}' : '';
					$dynamic .= $dynamic_mobile ? '@media screen and (max-width:' . ( !Codevz::option( 'breakpoint_3' ) ? '480px' : Codevz::option( 'breakpoint_3' ) ) . '){' . $dynamic_mobile . '}' : '';
				}
			}

			// Single pages
			if ( $single_page ) {
				return $dynamic;
			}

			// Site Width & Boxed
			$site_width = empty( $opt['site_width'] ) ? 0 : $opt['site_width'];
			if ( $site_width ) {
				$out .= empty( $opt['boxed'] ) ? '.row{width: ' . $site_width . '}' : '.layout_1,.layout_1 .cz_fixed_footer,.layout_1 .header_is_sticky{width: ' . $site_width . '}.layout_1 .row{width: calc(' . $site_width . ' - 10%)}';
			}

			// Responsive
			if ( ! empty( $opt['responsive'] ) ) {
        $bxw = empty( $opt['boxed'] ) ? '1170px' : '1300px';
				$rs1 = empty( $opt['site_width'] ) ? $bxw : ( Codevz::contains( $opt['site_width'], '%' ) ? '4000px' : $opt['site_width'] );
				$rs2 = empty( $opt['breakpoint_2'] ) ? '768px' : $opt['breakpoint_2'];
				$rs3 = empty( $opt['breakpoint_3'] ) ? '480px' : $opt['breakpoint_3'];
				$rsc = isset( $opt['breakpoint_2_custom_css'] ) ? $opt['breakpoint_2_custom_css'] : '';
				$rsc3 = isset( $opt['breakpoint_3_custom_css'] ) ? $opt['breakpoint_3_custom_css'] : '';

				$lt = $pt = $mm = '';
				$header_css = '.header_1,.header_2,.header_3,.header_5,.fixed_side{display: none !important}.header_4,.Corpse_Sticky.cz_sticky_corpse_for_header_4{display: block !important}.header_onthe_cover:not(.header_onthe_cover_dt):not(.header_onthe_cover_all){margin-top: 0 !important}';

				if ( empty( $opt['mobile_header'] ) || ( isset( $opt['mobile_header'] ) && $opt['mobile_header'] === 'pt' ) ) {
					$pt = $header_css;
				} else if ( $opt['mobile_header'] === 'lt' ) {
					$lt = $header_css;
				} else {
					$mm = $header_css;
				}

				$dynamic .= "\n\n/* Responsive */" . '@media screen and (max-width:' . $rs1 . '){#layout{width:100%!important}#layout.layout_1{width:95%!important}.row{width:90% !important;padding:0}blockquote{padding:20px}.slick-slide{margin:0!important}footer .elms_center,footer .elms_left,footer .elms_right,footer .have_center .elms_left, footer .have_center .elms_center, footer .have_center .elms_right{float:none;display:table;text-align:center;margin: 0 auto;flex:unset}}
	@media screen and (max-width:1025px){' . $lt . '.header_1,.header_2,.header_3{width: 100%}#layout.layout_1{width:94%!important}#layout.layout_1 .row{width:90% !important}}
	@media screen and (max-width:' . $rs2 . '){' . $pt . 'body,#layout{padding: 0 !important;margin: 0 !important}.inner_layout,#layout.layout_1,.col,.cz_five_columns > .wpb_column,.cz_five_columns > .vc_vc_column{width:100% !important;margin:0 !important;border-radius:0}.hidden_top_bar,.fixed_contact,.cz_process_road_a,.cz_process_road_b{display:none!important}.cz_parent_megamenu>.sub-menu{margin:0!important}.is_fixed_side{padding:0!important}.cz_tabs_is_v .cz_tabs_nav,.cz_tabs_is_v .cz_tabs_content{width: 100% !important;margin-bottom: 20px}.wpb_column {margin-bottom: 20px}.cz_fixed_footer {position: static !important}' . $rsc . '.Corpse_Sticky,.hide_on_tablet{display:none !important}header i.hide,.show_on_tablet{display:block}.cz_grid_item:not(.slick-slide){width:50% !important}.cz_grid_item img{width:auto !important}.cz_mobile_text_center, .cz_mobile_text_center *{text-align:center !important;float:none !important}.cz_mobile_btn_center{float:none !important;margin-left: auto !important;margin-right: auto !important;display: table !important;text-align: center !important}.vc_row[data-vc-stretch-content] .vc_column-inner[class^=\'vc_custom_\'],.vc_row[data-vc-stretch-content] .vc_column-inner[class*=\' vc_custom_\'] {padding:20px !important;}.wpb_column {margin-bottom: 0 !important;}.vc_row.no_padding .vc_column_container > .vc_column-inner, .vc_row.nopadding .vc_column_container > .vc_column-inner{padding:0 !important;}.cz_posts_container article > div{height: auto !important}.cz_split_box_left > div, .cz_split_box_right > div {width:100%;float:none}.woo-col-3.woocommerce ul.products li.product, .woo-col-3.woocommerce-page ul.products li.product, .woo-related-col-3.woocommerce ul.products .related li.product, .woo-related-col-3.woocommerce-page ul.products .related li.product {width: calc(100% / 2 - 2.6%)}.search_style_icon_full .search{width:86%;top:80px}.vc_row-o-equal-height .cz_box_front_inner, .vc_row-o-equal-height .cz_eqh, .vc_row-o-equal-height .cz_eqh > div, .vc_row-o-equal-height .cz_eqh > div > div, .vc_row-o-equal-height .cz_eqh > div > div > div, .cz_posts_equal > .clr{display:block !important}.cz_a_c.cz_timeline_container:before {left: 0}.cz_timeline-i i {left: 0;transform: translateX(-50%)}.cz_a_c .cz_timeline-content {margin-left: 50px;width: 70%;float: left}.cz_a_c .cz_timeline-content .cz_date{position: static;text-align: left}' . $dynamic_tablet . '}
	@media screen and (max-width:' . $rs3 . '){' . $mm . '.cz_grid_item img{width:auto !important}.hide_on_mobile,.show_only_tablet,.fixed_contact,.cz_cart_items{display:none}header i.hide,.show_on_mobile{display:block}.offcanvas_area{width:80%}.cz_tab_a,.cz_tabs_content,.cz_tabs_is_v .cz_tabs_nav{box-sizing:border-box;display: block;width: 100% !important;margin-bottom: 20px}.woocommerce ul.products li.product, .woocommerce-page ul.products li.product, .woocommerce-page[class*=columns-] ul.products li.product, .woocommerce[class*=columns-] ul.products li.product,.wpcf7-form p{width: 100% !important}.cz_post_image,.cz_default_grid{width: 100%;margin-bottom:30px !important}.wpcf7-form p {width: 100% !important;margin: 0 0 10px !important}[class^="cz_parallax_"],[class*=" cz_parallax_"]{transform:none !important}th, td {padding: 1px}dt {width: auto}dd {margin: 0}pre{width: 90%}.woocommerce .woocommerce-result-count, .woocommerce-page .woocommerce-result-count,.woocommerce .woocommerce-ordering, .woocommerce-page .woocommerce-ordering{float:none;text-align:center;width:100%}.woocommerce #coupon_code, .coupon input.button {width:100% !important;margin:0 0 10px !important}span.wpcf7-not-valid-tip{left:auto}.wpcf7-not-valid-tip:after{right:auto;left:-41px}.cz_video_popup div{width:fit-content}.cz_grid_item:not(.slick-slide){width:100% !important;margin: 0 !important}.cz_grid_item > div{margin:0 0 10px !important}.cz_grid{width:100% !important;margin:0 !important}.center_on_mobile,.center_on_mobile *{text-align:center !important;float:none !important}.center_on_mobile .cz_wh_left, .center_on_mobile .cz_wh_right {display:block}.center_on_mobile .item_small > a{display:inline-block;margin:2px 0}.center_on_mobile img,.center_on_mobile .cz_image > div{display:table !important;margin-left: auto !important;margin-right: auto !important}.tac_in_mobile{text-align:center !important;float:none !important;display:table;margin-left:auto !important;margin-right:auto !important}.next_prev li {float:none !important;width:100% !important;border: 0 !important;margin-bottom:30px !important}.services.left .service_custom,.services.right .service_custom,.services.left .service_img,.services.right .service_img{float:none;margin:0 auto 20px auto !important;display:table}.services div.service_text,.services.right div.service_text{padding:0 !important;text-align:center !important}.header_onthe_cover_dt{margin-top:0 !important}.alignleft,.alignright{float:none;margin:0 auto 30px}.woocommerce li.product{margin-bottom:30px !important}.woocommerce #reviews #comments ol.commentlist li .comment-text{margin:0 !important}#comments .commentlist li .avatar{left:-20px !important}.services .service_custom i{left: 50%;transform: translateX(-50%)}#commentform > p{display:block;width:100%}blockquote,.blockquote{width:100% !important;box-sizing:border-box;text-align:center;display:table !important;margin:0 auto 30px !important;float:none !important}.cz_related_post{margin-bottom: 30px !important}.right_br_full_container .lefter, .right_br_full_container .righter,.right_br_full_container .breadcrumbs{width:100%;text-align:center}a img.alignleft,a img.alignright{margin:0 auto 30px;display:block;float:none}.cz_popup_in{max-height:85%!important;max-width:90%!important;min-width:0;animation:none;box-sizing:border-box;left:5%;transform:translate(0,-50%)}.rtl .sf-menu > .cz{width:100%}.cz_2_btn a {box-sizing: border-box}.cz_has_year{margin-left:0 !important}.cz_history_1 > span:first-child{position:static !important;margin-bottom:10px !important;display:inline-block}.search-form .search-submit{margin: 0}.page_item_has_children .children, ul.cz_circle_list {margin: 8px 0 8px 10px}ul, .widget_nav_menu .sub-menu, .widget_categories .children, .page_item_has_children .children, ul.cz_circle_list{margin-left: 10px}.dwqa-questions-list .dwqa-question-item{padding: 20px 20px 20px 90px}.dwqa-question-content, .dwqa-answer-content{padding:0}.cz_subscribe_elm button{position:static !important}.cz_hexagon{position: relative;margin: 0 auto 30px}.cz_gallery_badge{right:-10px}' . $rsc3 . $dynamic_mobile . '}';
			}

			// Fixed Border for Body
			if ( ! empty( $opt['_css_body'] ) && Codevz::contains( $opt['_css_body'], 'border-width' ) && Codevz::contains( $opt['_css_body'], 'border-color' ) ) {
				$out .= '.cz_fixed_top_border, .cz_fixed_bottom_border {border-top: ' . Codevz::get_string_between( $opt['_css_body'], 'border-width:', ';' ) . ' solid ' . Codevz::get_string_between( $opt['_css_body'], 'border-color:', ';' ) . '}';
			}

			// Site Colors
			if ( ! empty( $opt['site_color'] ) ) {
				$site_color = $opt['site_color'];
				$out .= "\n\n/* Theme color */" . 'a:hover, .sf-menu > .cz.current_menu > a, .sf-menu > .cz > .current_menu > a, .sf-menu > .current-menu-parent > a {color: ' . $site_color . '} 
	button:not(.customize-partial-edit-shortcut-button):not(.vc_general):not(.slick-arrow):not(.slick-dots-btn):not([role="presentation"]):not([aria-controls]),
	.button,.sf-menu > .cz > a:before,.sf-menu > .cz > a:before,.widget_product_search #searchsubmit, .post-password-form input[type="submit"], .wpcf7-submit, .submit_user, 
	#commentform #submit, .commentlist li.bypostauthor > .comment-body:after,.commentlist li.comment-author-admin > .comment-body:after, 
	.woocommerce input.button.alt.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce .woocommerce-error .button, .woocommerce .woocommerce-info .button, .woocommerce .woocommerce-message .button, .woocommerce-page .woocommerce-error .button, .woocommerce-page .woocommerce-info .button, .woocommerce-page .woocommerce-message .button,#add_payment_method table.cart input, .woocommerce-cart table.cart input:not(.input-text), .woocommerce-checkout table.cart input,.woocommerce input.button:disabled, .woocommerce input.button:disabled[disabled],#add_payment_method table.cart input, #add_payment_method .wc-proceed-to-checkout a.checkout-button, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button,.woocommerce #payment #place_order, .woocommerce-page #payment #place_order,.woocommerce input.button.alt,
	.woocommerce #respond input#submit.alt:hover, .pagination .current, .pagination > b, .pagination a:hover, .page-numbers .current, .page-numbers a:hover, .pagination .next:hover, 
	.pagination .prev:hover, input[type=submit], .sticky:before, .commentlist li.comment-author-admin .fn, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce-MyAccount-navigation a:hover, .woocommerce-MyAccount-navigation .is-active a,
	input[type=submit],input[type=button],.cz_header_button,.cz_default_portfolio a, .dwqa-questions-footer .dwqa-ask-question a,
	.cz_readmore, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, 
	.woocommerce nav.woocommerce-pagination ul li span.current, .cz_btn, 
	.woocommerce .widget_price_filter .ui-slider .ui-slider-range, 
	.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {background-color: ' . $site_color . '}
	textarea:focus, input:focus, .nice-select.open, .nice-select:active, .nice-select:hover, .nice-select:focus {border-color: ' . $site_color . ' !important}
	.cs_load_more_doing, div.wpcf7 .wpcf7-form .ajax-loader, .cz_ajax_loader {border-right-color: ' . $site_color . '}
	::selection {background-color: ' . $site_color . ';color: #fff}::-moz-selection {background-color: ' . $site_color . ';color: #fff}';
			} // Primary Color

			// Dev CSS
			$out .= empty( $opt['dev_css'] ) ? '' : "\n\n/* Dev */" . $opt['dev_css'];

			// Custom CSS
			$out .= empty( $opt['css'] ) ? '' : "\n\n/* Custom */" . $opt['css'];

			// Enqueue Google Fonts
			if ( ! isset( $opt['_css_body_typo'] ) || ! Codevz::contains( $opt['_css_body_typo'], 'font-family' ) ) {
				$fonts[]['font'] = Codevz::$is_rtl ? 'font-family:Cairo;' : 'font-family:Open Sans;';
			}
			$fonts = wp_parse_args( (array) Codevz::option( 'wp_editor_fonts' ), $fonts );
			$final_fonts = array();
			foreach ( $fonts as $font ) {
				if ( isset( $font['font'] ) ) {
					$final_fonts[] = $font['font'];
					Codevz::enqueue_font( $font['font'] );
				}
			}
			set_transient( Codevz::$transient . 'theme_styles_fonts', $final_fonts, MONTH_IN_SECONDS );

			// Return for using it in wp_add_inline_style()
			return $out . $dynamic;
		}

		/**
		 *
		 * Get RGB numbers of HEX color
		 * 
		 * @var Hex color code
		 * @return string
		 *
		 */
		public static function hex2rgb( $c = '', $s = 0 ) {
			if ( empty( $c[0] ) ) {
				return '';
			}
			
			$c = substr( $c, 1 );
			if ( strlen( $c ) == 6 ) {
				list( $r, $g, $b ) = array( $c[0] . $c[1], $c[2] . $c[3], $c[4] . $c[5] );
			} elseif ( strlen( $c ) == 3 ) {
				list( $r, $g, $b ) = array( $c[0] . $c[0], $c[1] . $c[1], $c[2] . $c[2] );
			} else {
				return false;
			}
			$r = hexdec( $r );
			$g = hexdec( $g );
			$b = hexdec( $b );

			return implode( $s ? ', ' : ',', array( $r, $g, $b ) );
		}

		/**
		 *
		 * Update database, options for site colors changes
		 * 
		 * @var Old string and New string
		 * @return -
		 *
		 */
		public static function updateDatabase( $o = '', $n = '' ) {
			if ( $o ) {
				$old_rgb = self::hex2rgb( $o );
				$new_rgb = self::hex2rgb( $n );
				$old_rgb_s = self::hex2rgb( $o, 1 );
				$new_rgb_s = self::hex2rgb( $n, 1 );

				// Replace db
				global $wpdb;
				$wpdb->query( "UPDATE " . $wpdb->prefix . "posts SET post_content = replace(replace(replace(post_content, '" . $old_rgb_s . "','" . $new_rgb_s . "' ), '" . $old_rgb . "','" . $new_rgb . "' ), '" . $o . "','" . $n . "')" );
        $wpdb->query( "UPDATE " . $wpdb->prefix . "postmeta SET meta_value = replace(replace(replace(meta_value, '" . $old_rgb_s . "','" . $new_rgb_s . "' ), '" . $old_rgb . "','" . $new_rgb . "' ), '" . $o . "','" . $n . "')" );
				
				// Replace options
				$all = json_encode( Codevz::option() );
				$all = str_replace( array( $o, $old_rgb, $old_rgb_s ), array( $n, $new_rgb, $new_rgb_s ), $all );
				update_option( Codevz::$options_id, json_decode( $all, true ) );
			}
		}

		/**
		 *
		 * Action after customizer saved
		 * 
		 * @return -
		 *
		 */
		public static function codevz_customize_save_after() {

      // Header Preset
      require_once self::$dir . 'includes/headers_preset.php';
      $header_preset = Codevz::option( 'header_preset' );
      if ( $header_preset && function_exists( 'codevz_headers_preset' ) ) {
        $options = Codevz::option();
        foreach ( (array) codevz_headers_preset( 'reset' ) as $key => $val ) {
          unset( $options[ $key ] );
        }
        unset( $options['header_preset'] );
        update_option( Codevz::$options_id, wp_parse_args( codevz_headers_preset( $header_preset ), $options ) );
      }

			// Update new post types
			$new_cpt = Codevz::option( 'add_post_type' );
			if ( is_array( $new_cpt ) && json_encode( $new_cpt ) !== json_encode( get_option( 'codevz_post_types_org' ) ) ) {
				$post_types = array();
				foreach ( $new_cpt as $cpt ) {
					if ( isset( $cpt['name'] ) ) {
						$post_types[] = strtolower( $cpt['name'] );
					}
				}
				update_option( 'codevz_css_selectors', '' );
				update_option( 'codevz_post_types', $post_types );
				update_option( 'codevz_post_types_org', $new_cpt );
			} else if ( empty( $new_cpt ) ) {
				delete_option( 'codevz_post_types' );
			}

			// Update Google Fonts for WP editor
			$fonts = Codevz::option( 'wp_editor_fonts' );
			if ( json_encode( $fonts ) !== json_encode( get_option( 'codevz_wp_editor_google_fonts_org' ) ) ) {
				$wp_editor_fonts = '';
				$fonts = wp_parse_args( $fonts, array(
					array( 'font' => 'inherit' ),
					array( 'font' => 'Arial' ),
					array( 'font' => 'Arial Black' ),
					array( 'font' => 'Comic Sans MS' ),
					array( 'font' => 'Impact' ),
					array( 'font' => 'Lucida Sans Unicode' ),
					array( 'font' => 'Tahoma' ),
					array( 'font' => 'Trebuchet MS' ),
					array( 'font' => 'Verdana' ),
					array( 'font' => 'Courier New' ),
					array( 'font' => 'Lucida Console' ),
					array( 'font' => 'Georgia, serif' ),
					array( 'font' => 'Palatino Linotype' ),
					array( 'font' => 'Times New Roman' )
				));
				foreach ( $fonts as $font ) {
					if ( ! empty( $font['font'] ) ) {
						$font = $font['font'];
						if ( Codevz::contains( $font, ':' ) ) {
							$value = explode( ':', $font );
							$font = empty( $value[0] ) ? $font : $value[0];
							$wp_editor_fonts .= $font . '=' . $font . ';';
						} else {
							$title = ( $font === 'inherit' ) ? esc_html__( 'Default', 'xtra' ) : $font;
							$wp_editor_fonts .= $title . '=' . $font . ';';
						}
					}
				}
				update_option( 'codevz_wp_editor_google_fonts', $wp_editor_fonts );
				update_option( 'codevz_wp_editor_google_fonts_org', $fonts );
			}

			// Update primary theme color
			$primary = Codevz::option( 'site_color' );
			if ( $primary && $primary !== get_option( 'codevz_primary_color' ) ) {
				self::updateDatabase( get_option( 'codevz_primary_color' ), $primary );
        update_option( 'codevz_primary_color', $primary );
			}

			// Update secondary theme color
			$secondary = Codevz::option( 'site_color_sec' );
			if ( $secondary && $secondary !== get_option( 'codevz_secondary_color' ) ) {
				self::updateDatabase( get_option( 'codevz_secondary_color' ), $secondary );
        update_option( 'codevz_secondary_color', $secondary );
			}

			// Add custom 
			global $wp_filesystem;
			if ( empty( $wp_filesystem ) ) {
				require_once( ABSPATH .'/wp-admin/includes/file.php' );
				WP_Filesystem();
			}
			if ( $wp_filesystem ) {
				$ud = wp_upload_dir();
				if ( isset( $ud['basedir'] ) ) {
					$to = $ud['basedir'];
					$to = file_exists( $to . '/codevz_icons' ) ? $to . '/codevz_icons' : wp_mkdir_p( $to . '/codevz_icons' );
					$to_url = $ud['baseurl'] . '/codevz_icons';
				} else {
					$to = $to_url = 0;
				}
				if ( $to ) {
					$zip_icons = Codevz::option( 'zip_icons' );
					if ( $zip_icons && is_array( $zip_icons ) ) {
						$icons_folder = array();
						foreach ( $zip_icons as $zip ) {

							if ( ! empty( $zip['zip'] ) && Codevz::contains( $zip['zip'], '.zip' ) ) {
								$zip = $zip['zip'];
								$nam = str_replace( '.zip', '', basename( $zip ) );
								$zip = substr( $to, 0, strpos( $to, 'wp-content/uploads' ) ) . substr( $zip, strpos( $zip, "wp-content/uploads") );
								$unzipfile = unzip_file( $zip, $to );

								$icons_folder[] = array(
									'name' 	=> $nam,
									'css' 	=> $to_url . '/' . $nam . '/css/fontello.css',
									'json' 	=> $to_url . '/' . $nam . '/config.json',
								);
							}
						}

						update_option( 'codevz_custom_icons', $icons_folder );
					}
				}
			}

			// Update theme styles and custom CSS
			set_transient( Codevz::$transient . 'theme_styles', self::css_out(), MONTH_IN_SECONDS );
		}

		/**
		 *
		 * Meta box for pages, posts, port types
		 * 
		 * @return array
		 *
		 */
		public static function metabox() {

			// Add one-page menu option for pages only
			if ( Codevz::get_post_type_admin() === 'page' ) {
				add_filter( 'codevz_filter_metabox', function( $array) {
					$array[0]['fields'][] = array(
						'id'  		=> 'one_page',
						'type'  	=> 'switcher',
						'title' 	=> esc_html__( 'One Page Menu ?', 'xtra' ),
						'desc' 		=> esc_html__( 'One-Page menu instead primary location menu, only on this page', 'xtra' ),
					);

					return $array;
				}, 999 );
			}

      $page_seo = Codevz::option( 'description' ) ? array(
        'name'   => 'page_seo',
        'title'  => esc_html__( 'SEO settings', 'xtra' ),
        'icon'   => 'fa fa-crosshairs',
        'fields' => array(
          array(
            'id'          => 'description',
            'type'        => 'textarea',
            'title'       => esc_html__( 'Short Description', 'xtra' ),
            'desc'        => esc_html__( 'Max length 300 characters', 'xtra' ),
            'attributes'  => array(
              'maxlength'   => '300'
            )
          ),
          array(
            'id'      => 'keywords',
            'type'    => 'textarea',
            'title'   => esc_html__( 'Keywords', 'xtra' ),
            'desc'    => esc_html__( 'Separate with comma', 'xtra' )
          ),
        )
      ) : array(
        'name'   => 'page_seo',
        'title'  => esc_html__( 'SEO settings', 'xtra' ),
        'icon'   => 'fa fa-crosshairs',
        'fields' => array(
          array(
            'type'        => 'content',
            'content'     => esc_html__( 'To enable SEO settings for this specific page, Go to Theme Options > General Settings > SEO and fill SEO Description field.', 'xtra' )
          )
        )
      ); 

			// Return meta box
			return array(array(
				'id'           => Codevz::$meta_id,
				'title'        => esc_html__( 'Page Settings', 'xtra' ),
				'post_type'    => self::post_types( array( 'post', 'page' ) ),
				'context'      => 'normal',
				'priority'     => 'default',
				'show_restore' => true,
				'sections'     => apply_filters( 'codevz_filter_metabox', array(

					array(
					  'name'   => 'page_general_settings',
					  'title'  => esc_html__( 'General settings', 'xtra' ),
					  'icon'   => 'fa fa-cog',
					  'fields' => array(
					    array(
					      'id'  		=> 'layout',
					      'type'  		=> 'select',
					      'title' 		=> esc_html__( 'Layout', 'xtra' ),
					      'options' 	=> array(
					        '1'         	=> esc_html__( 'Default', 'xtra' ),
					        'none'      	=> esc_html__( 'Blank Page', 'xtra' ),
					        'bpnp'      	=> esc_html__( 'Blank Page ( No Padding )', 'xtra' ),
                  'right'       => esc_html__( 'Right sidebar', 'xtra' ),
                  'right-s'     => esc_html__( 'Right sidebar ( Small )', 'xtra' ),
                  'left'        => esc_html__( 'Left sidebar', 'xtra' ),
                  'left-s'      => esc_html__( 'Left sidebar ( Small )', 'xtra' ),
    							'both-side' 	=> esc_html__( 'Both sidebars', 'xtra' ),
    							'both-side2' 	=> esc_html__( 'Both sidebars ( Small )', 'xtra' ),
    							'both-right'	=> esc_html__( 'Both sidebars ( Right )', 'xtra' ),
    							'both-right2'	=> esc_html__( 'Both sidebars ( Right - Small )', 'xtra' ),
    							'both-left' 	=> esc_html__( 'Both sidebars ( Left )', 'xtra' ),
    							'both-left2' 	=> esc_html__( 'Both sidebars ( Left - Small )', 'xtra' ),
					      ),
					      'default'     => ( Codevz::get_post_type_admin() === 'page' ) ? 'none' : '1'
					    ),
					    array(
					      'id'  		=> 'primary',
					      'type'  		=> 'select',
					      'title' 		=> esc_html__( 'Sidebar', 'xtra' ),
					      'options' 	=> self::sidebars(),
					      'default'		=> 'primary',
					      'dependency' 	=> array( 'layout|layout|layout', '!=|!=|!=|!=', '1|none|bpnp' )
					    ),
					    array(
					      'id'  		=> 'secondary',
					      'type'  		=> 'select',
					      'title' 		=> esc_html__( 'Secondary Sidebar', 'xtra' ),
					      'options' 	=> self::sidebars(),
					      'default'		=> 'secondary',
					      'dependency' 	=> array( 'layout|layout|layout|layout|layout', '!=|!=|!=|!=|!=', '1|none|bpnp|left|right' )
					    ),
              array(
                'id'      => 'page_content_margin',
                'type'    => 'select',
                'title'   => esc_html__( 'Page content margin', 'xtra' ),
                'desc'    => esc_html__( 'Margin between header, page content and footer', 'xtra' ),
                'options' => array(
                    ''  => esc_html__( 'Default', 'xtra' ),
                    'mt0'  => esc_html__( 'Margin top 0', 'xtra' ),
                    'mb0'  => esc_html__( 'Margin bottom 0', 'xtra' ),
                    'mt0 mb0'  => esc_html__( 'Margin top & bottom 0', 'xtra' ),
                )
              ),
              array(
                'id'        => '_css_page_body_bg',
                'type'      => 'cz_sk',
                'title'     => esc_html__( 'Page Background', 'xtra' ),
                'button'    => esc_html__( 'Stylekit', 'xtra' ),
                'settings'    => array( 'background' ),
                'selector'    => ''
              ),
              array('id' => '_css_page_body_bg_tablet','type' => 'cz_sk_hidden','selector' => ''),
              array('id' => '_css_page_body_bg_mobile','type' => 'cz_sk_hidden','selector' => ''),

							array(
								'id'  		=> 'hide_header',
								'type'  	=> 'switcher',
								'title' 	=> esc_html__( 'Hide Header ?', 'xtra' ),
                 'desc'   => esc_html__( 'Only on this page', 'xtra' ),
							),
							array(
								'id'  		=> 'hide_footer',
								'type' 		=> 'switcher',
								'title' 	=> esc_html__( 'Hide Footer ?', 'xtra' ),
                 'desc'   => esc_html__( 'Only on this page', 'xtra' ),
							),

						)
					), // page_general_settings

          array(
            'name'   => 'page_header',
            'title'  => esc_html__( 'Header Styling', 'xtra' ),
            'icon'   => 'fa fa-paint-brush',
            'fields' => array(
              array(
                'id'      => '_css_container_header_1',
                'type'      => 'cz_sk',
                'title'    => esc_html__( 'Top of Header Container', 'xtra' ),
                'button'    => esc_html__( 'Stylekit', 'xtra' ),
                'settings'    => array( 'background', 'padding', 'margin', 'box-shadow', 'border' ),
                'selector'    => ''
              ),
              array('id' => '_css_container_header_1_tablet','type' => 'cz_sk_hidden','selector' => ''),
              array('id' => '_css_container_header_1_mobile','type' => 'cz_sk_hidden','selector' => ''),
              array(
                'id'      => '_css_row_header_1',
                'type'      => 'cz_sk',
                'title'    => esc_html__( 'Top of Header Row inner', 'xtra' ),
                'button'    => esc_html__( 'Stylekit', 'xtra' ),
                'settings'    => array( 'color', 'background', '_class_shape', 'width', 'padding', 'margin', 'border', 'box-shadow' ),
                'selector'    => ''
              ),
              array('id' => '_css_row_header_1_tablet','type' => 'cz_sk_hidden','selector' => ''),
              array('id' => '_css_row_header_1_mobile','type' => 'cz_sk_hidden','selector' => ''),

              array(
                'id'      => '_css_container_header_2',
                'type'      => 'cz_sk',
                'title'    => esc_html__( 'Header Container', 'xtra' ),
                'button'    => esc_html__( 'Stylekit', 'xtra' ),
                'settings'    => array( 'background', 'padding', 'margin', 'box-shadow', 'border' ),
                'selector'    => ''
              ),
              array('id' => '_css_container_header_2_tablet','type' => 'cz_sk_hidden','selector' => ''),
              array('id' => '_css_container_header_2_mobile','type' => 'cz_sk_hidden','selector' => ''),
              array(
                'id'      => '_css_row_header_2',
                'type'      => 'cz_sk',
                'title'    => esc_html__( 'Header Row inner', 'xtra' ),
                'button'    => esc_html__( 'Stylekit', 'xtra' ),
                'settings'    => array( 'color', 'background', '_class_shape', 'width', 'padding', 'margin', 'border', 'box-shadow' ),
                'selector'    => ''
              ),
              array('id' => '_css_row_header_2_tablet','type' => 'cz_sk_hidden','selector' => ''),
              array('id' => '_css_row_header_2_mobile','type' => 'cz_sk_hidden','selector' => ''),

              array(
                'id'      => '_css_container_header_3',
                'type'      => 'cz_sk',
                'title'    => esc_html__( 'Bottom of Header Container', 'xtra' ),
                'button'    => esc_html__( 'Stylekit', 'xtra' ),
                'settings'    => array( 'background', 'padding', 'margin', 'box-shadow', 'border' ),
                'selector'    => ''
              ),
              array('id' => '_css_container_header_3_tablet','type' => 'cz_sk_hidden','selector' => ''),
              array('id' => '_css_container_header_3_mobile','type' => 'cz_sk_hidden','selector' => ''),
              array(
                'id'      => '_css_row_header_3',
                'type'      => 'cz_sk',
                'title'    => esc_html__( 'Bottom of Header Row inner', 'xtra' ),
                'button'    => esc_html__( 'Stylekit', 'xtra' ),
                'settings'    => array( 'color', 'background', '_class_shape', 'width', 'padding', 'margin', 'border', 'box-shadow' ),
                'selector'    => ''
              ),
              array('id' => '_css_row_header_3_tablet','type' => 'cz_sk_hidden','selector' => ''),
              array('id' => '_css_row_header_3_mobile','type' => 'cz_sk_hidden','selector' => ''),

              array(
                'id'        => '_css_header_container',
                'type'      => 'cz_sk',
                'title'    => esc_html__( 'Overall Header Container', 'xtra' ),
                'button'    => esc_html__( 'Stylekit', 'xtra' ),
                'settings'  => array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
                'selector'  => ''
              ),
              array('id' => '_css_header_container_tablet','type' => 'cz_sk_hidden','selector' => ''),
              array('id' => '_css_header_container_mobile','type' => 'cz_sk_hidden','selector' => ''),

              array(
                'id'        => '_css_fixed_side_style',
                'type'      => 'cz_sk',
                'title'     => esc_html__( 'Fixed Side Container', 'xtra' ),
                'button'    => esc_html__( 'Stylekit', 'xtra' ),
                'settings'  => array( 'background', 'width', 'height', 'padding', 'border', 'box-shadow' ),
                'selector'  => ''
              ),
              array('id' => '_css_fixed_side_style_tablet','type' => 'cz_sk_hidden','selector' => ''),
              array('id' => '_css_fixed_side_style_mobile','type' => 'cz_sk_hidden','selector' => ''),

            )
          ), // page_header_settings

          array(
            'name'   => 'page_title_br',
            'title'  => esc_html__( 'Title & Slider', 'xtra' ),
            'icon'   => 'fa fa-window-maximize',
            'fields' => array(
              array(
                'id'    => 'page_cover',
                'type'    => 'select',
                'title'   => esc_html__( 'Title Type', 'xtra' ),
                'options'   => array(
                  '1'     => esc_html__( 'Default', 'xtra' ),
                  'none'    => esc_html__( 'None', 'xtra' ),
                  'title'   => esc_html__( 'Title & Breadcrumbs', 'xtra' ),
                  'rev'     => esc_html__( 'Revolution Slider', 'xtra' ),
                  'custom'  => esc_html__( 'Custom Shortcode', 'xtra' ),
                  'page'    => esc_html__( 'Custom Page', 'xtra' )
                ),
                'default'   => '1',
              ),
              array(
                'id'    => 'page_cover_page',
                'type'    => 'select',
                'title'   => esc_html__( 'Select Page', 'xtra' ),
                'options'   => Codevz::$array_pages,
                'after'   => '<a class="button" href="#" target="_blank" data-url="' . admin_url( '?cz_edit_page=' ) . '" style="margin-left: 2%;line-height: 27px;height: 30px;">' . esc_html__( 'Edit', 'xtra') . '</a>',
                'dependency' => array( 'page_cover', '==', 'page' ),
                'default_option' => esc_html__( 'Select', 'xtra'),
              ),
              array(
                'id'    => 'page_cover_custom',
                'type'    => 'textarea',
                'title'   => esc_html__( 'Custom Shortcode', 'xtra' ),
                'dependency' => array( 'page_cover', '==', 'custom' )
              ),
              array(
                'id'    => 'page_cover_rev',
                'type'    => 'select',
                'title'   => esc_html__( 'Reolution Slider', 'xtra' ),
                'options'   => self::revSlider(),
                'dependency' => array( 'page_cover', '==', 'rev' ),
                'default_option' => esc_html__( 'Select', 'xtra'),
              ),

              array(
                'id'    => 'page_title',
                'type'    => 'select',
                'title'   => esc_html__( 'Title & Breadcrumbs', 'xtra' ),
                'options'   => array(
                  'd'     => esc_html__( 'Default', 'xtra' ),
                  '2'   => esc_html__( 'Title ( in Content )', 'xtra' ),
                  '3'   => esc_html__( 'Title ( Top of Content )', 'xtra' ),
                  '4'   => esc_html__( 'Title &gt; Breadcrumbs', 'xtra' ),
                  '5'   => esc_html__( 'Breadcrumbs &gt; Title', 'xtra' ),
                  '6'   => esc_html__( 'Title & Breadcrumbs ( Left & Right )', 'xtra' ),
                  '7'   => esc_html__( 'Breadcrumbs', 'xtra' ),
                  '8'   => esc_html__( 'Breadcrumbs & Title ( in Content )', 'xtra' ),
                  '9'   => esc_html__( 'Breadcrumbs ( Right )', 'xtra' ),
                ),
                'dependency' => array( 'page_cover', '==', 'title' ),
                'default'    => 'd'
              ),
              array(
                'id'    => 'page_title_center',
                'type'    => 'select',
                'title'   => esc_html__( 'Title & Breadcrumbs Center ?', 'xtra' ),
                'options'   => array(
                  'd'     => esc_html__( 'Default', 'xtra' ),
                  'n'     => esc_html__( 'No', 'xtra' ),
                  'y'     => esc_html__( 'Yes', 'xtra' ),
                ),
                'default'   => 'd',
                'dependency' => array( 'page_cover|page_title', '==|any', 'title|3,4,5,6,7,8,9' )
              ),
              array(
                'id'        => 'cover_than_header',
                'type'      => 'select',
                'title'     => esc_html__( 'Header Position', 'xtra' ),
                'options'   => array(
                  'd'                   => esc_html__( 'Default', 'xtra' ),
                  'header_top'          => esc_html__( 'Top', 'xtra' ),
                  'header_after_cover'  => esc_html__( 'Header after title ( Slider )', 'xtra' ),
                  'header_onthe_cover'  => esc_html__( 'Header Overlay ( Only Desktop )', 'xtra' ),
                  'header_onthe_cover header_onthe_cover_dt' => esc_html__( 'Header Overlay ( Desktop + Tablet )', 'xtra' ),
                  'header_onthe_cover header_onthe_cover_all' => esc_html__( 'Header Overlay ( All Devices )', 'xtra' ),
                ),
                'default'   => 'd',
                //'dependency' => array( 'page_cover', 'any', 'title,rev,custom,page' )
              ),

              array(
                'id'        => '_css_page_title',
                'type'      => 'cz_sk',
                'title'    => esc_html__( 'Container', 'xtra' ),
                'button'    => esc_html__( 'Stylekit', 'xtra' ),
                'settings'  => array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
                'selector'  => '',
                //'dependency'  => array( 'page_cover|page_title', '==|any', 'title|3,4,5,6,7' )
              ),
              array('id' => '_css_page_title_tablet','type' => 'cz_sk_hidden','selector' => ''),
              array('id' => '_css_page_title_mobile','type' => 'cz_sk_hidden','selector' => ''),

              array(
                'id'        => '_css_page_title_inner_row',
                'type'      => 'cz_sk',
                'title'    => esc_html__( 'Inner Row', 'xtra' ),
                'button'    => esc_html__( 'Stylekit', 'xtra' ),
                'settings'  => array( 'background', 'width', 'padding', 'margin', 'border', 'box-shadow' ),
                'selector'  => '',
                //'dependency'  => array( 'page_cover|page_title', '==|any', 'title|3,4,5,6,7,8,9' )
              ),
              array('id' => '_css_page_title_inner_row_tablet','type' => 'cz_sk_hidden','selector' => ''),
              array('id' => '_css_page_title_inner_row_mobile','type' => 'cz_sk_hidden','selector' => ''),

              array(
                'id'          => '_css_page_title_color',
                'type'        => 'cz_sk',
                'title'      => esc_html__( 'Page Title', 'xtra' ),
                'button'    => esc_html__( 'Stylekit', 'xtra' ),
                'settings'    => array( 'color', 'font-size', 'font-weight', 'font-style', 'letter-spacing', 'line-height', 'background', 'padding', 'margin', 'box-shadow', 'border' ),
                'selector'    => '',
                //'dependency'  => array( 'page_cover|page_title', '==|any', 'title|3,4,5,6,7,8,9' )
              ),
              array('id' => '_css_page_title_color_tablet','type' => 'cz_sk_hidden','selector' => ''),
              array('id' => '_css_page_title_color_mobile','type' => 'cz_sk_hidden','selector' => ''),

              array(
                'id'      => '_css_page_title_breadcrumbs_color',
                'type'      => 'cz_sk',
                'title'    => esc_html__( 'Breadcrumbs Typography', 'xtra' ),
                'button'    => esc_html__( 'Stylekit', 'xtra' ),
                'settings'    => array( 'font-size', 'color' ),
                'selector'    => '',
                //'dependency'  => array( 'page_cover|page_title', '==|any', 'title|4,5,6,7,8,9' )
              ),
              array('id' => '_css_page_title_breadcrumbs_color_tablet','type' => 'cz_sk_hidden','selector' => ''),
              array('id' => '_css_page_title_breadcrumbs_color_mobile','type' => 'cz_sk_hidden','selector' => ''),

              array(
                'id'      => '_css_breadcrumbs_container',
                'type'      => 'cz_sk',
                'title'    => esc_html__( 'Breadcrumbs Container', 'xtra' ),
                'button'    => esc_html__( 'Stylekit', 'xtra' ),
                'settings'    => array( 'background', 'padding', 'margin', 'box-shadow', 'border' ),
                'selector'    => '',
                //'dependency'  => array( 'page_cover|page_title', '==|any', 'title|4,5,6,7,8,9' )
              ),
              array('id' => '_css_breadcrumbs_container_tablet','type' => 'cz_sk_hidden','selector' => ''),
              array('id' => '_css_breadcrumbs_container_mobile','type' => 'cz_sk_hidden','selector' => ''),

              array(
                'id'      => '_css_breadcrumbs_inner_container',
                'type'      => 'cz_sk',
                'title'    => esc_html__( 'Breadcrumbs Inner Container', 'xtra' ),
                'button'    => esc_html__( 'Stylekit', 'xtra' ),
                'settings'    => array( 'background', 'padding', 'margin', 'box-shadow', 'border' ),
                'selector'    => '',
                //'dependency'  => array( 'page_cover|page_title', '==|any', 'title|4,5,6,7,8,9' )
              ),
              array('id' => '_css_breadcrumbs_inner_container_tablet','type' => 'cz_sk_hidden','selector' => ''),
              array('id' => '_css_breadcrumbs_inner_container_mobile','type' => 'cz_sk_hidden','selector' => ''),

              array(
                'id'      => '_css_right_br_full_container',
                'type'      => 'cz_sk',
                'title'    => esc_html__( 'Extra Container', 'xtra' ),
                'button'    => esc_html__( 'Stylekit', 'xtra' ),
                'settings'    => array( 'background', 'padding', 'margin', 'box-shadow', 'border' ),
                'selector'    => '',
                //'dependency'  => array( 'page_cover|page_title', '==|==', 'title|6' )
              ),
              array('id' => '_css_right_br_full_container_tablet','type' => 'cz_sk_hidden','selector' => ''),
              array('id' => '_css_right_br_full_container_mobile','type' => 'cz_sk_hidden','selector' => ''),

            )
          ), // page_title_br

          $page_seo

				))
			));
		}

		/**
		 *
		 * Breadcrumbs and title options
		 * 
		 * @var post type name, CSS selector
		 * @return array
		 *
		 */
		public static function title_options( $i = '', $c = '' ) {

			// Icon option for default title settings
			$br_separator = $i ? array(
				'type'    		=> 'notice',
				'class'   		=> 'info',
				'content' 		=> '',
				'dependency' 	=> array( 'xxx', '==', 'true' )
			) : array(
				'id'    		=> 'breadcrumbs_separator',
				'type'  		=> 'icon',
				'title' 		=> esc_html__( 'Separator', 'xtra' ),
				'dependency' 	=> array( 'page_cover|page_title', '==|any', 'title|4,5,6,7,8,9' ),
				'setting_args' 	=> array( 'transport' => 'postMessage' )
			);

			$br_home_icon = $i ? array(
				'type'    		=> 'notice',
				'class'   		=> 'info',
				'content' 		=> '',
				'dependency' 	=> array( 'xxx', '==', 'true' )
			) : array(
				'id'    		=> 'breadcrumbs_home_icon',
				'type'  		=> 'icon',
				'title' 		=> esc_html__( 'Home icon ?', 'xtra' ),
				'dependency' 	=> array( 'page_cover|page_title', '==|any', 'title|4,5,6,7,8,9' ),
				'setting_args' 	=> array( 'transport' => 'postMessage' )
			);

      $show_br_front_page = $i ? array(
        'type'        => 'notice',
        'class'       => 'info',
        'content'     => '',
        'dependency'  => array( 'xxx', '==', 'true' )
      ) : array(
        'id'          => 'show_br_front_page',
        'type'        => 'switcher',
        'title'       => esc_html__( 'Show on front page?', 'xtra' ),
        'dependency'  => array( 'page_cover|page_title', '==|any', 'title|4,5,6,7,8,9' ),
      );

			return array(
				array(
					'id' 	=> 'page_cover' . $i,
					'type' 	=> 'select',
					'title' => esc_html__( 'Title Type', 'xtra' ),
					'options' => array(
						( $i ? '1' : '' ) => $i ? esc_html__( 'Default', 'xtra' ) : esc_html__( 'Select', 'xtra' ),
						'none' 		=> esc_html__( 'None', 'xtra' ),
						'title' 	=> esc_html__( 'Title & Breadcrumbs', 'xtra' ),
						'rev' 		=> esc_html__( 'Revolution Slider', 'xtra' ),
						'custom' 	=> esc_html__( 'Custom Shortcode', 'xtra' ),
						'page' 		=> esc_html__( 'Custom Page', 'xtra' )
					),
					'help'  => self::help('default'),
					'default' => $i ? '1' : 'none'
				),
				array(
					'id'            => 'page_cover_page' . $i,
					'type'          => 'select',
					'title'         => esc_html__( 'Select Page', 'xtra' ),
					'options'       => Codevz::$array_pages,
					'dependency' 	=> array( 'page_cover' . $i, '==', 'page' )
				),
				array(
					'id' 	=> 'page_cover_custom' . $i,
					'type' 	=> 'textarea',
					'title' => esc_html__( 'Custom Shortcode', 'xtra' ),
					'dependency' => array( 'page_cover' . $i, '==', 'custom' )
				),
				array(
					'id' 			=> 'page_cover_rev' . $i,
					'type' 			=> 'select',
					'title' 		=> esc_html__( 'Reolution Slider', 'xtra' ),
					'options' 		=> self::revSlider(),
					'dependency' 	=> array( 'page_cover' . $i, '==', 'rev' ),
					'default_option' => esc_html__( 'Select', 'xtra'),
				),

				array(
					'id' 			=> 'page_title' . $i,
					'type' 			=> 'select',
					'title' 		=> esc_html__( 'Title & Breadcrumbs', 'xtra' ),
					'options' 		=> array(
						'1' 	=> $i ? esc_html__( 'Default', 'xtra' ) : esc_html__( 'Select', 'xtra' ),
						'2' 	=> esc_html__( 'Title ( in Content )', 'xtra' ),
						'3' 	=> esc_html__( 'Title ( Top of Content )', 'xtra' ),
						'4' 	=> esc_html__( 'Title &gt; Breadcrumbs', 'xtra' ),
						'5' 	=> esc_html__( 'Breadcrumbs &gt; Title', 'xtra' ),
						'6' 	=> esc_html__( 'Title & Breadcrumbs ( Left & Right )', 'xtra' ),
						'7' 	=> esc_html__( 'Breadcrumbs', 'xtra' ),
						'8' 	=> esc_html__( 'Breadcrumbs & Title ( in Content )', 'xtra' ),
						'9' 	=> esc_html__( 'Breadcrumbs ( Right )', 'xtra' ),
					),
					'dependency' 	=> array( 'page_cover' . $i, '==', 'title' ),
					'default' 		=> '1'
				),
        array(
          'id'      => 'page_title_center' . $i,
          'type'      => 'switcher',
          'title'     => esc_html__( 'Center mode?', 'xtra' ),
          'dependency'  => array( 'page_cover' . $i . '|page_title' . $i, 'any|any', 'title|3,4,5,7,8,9' )
        ),
        $show_br_front_page,
				$br_home_icon,
				$br_separator,
				array(
					'id' 			=> 'cover_than_header' . $i,
					'type' 			=> 'select',
					'title' 		=> esc_html__( 'Header Position', 'xtra' ),
					'options' 		=> array(
						'' 		 			 => esc_html__( 'Default', 'xtra' ),
						'header_top' 		 	=> esc_html__( 'Top', 'xtra' ),
						'header_after_cover' 	=> esc_html__( 'Header after title', 'xtra' ),
						'header_onthe_cover' 	=> esc_html__( 'Header Overlay ( Only Desktop )', 'xtra' ),
						'header_onthe_cover header_onthe_cover_dt' => esc_html__( 'Header Overlay ( Desktop + Tablet )', 'xtra' ),
						'header_onthe_cover header_onthe_cover_all' => esc_html__( 'Header Overlay ( All Devices )', 'xtra' ),
					),
					'dependency' 	=> array( 'page_cover' . $i, 'any', 'title,rev,custom,page' )
				),
				array(
					'id'        	=> 'title_parallax' . $i,
					'type'      	=> 'slider',
					'title'     	=> esc_html__( 'Background Parallax', 'xtra' ),
					'help'   		=> esc_html__( 'This option is related to Container background, Best value is between -5 to 5', 'xtra' ),
					'options' 		=> array( 'unit' => '', 'step' => 1, 'min' => -5, 'max' => 5 ),
					'dependency' 	=> array( 'page_cover' . $i . '|page_title' . $i, '==|any', 'title|3,4,5,6,7,8,9' )
				),
				array(
					'id' 			=> '_css_page_title' . $i,
					'type' 			=> 'cz_sk',
					'button' 		=> esc_html__( 'Container', 'xtra' ),
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
					'selector' 		=> $c . '.page_title,' . $c . '.header_onthe_cover .page_title',
					'dependency' 	=> array( 'page_cover' . $i . '|page_title' . $i, '==|any', 'title|3,4,5,6,7,8,9' )
				),
				array(
					'id' 			=> '_css_page_title' . $i . '_tablet',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $c . '.page_title,' . $c . '.header_onthe_cover .page_title'
				),
				array(
					'id' 			=> '_css_page_title' . $i . '_mobile',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $c . '.page_title,' . $c . '.header_onthe_cover .page_title'
				),
				array(
					'id' 			=> '_css_page_title_inner_row' . $i,
					'type' 			=> 'cz_sk',
					'button' 		=> esc_html__( 'Inner Row', 'xtra' ),
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'settings' 		=> array( 'background', 'width', 'padding', 'margin', 'border', 'box-shadow' ),
					'selector' 		=> $c . '.page_title .row',
					'dependency' 	=> array( 'page_cover' . $i . '|page_title' . $i, '==|any', 'title|3,4,5,6,7,8,9' )
				),
				array(
					'id' 			=> '_css_page_title_inner_row' . $i . '_tablet',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $c . '.page_title .row',
				),
				array(
					'id' 			=> '_css_page_title_inner_row' . $i . '_mobile',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $c . '.page_title .row',
				),
				array(
					'id' 			=> '_css_page_title_color' . $i,
					'type' 			=> 'cz_sk',
					'button' 		=> esc_html__( 'Page Title', 'xtra' ),
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'settings' 		=> array( 'color', 'font-size', 'font-weight', 'font-style', 'letter-spacing', 'line-height', 'letter-spacing', 'background', 'padding', 'margin', 'box-shadow', 'text-shadow', 'border' ),
					'selector' 		=> $c . '.page_title .section_title',
					'dependency' 	=> array( 'page_cover' . $i . '|page_title' . $i, '==|any', 'title|3,4,5,6' )
				),
				array(
					'id' 			=> '_css_page_title_color' . $i . '_tablet',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $c . '.page_title .section_title',
				),
				array(
					'id' 			=> '_css_page_title_color' . $i . '_mobile',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $c . '.page_title .section_title',
				),
				array(
					'id' 			=> '_css_inner_title' . $i,
					'type' 			=> 'cz_sk',
					'button' 		=> esc_html__( 'Title ( in Content )', 'xtra' ),
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'settings' 		=> array( 'color', 'background', 'font-size', 'font-weight', 'font-style', 'text-align', 'line-height', 'text-transform', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
					'selector' 		=> $c . ' .content > h3:first-child,' . $c . ' .content .section_title',
					'dependency' 	=> array( 'page_cover' . $i . '|page_title' . $i, '==|any', 'title|2,8' )
				),
				array(
					'id' 			=> '_css_inner_title' . $i . '_tablet',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $c . ' .content > h3:first-child,' . $c . ' .content .section_title'
				),
				array(
					'id' 			=> '_css_inner_title' . $i . '_mobile',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $c . ' .content > h3:first-child,' . $c . ' .content .section_title'
				),
				array(
					'id' 			=> '_css_page_title_breadcrumbs_color' . $i,
					'type' 			=> 'cz_sk',
					'button' 		=> esc_html__( 'Breadcrumbs Typography', 'xtra' ),
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'settings' 		=> array( 'color', 'font-size', 'font-weight', 'font-style', 'letter-spacing', 'line-height', 'letter-spacing', 'text-shadow' ),
					'selector' 		=> $c . '.page_title a,' . $c . '.page_title a:hover,' . $c . '.page_title i',
					'dependency' 	=> array( 'page_cover' . $i . '|page_title' . $i, '==|any', 'title|4,5,6,7,8,9' )
				),
				array(
					'id' 			=> '_css_page_title_breadcrumbs_color' . $i . '_tablet',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $c . '.page_title a,' . $c . '.page_title a:hover,' . $c . '.page_title i',
				),
				array(
					'id' 			=> '_css_page_title_breadcrumbs_color' . $i . '_mobile',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $c . '.page_title a,' . $c . '.page_title a:hover,' . $c . '.page_title i',
				),
				array(
					'id' 			=> '_css_breadcrumbs_inner_container' . $i,
					'type' 			=> 'cz_sk',
					'button' 		=> esc_html__( 'Breadcrumbs Inner', 'xtra' ),
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'settings' 		=> array( 'background', 'width', 'padding', 'margin', 'box-shadow', 'border' ),
					'selector' 		=> $c . '.breadcrumbs',
					'dependency' 	=> array( 'page_cover' . $i . '|page_title' . $i, '==|any', 'title|4,5,6,7,8,9' )
				),
				array(
					'id' 			=> '_css_breadcrumbs_inner_container' . $i . '_tablet',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $c . '.breadcrumbs',
				),
				array(
					'id' 			=> '_css_breadcrumbs_inner_container' . $i . '_mobile',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $c . '.breadcrumbs',
				),
				array(
					'id' 			=> '_css_right_br_full_container' . $i,
					'type' 			=> 'cz_sk',
					'button' 		=> esc_html__( 'Overall row container', 'xtra' ),
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'settings' 		=> array( 'background', 'padding', 'margin', 'box-shadow', 'border' ),
					'selector' 		=> $c . '.right_br_full_container',
					'dependency' 	=> array( 'page_cover' . $i . '|page_title' . $i, '==|==', 'title|6' )
				),
				array(
					'id' 			=> '_css_right_br_full_container' . $i . '_tablet',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $c . '.right_br_full_container',
				),
				array(
					'id' 			=> '_css_right_br_full_container' . $i . '_mobile',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $c . '.right_br_full_container',
				),
			);
		}

		/**
		 *
		 * Customize page options
		 * 
		 * @return array
		 *
		 */
		public static function options() {

			$options = array();

			$options[]   = array(
				'name' 		=> 'general',
				'title' 	=> esc_html__( 'General Settings', 'xtra' ),
				'sections' => array(

					array(
						'name'   => 'layout',
						'title'  => esc_html__( 'Layout', 'xtra' ),
						'fields' => array(
							array(
								'id' 		=> 'layout',
								'type' 		=> 'select',
								'title' 	=> esc_html__( 'Layout', 'xtra' ),
								'options' 	=> array(
									'' 				=> esc_html__( 'Select', 'xtra' ),
									'ws' 			=> esc_html__( 'Without sidebar', 'xtra' ),
							        'bpnp'      	=> esc_html__( 'Blank Page ( No Padding )', 'xtra' ),
                  'right'       => esc_html__( 'Right sidebar', 'xtra' ),
                  'right-s'     => esc_html__( 'Right sidebar ( Small )', 'xtra' ),
                  'left'        => esc_html__( 'Left sidebar', 'xtra' ),
                  'left-s'      => esc_html__( 'Left sidebar ( Small )', 'xtra' ),
									'both-side' 	=> esc_html__( 'Both sidebars', 'xtra' ),
									'both-side2' 	=> esc_html__( 'Both sidebars ( Small )', 'xtra' ),
									'both-right'	=> esc_html__( 'Both sidebars ( Right )', 'xtra' ),
									'both-right2'	=> esc_html__( 'Both sidebars ( Right - Small )', 'xtra' ),
									'both-left' 	=> esc_html__( 'Both sidebars ( Left )', 'xtra' ),
									'both-left2' 	=> esc_html__( 'Both sidebars ( Left - Small )', 'xtra' ),
								),
								'default'  	=> 'right',
								'help'  	=> self::help('default')
							),
							array(
								'id' 		=> 'primary',
								'type' 		=> 'select',
								'title' 	=> esc_html__( 'Sidebar', 'xtra' ),
								'default' 	=> 'primary',
								'options' 	=> self::sidebars(),
					      		'dependency' 	=> array( 'layout|layout|layout', '!=|!=|!=', '|ws|bpnp' )
							),
							array(
								'id' 		=> 'secondary',
								'type' 		=> 'select',
								'title' 	=> esc_html__( 'Secondary Sidebar', 'xtra' ),
								'default' 	=> 'secondary',
								'options' 	=> self::sidebars(),
					      		'dependency' 	=> array( 'layout|layout|layout|layout|layout', '!=|!=|!=|!=|!=', '|ws|left|right|bpnp' )
							),
							array(
								'id'              => 'sidebars',
								'type'            => 'group',
								'title' 		  => esc_html__('Add Sidebar', 'xtra'),
								'button_title'    => esc_html__('Add Sidebar', 'xtra'),
								'help' 			  => esc_html__('Save and refresh is required for this option', 'xtra'),
								'fields'          => array(
									array(
										'id'          => 'id',
										'type'        => 'text',
										'title'       => esc_html__('Title', 'xtra')
									),
								),
								'setting_args' 	 => array('transport' => 'postMessage')
							),
							array(
								'id' 		=> 'sticky',
								'type' 		=> 'switcher',
								'title' 	=> esc_html__( 'Sticky Sidebars ?', 'xtra' ),
								'help' 		=> esc_html__( 'Sticky all sidebars and content layouts', 'xtra' )
							),
						),
					),

					array(
						'name'   => 'responsive',
						'title'  => esc_html__( 'Responsive', 'xtra' ),
						'fields' => array(
							array(
								'id' 		=> 'responsive',
								'type' 		=> 'switcher',
								'title' 	=> esc_html__( 'Responsive', 'xtra' ),
								'default' 	=> true
							),
							array(
								'id'        => 'breakpoint_2',
								'type'      => 'slider',
								'title'     => esc_html__( 'Medium device breakpoint', 'xtra' ),
								'help'      => '768px',
								'default'   => '768px',
								'options' 	=> array( 'unit' => 'px', 'step' => 1, 'min' => 100, 'max' => 1200 ),
								'dependency' => array( 'responsive', '==', 'true' )
							),
							array(
								'id'		=> 'breakpoint_2_custom_css',
								'type'		=> 'textarea',
								'title'		=> esc_html__('Medium device custom CSS', 'xtra'),
								'help'		=> esc_html__('Insert codes without style tag', 'xtra'),
								'attributes' => array(
                  'placeholder' => ".selector {font-size: 20px}",
									'style'	      => "direction: ltr",
								),
								'dependency' => array( 'responsive', '==', 'true' )
							),
							array(
								'id'        => 'breakpoint_3',
								'type'      => 'slider',
								'title'     => esc_html__( 'Small device breakpoint', 'xtra' ),
								'help'      => '480px',
								'default'   => '480px',
								'options' 	=> array( 'unit' => 'px', 'step' => 1, 'min' => 100, 'max' => 1200 ),
								'dependency' => array( 'responsive', '==', 'true' )
							),
							array(
								'id'		=> 'breakpoint_3_custom_css',
								'type'		=> 'textarea',
								'title'		=> esc_html__('Small device custom CSS', 'xtra'),
								'help'		=> esc_html__('Insert codes without style tag', 'xtra'),
								'attributes' => array(
									'placeholder'	=> ".selector {font-size: 20px}",
                  'style'       => "direction: ltr",
								),
								'dependency' => array( 'responsive', '==', 'true' )
							),
						)
					),

					array(
						'name'   => 'loading',
						'title'  => esc_html__( 'Loading', 'xtra' ),
						'fields' => array(
							array(
								'id'			=> 'pageloader',
								'type'			=> 'switcher',
								'title'			=> esc_html__('Loading', 'xtra'),
							),
							array(
								'id'			=> 'out_loading',
								'type'			=> 'switcher',
								'title'			=> esc_html__('Show loadnig by click on links', 'xtra'),
								'dependency'  	=> array( 'pageloader', '==', true ),
								'setting_args' 	=> array( 'transport' => 'postMessage' )
							),
							array(
								'id' 			=> '_css_preloader',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Loading Background', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'background' ),
								'selector' 		=> '.pageloader',
								'dependency' 	=> array( 'pageloader', '==', true )
							),
							array(
								'id' 			=> '_css_preloader_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.pageloader',
							),
							array(
								'id' 			=> '_css_preloader_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.pageloader',
							),
							array(
								'id'			=> 'pageloader_img',
								'type'			=> 'upload',
								'title'			=> esc_html__('Image', 'xtra'),
                'preview'       => 1,
								'dependency'  	=> array( 'pageloader', '==', true ),
								'setting_args' 	=> array( 'transport' => 'postMessage' )
							),
							array(
								'id'        => 'pageloader_fx',
								'type'      => 'select',
								'title'     => esc_html__( 'Image Animation', 'xtra' ),
								'options' 	=> array(
									'' 				=> esc_html__( 'Select', 'xtra' ),
									'cz_load_fx1' 	=> '1',
									'cz_load_fx2' 	=> '2',
								),
                'dependency'    => array( 'pageloader', '==', true ),
							),
							array(
								'id'			=> 'pageloader_time',
								'type'			=> 'slider',
								'title'			=> esc_html__('Custom time ( ms )', 'xtra'),
								'help'			=> esc_html__('Hide loading after this time', 'xtra'),
								'options' 		=> array( 'unit' => '', 'step' => 500, 'min' => 500, 'max' => 10000 ),
								'dependency' 	=> array( 'pageloader', '==', true ),
								'setting_args' 	=> array( 'transport' => 'postMessage' )
							),
						),
					),

					array(
						'name'   => 'maintenance',
						'title'  => esc_html__( 'Maintenance Mode', 'xtra' ),
						'fields' => array(
							array(
								'id'            => 'maintenance',
								'type'          => 'select',
								'title'         => esc_html__( 'Maintenance mode', 'xtra' ),
								'help'			 => esc_html__('If you set this option, then all of your visitors will redirect to this page', 'xtra'),
								'options'       => Codevz::$array_pages,
								'setting_args' 	 => array('transport' => 'postMessage')
							),
						)
					),

					array(
						'name'    => 'page_404',
						'title'   => esc_html__( 'Page 404', 'xtra' ),
						'fields'  => array(
							array(
								'id'            => '404',
								'type'          => 'select',
								'title'         => esc_html__( 'Page 404', 'xtra' ),
								'options'       => Codevz::$array_pages,
								'setting_args'  => array('transport' => 'postMessage')
							),
							array(
								'id'            => 'not_found',
								'type'          => 'textarea',
								'title'         => esc_html__( 'Default 404 message', 'xtra' ),
								'setting_args'  => array( 'transport' => 'postMessage' )
							),
						)
					),

					array(
						'name'    => 'seo',
						'title'   => esc_html__( 'SEO Settings', 'xtra' ),
						'fields'  => array(
              array(
                'id'            => 'description',
                'type'          => 'textarea',
                'title'         => esc_html__('SEO Description', 'xtra'),
                'help'          => esc_html__('If you fill this field, all required meta tags automatically will add to your site', 'xtra'),
                'attributes'    => array( 'placeholder' => 'Site description' ),
                'setting_args'  => array('transport' => 'postMessage')
              ),
              array(
                'id'            => 'keywords',
                'type'          => 'textarea',
                'title'         => esc_html__('SEO Keywords', 'xtra'),
                'attributes'    => array( 'placeholder' => 'e.g. bisuness, entertainment, seo, tutorial' ),
                'setting_args'  => array('transport' => 'postMessage')
              ),
              array(
                'id'            => 'lazyload',
                'type'          => 'switcher',
                'title'         => esc_html__('Lazyload images', 'xtra'),
                'help'          => esc_html__('Speed up your site by loading images on page scrolling', 'xtra'),
                'setting_args'  => array('transport' => 'postMessage')
              ),
              array(
                'id'            => 'remove_query_args',
                'type'          => 'switcher',
                'title'         => esc_html__('Remove query args (JS-CSS)', 'xtra'),
                'help'          => esc_html__('Resources with \'?\' in the URL are not cached by some proxy caching servers. You can enable this option for fixing it.', 'xtra'),
                'setting_args'  => array('transport' => 'postMessage')
              ),
						)
					),

					array(
						'name'   => 'ajax',
						'title'  => esc_html__( 'AJAX Mode', 'xtra' ),
						'fields' => array(
							array(
								'id' 			=> 'ajax',
								'type' 			=> 'switcher',
								'title' 		=> esc_html__( 'Ajax', 'xtra' ),
								'help'			=> esc_html__( 'Ajax mode will loads pages without reloading browser and uses fewer server resources', 'xtra'),
							),
							array(
								'id' 			=> '_css_ajax_loader',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Ajax Spinner', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'background', 'padding', 'box-shadow', 'border-style', 'border-width', 'border-right-color', 'border-radius' ),
								'selector' 		=> '.cz_ajax_loader',
								'dependency' 	=> array( 'ajax', '==', true )
							),
							array(
								'id' 			=> '_css_ajax_loader_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_ajax_loader',
							),
							array(
								'id' 			=> '_css_ajax_loader_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_ajax_loader',
							),
							array(
								'id'            => 'ajax_mp',
								'type'          => 'switcher',
								'title'         => esc_html__( 'Fixed music player?', 'xtra' ),
								'dependency' 	=> array( 'ajax', '==', true ),
							),
							array(
								'id'              => 'ajax_mp_tracks',
								'type'            => 'group',
								'title' 		  => esc_html__('Add track(s)', 'xtra'),
								'button_title'    => esc_html__('Add new', 'xtra'),
								'dependency' 	  => array( 'ajax_mp|ajax', '==|==', 'true|true' ),
								'fields'          => array(
									array(
										'id'          => 'title',
										'type'        => 'text',
										'title'       => esc_html__('Title', 'xtra')
									),
									array(
										'id'          => 'badge',
										'type'        => 'text',
										'title'       => esc_html__('Badge', 'xtra')
									),
									array(
										'id'          => 'mp3',
										'type'        => 'upload',
										'title'       => esc_html__('MP3 or Stream URL', 'xtra'),
										'settings'   => array(
											'upload_type'  => 'audio/mpeg',
											'frame_title'  => 'Upload / Select',
											'insert_title' => 'Insert',
										),
									),
								)
							),
							array(
								'id'            => 'ajax_mp_autoplay',
								'type'          => 'switcher',
								'title'         => esc_html__( 'Auto play?', 'xtra' ),
								'dependency' 	=> array( 'ajax_mp|ajax', '==|==', 'true|true' ),
							),
							array(
								'id'            => 'ajax_mp_flat',
								'type'          => 'switcher',
								'title'         => esc_html__( 'Flat mode?', 'xtra' ),
								'dependency' 	=> array( 'ajax_mp|ajax', '==|==', 'true|true' ),
							),
							array(
								'id'            => 'ajax_mp_dark_text',
								'type'          => 'switcher',
								'title'         => esc_html__( 'Dark text?', 'xtra' ),
								'dependency' 	=> array( 'ajax_mp|ajax', '==|==', 'true|true' ),
							),
							array(
								'id' 			=> '_css_ajax_mp',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Player styling', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '#cz_ajax_mp .bd.sm2-main-controls, #cz_ajax_mp .bd.sm2-playlist-drawer',
								'dependency' 	=> array( 'ajax_mp|ajax', '==|==', 'true|true' ),
							),
							array(
								'id' 			=> '_css_ajax_mp_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '#cz_ajax_mp .bd.sm2-main-controls, #cz_ajax_mp .bd.sm2-playlist-drawer',
							),
							array(
								'id' 			=> '_css_ajax_mp_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '#cz_ajax_mp .bd.sm2-main-controls, #cz_ajax_mp .bd.sm2-playlist-drawer',
							),
						)
					),

					array(
						'name'   => 'popup',
						'title'  => esc_html__( 'Popup, Modal Box', 'xtra' ),
						'fields' => array(
							array(
								'type'    => 'notice',
								'class'   => 'info',
								'content' => esc_html__( 'Select the page that you created with popup element, then you can launch it from any links and buttons with your popup unique ID, e.g. #popup_id', 'xtra' )
							),
							array(
								'id'            => 'popup',
								'type'          => 'select',
								'title'         => esc_html__( 'Popup Page', 'xtra' ),
								'options'       => Codevz::$array_pages
							),
						)
					),

					array(
						'name'   => 'nicescroll',
						'title'  => esc_html__( 'Nicescroll', 'xtra' ),
						'fields' => array(
							array(
								'id' 		=> 'nicescroll',
								'type' 		=> 'switcher',
								'title' 	=> esc_html__( 'NiceScroll', 'xtra' ),
								'default' 	=> false
							),
							array(
								'id'              => 'nicescroll_opt',
								'type'            => 'group',
								'limit'           => 1,
								'title' 		  => esc_html__('NiceScroll Config', 'xtra'),
								'button_title'    => esc_html__('Parameters', 'xtra'),
								'fields'          => array(
									array(
										'id'        => 'railalign',
										'type'      => 'select',
										'title'     => esc_html__( 'Scroll Position', 'xtra' ),
										'options' 	=> array(
											'' 				=> esc_html__( 'Default', 'xtra' ),
											'right' 		=> esc_html__( 'Right', 'xtra' ),
											'left' 			=> esc_html__( 'Left', 'xtra' )
										),
									),
									array(
										'id'        => 'cursorcolor',
										'type'      => 'color_picker',
										'title'     => esc_html__( 'Cursor Color', 'xtra' )
									),
									array(
										'id'        => 'background',
										'type'      => 'color_picker',
										'title'     => esc_html__( 'Rail Background', 'xtra' )
									),
									array(
										'id'        => 'cursoropacitymin',
										'type'      => 'select',
										'title'     => esc_html__( 'Cursor Opacity Inactive', 'xtra' ),
										'options' 	=> array(
											'1' 			=> '1',
											'0.9' 			=> '0.9',
											'0.8' 			=> '0.8',
											'0.7' 			=> '0.7',
											'0.6' 			=> '0.6',
											'0.5' 			=> '0.5',
											'0.4' 			=> '0.4',
											'0.3' 			=> '0.3',
											'0.2' 			=> '0.2',
											'0.1' 			=> '0.1',
											'00' 			=> '0',
										),
									),
									array(
										'id'        => 'cursoropacitymax',
										'type'      => 'select',
										'title'     => esc_html__( 'Cursor Opacity Active', 'xtra' ),
										'options' 	=> array(
											'1' 			=> '1',
											'0.9' 			=> '0.9',
											'0.8' 			=> '0.8',
											'0.7' 			=> '0.7',
											'0.6' 			=> '0.6',
											'0.5' 			=> '0.5',
											'0.4' 			=> '0.4',
											'0.3' 			=> '0.3',
											'0.2' 			=> '0.2',
											'0.1' 			=> '0.1',
											'00' 			=> '0',
										),
									),
									array(
										'id'        => 'cursorwidth',
										'type'      => 'slider',
										'title'     => esc_html__( 'Cursor Width', 'xtra' ),
										'default'	=> '8px',
										'options' 	=> array( 'unit' => 'px', 'step' => 1, 'min' => 1, 'max' => 50 )
									),
									array(
										'id'        => 'cursorborderradius',
										'type'      => 'slider',
										'title'     => esc_html__( 'Cursor Border Radius', 'xtra' ),
										'default'	=> '20px',
										'options' 	=> array( 'unit' => 'px', 'step' => 1, 'min' => 1, 'max' => 50 )
									),
									array(
										'id'        => 'scrollspeed',
										'type'      => 'slider',
										'title'     => esc_html__( 'Scrolling Speed', 'xtra' ),
										'options' 	=> array( 'unit' => '', 'step' => 10, 'min' => 10, 'max' => 120 )
									),
									array(
										'id'        => 'scrollspeed',
										'type'      => 'slider',
										'title'     => esc_html__( 'Scrolling Speed Mouse Wheel', 'xtra' ),
										'options' 	=> array( 'unit' => '', 'step' => 10, 'min' => 10, 'max' => 120 )
									),

								),
								'dependency' => array( 'nicescroll', '==', 'true' )
							),

						)
					),

					array(
						'name'   => 'wp_login',
						'title'  => esc_html__( 'WP-Login Page', 'xtra' ),
						'fields' => array(
							
							array(
								'id' 			=> 'wp_login_logo',
								'type' 			=> 'upload',
								'title' 		=> esc_html__( 'Logo', 'xtra' ),
                'preview'       => 1,
								'setting_args' 	=> array( 'transport' => 'postMessage' )
							),
							array(
								'id' 			=> '_wp_login_body',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Body', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'border' ),
								'selector' 		=> ''
							),
							array(
								'id' 			=> '_wp_login_links',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Links', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'padding', 'margin', 'box-shadow', 'border' ),
								'selector' 		=> ''
							),
							array(
								'id' 			=> '_wp_login_form',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Form Container', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'background', 'padding', 'margin', 'box-shadow', 'border' ),
								'selector' 		=> ''
							),
							array(
								'id' 			=> '_wp_login_inputs',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Form Inputs', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'padding', 'margin', 'box-shadow', 'border' ),
								'selector' 		=> ''
							),
							array(
								'id' 			=> '_wp_login_button',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Form Button', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'padding', 'margin', 'box-shadow', 'border' ),
								'selector' 		=> ''
							),
						),
					),

					array(
						'name'   => 'custom_codes',
						'title'  => esc_html__( 'Custom codes', 'xtra' ),
						'fields' => array(
							array(
								'id'		=> 'dev_css',
								'type'		=> 'textarea',
								'title'		=> 'DEV CSS',
								'dependency'  => array( 'dev', '==', 'xxx' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' )
							),
							array(
								'id'		=> 'css',
								'type'		=> 'textarea',
								'title'		=> esc_html__('Custom CSS', 'xtra'),
								'help'		=> esc_html__('Insert codes without style tag', 'xtra'),
								'attributes' => array(
									'placeholder'	=> ".selector {font-size: 20px}",
                  'style'       => "direction: ltr",
								),
								'setting_args' 	=> array( 'transport' => 'postMessage' )
							),
							array(
								'id'		=> 'js',
								'type'		=> 'textarea',
								'title'		=> esc_html__('Custom JS', 'xtra'),
								'help'		=> esc_html__('Insert codes without script tag', 'xtra'),
								'attributes' => array(
									'placeholder'	=> "jQuery('.selector').addClass('class');",
                  'style'       => "direction: ltr",
								)
							),
							array(
								'id'		=> 'head_codes',
								'type'		=> 'textarea',
								'title'		=> esc_html__('Before closing /head', 'xtra'),
                'attributes' => array(
                  'style'       => "direction: ltr",
                ),
							),
							array(
								'id'		=> 'foot_codes',
								'type'		=> 'textarea',
								'title'		=> esc_html__('Before closing /body', 'xtra'),
                'attributes' => array(
                  'style'       => "direction: ltr",
                ),
							),
						),
					),

          array(
            'name'   => 'general_more',
            'title'  => esc_html__( 'More Settings', 'xtra' ),
            'fields' => array(
              array(
                'type'    => 'notice',
                'class'   => 'info',
                'content' => esc_html__( 'If you want to improve page builder speed, disable templates or some of page builder modules.', 'xtra' )
              ),
							array(
								'id' 			    => 'vc_disable_templates',
								'type' 			  => 'switcher',
								'title' 		  => esc_html__( 'Disable Page Builder Templates', 'xtra' ),
								'help' 			  => esc_html__( 'If you do not need content premium templates in the page builder, check this option. This will increase your page builder load speed.', 'xtra' ),
								'setting_args' => array( 'transport' => 'postMessage' )
							),
              array(
                'id'      => 'vc_disable_modules',
                'type'    => 'checkbox',
                'title'   => esc_html__( 'Disable Page Builder Modules', 'xtra' ),
                'setting_args' => array( 'transport' => 'postMessage' ),
                'options' => array(
                  'contact-form-7'    => esc_html__('Contact form 7', 'xtra'),
                  'vc_icon'           => esc_html__('Icon', 'xtra'),
                  'vc_separator'      => esc_html__('Separator', 'xtra'),
                  'vc_zigzag'         => esc_html__('Zig Zag', 'xtra'),
                  'vc_text_separator' => esc_html__('Text Separator', 'xtra'),
                  'vc_message'        => esc_html__('Message Box', 'xtra'),
                  'vc_hoverbox'       => esc_html__('Hover Box', 'xtra'),
                  'vc_facebook'       => esc_html__('Facebook', 'xtra'),
                  'vc_tweetmeme'      => esc_html__('Twitter', 'xtra'),
                  'vc_googleplus'     => esc_html__('Google Plus', 'xtra'),
                  'vc_pinterest'      => esc_html__('Pinterest', 'xtra'),
                  'vc_toggle'         => esc_html__('Toggle', 'xtra'),
                  'vc_single_image'   => esc_html__('Single Image', 'xtra'),
                  'vc_gallery'        => esc_html__('Gallery', 'xtra'),
                  'vc_images_carousel'=> esc_html__('Images Carousel', 'xtra'),
                  'vc_tta_tabs'       => esc_html__('Tabs', 'xtra'),
                  'vc_tta_tour'       => esc_html__('Tour', 'xtra'),
                  'vc_tta_accordion'  => esc_html__('Accordion', 'xtra'),
                  'vc_tta_pageable'   => esc_html__('Pageable', 'xtra'),
                  'vc_custom_heading' => esc_html__('Custom Heading', 'xtra'),
                  'vc_btn'            => esc_html__('Button', 'xtra'),
                  'vc_cta'            => esc_html__('Call to Action', 'xtra'),
                  'vc_posts_slider'   => esc_html__('Posts Slider', 'xtra'),
                  'vc_video'          => esc_html__('Video', 'xtra'),
                  'vc_gmaps'          => esc_html__('Google Map', 'xtra'),
                  'vc_flickr'         => esc_html__('Flickr', 'xtra'),
                  'vc_progress_bar'   => esc_html__('Progress Bar', 'xtra'),
                  'vc_pie'            => esc_html__('Pie Chart', 'xtra'),
                  'vc_round_chart'    => esc_html__('Round Chart', 'xtra'),
                  'vc_line_chart'     => esc_html__('Line Chart', 'xtra'),
                  'vc_basic_grid'     => esc_html__('Posts Grid', 'xtra'),
                  'vc_media_grid'     => esc_html__('Media Grid', 'xtra'),
                  'vc_masonry_grid'   => esc_html__('Masonry Grid', 'xtra'),
                  'vc_masonry_media_grid' => esc_html__('Masonry Media Grid', 'xtra'),
                  'woocommerce_cart'      => esc_html__('Woocommerce Cart', 'xtra'),
                  'woocommerce_checkout'  => esc_html__('Woocommerce Checkout', 'xtra'),
                  'woocommerce_order_tracking'  => esc_html__('Woocommerce Order Tracking', 'xtra'),
                  'woocommerce_my_account'      => esc_html__('Woocommerce My Account', 'xtra'),
                  'recent_products'   => esc_html__('Woocommerce Recent Products', 'xtra'),
                  'featured_products' => esc_html__('Woocommerce Featured Products', 'xtra'),
                  'product'           => esc_html__('Woocommerce Product', 'xtra'),
                  'products'          => esc_html__('Woocommerce Products', 'xtra'),
                  'add_to_cart'       => esc_html__('Woocommerce Add to Cart', 'xtra'),
                  'add_to_cart_url'   => esc_html__('Woocommerce Add to Cart URL', 'xtra'),
                  'product_page'      => esc_html__('Woocommerce Product Page', 'xtra'),
                  'product_category'  => esc_html__('Woocommerce Product Category', 'xtra'),
                  'product_categories'=> esc_html__('Woocommerce Product Categories', 'xtra'),
                  'sale_products'     => esc_html__('Woocommerce Sale Products', 'xtra'),
                  'best_selling_products' => esc_html__('Woocommerce Best Selling Products', 'xtra'),
                  'top_rated_products'=> esc_html__('Woocommerce Top Rated Products', 'xtra'),
                  'product_attribute' => esc_html__('Woocommerce Product Attribute', 'xtra'),
                  'vc_wp_search'      => esc_html__('WP Search', 'xtra'),
                  'vc_wp_meta'        => esc_html__('WP Meta', 'xtra'),
                  'vc_wp_recentcomments'  => esc_html__('WP Recent Comments', 'xtra'),
                  'vc_wp_calendar'        => esc_html__('WP Calendar', 'xtra'),
                  'vc_wp_pages'       => esc_html__('WP Pages', 'xtra'),
                  'vc_wp_tagcloud'    => esc_html__('WP Tag Cloud', 'xtra'),
                  'vc_wp_custommenu'  => esc_html__('WP Custom Menu', 'xtra'),
                  'vc_wp_text'        => esc_html__('WP Text', 'xtra'),
                  'vc_wp_posts'       => esc_html__('WP Recent Posts', 'xtra'),
                  'vc_wp_categories'  => esc_html__('WP Categories', 'xtra'),
                  'vc_wp_archives'    => esc_html__('WP Archives', 'xtra'),
                  'vc_wp_rss'         => esc_html__('WP RSS', 'xtra'),
                ),
                'default' => array('vc_wp_search','vc_wp_meta','vc_wp_recentcomments','vc_wp_calendar','vc_wp_pages','vc_wp_tagcloud','vc_wp_custommenu','vc_wp_text','vc_wp_posts','vc_wp_categories','vc_wp_archives', 'vc_wp_rss')
              ),
						)
					),

				),
			);
			defined( 'kopyright' ) or define( 'kopyright', 'Q29weXJpZ2h0IENvZGV2ei5jb20sIFRoaXMgcHJvZHVjdCBkZXNpZ25lZCBhbmQgZGV2ZWxvcGVkIGJ5IENPREVWWi4=' );
			$options[]   = array(
				'name' 		=> 'general_styles',
				'title' 	=> esc_html__( 'General Styles', 'xtra' ),
				'fields' => array(

					array(
						'id'        => 'site_color',
						'type'      => 'color_picker',
						'title'     => esc_html__( 'Primary Color', 'xtra' ),
						'desc'      => esc_html__( 'Warning: All old Primary Colors in the options and pages content will change.', 'xtra' ),
						'setting_args' => array( 'transport' => 'postMessage' )
					),
					array(
						'id'        => 'site_color_sec',
						'type'      => 'color_picker',
						'title'     => esc_html__( 'Secondary Color', 'xtra' ),
						'desc'      => esc_html__( 'Warning: All old Secondary Colors in the options and pages content will change.', 'xtra' ),
						'setting_args' => array( 'transport' => 'postMessage' )
					),
					array(
						'id'        => 'site_width',
						'type'      => 'slider',
						'title'     => esc_html__( 'Site Width', 'xtra' ),
						'help'   	=> '1170px',
						'options' 	=> array( 'unit' => 'px', 'step' => 10, 'min' => 960, 'max' => 1400 ),
						'setting_args' 	  => array( 'transport' => 'postMessage' )
					),
					array(
						'id' 	=> 'dark',
						'type' 	=> 'switcher',
						'title' => esc_html__( 'Dark version ?', 'xtra' )
					),
					array(
						'id' 			=> 'boxed',
						'type' 			=> 'switcher',
						'title' 		=> esc_html__( 'Boxed ?', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' )
					),
					array(
						'id' 			=> 'rtl',
						'type' 			=> 'switcher',
						'title' 		=> esc_html__( 'RTL ?', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' )
					),
					array(
						'type'    => 'notice',
						'class'   => 'info',
						'content' => esc_html__( 'Styles', 'xtra' ) . self::$sk_advanced
					),
					array(
						'id' 			=> '_css_body',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Body', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'background', 'padding', 'margin', 'border' ),
						'selector' 		=> 'html,body',
					),
					array(
						'id' 			=> '_css_body_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'html,body'
					),
					array(
						'id' 			=> '_css_body_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'html,body'
					),
					array(
						'id' 			=> '_css_layout_1',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Layout', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'background', 'overflow', 'padding', 'margin', 'border', 'box-shadow' ),
						'selector' 		=> '#layout'
					),
					array(
						'id' 			=> '_css_layout_1_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '#layout'
					),
					array(
						'id' 			=> '_css_layout_1_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '#layout'
					),
					array(
						'id' 			=> '_css_buttons',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Buttons', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'background', 'font-family', 'font-size', 'font-weight', 'font-style', 'text-transform', 'letter-spacing', 'line-height', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
						'selector' 		=> 'button:not(.customize-partial-edit-shortcut-button):not(.vc_general):not(.slick-arrow):not(.slick-dots-btn):not([role="presentation"]):not([aria-controls]),.dwqa-questions-footer .dwqa-ask-question a,input[type=submit],input[type=button],.button,.cz_header_button,.woocommerce a.button,.woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt'
					),
					array(
						'id' 			=> '_css_buttons_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'button:not(.customize-partial-edit-shortcut-button):not(.vc_general):not(.slick-arrow):not(.slick-dots-btn):not([role="presentation"]):not([aria-controls]),.dwqa-questions-footer .dwqa-ask-question a,input[type=submit],input[type=button],.button,.cz_header_button,.woocommerce a.button,.woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt'
					),
					array(
						'id' 			=> '_css_buttons_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'button:not(.customize-partial-edit-shortcut-button):not(.vc_general):not(.slick-arrow):not(.slick-dots-btn):not([role="presentation"]):not([aria-controls]),.dwqa-questions-footer .dwqa-ask-question a,input[type=submit],input[type=button],.button,.cz_header_button,.woocommerce a.button,.woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt'
					),
					array(
						'id' 			=> '_css_buttons_hover',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Buttons :Hover', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'background', 'font-size', 'font-weight', 'font-style', 'text-transform', 'letter-spacing', 'line-height', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
						'selector' 		=> 'button:not(.customize-partial-edit-shortcut-button):not(.vc_general):not(.slick-arrow):not(.slick-dots-btn):not([role="presentation"]):not([aria-controls]):hover,.dwqa-questions-footer .dwqa-ask-question a:hover,input[type=submit]:hover,input[type=button]:hover,.button:hover,.cz_header_button:hover,.woocommerce a.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover'
					),
					array(
						'id' 			=> '_css_buttons_hover_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'button:not(.customize-partial-edit-shortcut-button):not(.vc_general):not(.slick-arrow):not(.slick-dots-btn):not([role="presentation"]):not([aria-controls]):hover,.dwqa-questions-footer .dwqa-ask-question a:hover,input[type=submit]:hover,input[type=button]:hover,.button:hover,.cz_header_button:hover,.woocommerce a.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover'
					),
					array(
						'id' 			=> '_css_buttons_hover_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'button:not(.customize-partial-edit-shortcut-button):not(.vc_general):not(.slick-arrow):not(.slick-dots-btn):not([role="presentation"]):not([aria-controls]):hover,.dwqa-questions-footer .dwqa-ask-question a:hover,input[type=submit]:hover,input[type=button]:hover,.button:hover,.cz_header_button:hover,.woocommerce a.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover'
					),
					array(
						'id' 			=> '_css_content_block',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Content box', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'font-size', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'selector' 		=> '.content'
					),
					array(
						'id' 			=> '_css_content_block_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.content'
					),
					array(
						'id' 			=> '_css_content_block_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.content'
					),
					array(
						'id' 			=> '_css_content_block_headline',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Content box headlines', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'background', 'font-size', 'font-weight', 'font-style', 'text-align', 'line-height', 'text-transform', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
						'selector' 		=> '.content > h3:first-child, .content .section_title'
					),
					array(
						'id' 			=> '_css_content_block_headline_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.content > h3:first-child, .content .section_title'
					),
					array(
						'id' 			=> '_css_content_block_headline_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.content > h3:first-child, .content .section_title'
					),
					array(
						'id' 			=> '_css_content_block_links',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Content box links', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'background', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow' ),
						'selector' 		=> '.content a'
					),
					array(
						'id' 			=> '_css_content_block_links_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.content a'
					),
					array(
						'id' 			=> '_css_content_block_links_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.content a'
					),
					array(
						'id' 			=> '_css_content_block_links_hover',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Content box links :Hover', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'background', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow' ),
						'selector' 		=> '.content a:hover'
					),
					array(
						'id' 			=> '_css_content_block_links_hover_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.content a:hover'
					),
					array(
						'id' 			=> '_css_content_block_links_hover_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.content a:hover'
					),
					array(
						'id' 			=> '_css_sidebar_primary',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Primary Sidebar Area', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'selector' 		=> 'aside.sidebar_primary .sidebar_inner'
					),
					array(
						'id' 			=> '_css_sidebar_primary_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'aside.sidebar_primary .sidebar_inner'
					),
					array(
						'id' 			=> '_css_sidebar_primary_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'aside.sidebar_primary .sidebar_inner'
					),
					array(
						'id' 			=> '_css_sidebar_secondary',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Secondary Sidebar Area', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'selector' 		=> 'aside.sidebar_secondary .sidebar_inner'
					),
					array(
						'id' 			=> '_css_sidebar_secondary_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'aside.sidebar_secondary .sidebar_inner'
					),
					array(
						'id' 			=> '_css_sidebar_secondary_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'aside.sidebar_secondary .sidebar_inner'
					),
					array(
						'id' 			=> '_css_widgets',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Widgets', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'font-size', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'selector' 		=> '.widget'
					),
					array(
						'id' 			=> '_css_widgets_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.widget'
					),
					array(
						'id' 			=> '_css_widgets_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.widget'
					),
					array(
						'id' 			=> '_css_widgets_headline',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Widgets Headlines', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'background', 'font-size', 'font-weight', 'font-style', 'text-align', 'line-height', 'text-transform', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
						'selector' 		=> '.widget > h4'
					),
					array(
						'id' 			=> '_css_widgets_headline_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.widget > h4'
					),
					array(
						'id' 			=> '_css_widgets_headline_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.widget > h4'
					),
					array(
						'id' 			=> '_css_widgets_links',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Widgets links', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'background', 'font-weight', 'font-size', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow' ),
						'selector' 		=> '.widget a'
					),
					array(
						'id' 			=> '_css_widgets_links_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.widget a'
					),
					array(
						'id' 			=> '_css_widgets_links_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.widget a'
					),
					array(
						'id' 			=> '_css_widgets_links_hover',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Widgets links :Hover', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'background', 'font-size', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow' ),
						'selector' 		=> '.widget a:hover'
					),
					array(
						'id' 			=> '_css_widgets_links_hover_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.widget a:hover'
					),
					array(
						'id' 			=> '_css_widgets_links_hover_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.widget a:hover'
					),
					array(
						'id' 			=> '_css_all_img_tags',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Images', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'background', 'padding', 'border', 'box-shadow' ),
            'selector'    => 'img, .cz_image img'
					),
					array(
						'id' 			=> '_css_all_img_tags_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
            'selector'    => 'img, .cz_image img'
					),
					array(
						'id' 			=> '_css_all_img_tags_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'img, .cz_image img'
					),
					array(
						'id' 			=> '_css_input_textarea',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Input, Textarea', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'font-size', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'selector' 		=> 'input,textarea,select,.qty'
					),
					array(
						'id' 			=> '_css_input_textarea_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'input,textarea,select,.qty'
					),
					array(
						'id' 			=> '_css_input_textarea_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'input,textarea,select,.qty'
					),
					array(
						'id' 			=> '_css_input_textarea_focus',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Input on focus', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'background', 'padding', 'border', 'box-shadow' ),
						'selector' 		=> 'input:focus,textarea:focus,select:focus'
					),
					array(
						'id' 			=> '_css_input_textarea_focus_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'input:focus,textarea:focus,select:focus'
					),
					array(
						'id' 			=> '_css_input_textarea_focus_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'input:focus,textarea:focus,select:focus'
					),
					array(
						'id' 			=> '_css_select',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Select', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'font-size', 'font-weight', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'selector' 		=> 'select,.nice-select'
					),
					array(
						'id' 			=> '_css_select_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'select,.nice-select'
					),
					array(
						'id' 			=> '_css_select_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'select,.nice-select'
					),
					array(
						'id' 			=> '_css_select_dropdown',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Select Dropdown', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'font-size', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'selector' 		=> '.nice-select .list'
					),
					array(
						'id' 			=> '_css_select_dropdown_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.nice-select .list'
					),
					array(
						'id' 			=> '_css_select_dropdown_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.nice-select .list'
					),
					array(
						'id' 			=> '_css_lightbox_bg',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Lightbox Backgroud', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'background', 'border-right-color' ),
						'selector' 		=> '.lg-backdrop'
					),
					array(
						'id' 			=> '_css_lightbox_bg_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.lg-backdrop'
					),
					array(
						'id' 			=> '_css_lightbox_bg_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> '.lg-backdrop'
					),
					
				),
			);

      /*
      // Export headers array
      $new_header = array();
      foreach ( self::reset_header() as $k => $v ) {
        $v = Codevz::option( $k );
        if ( $v ) {
          if ( is_array( $v ) ) {
            foreach ( $v as $kk => $vv ) {
                foreach ( $vv as $kkk => $vvv ) {
                  if ( is_array( $vvv ) ) {
                    $vv[$kkk] = array_filter( $vvv );
                  }
                }
              $v[$kk] = array_filter( $vv );
            }
          }

          $new_header[ $k ] = $v;
        }
      }
      ob_start();
      var_export( $new_header );
      $new_header = ob_get_clean();
      */

      //$options['header'] = array(
			$options[] = array(
				'name' 		=> 'header',
				'title' 	=> esc_html__( 'Header', 'xtra' ),
				'sections' => array(

          /*array(
            'name'   => 'header_preset',
            'title'  => esc_html__( 'Header Preset', 'xtra' ),
            'fields' => array(
              array(
                'type'    => 'content',
                'content' => '<textarea disabled="disabled" rows="10" style="width:100%">'. $new_header .'</textarea>'
              ),
              array(
                'type'      => 'content',
                'content'   => '<div class="csf-field-header-preset"><a href="#" class="button csf-header-preset-add">' . esc_html__( 'Open Header Preset', 'codevz' ) . '</a></div>'
              ),
              array(
                'id'            => 'header_preset',
                'type'          => 'text',
                'title'         => '',
                'setting_args'  => array( 'transport' => 'postMessage' )
              ),
            )
          ),*/
          array(
            'name'   => 'header_logo',
            'title'  => esc_html__( 'Logo', 'xtra' ),
            'fields' => array(
							array(
								'id' 			      => 'logo',
								'type' 			    => 'upload',
								'title' 		    => esc_html__( 'Logo', 'xtra' ),
                'preview'       => 1,
								'setting_args' 	=> array('transport' => 'postMessage')
							),
							array(
								'id'            => '_css_logo_css',
								'type'          => 'cz_sk',
								'button'        => esc_html__( 'Logo', 'xtra' ),
								'setting_args'  => array( 'transport' => 'postMessage' ),
								'settings'      => array( 'color', 'background', 'font-family', 'text-transform', 'font-size', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector'      => '.logo > a, .logo > h1, .logo h2',
							),
							array(
								'id' 			=> '_css_logo_css_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.logo > a, .logo > h1, .logo h2',
							),
							array(
								'id' 			=> '_css_logo_css_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.logo > a, .logo > h1, .logo h2',
							),
							array(
								'type'    => 'notice',
								'class'   => 'info',
								'content' => esc_html__( 'Logo 2 ( Alternative )', 'xtra' )
							),
							array(
								'id' 			=> 'logo_2',
								'type' 			=> 'upload',
								'title' 		=> esc_html__( 'Logo Alternative', 'xtra' ),
                'preview'       => 1,
								'setting_args' 	=> array('transport' => 'postMessage')
							),
							array(
								'id' 			=> '_css_logo_2_css',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Logo 2', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-family', 'text-transform', 'font-size', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.logo_2 > a, .logo_2 > h1'
							),
							array(
								'id' 			=> '_css_logo_2_css_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.logo_2 > a, .logo_2 > h1'
							),
							array(
								'id' 			=> '_css_logo_2_css_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.logo_2 > a, .logo_2 > h1'
							),
							array(
								'type'    => 'notice',
								'class'   => 'info',
								'content' => esc_html__( 'Logo Tooltip on Hover', 'xtra' )
							),
							array(
								'id'            => 'logo_hover_tooltip',
								'type'          => 'select',
								'title'         => esc_html__( 'Tooltip', 'xtra' ),
								'options'       => Codevz::$array_pages
							),
							array(
								'id' 			=> '_css_logo_hover_tooltip',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Logo Tooltip', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'width', 'padding', 'margin', 'box-shadow', 'border' ),
								'selector' 		=> '.logo_hover_tooltip',
								'dependency' 	=> array( 'logo_hover_tooltip', '!=', '' )
							),
							array(
								'id' 			=> '_css_logo_hover_tooltip_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.logo_hover_tooltip',
							),
							array(
								'id' 			=> '_css_logo_hover_tooltip_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.logo_hover_tooltip',
							),
						)
					),

					array(
						'name'   => 'header_social',
						'title'  => esc_html__( 'Social Icons', 'xtra' ),
						'fields' => array(
							array(
								'id'              => 'social',
								'type'            => 'group',
								'title'           => esc_html__( 'Social Icons', 'xtra' ),
								'button_title'    => esc_html__( 'Add', 'xtra' ),
								'accordion_title' => esc_html__( 'Add', 'xtra' ),
								'fields'          => array(
									array(
										'id'    	=> 'title',
										'type'  	=> 'text',
										'title' 	=> esc_html__( 'Title', 'xtra' )
									),
									array(
										'id'    	=> 'icon',
										'type'  	=> 'icon',
										'title' 	=> esc_html__( 'Icon', 'xtra' ),
										'default' 	=> 'fa fa-facebook'
									),
									array(
										'id'    	=> 'link',
										'type'  	=> 'text',
										'title' 	=> esc_html__( 'Link', 'xtra' )
									),
								),
								'setting_args' 	     => array( 'transport' => 'postMessage' ),
								'selective_refresh'  => array(
									'selector' 			   => '.elms_row .cz_social',
									'settings' 			   => Codevz::$options_id . '[social]',
									'render_callback'  => function() {
                    return Codevz::social();
									},
								),
							),
							array(
								'id'            => 'social_hover_fx',
								'type'          => 'select',
								'title'         => esc_html__( 'Hover FX', 'xtra' ),
								'options'       => array(
									'cz_social_fx_0' => esc_html__( 'ZoomIn', 'xtra' ),
									'cz_social_fx_1' => esc_html__( 'ZoomOut', 'xtra' ),
									'cz_social_fx_2' => esc_html__( 'Bottom to Top', 'xtra' ),
									'cz_social_fx_3' => esc_html__( 'Top to Bottom', 'xtra' ),
									'cz_social_fx_4' => esc_html__( 'Left to Right', 'xtra' ),
									'cz_social_fx_5' => esc_html__( 'Right to Left', 'xtra' ),
									'cz_social_fx_6' => esc_html__( 'Rotate', 'xtra' ),
									'cz_social_fx_7' => esc_html__( 'Infinite Shake', 'xtra' ),
									'cz_social_fx_8' => esc_html__( 'Infinite Wink', 'xtra' ),
									'cz_social_fx_9' => esc_html__( 'Quick Bob', 'xtra' ),
									'cz_social_fx_10'=> esc_html__( 'Flip Horizontal', 'xtra' ),
									'cz_social_fx_11'=> esc_html__( 'Flip Vertical', 'xtra' ),
								),
								'default_option' => esc_html__( 'Select', 'xtra'),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selective_refresh' => array(
									'selector' 			=> '.elms_row .cz_social',
									'settings' 			=> Codevz::$options_id . '[social_hover_fx]',
									'render_callback' 	=> function() {
										return Codevz::social();
									},
								),
							),
							array(
								'id'            => 'social_color_mode',
								'type'          => 'select',
								'title'         => esc_html__( 'Color Mode', 'xtra' ),
								'options'       => array(
									'cz_social_colored' 		=> esc_html__( 'Original colors', 'xtra' ),
									'cz_social_colored_hover' 	=> esc_html__( 'Original colors on :Hover', 'xtra' ),
									'cz_social_colored_bg' 		=> esc_html__( 'Original background', 'xtra' ),
									'cz_social_colored_bg_hover' => esc_html__( 'Original background on :Hover', 'xtra' ),
								),
								'default_option' => esc_html__( 'Select', 'xtra'),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selective_refresh' => array(
									'selector' 			=> '.elms_row .cz_social',
									'settings' 			=> Codevz::$options_id . '[social_color_mode]',
									'render_callback' 	=> function() {
										return Codevz::social();
									},
								),
							),
              array(
                'id'            => 'social_inline_title',
                'type'          => 'switcher',
                'title'         => esc_html__( 'Inline titles ?', 'xtra' ),
                'setting_args'  => array( 'transport' => 'postMessage' ),
                'selective_refresh' => array(
                  'selector'      => '.elms_row .cz_social',
                  'settings'      => Codevz::$options_id . '[social_inline_title]',
                  'render_callback'   => function() {
                    return Codevz::social();
                  },
                ),
              ),
              array(
                'id'            => 'social_tooltip',
                'type'          => 'select',
                'title'         => esc_html__( 'Tooltip', 'xtra' ),
                'options'       => array(
                  'cz_tooltip cz_tooltip_up'    => esc_html__( 'Up', 'xtra' ),
                  'cz_tooltip cz_tooltip_down'  => esc_html__( 'Down', 'xtra' ),
                  'cz_tooltip cz_tooltip_right' => esc_html__( 'Right', 'xtra' ),
                  'cz_tooltip cz_tooltip_left'  => esc_html__( 'Left', 'xtra' ),
                ),
                'default_option' => esc_html__( 'Select', 'xtra'),
                'setting_args'  => array( 'transport' => 'postMessage' ),
                'selective_refresh' => array(
                  'selector'      => '.elms_row .cz_social',
                  'settings'      => Codevz::$options_id . '[social_tooltip]',
                  'render_callback'   => function() {
                    return Codevz::social();
                  },
                ),
              ),

							array(
								'id' 			=> '_css_social',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Social Container', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.elms_row .cz_social, .fixed_side .cz_social'
							),
							array(
								'id' 			=> '_css_social_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.elms_row .cz_social, .fixed_side .cz_social'
							),
							array(
								'id' 			=> '_css_social_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.elms_row .cz_social, .fixed_side .cz_social'
							),
							array(
								'id' 			=> '_css_social_a',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Social Icons', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.elms_row .cz_social a, .fixed_side .cz_social a'
							),
							array(
								'id' 			=> '_css_social_a_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.elms_row .cz_social a, .fixed_side .cz_social a'
							),
							array(
								'id' 			=> '_css_social_a_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.elms_row .cz_social a, .fixed_side .cz_social a'
							),
              array(
                'id'      => '_css_social_a_hover',
                'type'      => 'cz_sk',
                'button'    => esc_html__( 'Social :Hover', 'xtra' ),
                'setting_args'  => array( 'transport' => 'postMessage' ),
                'settings'    => array( 'color', 'background', 'font-size', 'padding', 'margin', 'border', 'box-shadow' ),
                'selector'    => '.elms_row .cz_social a:hover, .fixed_side .cz_social a:hover'
              ),
              array(
                'id'      => '_css_social_a_hover_tablet',
                'type'      => 'cz_sk_hidden',
                'setting_args'  => array( 'transport' => 'postMessage' ),
                'selector'    => '.elms_row .cz_social a:hover, .fixed_side .cz_social a:hover'
              ),
              array(
                'id'      => '_css_social_a_hover_mobile',
                'type'      => 'cz_sk_hidden',
                'setting_args'  => array( 'transport' => 'postMessage' ),
                'selector'    => '.elms_row .cz_social a:hover, .fixed_side .cz_social a:hover'
              ),
              array(
                'id'      => '_css_social_inline_titles',
                'type'      => 'cz_sk',
                'button'    => esc_html__( 'Social Inline Title', 'xtra' ),
                'setting_args'  => array( 'transport' => 'postMessage' ),
                'settings'    => array( 'color', 'background', 'font-size', 'font-weight', 'letter-spacing', 'line-height', 'padding', 'margin', 'border' ),
                'selector'    => '.elms_row .cz_social a span, .fixed_side .cz_social a span',
                'dependency'  => array( 'social_inline_title', '!=', '' )
              ),
              array(
                'id'      => '_css_social_inline_titles_tablet',
                'type'      => 'cz_sk_hidden',
                'setting_args'  => array( 'transport' => 'postMessage' ),
                'selector'    => '.elms_row .cz_social a span, .fixed_side .cz_social a span'
              ),
              array(
                'id'      => '_css_social_inline_titles_mobile',
                'type'      => 'cz_sk_hidden',
                'setting_args'  => array( 'transport' => 'postMessage' ),
                'selector'    => '.elms_row .cz_social a span, .fixed_side .cz_social a span'
              ),
              array(
                'id'      => '_css_social_tooltip',
                'type'      => 'cz_sk',
                'button'    => esc_html__( 'Social Tooltip', 'xtra' ),
                'setting_args'  => array( 'transport' => 'postMessage' ),
                'settings'    => array( 'color', 'background', 'font-size', 'font-weight', 'letter-spacing', 'line-height', 'padding', 'margin', 'border' ),
                'selector'    => '.elms_row .cz_social a:after, .fixed_side .cz_social a:after',
                'dependency'  => array( 'social_tooltip', '!=', '' )
              ),
              array(
                'id'      => '_css_social_tooltip_tablet',
                'type'      => 'cz_sk_hidden',
                'setting_args'  => array( 'transport' => 'postMessage' ),
                'selector'    => '.elms_row .cz_social a:after, .fixed_side .cz_social a:after'
              ),
              array(
                'id'      => '_css_social_tooltip_mobile',
                'type'      => 'cz_sk_hidden',
                'setting_args'  => array( 'transport' => 'postMessage' ),
                'selector'    => '.elms_row .cz_social a:after, .fixed_side .cz_social a:after'
              ),

						),
					),
					array(
						'name'   => 'header_1',
						'title'  => esc_html__( 'Top of Header', 'xtra' ),
						'fields' => self::row_options( 'header_1' )
					),
					array(
						'name'   => 'header_2',
						'title'  => esc_html__( 'Header', 'xtra' ),
						'fields' => self::row_options( 'header_2' )
					),
					array(
						'name'   => 'header_3',
						'title'  => esc_html__( 'Bottom of Header', 'xtra' ),
						'fields' => self::row_options( 'header_3' )
					),
					array(
						'name'   => 'header_5',
						'title'  => esc_html__( 'Sticky Header', 'xtra' ),
						'fields' => self::row_options( 'header_5' )
					),
					array(
						'name'   => 'mobile_header',
						'title'  => esc_html__( 'Mobile,Tablet Header', 'xtra' ),
						'fields' => self::row_options( 'header_4' )
					),
					array(
						'name'   => 'fixed_side_1',
						'title'  => esc_html__( 'Fixed Side', 'xtra' ),
						'fields' => self::row_options( 'fixed_side_1', array('top','middle','bottom') )
					),
					array(
						'name'   => 'header_more',
						'title'  => esc_html__( 'More', 'xtra' ),
						'fields' => array(
							array(
								'id' 			=> '_css_header_container',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Overall Header Container', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.page_header'
							),
							array(
								'id' 			=> '_css_header_container_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.page_header'
							),
							array(
								'id' 			=> '_css_header_container_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.page_header'
							),
							array(
								'id'            => 'hidden_top_bar',
								'type'          => 'select',
								'title'         => esc_html__( 'Extra header panel', 'xtra' ),
								'options'       => Codevz::$array_pages,
								'selective_refresh' => array(
									'selector' => '.hidden_top_bar > i',
									'container_inclusive' => true
								)
							),
							array(
								'id' 			=> '_css_hidden_top_bar',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Extra header panel', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'padding', 'margin', 'border' ),
								'selector' 		=> '.hidden_top_bar',
								'dependency' 	=> array( 'hidden_top_bar', '!=', '' )
							),
							array(
								'id' 			=> '_css_hidden_top_bar_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.hidden_top_bar',
							),
							array(
								'id' 			=> '_css_hidden_top_bar_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.hidden_top_bar',
							),
							array(
								'id' 			=> '_css_hidden_top_bar_handle',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Handle', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'padding', 'margin', 'border' ),
								'selector' 		=> '.hidden_top_bar > i',
								'dependency' 	=> array( 'hidden_top_bar', '!=', '' )
							),
							array(
								'id' 			=> '_css_hidden_top_bar_handle_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.hidden_top_bar > i',
							),
							array(
								'id' 			=> '_css_hidden_top_bar_handle_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.hidden_top_bar > i',
							),
						),
					),

				),
			);

			$options[]   = array(
				'name'   => 'page_cover',
				'title'  => esc_html__( 'Title & Slider', 'xtra' ),
				'fields' => wp_parse_args( self::title_options(), array(
          array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => esc_html__( 'This settings will affect on all your website pages, if you want different settings for specific page(s), edit that page and from page settings you can find / change Title, Slider & Breadcrumbs settings', 'xtra' )
          )
        ))
			);

			$options[]   = array(
				'name' 		=> 'typography',
				'title' 	=> esc_html__( 'Typography', 'xtra' ),
				'fields' => array(

					array(
						'id' 			=> '_css_body_typo',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Body', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'font-family', 'font-size', 'font-weight', 'font-style', 'line-height', 'text-transform' ),
						'selector' 		=> 'body'
					),
					array(
						'id' 			=> '_css_body_typo_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'body'
					),
					array(
						'id' 			=> '_css_body_typo_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'body'
					),
					array(
						'id' 			=> '_css_all_headlines',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'All Headlines', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'background', 'font-family', 'font-weight', 'font-style', 'line-height', 'text-transform', 'padding', 'margin', 'border' ),
						'selector' 		=> 'h1,h2,h3,h4,h5,h6'
					),
					array(
						'id' 			=> '_css_all_headlines_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'h1,h2,h3,h4,h5,h6'
					),
					array(
						'id' 			=> '_css_all_headlines_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'h1,h2,h3,h4,h5,h6'
					),
					array(
						'id' 			=> '_css_h1',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'H1', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'background', 'font-family', 'font-size', 'font-weight', 'font-style', 'line-height', 'text-transform', 'padding', 'margin', 'border' ),
						'selector' 		=> 'h1'
					),
					array(
						'id' 			=> '_css_h1_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'h1'
					),
					array(
						'id' 			=> '_css_h1_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'h1'
					),
					array(
						'id' 			=> '_css_h2',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'H2', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'background', 'font-family', 'font-size', 'font-weight', 'font-style', 'line-height', 'text-transform', 'padding', 'margin', 'border' ),
						'selector' 		=> 'h2'
					),
					array(
						'id' 			=> '_css_h2_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'h2'
					),
					array(
						'id' 			=> '_css_h2_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'h2'
					),
					array(
						'id' 			=> '_css_h3',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'H3', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'background', 'font-family', 'font-size', 'font-weight', 'font-style', 'line-height', 'text-transform', 'padding', 'margin', 'border' ),
						'selector' 		=> 'h3'
					),
					array(
						'id' 			=> '_css_h3_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'h3'
					),
					array(
						'id' 			=> '_css_h3_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'h3'
					),
					array(
						'id' 			=> '_css_h4',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'H4', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'background', 'font-family', 'font-size', 'font-weight', 'font-style', 'line-height', 'text-transform', 'padding', 'margin', 'border' ),
						'selector' 		=> 'h4'
					),
					array(
						'id' 			=> '_css_h4_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'h4'
					),
					array(
						'id' 			=> '_css_h4_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'h4'
					),
					array(
						'id' 			=> '_css_h5',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'H5', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'background', 'font-family', 'font-size', 'font-weight', 'font-style', 'line-height', 'text-transform', 'padding', 'margin', 'border' ),
						'selector' 		=> 'h5'
					),
					array(
						'id' 			=> '_css_h5_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'h5'
					),
					array(
						'id' 			=> '_css_h5_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'h5'
					),
					array(
						'id' 			=> '_css_h6',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'H6', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'background', 'font-family', 'font-size', 'font-weight', 'font-style', 'line-height', 'text-transform', 'padding', 'margin', 'border' ),
						'selector' 		=> 'h6'
					),
					array(
						'id' 			=> '_css_h6_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'h6'
					),
					array(
						'id' 			=> '_css_h6_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'h6'
					),
					array(
						'id' 			=> '_css_p',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Paragraphs', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'background', 'font-family', 'font-size', 'font-weight', 'font-style', 'line-height', 'text-transform', 'padding', 'margin', 'border' ),
						'selector' 		=> 'p'
					),
					array(
						'id' 			=> '_css_p_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'p'
					),
					array(
						'id' 			=> '_css_p_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'p'
					),
					array(
						'id' 			=> '_css_a',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Links', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'background', 'font-family', 'font-size', 'font-weight', 'font-style', 'line-height', 'text-transform', 'padding', 'margin', 'border' ),
						'selector' 		=> 'a'
					),
					array(
						'id' 			=> '_css_a_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'a'
					),
					array(
						'id' 			=> '_css_a_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'a'
					),
					array(
						'id' 			=> '_css_a_hover',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Links :Hover', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'opacity', 'color', 'background', 'font-size', 'font-weight', 'font-style', 'line-height', 'text-transform', 'padding', 'margin', 'border' ),
						'selector' 		=> 'a:hover'
					),
					array(
						'id' 			=> '_css_a_hover_tablet',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'a:hover'
					),
					array(
						'id' 			=> '_css_a_hover_mobile',
						'type' 			=> 'cz_sk_hidden',
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'selector' 		=> 'a:hover'
					),

					array(
						'id'              => 'wp_editor_fonts',
						'type'            => 'group', 
						'title' 		      => esc_html__( 'Google Fonts for WP Editor', 'xtra' ),
						'button_title'    => esc_html__( 'Add', 'xtra' ),
						'fields'          => array(
							array(
								'id' 		       => 'font',
								'type' 		     => 'select_font',
								'title' 	     => esc_html__('Font Family', 'xtra')
							),
						),
						'setting_args' 	  => array( 'transport' => 'postMessage' )
					),


					array(
						'type'    => 'notice',
						'class'   => 'info',
						'content' => esc_html__( 'Custom icons pack', 'xtra' )
					),
					array(
						'id' 			=> 'allow_zip_upload',
						'type' 			=> 'switcher',
						'title' 		=> esc_html__( 'Allow WordPress to upload zip files', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' )
					),
					array(
						'type'    	=> 'notice',
						'class'   	=> 'info',
						'content' 	=> esc_html__( 'If you can not upload zip file, once save and refresh this page', 'xtra' ),
						'dependency' => array( 'allow_zip_upload', '!=', '' )
					),
					array(
						'id'              => 'zip_icons',
						'type'            => 'group', 
						'title' 		  => esc_html__( 'Add icons pack', 'xtra' ),
						'button_title'    => esc_html__( 'Add', 'xtra' ),
						'fields'          => array(
							array(
								'id' 		=> 'title',
								'type' 		=> 'text',
								'title' 	=> esc_html__( 'Title', 'xtra' )
							),
							array(
								'id' 		=> 'zip',
								'type' 		=> 'upload',
								'title' 	=> esc_html__( 'Fontello zip file', 'xtra' ),
								'settings'   => array(
									'upload_type'  => 'application/zip',
									'frame_title'  => 'Upload / Select',
									'insert_title' => 'Insert',
								),
							),
						),
						'setting_args' 		=> array( 'transport' => 'postMessage' ),
						'dependency' 		=> array( 'allow_zip_upload', '!=', '' )
					),

				),
			);

			$options[]   = array(
				'name' 		=> 'footer',
				'title' 	=> esc_html__( 'Footer', 'xtra' ),
				'sections' => array(

					array(
						'name'   => 'footer_1',
						'title'  => esc_html__( 'Top of Footer', 'xtra' ),
						'fields' => self::row_options( 'footer_1' )
					),
					array(
						'name'   => 'footer_widgets',
						'title'  => esc_html__( 'Footer Widgets', 'xtra' ),
						'fields' => array(
							array(
								'id' 	=> 'footer_layout',
								'type' 	=> 'select',
								'title' => esc_html__( 'Widgets layout', 'xtra' ),
								'options' => array(
									'' 					=> esc_html__( 'Select', 'xtra' ),
									's12'				=> '1/1',
									's6,s6'				=> '1/2 1/2',
									's4,s8'				=> '1/3 2/3',
									's8,s4'				=> '2/3 1/3',
									's3,s9'				=> '1/4 3/4',
									's9,s3'				=> '3/4 1/4',
									's4,s4,s4'			=> '1/3 1/3 1/3',
									's3,s6,s3'			=> '1/4 2/4 1/4',
									's3,s3,s6'			=> '1/4 1/4 2/4',
									's6,s3,s3'			=> '2/4 1/4 1/4',
									's2,s2,s8'			=> '1/6 1/6 4/6',
									's2,s8,s2'			=> '1/6 4/6 1/6',
									's8,s2,s2'			=> '4/6 1/6 1/6',
									's3,s3,s3,s3'		=> '1/4 1/4 1/4 1/4',
									's6,s2,s2,s2'		=> '3/6 1/6 1/6 1/6',
									's2,s2,s2,s6'		=> '1/6 1/6 1/6 3/6',
									's2,s2,s2,s2,s4'	=> '1/6 1/6 1/6 1/6 2/6',
									's4,s2,s2,s2,s2'	=> '2/6 1/6 1/6 1/6 1/6',
									's2,s2,s4,s2,s2'	=> '1/6 1/6 2/6 1/6 1/6',
									's2,s2,s2,s2,s2,s2'	=> '1/6 1/6 1/6 1/6 1/6 1/6',
								),
							),
							array(
								'id' 			=> '_css_footer',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Container', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.cz_middle_footer',
								'dependency' 	=> array( 'footer_layout', '!=', '' )
							),
							array(
								'id' 			=> '_css_footer_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_middle_footer',
							),
							array(
								'id' 			=> '_css_footer_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_middle_footer',
							),
							array(
								'id' 			=> '_css_footer_row',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Row inner', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'width', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.cz_middle_footer > .row',
								'dependency' 	=> array( 'footer_layout', '!=', '' )
							),
							array(
								'id' 			=> '_css_footer_row_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_middle_footer > .row',
							),
							array(
								'id' 			=> '_css_footer_row_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_middle_footer > .row',
							),
							array(
								'id' 			=> '_css_footer_widget',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Widgets', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'font-size', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.footer_widget',
								'dependency' 	=> array( 'footer_layout', '!=', '' )
							),
							array(
								'id' 			=> '_css_footer_widget_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.footer_widget',
							),
							array(
								'id' 			=> '_css_footer_widget_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.footer_widget',
							),
							array(
								'id' 			=> '_css_footer_widget_headlines',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Widgets Headlines', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'font-weight', 'font-style', 'letter-spacing', 'line-height', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.footer_widget > h4',
								'dependency' 	=> array( 'footer_layout', '!=', '' )
							),
							array(
								'id' 			=> '_css_footer_widget_headlines_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.footer_widget > h4',
							),
							array(
								'id' 			=> '_css_footer_widget_headlines_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.footer_widget > h4',
							),
							array(
								'id' 			=> '_css_footer_a',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Widgets Links', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-weight', 'font-size', 'font-style', 'letter-spacing', 'line-height', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.cz_middle_footer a',
								'dependency' 	=> array( 'footer_layout', '!=', '' )
							),
							array(
								'id' 			=> '_css_footer_a_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_middle_footer a',
							),
							array(
								'id' 			=> '_css_footer_a_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_middle_footer a',
							),
							array(
								'id' 			=> '_css_footer_a_hover',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Widgets Links :Hover', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-weight', 'font-size', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.cz_middle_footer a:hover',
								'dependency' 	=> array( 'footer_layout', '!=', '' )
							),
							array(
								'id' 			=> '_css_footer_a_hover_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_middle_footer a:hover',
							),
							array(
								'id' 			=> '_css_footer_a_hover_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_middle_footer a:hover',
							),
						),
					),
					array(
						'name'   => 'footer_2',
						'title'  => esc_html__( 'Bottom of Footer', 'xtra' ),
						'fields' => self::row_options( 'footer_2' )
					),
					array(
						'name'   => 'footer_more',
						'title'  => esc_html__( 'More', 'xtra' ),
						'fields' => array(
							array(
								'id' 			=> '_css_overal_footer',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Overall Footer', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.page_footer'
							),
							array(
								'id' 			=> '_css_overal_footer_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.page_footer'
							),
							array(
								'id' 			=> '_css_overal_footer_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.page_footer'
							),
							array(
								'id' 			=> 'fixed_footer',
								'type' 			=> 'switcher',
								'title' 		=> esc_html__( 'Fixed footer under body ?', 'xtra' ),
								'help'			=> esc_html__( 'Body Background color is required for fixed footer. Go to Customize > General Styles > Body', 'xtra' ),
							),
							array(
								'type'    	=> 'notice',
								'class'   	=> 'info',
								'content' 	=> esc_html__( 'Back to Top button', 'xtra' ),
							),
							array(
								'id'    		=> 'backtotop',
								'type'  		=> 'icon',
								'title' 		=> esc_html__( 'Back To Top', 'xtra' ),
								'default'		=> 'fa fa-angle-up',
								'setting_args' 	=> array( 'transport' => 'postMessage' )
							),
							array(
								'id' 			=> '_css_backtotop',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Back To Top', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'width', 'height', 'line-height', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> 'i.backtotop'
							),
							array(
								'id' 			=> '_css_backtotop_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> 'i.backtotop'
							),
							array(
								'id' 			=> '_css_backtotop_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> 'i.backtotop'
							),
							array(
								'id' 			=> '_css_backtotop_hover',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Back To Top :Hover', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'font-size', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> 'i.backtotop:hover'
							),
							array(
								'id' 			=> '_css_backtotop_hover_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> 'i.backtotop:hover'
							),
							array(
								'id' 			=> '_css_backtotop_hover_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> 'i.backtotop:hover'
							),
							array(
								'type'    	=> 'notice',
								'class'   	=> 'info',
								'content' 	=> esc_html__( 'Quick contact form button', 'xtra' ),
							),
							array(
								'id' 	=> 'cf7_beside_backtotop',
								'type' 	=> 'select',
								'title' => esc_html__( 'Contact form', 'xtra' ),
								'options'       => Codevz::$array_pages
							),
							array(
								'id' 			=> '_css_cf7_beside_backtotop_container',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Contact form container', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> 'div.fixed_contact',
								'dependency' 	=> array( 'cf7_beside_backtotop', '!=', '' ),
							),
							array(
								'id' 			=> '_css_cf7_beside_backtotop_container_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> 'div.fixed_contact',
							),
							array(
								'id' 			=> '_css_cf7_beside_backtotop_container_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> 'div.fixed_contact',
							),
							array(
								'id'    		=> 'cf7_beside_backtotop_icon',
								'type'  		=> 'icon',
								'title' 		=> esc_html__( 'Contact Icon', 'xtra' ),
								'default'		=> 'fa fa-envelope-o',
								'dependency' => array( 'cf7_beside_backtotop', '!=', '' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
							),
							array(
								'id' 			=> '_css_cf7_beside_backtotop',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Contact form icon', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'width', 'height', 'line-height', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> 'i.fixed_contact',
								'dependency' 	=> array( 'cf7_beside_backtotop', '!=', '' ),
							),
							array(
								'id' 			=> '_css_cf7_beside_backtotop_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> 'i.fixed_contact',
							),
							array(
								'id' 			=> '_css_cf7_beside_backtotop_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> 'i.fixed_contact',
							),
							array(
								'id' 			=> '_css_cf7_beside_backtotop_hover',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Contact form icon :Hover', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'font-size', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> 'i.fixed_contact:hover',
								'dependency' 	=> array( 'cf7_beside_backtotop', '!=', '' ),
							),
							array(
								'id' 			=> '_css_cf7_beside_backtotop_hover_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> 'i.fixed_contact:hover',
							),
							array(
								'id' 			=> '_css_cf7_beside_backtotop_hover_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> 'i.fixed_contact:hover',
							),
						),
					),
				),
			);

			$options[]   = array(
				'name' 		=> 'posts',
				'title' 	=> esc_html__( 'Blog', 'xtra' ),
				'sections' => array(

					array(
						'name'   => 'blog_settings',
						'title'  => esc_html__( 'Blog Settings', 'xtra' ),
						'fields' => array(
							array(
								'id' 		=> 'template_style',
								'type' 		=> 'select',
								'title' 	=> esc_html__( 'Template Style', 'xtra' ),
								'options' 	=> array(
									'1'			=> esc_html__( 'Medium Image', 'xtra' ),
									'2'			=> esc_html__( 'Medium Image ( Right )', 'xtra' ),
									'3'			=> esc_html__( 'Full Width Image', 'xtra' ),
									'4'			=> esc_html__( 'Grid 2 Columns', 'xtra' ),
									'5'			=> esc_html__( 'Grid 3 Columns', 'xtra' ),
                  'x'     => esc_html__( 'Custom page as template', 'xtra' ),
								)
							),
              array(
                'id'    => 'template_post',
                'type'    => 'select',
                'title'   => esc_html__( 'Template', 'xtra' ),
                'desc'    => esc_html__( 'For more information please go to', 'xtra' ) . ' <a href="http://xtratheme.com/help/how-to-create-custom-blog-page/" target="_blank">' . esc_html__( 'Tutorial', 'xtra' ) . '</a>',
                'options'   => Codevz::$array_pages,
                'dependency'  => array( 'template_style', '==', 'x' ),
              ),
							array(
								'id'    	=> 'posts_per_page',
								'type'  	=> 'slider',
								'title' 	=> esc_html__( 'Posts Per Page', 'xtra' ),
								'options'	=> array( 'unit' => '', 'step' => 1, 'min' => -1, 'max' => 100 ),
                'dependency'  => array( 'template_style', '!=', 'x' )
							),
							array(
								'id'    	=> 'post_excerpt',
								'type'  	=> 'slider',
                'title'   => esc_html__( 'Excerpt lenght', 'xtra' ),
								'help' 	  => esc_html__( '-1 means full content without readmore button', 'xtra' ),
								'options'	=> array( 'unit' => '', 'step' => 1, 'min' => 0, 'max' => 50 ),
								'default' 	=> '20',
                'dependency'  => array( 'template_style', '!=', 'x' )
							),
							array(
								'id'          => 'readmore',
								'type'        => 'text',
								'title'       => esc_html__( 'Read more', 'xtra' ),
								'default'	    => 'Read More',
								'setting_args' => array( 'transport' => 'postMessage' )
							),
						),
					),

					array(
						'name'   => 'blog_styles',
						'title'  => esc_html__( 'Blog Styles', 'xtra' ),
						'fields' => array(
							array(
								'type'    => 'notice',
								'class'   => 'info',
								'content' => esc_html__( 'Styles', 'xtra' ) . self::$sk_advanced
							),
							array(
								'id' 			=> '_css_sticky_post',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Sticky Post', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'text-align', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.cz_default_loop.sticky > div',
							),
							array(
								'id' 			=> '_css_sticky_post_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop.sticky > div',
							),
							array(
								'id' 			=> '_css_sticky_post_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop.sticky > div',
							),
							array(
								'id' 			=> '_css_overall_post',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Overall Each Post', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'text-align', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.cz_default_loop > div',
							),
							array(
								'id' 			=> '_css_overall_post_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop > div',
							),
							array(
								'id' 			=> '_css_overall_post_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop > div',
							),
							array(
								'id' 			=> '_css_overall_post_hover',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Overall Each Post :Hover', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.cz_default_loop:hover > div',
							),
							array(
								'id' 			=> '_css_overall_post_hover_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop:hover > div',
							),
							array(
								'id' 			=> '_css_overall_post_hover_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop:hover > div',
							),
							array(
								'id' 			=> '_css_post_image',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Post image', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'opacity', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.cz_default_loop .cz_post_image img',
							),
							array(
								'id' 			=> '_css_post_image_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop .cz_post_image img',
							),
							array(
								'id' 			=> '_css_post_image_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop .cz_post_image img',
							),
							array(
								'id' 			=> '_css_post_image_hover',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Post image :Hover', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'opacity', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.cz_default_loop .cz_post_image:hover img',
							),
							array(
								'id' 			=> '_css_post_image_hover_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop .cz_post_image:hover img',
							),
							array(
								'id' 			=> '_css_post_image_hover_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop .cz_post_image:hover img',
							),
							array(
								'id' 			=> '_css_post_title',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Post Title', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'position', 'top', 'left', 'text-align', 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.cz_default_loop .cz_post_title h3',
							),
							array(
								'id' 			=> '_css_post_title_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop .cz_post_title h3',
							),
							array(
								'id' 			=> '_css_post_title_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop .cz_post_title h3',
							),
							array(
								'id' 			=> '_css_post_title_hover',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Post Title :Hover', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.cz_default_loop .cz_post_title h3:hover',
							),
							array(
								'id' 			=> '_css_post_title_hover_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop .cz_post_title h3',
							),
							array(
								'id' 			=> '_css_post_title_hover_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop .cz_post_title h3',
							),
							array(
								'id' 			=> '_css_post_meta_overall',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Post Meta Overall', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'float', 'position', 'top', 'right', 'bottom', 'left', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.cz_default_loop .cz_post_meta',
							),
							array(
								'id' 			=> '_css_post_meta_overall_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop .cz_post_meta',
							),
							array(
								'id' 			=> '_css_post_meta_overall_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop .cz_post_meta',
							),
							array(
								'id' 			=> '_css_post_avatar',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Post Avatar', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'background', 'padding', 'width', 'height', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.cz_default_loop .cz_post_author_avatar img',
							),
							array(
								'id' 			=> '_css_post_avatar_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop .cz_post_author_avatar img',
							),
							array(
								'id' 			=> '_css_post_avatar_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop .cz_post_author_avatar img',
							),
							array(
								'id' 			=> '_css_post_author',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Post Author', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.cz_default_loop .cz_post_author_name',
							),
							array(
								'id' 			=> '_css_post_author_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop .cz_post_author_name',
							),
							array(
								'id' 			=> '_css_post_author_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop .cz_post_author_name',
							),
							array(
								'id' 			=> '_css_post_date',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Post Date', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.cz_default_loop .cz_post_date',
							),
							array(
								'id' 			=> '_css_post_date_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop .cz_post_date',
							),
							array(
								'id' 			=> '_css_post_date_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop .cz_post_date',
							),
							array(
								'id' 			=> '_css_post_excerpt',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Post Excerpt', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'text-align', 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.cz_default_loop .cz_post_excerpt',
							),
							array(
								'id' 			=> '_css_post_excerpt_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop .cz_post_excerpt',
							),
							array(
								'id' 			=> '_css_post_excerpt_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_default_loop .cz_post_excerpt',
							),

							array(
								'type'    => 'notice',
								'class'   => 'info',
								'content' => esc_html__( 'Read More Button', 'xtra' )
							),
							array(
								'id' 			=> '_css_readmore',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Read more', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'float', 'position', 'top', 'right', 'bottom', 'left', 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.cz_readmore'
							),
							array(
								'id' 			=> '_css_readmore_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_readmore',
							),
							array(
								'id' 			=> '_css_readmore_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_readmore',
							),
							array(
								'id' 			=> '_css_readmore_hover',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Read more :Hover', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.cz_readmore:hover',
							),
							array(
								'id' 			=> '_css_readmore_hover_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_readmore:hover',
							),
							array(
								'id' 			=> '_css_readmore_hover_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_readmore:hover',
							),
							array(
								'id'          => 'readmore_icon',
								'type'        => 'icon',
								'title'       => esc_html__('Read more icon', 'xtra'),
								'default'	  => 'fa fa-angle-right'
							),
							array(
								'id' 			=> '_css_readmore_i',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Read more icon', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'font-size', 'float', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.cz_readmore i',
							),
							array(
								'id' 			=> '_css_readmore_i_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_readmore i',
							),
							array(
								'id' 			=> '_css_readmore_i_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_readmore i',
							),
							array(
								'id' 			=> '_css_readmore_hover_i',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Read more :Hover icon', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.cz_readmore:hover i',
							),
							array(
								'id' 			=> '_css_readmore_hover_i_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_readmore:hover i',
							),
							array(
								'id' 			=> '_css_readmore_hover_i_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.cz_readmore:hover i',
							),
							array(
								'type'    => 'notice',
								'class'   => 'info',
								'content' => esc_html__( 'Paginations', 'xtra' )
							),
							array(
								'id' 			=> '_css_pagination_li',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Paginations', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'width', 'height', 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'text-align', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.pagination a, .pagination > b, .pagination span, .page-numbers a, .page-numbers span'
							),
							array(
								'id' 			=> '_css_pagination_li_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.pagination a, .pagination > b, .pagination span, .page-numbers a, .page-numbers span'
							),
							array(
								'id' 			=> '_css_pagination_li_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.pagination a, .pagination > b, .pagination span, .page-numbers a, .page-numbers span'
							),
							array(
								'id' 			=> '_css_pagination_hover',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Paginations :Hover, active', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.pagination .current, .pagination > b, .pagination a:hover, .page-numbers .current, .page-numbers a:hover, .pagination .next:hover, .pagination .prev:hover, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current'
							),
							array(
								'id' 			=> '_css_pagination_hover_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.pagination .current, .pagination > b, .pagination a:hover, .page-numbers .current, .page-numbers a:hover, .pagination .next:hover, .pagination .prev:hover, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current'
							),
							array(
								'id' 			=> '_css_pagination_hover_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.pagination .current, .pagination > b, .pagination a:hover, .page-numbers .current, .page-numbers a:hover, .pagination .next:hover, .pagination .prev:hover, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current'
							),

						),
					),

					array(
						'name'   => 'single_settings',
						'title'  => esc_html__( 'Single Settings', 'xtra' ),
						'fields' => array(
							array(
								'id' 	=> 'meta_data_post',
								'type' 	=> 'checkbox',
								'title' => esc_html__( 'Single posts features', 'xtra' ),
								'options' => array(
									'image'		=> esc_html__('Featured image', 'xtra'),
									'author'	=> esc_html__('Author avatar & name', 'xtra'),
									'date'		=> esc_html__('Date', 'xtra'),
									'mbot'		=> esc_html__('Meta under the title', 'xtra'),
									'cats'		=> esc_html__('Categories', 'xtra'),
									'tags'		=> esc_html__('Tags', 'xtra'),
									'author_box'=> esc_html__('Author Box', 'xtra'),
									'next_prev' => esc_html__('Next Prev posts', 'xtra'),
								),
								'default' => array('image','date','author','cats','tags','author_box', 'next_prev')
							),
							array(
								'id' 			=> 'prev_post',
								'type' 			=> 'text',
								'title' 		=> esc_html__( 'Prev Post Sur title', 'xtra' ),
								'default' 		=> 'Previous',
								'setting_args' 	=> array('transport' => 'postMessage')
							),
							array(
								'id' 			=> 'next_post',
								'type' 			=> 'text',
								'title' 		=> esc_html__( 'Next Post Sur title', 'xtra' ),
								'default' 		=> 'Next',
								'setting_args' 	=> array('transport' => 'postMessage')
							),
							array(
								'id'          	=> 'related_posts_post',
								'type'        	=> 'text',
								'title'       	=> esc_html__('Related title', 'xtra'),
								'default'		=> 'Related Posts ...',
								'setting_args' => array('transport' => 'postMessage')
							),
							array(
								'id' 		=> 'related_post_col',
								'type' 		=> 'select',
								'title' 	=> esc_html__( 'Related columns', 'xtra' ),
								'options' 	=> array(
									's6' 		=> '2',
									's4' 		=> '3',
									's3' 		=> '4',
								),
								'default' 	=> 's4'
							),
							array(
								'id'    	=> 'related_post_ppp',
								'type'  	=> 'slider',
								'title' 	=> esc_html__( 'Related count', 'xtra' ),
								'options'	=> array( 'unit' => '', 'step' => 1, 'min' => -1, 'max' => 100 ),
								'default' 	=> '3'
							),
							//array(
							//	'id'    		=> 'comments',
							//	'type'  		=> 'text',
							//	'title' 		=> esc_html__( 'Comments title', 'xtra' ),
							//	'default' 		=> 'Comments',
							//	'setting_args' 	=> array( 'transport' => 'postMessage' )
							//),
						),
					),

					array(
						'name'   => 'single_styles',
						'title'  => esc_html__( 'Single Styles', 'xtra' ),
						'fields' => array(
							array(
								'type'    => 'notice',
								'class'   => 'info',
								'content' => esc_html__( 'Styles', 'xtra' ) . self::$sk_advanced
							),
							array(
								'id' 			=> '_css_single_con',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Content Container', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.single .single_con',
							),
							array(
								'id' 			=> '_css_single_con_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .single_con',
							),
							array(
								'id' 			=> '_css_single_con_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .single_con',
							),
							array(
								'id' 			=> '_css_single_title',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Title', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.single h3.section_title',
							),
							array(
								'id' 			=> '_css_single_title_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single h3.section_title',
							),
							array(
								'id' 			=> '_css_single_title_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single h3.section_title',
							),
							array(
								'id' 			=> '_css_single_fi',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Featured Image', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'width', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.single .cz_single_fi img',
							),
							array(
								'id' 			=> '_css_single_fi_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_single_fi img',
							),
							array(
								'id' 			=> '_css_single_fi_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_single_fi img',
							),
							array(
								'id' 			=> '_css_single_post_avatar',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Post Avatar', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.single .cz_post_author_avatar img',
							),
							array(
								'id' 			=> '_css_single_post_avatar_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_post_author_avatar img',
							),
							array(
								'id' 			=> '_css_single_post_avatar_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_post_author_avatar img',
							),
							array(
								'id' 			=> '_css_single_post_author',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Post Author', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.single .cz_post_author_name',
							),
							array(
								'id' 			=> '_css_single_post_author_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_post_author_name',
							),
							array(
								'id' 			=> '_css_single_post_author_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_post_author_name',
							),
							array(
								'id' 			=> '_css_single_post_date',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Post Date', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.single .cz_post_date',
							),
							array(
								'id' 			=> '_css_single_post_date_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_post_date',
							),
							array(
								'id' 			=> '_css_single_post_date_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_post_date',
							),
							array(
								'id' 			=> '_css_single_mbot',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Meta', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.single .cz_top_meta_i',
							),
							array(
								'id' 			=> '_css_single_mbot_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_top_meta_i',
							),
							array(
								'id' 			=> '_css_single_mbot_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_top_meta_i',
							),
							array(
								'id' 			=> '_css_single_mbot_i',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Meta title', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.single .cz_top_meta_i a, .single .cz_top_meta_i .cz_post_date',
							),
							array(
								'id' 			=> '_css_single_mbot_i_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_top_meta_i a, .single .cz_top_meta_i .cz_post_date',
							),
							array(
								'id' 			=> '_css_single_mbot_i_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_top_meta_i a, .single .cz_top_meta_i .cz_post_date',
							),
							array(
								'id' 			=> '_css_tags_categories',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Post Tags, Categories', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.tagcloud a, .cz_post_cat a'
							),
							array(
								'id' 			=> '_css_tags_categories_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.tagcloud a, .cz_post_cat a'
							),
							array(
								'id' 			=> '_css_tags_categories_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.tagcloud a, .cz_post_cat a'
							),
							array(
								'id' 			=> '_css_tags_categories_hover',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Tags, Cats :Hover', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.tagcloud a:hover, .cz_post_cat a:hover'
							),
							array(
								'id' 			=> '_css_tags_categories_hover_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.tagcloud a:hover, .cz_post_cat a:hover'
							),
							array(
								'id' 			=> '_css_tags_categories_hover_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.tagcloud a:hover, .cz_post_cat a:hover'
							),
							array(
								'id' 			=> '_css_next_prev_con',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Next / Prev posts Container', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.next_prev'
							),
							array(
								'id' 			=> '_css_next_prev_con_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.next_prev'
							),
							array(
								'id' 			=> '_css_next_prev_con_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.next_prev'
							),
							array(
								'id' 			=> '_css_next_prev_icons',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Next / Prev posts icons', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.next_prev i'
							),
							array(
								'id' 			=> '_css_next_prev_icons_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.next_prev i'
							),
							array(
								'id' 			=> '_css_next_prev_icons_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.next_prev i'
							),
							array(
								'id' 			=> '_css_next_prev_icons_hover',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Next / Prev icons :Hover', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.next_prev li:hover i'
							),
							array(
								'id' 			=> '_css_next_prev_icons_hover_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.next_prev li:hover i'
							),
							array(
								'id' 			=> '_css_next_prev_icons_hover_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.next_prev li:hover i'
							),
							array(
								'id' 			=> '_css_next_prev_icons_hover',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Next / Prev icons :Hover', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.next_prev li:hover i'
							),
							array(
								'id' 			=> '_css_next_prev_icons_hover_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.next_prev li:hover i'
							),
							array(
								'id' 			=> '_css_next_prev_icons_hover_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.next_prev li:hover i'
							),
							array(
								'id' 			=> '_css_next_prev_titles',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Next / Prev Post Titles', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.next_prev h4'
							),
							array(
								'id' 			=> '_css_next_prev_titles_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.next_prev h4'
							),
							array(
								'id' 			=> '_css_next_prev_titles_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.next_prev h4'
							),
							array(
								'id' 			=> '_css_next_prev_titles_hover',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Next / Prev Titles :Hover', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.next_prev li:hover h4'
							),
							array(
								'id' 			=> '_css_next_prev_titles_hover_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.next_prev li:hover h4'
							),
							array(
								'id' 			=> '_css_next_prev_titles_hover_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.next_prev li:hover h4'
							),
							array(
								'id' 			=> '_css_next_prev_surtitle',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Next / Prev Sur Titles', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.next_prev h4 small'
							),
							array(
								'id' 			=> '_css_next_prev_surtitle_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.next_prev h4 small'
							),
							array(
								'id' 			=> '_css_next_prev_surtitle_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.next_prev h4 small'
							),

							array(
								'type'    => 'notice',
								'class'   => 'info',
								'content' => esc_html__( 'Single More', 'xtra' )
							),
							array(
								'id' 			=> '_css_related_posts_con',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Related Posts Container', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.single .cz_related_posts'
							),
							array(
								'id' 			=> '_css_related_posts_con_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_related_posts'
							),
							array(
								'id' 			=> '_css_related_posts_con_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_related_posts'
							),
							array(
								'id' 			=> '_css_related_posts_sec_title',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Related Section Title', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.single .cz_related_posts > h4'
							),
							array(
								'id' 			=> '_css_related_posts_sec_title_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_related_posts > h4'
							),
							array(
								'id' 			=> '_css_related_posts_sec_title_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_related_posts > h4'
							),
							array(
								'id' 			=> '_css_related_posts',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Related Each Posts', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.single .cz_related_post > div'
							),
							array(
								'id' => '_css_related_posts_tablet',
								'type' => 'cz_sk_hidden',
								'setting_args' => array( 'transport' => 'postMessage' ),
								'selector' => '.single .cz_related_post > div'
							),
							array(
								'id' => '_css_related_posts_mobile',
								'type' => 'cz_sk_hidden',
								'setting_args' => array( 'transport' => 'postMessage' ),
								'selector' => '.single .cz_related_post > div'
							),
							array(
								'id' 			=> '_css_related_posts_hover',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Related Each Posts Hover', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.single .cz_related_post:hover > div'
							),
							array(
								'id' 			=> '_css_related_posts_hover_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_related_post:hover > div'
							),
							array(
								'id' 			=> '_css_related_posts_hover_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_related_post:hover > div'
							),
              array(
                'id'      => '_css_related_posts_img',
                'type'      => 'cz_sk',
                'button'    => esc_html__( 'Related Posts Image', 'xtra' ),
                'setting_args'  => array( 'transport' => 'postMessage' ),
                'settings'    => array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
                'selector'    => '.single .cz_related_post > div img'
              ),
              array(
                'id' => '_css_related_posts_img_tablet',
                'type' => 'cz_sk_hidden',
                'setting_args' => array( 'transport' => 'postMessage' ),
                'selector'    => '.single .cz_related_post > div img'
              ),
              array(
                'id' => '_css_related_posts_img_mobile',
                'type' => 'cz_sk_hidden',
                'setting_args' => array( 'transport' => 'postMessage' ),
                'selector'    => '.single .cz_related_post > div img'
              ),
							array(
								'id' 			=> '_css_related_posts_title',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Related Posts Title', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.single .cz_related_post h3'
							),
							array(
								'id' 			=> '_css_related_posts_title_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_related_post h3'
							),
							array(
								'id' 			=> '_css_related_posts_title_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_related_post h3'
							),
							array(
								'id' 			=> '_css_related_posts_meta',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Related Posts Meta', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.single .cz_related_post_date'
							),
							array(
								'id' 			=> '_css_related_posts_meta_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_related_post_date'
							),
							array(
								'id' 			=> '_css_related_posts_meta_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_related_post_date'
							),
							array(
								'id' 			=> '_css_related_posts_meta_links',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Related Posts Meta links', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.single .cz_related_post_date a'
							),
							array(
								'id' 			=> '_css_related_posts_meta_links_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_related_post_date a'
							),
							array(
								'id' 			=> '_css_related_posts_meta_links_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .cz_related_post_date a'
							),
							array(
								'id' 			=> '_css_single_comments_title',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Comments Title', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'color', 'background', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
								'selector' 		=> '.single #comments > h3'
							),
							array(
								'id' 			=> '_css_single_comments_title_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single #comments > h3'
							),
							array(
								'id' 			=> '_css_single_comments_title_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single #comments > h3'
							),
							array(
								'id' 			=> '_css_single_comments_li',
								'type' 			=> 'cz_sk',
								'button' 		=> esc_html__( 'Each comments', 'xtra' ),
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'settings' 		=> array( 'background', 'font-size', 'padding', 'margin', 'border', 'box-shadow' ),
								'selector' 		=> '.single .commentlist li article'
							),
							array(
								'id' 			=> '_css_single_comments_li_tablet',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .commentlist li article'
							),
							array(
								'id' 			=> '_css_single_comments_li_mobile',
								'type' 			=> 'cz_sk_hidden',
								'setting_args' 	=> array( 'transport' => 'postMessage' ),
								'selector' 		=> '.single .commentlist li article'
							),
						),
					),

          array(
            'name'   => 'search_settings',
            'title'  => esc_html__( 'Search Page Settings', 'xtra' ),
            'fields' => array(
				array(
					'id'      => 'search_title_prefix',
					'type'    => 'text',
					'title'   => esc_html__( 'Search Title Prefix', 'xtra' ),
				),
				array(
					'id' 		=> 'search_cpt',
					'type' 		=> 'text',
					'title'		=> esc_html__( 'Search Post type(s)', 'xtra' ),
					'help'		=> 'e.g. post,portfolio,product'
				),
              array(
                'id'  => 'layout_search',
                'type'  => 'select',
                'title' => esc_html__( 'Layout', 'xtra' ),
                'options'       => array(
                  '1'           => esc_html__( 'Default', 'xtra' ),
                  'ws'          => esc_html__( 'Without sidebar', 'xtra' ),
                  'bpnp'        => esc_html__( 'Blank Page ( No Padding )', 'xtra' ),
                  'right'       => esc_html__( 'Right sidebar', 'xtra' ),
                  'right-s'     => esc_html__( 'Right sidebar ( Small )', 'xtra' ),
                  'left'        => esc_html__( 'Left sidebar', 'xtra' ),
                  'left-s'      => esc_html__( 'Left sidebar ( Small )', 'xtra' ),
                  'both-side'   => esc_html__( 'Both sidebars', 'xtra' ),
                  'both-side2'  => esc_html__( 'Both sidebars ( Small )', 'xtra' ),
                  'both-right'  => esc_html__( 'Both sidebars ( Right )', 'xtra' ),
                  'both-right2' => esc_html__( 'Both sidebars ( Right - Small )', 'xtra' ),
                  'both-left'   => esc_html__( 'Both sidebars ( Left )', 'xtra' ),
                  'both-left2'  => esc_html__( 'Both sidebars ( Left - Small )', 'xtra' ),
                ),
                'help'  => self::help('default')
              ),
              array(
                'id'  => 'primary_search',
                'type'  => 'select',
                'title' => esc_html__( 'Primary Sidebar', 'xtra' ),
                'default'   => 'primary',
                'options' => self::sidebars(),
                    'dependency'  => array( 'layout_search|layout_search|layout_search|layout_search', '!=|!=|!=|!=', '|ws|1|bpnp' )
              ),
              array(
                'id'  => 'secondary_search',
                'type'  => 'select',
                'title' => esc_html__( 'Secondary Sidebar', 'xtra' ),
                'default'   => 'secondary',
                'options' => self::sidebars(),
                    'dependency'  => array( 'layout_search|layout_search|layout_search|layout_search|layout_search|layout_search', '!=|!=|!=|!=|!=|!=', '|ws|left|right|1|bpnp' )
              )
            ),
          ),

				),
			);

			// Generate options for each post types
			foreach ( self::post_types() as $cpt ) {
				if ( empty( $cpt ) ) {
					continue;
				}
				$name = ucwords( str_replace( '_', ' ', $cpt ) );
				$options[] = array(
					'name'   => 'post_type_' . $cpt,
					'title'  => $name,
					'sections' => array(

						array(
							'name'   => $cpt . '_settings',
							'title'  => $name . ' ' . esc_html__( 'Settings', 'xtra' ),
							'fields' => wp_parse_args( 
								self::title_options( '_' . $cpt, '.cz-cpt-' . $cpt . ' ' ),
								array(
									array(
										'id' 	=> 'slug_' . $cpt,
										'type' 	=> 'text',
										'title' => esc_html__( 'Slug', 'xtra' ),
										'attributes' => array( 'placeholder'	=> $cpt ),
										'setting_args' => array('transport' => 'postMessage')
									),
									array(
										'id' 	=> 'title_' . $cpt,
										'type' 	=> 'text',
										'title' => esc_html__( 'Archive title', 'xtra' ),
										'attributes' => array( 'placeholder'	=> $name ),
										'setting_args' => array('transport' => 'postMessage')
									),
									array(
										'id' 	=> 'cat_' . $cpt,
										'type' 	=> 'text',
										'title' => esc_html__( 'Category slug', 'xtra' ),
										'attributes' => array( 'placeholder'	=> $cpt . '/cat' ),
										'setting_args' => array('transport' => 'postMessage')
									),
									array(
										'id' 	=> 'cat_title_' . $cpt,
										'type' 	=> 'text',
										'title' => esc_html__( 'Category title', 'xtra' ),
										'attributes' => array( 'placeholder'	=> 'Categories' ),
										'setting_args' => array('transport' => 'postMessage')
									),
									array(
										'id' 	=> 'tags_' . $cpt,
										'type' 	=> 'text',
										'title' => esc_html__( 'Tags slug', 'xtra' ),
										'attributes' => array( 'placeholder'	=> $cpt . '/tags' ),
										'setting_args' => array('transport' => 'postMessage')
									),
									array(
										'id' 	=> 'tags_title_' . $cpt,
										'type' 	=> 'text',
										'title' => esc_html__( 'Tags title', 'xtra' ),
										'attributes' => array( 'placeholder'	=> 'Tags' ),
										'setting_args' => array('transport' => 'postMessage')
									),

									array(
										'type'    => 'notice',
										'class'   => 'info',
										'content' => esc_html__( 'Template', 'xtra' )
									),
									array(
										'id' 		=> 'template_' . $cpt,
										'type' 		=> 'select',
										'title'		=> esc_html__( 'Template', 'xtra' ),
										'desc'		=> esc_html__( 'For more information please go to', 'xtra' ) . ' <a href="http://xtratheme.com/help/" target="_blank">' . esc_html__( 'Help Center', 'xtra' ) . '</a>',
										'options' 	=> Codevz::$array_pages
									),
									array(
										'id' 		=> 'cols_' . $cpt,
										'type' 		=> 'select',
										'title' 	=> esc_html__( 'Columns', 'xtra' ),
										'options' 	=> array(
											's6'		=> '2',
											's4'		=> '3',
											's3'		=> '4',
										),
										'default' 	=> 's4'
									),
									array(
										'id'    	=> 'posts_per_page_' . $cpt,
										'type'  	=> 'slider',
										'title' 	=> esc_html__( 'Posts Per Page', 'xtra' ),
										'options'	=> array( 'unit' => '', 'step' => 1, 'min' => -1, 'max' => 100 )
									),

									array(
										'type'    => 'notice',
										'class'   => 'info',
										'content' => esc_html__( 'Layout', 'xtra' )
									),
									array(
										'id' 	=> 'layout_' . $cpt,
										'type' 	=> 'select',
										'title' => esc_html__( 'Layout', 'xtra' ),
										'options' 	=> array(
											'1' 			=> esc_html__( 'Default', 'xtra' ),
											'ws' 			=> esc_html__( 'Without sidebar', 'xtra' ),
									        'bpnp'      	=> esc_html__( 'Blank Page ( No Padding )', 'xtra' ),
                  'right'       => esc_html__( 'Right sidebar', 'xtra' ),
                  'right-s'     => esc_html__( 'Right sidebar ( Small )', 'xtra' ),
                  'left'        => esc_html__( 'Left sidebar', 'xtra' ),
                  'left-s'      => esc_html__( 'Left sidebar ( Small )', 'xtra' ),
											'both-side' 	=> esc_html__( 'Both sidebars', 'xtra' ),
											'both-side2' 	=> esc_html__( 'Both sidebars ( Small )', 'xtra' ),
											'both-right'	=> esc_html__( 'Both sidebars ( Right )', 'xtra' ),
											'both-right2'	=> esc_html__( 'Both sidebars ( Right - Small )', 'xtra' ),
											'both-left' 	=> esc_html__( 'Both sidebars ( Left )', 'xtra' ),
											'both-left2' 	=> esc_html__( 'Both sidebars ( Left - Small )', 'xtra' ),
										),
										'help'  => self::help('default')
									),
									array(
										'id' 	=> 'primary_' . $cpt,
										'type' 	=> 'select',
										'title' => esc_html__( 'Primary Sidebar', 'xtra' ),
										'default' 	=> 'primary',
										'options' => self::sidebars(),
							      		'dependency' 	=> array( 'layout_' . $cpt . '|layout_' . $cpt . '|layout_' . $cpt . '|layout_' . $cpt, '!=|!=|!=|!=', '|1|ws|bpnp' )
									),
									array(
										'id' 	=> 'secondary_' . $cpt,
										'type' 	=> 'select',
										'title' => esc_html__( 'Secondary Sidebar', 'xtra' ),
										'default' 	=> 'secondary',
										'options' => self::sidebars(),
							      		'dependency' 	=> array( 'layout_' . $cpt . '|layout_' . $cpt . '|layout_' . $cpt . '|layout_' . $cpt . '|layout_' . $cpt . '|layout_' . $cpt, '!=|!=|!=|!=|!=|!=', '|ws|1|left|right|bpnp' )
									),

									array(
										'type'    => 'notice',
										'class'   => 'info',
										'content' => esc_html__( 'Title & Slider', 'xtra' )
									),
								)
							)
						),

						array(
							'name'   => $cpt . '_single_settings',
							'title'  => ucwords( str_replace( '_', ' ', $name ) ) . ' ' . esc_html__( ' Single Settings', 'xtra' ),
							'fields' => array( 
								array(
									'id' 	=> 'meta_data_' . $cpt,
									'type' 	=> 'checkbox',
									'title' => esc_html__( 'Single pages meta', 'xtra' ),
									'options' => array(
										'image'		=> esc_html__('Featured image', 'xtra'),
										'date'		=> esc_html__('Date', 'xtra'),
										'cats'		=> esc_html__('Categories', 'xtra'),
										'tags'		=> esc_html__('Tags', 'xtra'),
										'author_box'=> esc_html__('Author Box', 'xtra'),
										'next_prev' => esc_html__('Next Prev posts', 'xtra'),
									),
									'default' => array('image','date','author','cats','tags','author_box')
								),
								array(
									'id'          => 'related_posts_' . $cpt,
									'type'        => 'text',
									'title'       => esc_html__('Related section title', 'xtra'),
									'default'	  => 'Related Posts ...',
									'setting_args' => array('transport' => 'postMessage')
								),
								array(
									'id' 		=> 'related_' . $cpt . '_col',
									'type' 		=> 'select',
									'title' 	=> esc_html__( 'Related columns', 'xtra' ),
									'options' 	=> array(
										's6' 		=> '2',
										's4' 		=> '3',
										's3' 		=> '4',
									),
									'default' 	=> 's4',
								),
								array(
									'id'    	=> 'related_' . $cpt . '_ppp',
									'type'  	=> 'slider',
									'title' 	=> esc_html__( 'Related count', 'xtra' ),
									'options'	=> array( 'unit' => '', 'step' => 1, 'min' => -1, 'max' => 100 ),
									'default' 	=> '3',
								),
							)
						),

						array(
							'name'   => $cpt . '_styling',
							'title'  => $name . ' ' . esc_html__( 'Styling', 'xtra' ),
							'fields' => array(
								array(
									'type'    => 'notice',
									'class'   => 'info',
									'content' => $name
								),
								array(
									'id' 			=> '_css_' . $cpt . '_overall',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Overall each posts', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'color', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
									'selector' 		=> '.cz_default_grid > div'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_overall_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.cz_default_grid > div'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_overall_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.cz_default_grid > div'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_overall_hover',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Overall posts :Hover', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'color', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
									'selector' 		=> '.cz_default_grid:hover > div'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_overall_hover_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.cz_default_grid:hover > div'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_overall_hover_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.cz_default_grid:hover > div'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_img',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Posts image', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'color', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
									'selector' 		=> '.cz_default_grid img'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_img_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.cz_default_grid img'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_img_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.cz_default_grid img'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_img_hover',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Posts image :Hover', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'color', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
									'selector' 		=> '.cz_default_grid:hover img'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_img_hover_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.cz_default_grid:hover img'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_img_hover_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.cz_default_grid:hover img'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_title',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Posts title', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'color', 'background', 'position', 'left', 'top', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
									'selector' 		=> '.cz_default_grid h3'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_title_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.cz_default_grid h3'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_title_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.cz_default_grid h3'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_title_hover',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Posts title :Hover', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'color', 'background', 'position', 'left', 'top', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
									'selector' 		=> '.cz_default_grid:hover h3'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_title_hover_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.cz_default_grid:hover h3'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_title_hover_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.cz_default_grid:hover h3'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_meta',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Posts meta', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'color', 'background', 'position', 'left', 'top', 'font-size', 'line-height', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
									'selector' 		=> '.cz_default_grid h3 small'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_meta_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.cz_default_grid h3 small'
								),
								array(
									'id' 			=> '_css_' . $cpt . '_meta_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.cz_default_grid h3 small'
								),

							)
						),
					)
				);
			}

			// Option for adding new post type by admin
			$options[]   = array(
				'name' 		=> 'add_post_type',
				'title' 	=> esc_html__( 'Add post type', 'xtra' ),
				'fields' => array(
					array(
						'id'              => 'add_post_type',
						'type'            => 'group',
						'title' 		      => esc_html__('Add post type', 'xtra'),
						'button_title'    => esc_html__('Add', 'xtra'),
						'fields'          => array(
							array(
								'id'          => 'name',
								'type'        => 'text',
								'title'       => esc_html__('Name', 'xtra'),
								'desc' 		    => 'e.g. projects or our_projects',
								'setting_args' => array( 'transport' => 'postMessage' ),
							),
						),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
					),
					array(
						'type'    => 'notice',
						'class'   => 'info',
						'content' => esc_html__( 'After adding new post type(s), Close theme options and go to Settings > Permalinks and save permalinks once for fixing error 404 on new post type pages, Then go back to Theme Options and you can see your new post type section for settings.', 'xtra' )
					),
				)
			);

			// bbpress options
			if ( function_exists( 'is_bbpress' ) ) {
				$options[] = array(
					'name'   => 'post_type_bbpress',
					'title'  => esc_html__( 'BBPress', 'xtra' ),
					'fields' => wp_parse_args( 
						self::title_options( '_bbpress', '.cz-cpt-bbpress ' ),
						array(
							array(
								'id' 	=> 'layout_bbpress',
								'type' 	=> 'select',
								'title' => esc_html__( 'Layout', 'xtra' ),
								'options' 	=> array(
									'1' 			=> esc_html__( 'Default', 'xtra' ),
									'ws' 			=> esc_html__( 'Without sidebar', 'xtra' ),
							        'bpnp'      	=> esc_html__( 'Blank Page ( No Padding )', 'xtra' ),
                  'right'       => esc_html__( 'Right sidebar', 'xtra' ),
                  'right-s'     => esc_html__( 'Right sidebar ( Small )', 'xtra' ),
                  'left'        => esc_html__( 'Left sidebar', 'xtra' ),
                  'left-s'      => esc_html__( 'Left sidebar ( Small )', 'xtra' ),
									'both-side' 	=> esc_html__( 'Both sidebars', 'xtra' ),
									'both-side2' 	=> esc_html__( 'Both sidebars ( Small )', 'xtra' ),
									'both-right'	=> esc_html__( 'Both sidebars ( Right )', 'xtra' ),
									'both-right2'	=> esc_html__( 'Both sidebars ( Right - Small )', 'xtra' ),
									'both-left' 	=> esc_html__( 'Both sidebars ( Left )', 'xtra' ),
									'both-left2' 	=> esc_html__( 'Both sidebars ( Left - Small )', 'xtra' ),
								),
								'help'  => self::help('default')
							),
							array(
								'id' 	=> 'primary_bbpress',
								'type' 	=> 'select',
								'title' => esc_html__( 'Primary Sidebar', 'xtra' ),
								'default' 	=> 'primary',
								'options' => self::sidebars(),
					      		'dependency' 	=> array( 'layout_bbpress|layout_bbpress|layout_bbpress|layout_bbpress', '!=|!=|!=|!=', '|ws|1|bpnp' )
							),
							array(
								'id' 	=> 'secondary_bbpress',
								'type' 	=> 'select',
								'title' => esc_html__( 'Secondary Sidebar', 'xtra' ),
								'default' 	=> 'secondary',
								'options' => self::sidebars(),
					      		'dependency' 	=> array( 'layout_bbpress|layout_bbpress|layout_bbpress|layout_bbpress|layout_bbpress|layout_bbpress', '!=|!=|!=|!=|!=|!=', '|ws|left|right|1|bpnp' )
							)
						)
					)
				);
			}

			// DWQA options
			if ( function_exists( 'dwqa' ) ) {
				$options[] = array(
					'name'   => 'post_type_dwqa-question',
					'title'  => esc_html__( 'DWQA', 'xtra' ),
					'fields' => wp_parse_args( 
						self::title_options( '_dwqa-question', '.cz-cpt-dwqa-question ' ),
						array(
							array(
								'id' 	=> 'layout_dwqa-question',
								'type' 	=> 'select',
								'title' => esc_html__( 'Layout', 'xtra' ),
								'options' 	=> array(
									'1' 			=> esc_html__( 'Default', 'xtra' ),
									'ws' 			=> esc_html__( 'Without sidebar', 'xtra' ),
							        'bpnp'      	=> esc_html__( 'Blank Page ( No Padding )', 'xtra' ),
                  'right'       => esc_html__( 'Right sidebar', 'xtra' ),
                  'right-s'     => esc_html__( 'Right sidebar ( Small )', 'xtra' ),
                  'left'        => esc_html__( 'Left sidebar', 'xtra' ),
                  'left-s'      => esc_html__( 'Left sidebar ( Small )', 'xtra' ),
									'both-side' 	=> esc_html__( 'Both sidebars', 'xtra' ),
									'both-side2' 	=> esc_html__( 'Both sidebars ( Small )', 'xtra' ),
									'both-right'	=> esc_html__( 'Both sidebars ( Right )', 'xtra' ),
									'both-right2'	=> esc_html__( 'Both sidebars ( Right - Small )', 'xtra' ),
									'both-left' 	=> esc_html__( 'Both sidebars ( Left )', 'xtra' ),
									'both-left2' 	=> esc_html__( 'Both sidebars ( Left - Small )', 'xtra' ),
								),
								'help'  => self::help('default')
							),
							array(
								'id' 	=> 'primary_dwqa-question',
								'type' 	=> 'select',
								'title' => esc_html__( 'Primary Sidebar', 'xtra' ),
								'default' 	=> 'primary',
								'options' => self::sidebars(),
					      		'dependency' 	=> array( 'layout_dwqa-question|layout_dwqa-question|layout_dwqa-question|layout_dwqa-question', '!=|!=|!=|!=', '|ws|1|bpnp' )
							),
							array(
								'id' 	=> 'secondary_dwqa-question',
								'type' 	=> 'select',
								'title' => esc_html__( 'Secondary Sidebar', 'xtra' ),
								'default' 	=> 'secondary',
								'options' => self::sidebars(),
					      		'dependency' 	=> array( 'layout_dwqa-question|layout_dwqa-question|layout_dwqa-question|layout_dwqa-question|layout_dwqa-question|layout_dwqa-question', '!=|!=|!=|!=|!=|!=', '|ws|left|right|1|bpnp' )
							)
						)
					)
				);
			}

			// WooCommerce options
			if ( function_exists('is_woocommerce') ) {
				$options[] = array(
					'name' 		=> 'post_type_product',
					'title' 	=> esc_html__( 'WooCommerce', 'xtra' ),
					'sections'  => array(

						array(
							'name'   => 'woo_settings',
							'title'  => esc_html__( 'Woocommerce Settings', 'xtra' ),
							'fields' => wp_parse_args(
								self::title_options( '_product', '.cz-cpt-product ' ),
								array(
									array(
										'id' 		=> 'layout_product',
										'type' 		=> 'select',
										'title' 	=> esc_html__( 'Layout', 'xtra' ),
										'options' 	=> array(
											'1' 			=> esc_html__( 'Default', 'xtra' ),
											'ws' 			=> esc_html__( 'Without sidebar', 'xtra' ),
									        'bpnp'      	=> esc_html__( 'Blank Page ( No Padding )', 'xtra' ),
                  'right'       => esc_html__( 'Right sidebar', 'xtra' ),
                  'right-s'     => esc_html__( 'Right sidebar ( Small )', 'xtra' ),
                  'left'        => esc_html__( 'Left sidebar', 'xtra' ),
                  'left-s'      => esc_html__( 'Left sidebar ( Small )', 'xtra' ),
											'both-side' 	=> esc_html__( 'Both sidebars', 'xtra' ),
											'both-side2' 	=> esc_html__( 'Both sidebars ( Small )', 'xtra' ),
											'both-right'	=> esc_html__( 'Both sidebars ( Right )', 'xtra' ),
											'both-right2'	=> esc_html__( 'Both sidebars ( Right - Small )', 'xtra' ),
											'both-left' 	=> esc_html__( 'Both sidebars ( Left )', 'xtra' ),
											'both-left2' 	=> esc_html__( 'Both sidebars ( Left - Small )', 'xtra' ),
										),
										'help'  	=> esc_html__( 'Default layout for all WooCommerce pages', 'xtra' )
									),
									array(
										'id' 		=> 'primary_product',
										'type' 		=> 'select',
										'title' 	=> esc_html__( 'Primary Sidebar', 'xtra' ),
										'default' 	=> 'primary',
										'options' 	=> self::sidebars(),
							      		'dependency' 	=> array( 'layout_product|layout_product|layout_product|layout_product', '!=|!=|!=|!=|!=', '|ws|1|bpnp' )
									),
									array(
										'id' 		=> 'secondary_product',
										'type' 		=> 'select',
										'title' 	=> esc_html__( 'Secondary Sidebar', 'xtra' ),
										'default' 	=> 'secondary',
										'options' 	=> self::sidebars(),
							      		'dependency' 	=> array( 'layout_product|layout_product|layout_product|layout_product|layout_product|layout_product', '!=|!=|!=|!=|!=|!=', '|ws|left|right|1|bpnp' )
									),

									array(
										'type' 		=> 'notice',
										'class' 	=> 'info',
										'content' 	=> esc_html__( 'Settings', 'xtra' )
									),
									array(
										'id' 	=> 'woo_col',
										'type' 	=> 'select',
										'title' => esc_html__( 'Shop Columns', 'xtra' ),
										'options' 	=> array(
											'2' => '2',
											'3' => '3',
											'4' => '4',
											'5' => '5',
											'6' => '6',
										),
										'default' 	=> '4'
									),
									array(
										'id'    => 'woo_items_per_page',
										'type'  => 'slider',
										'title' => esc_html__( 'Products Per Page', 'xtra' ),
										'options'	=> array( 'unit' => '', 'step' => 1, 'min' => -1, 'max' => 100 ),
									),
									array(
										'id' 	=> 'woo_related_col',
										'type' 	=> 'select',
										'title' => esc_html__( 'Related Products', 'xtra' ),
										'options' 	=> array(
											'2' => '2',
											'3' => '3',
											'4' => '4',
										),
										'default' 	=> '3'
									),
									array(
										'type'    => 'notice',
										'class'   => 'info',
										'content' => esc_html__( 'Title & Slider', 'xtra' )
									),
								)
							)
						),

						array(
							'name'   => 'woo_styles',
							'title'  => esc_html__( 'Woocommerce Styles', 'xtra' ),
							'fields' => array(
								array(
									'type'    => 'notice',
									'class'   => 'info',
									'content' => esc_html__( 'Styles', 'xtra' ) . self::$sk_advanced
								),
								array(
									'id' 			=> '_css_woo_products_overall',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Products', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
									'selector' 		=> '.woocommerce ul.products li.product .woocommerce-loop-product__link'
								),
								array(
									'id' 			=> '_css_woo_products_overall_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce ul.products li.product .woocommerce-loop-product__link'
								),
								array(
									'id' 			=> '_css_woo_products_overall_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce ul.products li.product .woocommerce-loop-product__link'
								),
								array(
									'id' 			=> '_css_woo_products_overall_hover',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Products :Hover', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
									'selector' 		=> '.woocommerce ul.products li.product:hover .woocommerce-loop-product__link'
								),
								array(
									'id' 			=> '_css_woo_products_overall_hover_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce ul.products li.product:hover .woocommerce-loop-product__link'
								),
								array(
									'id' 			=> '_css_woo_products_overall_hover_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce ul.products li.product:hover .woocommerce-loop-product__link'
								),
								array(
									'id' 			=> '_css_woo_products_thumbnails',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Images', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
									'selector' 		=> '.woocommerce ul.products li.product a img'
								),
								array(
									'id' 			=> '_css_woo_products_thumbnails_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce ul.products li.product a img'
								),
								array(
									'id' 			=> '_css_woo_products_thumbnails_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce ul.products li.product a img'
								),
								array(
									'id' 			=> '_css_woo_products_title',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Titles', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'color', 'background', 'font-family', 'font-weight', 'font-style', 'font-size', 'text-align', 'line-height', 'letter-spacing', 'padding', 'float', 'position', 'left', 'top', 'right', 'bottom', 'width', 'margin', 'border', 'box-shadow', 'text-shadow' ),
									'selector' 		=> '.woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce ul.products li.product h3,.woocommerce.woo-template-2 ul.products li.product .woocommerce-loop-category__title, .woocommerce.woo-template-2 ul.products li.product .woocommerce-loop-product__title, .woocommerce.woo-template-2 ul.products li.product h3'
								),
								array(
									'id' 			=> '_css_woo_products_title_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce ul.products li.product h3,.woocommerce.woo-template-2 ul.products li.product .woocommerce-loop-category__title, .woocommerce.woo-template-2 ul.products li.product .woocommerce-loop-product__title, .woocommerce.woo-template-2 ul.products li.product h3'
								),
								array(
									'id' 			=> '_css_woo_products_title_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce ul.products li.product h3,.woocommerce.woo-template-2 ul.products li.product .woocommerce-loop-category__title, .woocommerce.woo-template-2 ul.products li.product .woocommerce-loop-product__title, .woocommerce.woo-template-2 ul.products li.product h3'
								),
								array(
									'id' 			=> '_css_woo_products_stars',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Rating Stars', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'color', 'font-size', 'background', 'position', 'left', 'top', 'right', 'bottom', 'opacity', 'padding', 'margin', 'box-shadow' ),
									'selector' 		=> '.woocommerce ul.products li.product .star-rating'
								),
								array(
									'id' 			=> '_css_woo_products_stars_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce ul.products li.product .star-rating'
								),
								array(
									'id' 			=> '_css_woo_products_stars_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce ul.products li.product .star-rating'
								),
								array(
									'id' 			=> '_css_woo_products_onsale',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'On Sale Badge', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'line-height', 'width', 'height', 'position', 'color', 'background', 'font-family', 'font-weight', 'font-style', 'font-size', 'letter-spacing', 'top', 'left', 'padding', 'margin', 'border', 'box-shadow' ),
									'selector' 		=> '.woocommerce span.onsale, .woocommerce ul.products li.product .onsale'
								),
								array(
									'id' 			=> '_css_woo_products_onsale_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce span.onsale, .woocommerce ul.products li.product .onsale'
								),
								array(
									'id' 			=> '_css_woo_products_onsale_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce span.onsale, .woocommerce ul.products li.product .onsale'
								),
								array(
									'id' 			=> '_css_woo_products_price',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Price', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'position', 'color', 'background', 'font-family', 'font-weight', 'font-style', 'font-size', 'text-align', 'letter-spacing', 'top', 'right', 'padding', 'margin', 'border', 'box-shadow' ),
									'selector' 		=> '.woocommerce ul.products li.product .price'
								),
								array(
									'id' 			=> '_css_woo_products_price_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce ul.products li.product .price'
								),
								array(
									'id' 			=> '_css_woo_products_price_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce ul.products li.product .price'
								),
								array(
									'id' 			=> '_css_woo_products_add_to_cart',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Add to Cart Button', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'color', 'font-family', 'font-weight', 'font-style', 'font-size', 'text-align', 'letter-spacing', 'opacity', 'float', 'position', 'left', 'top', 'right', 'bottom', 'background', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
									'selector' 		=> '.woocommerce .button.product_type_simple.add_to_cart_button.ajax_add_to_cart, .woocommerce .button.product_type_variable.add_to_cart_button'
								),
								array(
									'id' 			=> '_css_woo_products_add_to_cart_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce .button.product_type_simple.add_to_cart_button.ajax_add_to_cart, .woocommerce .button.product_type_variable.add_to_cart_button'
								),
								array(
									'id' 			=> '_css_woo_products_add_to_cart_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce .button.product_type_simple.add_to_cart_button.ajax_add_to_cart, .woocommerce .button.product_type_variable.add_to_cart_button'
								),
								array(
									'id' 			=> '_css_woo_products_add_to_cart_hover',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Add to Cart :Hover', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'opacity', 'top', 'left', 'color', 'background', 'font-size', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
									'selector' 		=> '.woocommerce .button.product_type_simple.add_to_cart_button.ajax_add_to_cart:hover, .woocommerce .button.product_type_variable.add_to_cart_button:hover'
								),
								array(
									'id' 			=> '_css_woo_products_add_to_cart_hover_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce .button.product_type_simple.add_to_cart_button.ajax_add_to_cart:hover, .woocommerce .button.product_type_variable.add_to_cart_button:hover'
								),
								array(
									'id' 			=> '_css_woo_products_add_to_cart_hover_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce .button.product_type_simple.add_to_cart_button.ajax_add_to_cart:hover, .woocommerce .button.product_type_variable.add_to_cart_button:hover'
								),
								array(
									'id' 			=> '_css_woo_products_added_to_cart',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'View cart button', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'opacity', 'position', 'top', 'float', 'left', 'bottom', 'right', 'color', 'background', 'font-size', 'font-style', 'width', 'font-weight', 'text-align', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
									'selector' 		=> '.woocommerce a.added_to_cart'
								),
								array(
									'id' 			=> '_css_woo_products_added_to_cart_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce a.added_to_cart'
								),
								array(
									'id' 			=> '_css_woo_products_added_to_cart_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce a.added_to_cart'
								),
								array(
									'id' 			=> '_css_woo_products_added_to_cart_hover',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'View cart button :Hover', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'opacity', 'top', 'left', 'color', 'background', 'font-size', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
									'selector' 		=> '.woocommerce a.added_to_cart:hover'
								),
								array(
									'id' 			=> '_css_woo_products_added_to_cart_hover_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce a.added_to_cart:hover'
								),
								array(
									'id' 			=> '_css_woo_products_added_to_cart_hover_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce a.added_to_cart:hover'
								),
								array(
									'id' 			=> '_css_woo_products_result_count',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Result Count', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'color', 'background', 'font-size', 'letter-spacing', 'font-weight', 'font-style', 'text-transform', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
									'selector' 		=> '.woocommerce .woocommerce-result-count'
								),
								array(
									'id' 			=> '_css_woo_products_result_count_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce .woocommerce-result-count'
								),
								array(
									'id' 			=> '_css_woo_products_result_count_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce .woocommerce-result-count'
								),

								array(
									'type'    => 'notice',
									'class'   => 'info',
									'content' => esc_html__( 'Product Single Page', 'xtra' )
								),
								array(
									'id' 			=> '_css_woo_product_thumbnail',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Image', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
									'selector' 		=> '.woocommerce div.product div.images img'
								),
								array(
									'id' 			=> '_css_woo_product_thumbnail_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce div.product div.images img'
								),
								array(
									'id' 			=> '_css_woo_product_thumbnail_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce div.product div.images img'
								),
								array(
									'id' 			=> '_css_woo_product_title',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Title', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'text-align', 'color', 'font-family', 'font-size', 'font-weight', 'font-style', 'line-height', 'padding', 'margin', 'border' ),
									'selector' 		=> '.woocommerce div.product .product_title'
								),
								array(
									'id' 			=> '_css_woo_product_title_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce div.product .product_title'
								),
								array(
									'id' 			=> '_css_woo_product_title_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce div.product .product_title'
								),
								array(
									'id' 			=> '_css_woo_product_stars',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Rating Stars', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'color', 'font-size', 'padding', 'margin' ),
									'selector' 		=> '.woocommerce .woocommerce-product-rating .star-rating'
								),
								array(
									'id' 			=> '_css_woo_product_stars_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce .woocommerce-product-rating .star-rating'
								),
								array(
									'id' 			=> '_css_woo_product_stars_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce .woocommerce-product-rating .star-rating'
								),
								array(
									'id' 			=> '_css_woo_product_price',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Price', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'text-align', 'color', 'background', 'font-family', 'font-weight', 'font-style', 'font-size', 'letter-spacing', 'padding', 'margin', 'border' ),
									'selector' 		=> '.woocommerce div.product .summary p.price, .woocommerce div.product .summary span.price'
								),
								array(
									'id' 			=> '_css_woo_product_price_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce div.product .summary p.price, .woocommerce div.product .summary span.price'
								),
								array(
									'id' 			=> '_css_woo_product_price_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce div.product .summary p.price, .woocommerce div.product .summary span.price'
								),
								array(
									'id' 			=> '_css_woo_product_oos',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Out of stock', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'text-align', 'color', 'background', 'font-size', 'padding', 'margin', 'border' ),
									'selector' 		=> '.woocommerce div.product .out-of-stock'
								),
								array(
									'id' 			=> '_css_woo_product_oos_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce div.product .out-of-stock'
								),
								array(
									'id' 			=> '_css_woo_product_oos_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce div.product .out-of-stock'
								),
								array(
									'id' 			=> '_css_woo_product_meta',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Overall Meta', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'color', 'background', 'font-size', 'font-weight', 'font-style', 'line-height', 'letter-spacing', 'padding', 'margin', 'border' ),
									'selector' 		=> '.woocommerce .product_meta'
								),
								array(
									'id' 			=> '_css_woo_product_meta_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce .product_meta'
								),
								array(
									'id' 			=> '_css_woo_product_meta_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce .product_meta'
								),
								array(
									'id' 			=> '_css_woo_product_meta_link',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Meta links', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'color', 'background', 'font-size', 'font-weight', 'font-style', 'line-height', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
									'selector' 		=> '.woocommerce .product_meta a'
								),
								array(
									'id' 			=> '_css_woo_product_meta_link_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce .product_meta a'
								),
								array(
									'id' 			=> '_css_woo_product_meta_link_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce .product_meta a'
								),
								array(
									'id' 			=> '_css_woo_product_meta_link_hover',
									'type' 			=> 'cz_sk',
									'button' 		=> esc_html__( 'Meta links :Hover', 'xtra' ),
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'settings' 		=> array( 'color', 'background', 'font-size', 'font-weight', 'font-style', 'line-height', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
									'selector' 		=> '.woocommerce .product_meta a:hover'
								),
								array(
									'id' 			=> '_css_woo_product_meta_link_hover_tablet',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce .product_meta a:hover'
								),
								array(
									'id' 			=> '_css_woo_product_meta_link_hover_mobile',
									'type' 			=> 'cz_sk_hidden',
									'setting_args' 	=> array( 'transport' => 'postMessage' ),
									'selector' 		=> '.woocommerce .product_meta a:hover'
								),
							)
						)

					)
				);
			}

			// BuddyPress options
			if ( function_exists( 'is_buddypress' ) ) {
				$options[] = array(
					'name'   => 'post_type_buddypress',
					'title'  => esc_html__( 'Buddy Press', 'xtra' ),
					'fields' => wp_parse_args( 
						self::title_options( '_buddypress', '.cz-cpt-buddypress ' ),
						array(
							array(
								'id' 	=> 'layout_buddypress',
								'type' 	=> 'select',
								'title' => esc_html__( 'Layout', 'xtra' ),
								'options' 	=> array(
									'1' 			=> esc_html__( 'Default', 'xtra' ),
									'ws' 			=> esc_html__( 'Without sidebar', 'xtra' ),
							        'bpnp'      	=> esc_html__( 'Blank Page ( No Padding )', 'xtra' ),
                  'right'       => esc_html__( 'Right sidebar', 'xtra' ),
                  'right-s'     => esc_html__( 'Right sidebar ( Small )', 'xtra' ),
                  'left'        => esc_html__( 'Left sidebar', 'xtra' ),
                  'left-s'      => esc_html__( 'Left sidebar ( Small )', 'xtra' ),
									'both-side' 	=> esc_html__( 'Both sidebars', 'xtra' ),
									'both-side2' 	=> esc_html__( 'Both sidebars ( Small )', 'xtra' ),
									'both-right'	=> esc_html__( 'Both sidebars ( Right )', 'xtra' ),
									'both-right2'	=> esc_html__( 'Both sidebars ( Right - Small )', 'xtra' ),
									'both-left' 	=> esc_html__( 'Both sidebars ( Left )', 'xtra' ),
									'both-left2' 	=> esc_html__( 'Both sidebars ( Left - Small )', 'xtra' ),
								),
								'help'  => self::help('default')
							),
							array(
								'id' 	=> 'primary_buddypress',
								'type' 	=> 'select',
								'title' => esc_html__( 'Primary Sidebar', 'xtra' ),
								'default' 	=> 'primary',
								'options' => self::sidebars(),
					      		'dependency' 	=> array( 'layout_buddypress|layout_buddypress|layout_buddypress|layout_buddypress', '!=|!=|!=|!=', '|ws|1|bpnp' )
							),
							array(
								'id' 	=> 'secondary_buddypress',
								'type' 	=> 'select',
								'title' => esc_html__( 'Secondary Sidebar', 'xtra' ),
								'default' 	=> 'secondary',
								'options' => self::sidebars(),
					      		'dependency' 	=> array( 'layout_buddypress|layout_buddypress|layout_buddypress|layout_buddypress|layout_buddypress|layout_buddypress', '!=|!=|!=|!=|!=|!=', '|ws|left|right|1|bpnp' )
							)
						)
					)
				);
			}

			// EDD options
			if ( function_exists( 'EDD' ) ) {
				$options[] = array(
					'name'   => 'post_type_download',
					'title'  => esc_html__( 'Easy Digital Downloads', 'xtra' ),
					'fields' => wp_parse_args( 
						self::title_options( '_download', '.cz-cpt-download ' ),
						array(
							array(
								'id' 			=> 'layout_download',
								'type' 			=> 'select',
								'title' 		=> esc_html__( 'Layout', 'xtra' ),
								'options' 		=> array(
									'1' 			=> esc_html__( 'Default', 'xtra' ),
									'ws' 			=> esc_html__( 'Without sidebar', 'xtra' ),
							        'bpnp'      	=> esc_html__( 'Blank Page ( No Padding )', 'xtra' ),
                  'right'       => esc_html__( 'Right sidebar', 'xtra' ),
                  'right-s'     => esc_html__( 'Right sidebar ( Small )', 'xtra' ),
                  'left'        => esc_html__( 'Left sidebar', 'xtra' ),
                  'left-s'      => esc_html__( 'Left sidebar ( Small )', 'xtra' ),
									'both-side' 	=> esc_html__( 'Both sidebars', 'xtra' ),
									'both-side2' 	=> esc_html__( 'Both sidebars ( Small )', 'xtra' ),
									'both-right'	=> esc_html__( 'Both sidebars ( Right )', 'xtra' ),
									'both-right2'	=> esc_html__( 'Both sidebars ( Right - Small )', 'xtra' ),
									'both-left' 	=> esc_html__( 'Both sidebars ( Left )', 'xtra' ),
									'both-left2' 	=> esc_html__( 'Both sidebars ( Left - Small )', 'xtra' ),
								),
								'help'  		=> self::help('default')
							),
							array(
								'id' 			=> 'primary_download',
								'type' 			=> 'select',
								'title' 		=> esc_html__( 'Primary Sidebar', 'xtra' ),
								'default' 		=> 'primary',
								'options' 		=> self::sidebars(),
					      		'dependency' 	=> array( 'layout_download|layout_download|layout_download|layout_download', '!=|!=|!=|!=', '|ws|1|bpnp' )
							),
							array(
								'id' 			=> 'secondary_download',
								'type' 			=> 'select',
								'title' 		=> esc_html__( 'Secondary Sidebar', 'xtra' ),
								'default' 		=> 'secondary',
								'options' 		=> self::sidebars(),
					      		'dependency' 	=> array( 'layout_download|layout_download|layout_download|layout_download|layout_download|layout_download', '!=|!=|!=|!=|!=|!=', '|ws|left|right|1|bpnp' )
							)
						)
					)
				);
			}

			// Customize options for current widgets
			$options[] = array(
				'name'   => 'cz_customize_widgets',
				'title'  => esc_html__( 'Customize Widgets Styles', 'xtra' ),
				'fields' => self::sidebars_widgets()
			);

			$options[] = array(
				'name'   => 'backup_section',
				'title'  => esc_html__( 'Backup / Reset', 'xtra' ),
				'priority' => 900,
				'fields' => array(
					array(
						'type'    => 'notice',
						'class'   => 'info',
						'content' => esc_html__( 'You can save your current options. Download a Backup and Import.', 'xtra' )
					),
					array(
						'type' => 'backup'
					),
				)
			);

      /*
      $ids = array();
      foreach ( $options['header']['sections'] as $key ) {
        foreach ( $key['fields'] as $k ) {
          if ( ! empty( $k['id'] ) 
            && $k['id'] !== 'logo' 
            && $k['id'] !== '_css_logo_css' 
            && $k['id'] !== '_css_logo_css_tablet' 
            && $k['id'] !== '_css_logo_css_mobile' 
            && $k['id'] !== 'logo_2' 
            && $k['id'] !== '_css_logo_2_css' 
            && $k['id'] !== '_css_logo_2_css_tablet' 
            && $k['id'] !== '_css_logo_2_css_mobile' 
            && $k['id'] !== 'logo_hover_tooltip' 
            && $k['id'] !== '_css_logo_hover_tooltip' 
            && $k['id'] !== '_css_logo_hover_tooltip_tablet' 
            && $k['id'] !== '_css_logo_hover_tooltip_mobile' 
            && $k['id'] !== 'social' 
          ) {
            $ids[ $k['id'] ] = '';
          }
        }
      }
      var_export( $ids );
      */

			return $options;
		}

		/**
		 *
		 * Get CSS selector via option ID
		 * 
		 * @return string
		 *
		 */
		public static function get_selector( $i = '', $s = array() ) {

			$new_date = filemtime( __FILE__ );
			$save_date = get_option( 'codevz_options_file_modified_date' );

			if ( $save_date != $new_date || ! get_option( 'codevz_css_selectors' ) ) {
				foreach( self::options() as $option ) {
					if ( ! empty( $option['sections'] ) ) {
						foreach ( $option['sections'] as $section ) {
							if ( ! empty( $section['fields'] ) ) {
								foreach( $section['fields'] as $field ) {
									if ( ! empty( $field['id'] ) && ! empty( $field['selector'] ) ) {
										$s[ $field['id'] ] = $field['selector'];
									}
								}
							}
						}
					} else {
						if ( ! empty( $option['fields'] ) ) {
							foreach( $option['fields'] as $field ) {
								if ( ! empty( $field['id'] ) && ! empty( $field['selector'] ) ) {
									$s[ $field['id'] ] =  $field['selector'];
								}
							}
						}
					}
				}

				update_option( 'codevz_css_selectors', $s );
				update_option( 'codevz_options_file_modified_date', $new_date );
			} else {
				$s = get_option( 'codevz_css_selectors', array() );
			}

			// Append dynamic widgets and sidebars 
			$sidebars_widgets = (array) get_option( 'sidebars_widgets' );
			foreach ( $sidebars_widgets as $sidebar => $widgets ) {
				if ( $sidebar && $sidebar !== 'wp_inactive_widgets' && is_array( $widgets ) ) {
					foreach ( $widgets as $widget ) {
						$s[ '_css_' . $sidebar . '_' . $widget ] =  '.sidebar_' . $sidebar . ' #' . $widget;
					}
				}
			}

			return ( $i === 'all' ) ? $s : ( isset( $s[ $i ] ) ? $s[ $i ] : '' );
		}

		/**
		 *
		 * Get all sidebars and add widgets settings into customize page
		 * 
		 * @return array
		 *
		 */
		public static function sidebars_widgets() {
			$o = array();
			$a = (array) get_option( 'sidebars_widgets' );

			foreach ( $a as $sidebar => $widgets ) {
				if ( $sidebar && $sidebar !== 'wp_inactive_widgets' && is_array( $widgets ) ) {
					foreach ( $widgets as $widget ) {
						$o[] = array(
							'id' 			=> '_css_' . $sidebar . '_' . $widget,
							'type' 			=> 'cz_sk',
							'button' 		=> ucfirst( $sidebar ) . ' : ' . $widget,
							'setting_args' 	=> array( 'transport' => 'postMessage' ),
							'settings' 		=> array( 'color', 'background', 'padding', 'margin', 'box-shadow', 'border' ),
							'selector' 		=> '.sidebar_' . $sidebar . ' #' . $widget
						);
						$o[] = array(
							'id' 			=> '_css_' . $sidebar . '_' . $widget . '_tablet',
							'type' 			=> 'cz_sk_hidden',
							'setting_args' 	=> array( 'transport' => 'postMessage' ),
							'selector' 		=> '.sidebar_' . $sidebar . ' #' . $widget
						);
						$o[] = array(
							'id' 			=> '_css_' . $sidebar . '_' . $widget . '_mobile',
							'type' 			=> 'cz_sk_hidden',
							'setting_args' 	=> array( 'transport' => 'postMessage' ),
							'selector' 		=> '.sidebar_' . $sidebar . ' #' . $widget
						);
					}
				}
			}

			return $o;
		}

		/**
		 *
		 * General help texts for options
		 * 
		 * @return array
		 *
		 */
		public static function help( $i ) {

			$o = array(
				'4'				=> 'e.g. 10px 10px 10px 10px',
				'px'			=> 'e.g. 30px',
				'padding'		=> esc_html__( 'Creating space around an element, INSIDE of any defined margins and borders. Can set using px, %, em, ...', 'xtra' ),
				'margin'		=> esc_html__( 'Creating space around an element, OUTSIDE of any defined borders. Can set using px, %, em, auto, ...', 'xtra' ),
				'border'		=> esc_html__( 'Lines around element, e.g. 2px or manually set with this four positions respectively: <br />Top Right Bottom Left <br/><br/>e.g. 2px 2px 2px 2px', 'xtra' ),
				'radius'		=> esc_html__( 'Generate the arc for lines around element, e.g. 10px or manually set with this four positions respectively: <br />Top Right Bottom Left <br/><br/>e.g. 10px 10px 10px 10px', 'xtra' ),
				'default'		=> esc_html__( 'Default option', 'xtra' ),
			);

			return isset( $o[ $i ] ) ? $o[ $i ] : '';
		}

		/**
		 *
		 * Header builder elements
		 * 
		 * @return array
		 *
		 */
		public static function elements( $id, $title, $dependency = array(), $pos = '' ) {

			$is_fixed_side = Codevz::contains( $id, 'side' );
			$is_1_2_3 = Codevz::contains( $id, array( 'header_1', 'header_2', 'header_3' ) );
			$is_footer = Codevz::contains( $id, 'footer' );

			return array(
				'id'              => $id,
				'type'            => 'group',
				'title'           => $title,
				'button_title'    => esc_html__( 'Add', 'xtra' ) . ' ' . ucwords( $pos ),
				'accordion_title' => esc_html__( 'Add', 'xtra' ) . ' ' . ucwords( $pos ),
				'dependency'	  => $dependency,
				'setting_args' 	  => array( 'transport' => 'postMessage' ),
				'fields'          => array(

					array(
						'id' 	=> 'element',
						'type' 	=> 'select',
						'title' => esc_html__( 'Element', 'xtra' ),
						'options' => array(
							'logo' 		=> esc_html__( 'Logo', 'xtra' ),
							'logo_2' 	=> esc_html__( 'Logo Alternative', 'xtra' ),
							'menu' 		=> esc_html__( 'Menu', 'xtra' ),
							'social' 	=> esc_html__( 'Social Icons', 'xtra' ),
							'icon' 		=> esc_html__( 'Icon & Text', 'xtra' ),
							'search' 	=> esc_html__( 'Search', 'xtra' ),
							'line' 		=> esc_html__( 'Line', 'xtra' ),
							'button' 	=> esc_html__( 'Button', 'xtra' ),
							'image' 	=> esc_html__( 'Image', 'xtra' ),
							'shop_cart' => esc_html__( 'Shopping cart', 'xtra' ),
							'wpml' 		=> esc_html__( 'WPML Selector', 'xtra' ),
							'widgets' 	=> esc_html__( 'Offcanvas Sidebar', 'xtra' ),
							'hf_elm' 	=> esc_html__( 'Dropdown Content', 'xtra' ),
							'avatar' 	=> esc_html__( 'Current User GrAvatar', 'xtra' ),
							'custom' 	=> esc_html__( 'Custom Shortcode', 'xtra' ),
							'custom_element' => esc_html__( 'Custom Page', 'xtra' ),
						),
						'default_option' => esc_html__( 'Select', 'xtra'),
					),

					// Element ID for live customize
					array(
						'id'   		 => 'element_id',
						'title'   	 => 'ID',
						'type'       => 'text',
						'default'    => $id,
						'dependency' => array( 'xxx', '==', 'xxx' ),
					),

					// Logo
					array(
						'id'    => 'logo_width',
						'type'  => 'slider',
						'title' => esc_html__( 'Width', 'xtra' ),
						'options'	=> array( 'unit' => 'px', 'step' => 1, 'min' => 0, 'max' => 500 ),
						'dependency' => array( 'element', 'any', 'logo,logo_2' ),
					),

					// Menu
					array(
						'type'    => 'notice',
						'class'   => 'info',
						'content' => esc_html__( 'For adding or changing menu items go to Appearance > Menus', 'xtra' ),
						'dependency' => array( 'element', '==', 'menu' ),
					),
					array(
						'type'    => 'content',
						'content' => '<a class="button cz_menu_sk" href="#customize-control-codevz_theme_options-_css_menu_container_' . str_replace( '_' . $pos, '', $id ) . '">' . esc_html__( 'Menu Styling', 'xtra' ) . '</a>',
						'dependency' => array( 'element', '==', 'menu' ),
					),
					array(
						'id' 	=> 'menu_location',
						'type' 	=> 'select',
						'title' => esc_html__( 'Location', 'xtra' ),
						'options' 	=> array(
							'' 			=> esc_html__( 'Select', 'xtra' ), 
							'primary' 	=> esc_html__( 'Primary', 'xtra' ), 
							'secondary' => esc_html__( 'Secondary', 'xtra' ), 
							'one-page'  => esc_html__( 'One Page', 'xtra' ), 
							'footer'  	=> esc_html__( 'Footer', 'xtra' ),
							'mobile'  	=> esc_html__( 'Mobile', 'xtra' ),
							'custom-1' 	=> esc_html__( 'Custom 1', 'xtra' ), 
							'custom-2' 	=> esc_html__( 'Custom 2', 'xtra' ), 
							'custom-3' 	=> esc_html__( 'Custom 3', 'xtra' ),
							'custom-4' 	=> esc_html__( 'Custom 4', 'xtra' ),
							'custom-5' 	=> esc_html__( 'Custom 5', 'xtra' )
						),
						'dependency' => array( 'element', '==', 'menu' ),
					),
					array(
						'id'    => 'menu_type',
						'type'  => 'select',
						'title' => esc_html__( 'Menu type', 'xtra' ),
						'help'  => esc_html__( 'Scroll down to see menu styling', 'xtra' ),
						'options' 	=> array(
							'' 							               => esc_html__( 'Default', 'xtra' ),
							'offcanvas_menu_left' 		     => esc_html__( 'Offcanvas ( Left )', 'xtra' ),
							'offcanvas_menu_right' 		     => esc_html__( 'Offcanvas ( Right )', 'xtra' ),
							'fullscreen_menu' 			       => esc_html__( 'Fullscreen', 'xtra' ),
							'dropdown_menu' 			         => esc_html__( 'Dropdown', 'xtra' ),
							'open_horizontal inview_left'  => esc_html__( 'Sliding Menu ( Left )', 'xtra' ),
							'open_horizontal inview_right' => esc_html__( 'Sliding Menu ( Right )', 'xtra' ),
							'left_side_dots side_dots' 	   => esc_html__( 'Vertical Dots ( Left )', 'xtra' ),
							'right_side_dots side_dots'    => esc_html__( 'Vertical Dots ( Right )', 'xtra' ),
						),
						'dependency' => array( 'element', '==', 'menu' ),
					),
					array(
						'id'    => 'menu_icon',
						'type'  => 'icon',
						'title' => esc_html__( 'Icon', 'xtra' ),
						'dependency' => array( 'element|menu_type', '==|any', 'menu|offcanvas_menu_left,offcanvas_menu_right,fullscreen_menu,dropdown_menu,open_horizontal' ),
					),
					array(
						'id'    => 'menu_title',
						'type'  => 'text',
						'title' => esc_html__( 'Title', 'xtra' ),
						'dependency' => array( 'element|menu_type', '==|any', 'menu|offcanvas_menu_left,offcanvas_menu_right,fullscreen_menu,dropdown_menu,open_horizontal' ),
					),
					array(
						'id' 			=> 'sk_menu_icon',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Icon', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'font-size', 'color', 'background', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
						'dependency' 	=> array( 'element|menu_type', '==|any', 'menu|offcanvas_menu_left,offcanvas_menu_right,fullscreen_menu,dropdown_menu,open_horizontal' ),
					),
					array('id' => 'sk_menu_icon_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'sk_menu_icon_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),

					// Social
					array(
						'type'    => 'notice',
						'class'   => 'info',
						'content' => esc_html__( 'For adding or styling social icons go to Customize > Header > Social icons', 'xtra' ),
						'dependency' => array( 'element', '==', 'social' ),
					),

					// Image
					array(
						'id'    => 'image',
						'type'  => 'upload',
						'title' => esc_html__( 'Image', 'xtra' ),
            'preview'       => 1,
						'dependency' => array( 'element', '==', 'image' ),
						'attributes' => array(
							'style'		=> 'display: block'
						)
					),
					array(
						'id'    => 'image_width',
						'type'  => 'slider',
						'title' => esc_html__( 'Width', 'xtra' ),
						'options'	=> array( 'unit' => 'px', 'step' => 1, 'min' => 0, 'max' => 800 ),
						'dependency' => array( 'element', '==', 'image' ),
					),
					array(
						'id'    => 'image_link',
						'type'  => 'text',
						'title' => esc_html__( 'Link', 'xtra' ),
						'dependency' => array( 'element', '==', 'image' ),
					),

					// Icon & Text
					array(
						'id'    		=> 'it_text',
						'type'  		=> 'textarea',
						'title' 		=> esc_html__( 'Text', 'xtra' ),
						'help'  		=> esc_html__( 'Instead current year insert this variable %year%', 'xtra' ),
						'dependency' 	=> array( 'element', '==', 'icon' ),
					),
					array(
						'id' 			=> 'it_link',
						'type' 			=> 'text',
						'title' 		=> esc_html__( 'Link', 'xtra' ),
						'dependency' 	=> array( 'element', '==', 'icon' ),
					),
					array(
						'id' 			=> 'sk_it',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Text', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'font-family', 'font-size', 'font-weight', 'font-style', 'letter-spacing', 'line-height', 'color', 'background', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
						'dependency' 	=> array( 'element|it_text', '==|!=', 'icon|' )
					),
					array('id' => 'sk_it_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'sk_it_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array(
						'id'    => 'it_icon',
						'type'  => 'icon',
						'title' => esc_html__( 'Icon', 'xtra' ),
						'dependency' => array( 'element', '==', 'icon' ),
					),
					array(
						'id' 			=> 'sk_it_icon',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Icon', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'font-size', 'color', 'background', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
						'dependency' 	=> array( 'element|it_icon', '==|!=', 'icon|' )
					),
					array('id' => 'sk_it_icon_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'sk_it_icon_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),

					// Search
					array(
						'id' 	=> 'search_type',
						'type' 	=> 'select',
						'title' => esc_html__( 'Search type', 'xtra' ),
						'options' 	=> array(
							'form' 			=> esc_html__( 'Form', 'xtra' ),
							'form_2' 		=> esc_html__( 'Form', 'xtra' ) . ' 2',
							'icon_dropdown' => esc_html__( 'Dropdown', 'xtra' ),
							'icon_full' 	=> esc_html__( 'Full Screen', 'xtra' ),
							'icon_fullrow' 	=> esc_html__( 'Full Row', 'xtra' ),
						),
						'dependency' => array( 'element', '==', 'search' ),
					),
					array(
						'id' 		=> 'ajax_search',
						'type' 		=> 'switcher',
						'title'		=> esc_html__( 'Ajax Search ?', 'xtra' ),
						'dependency' => array( 'element', '==', 'search' ),
					),
					array(
						'id' 		=> 'search_cpt',
						'type' 		=> 'text',
						'title'		=> esc_html__( 'Ajax Post type(s)', 'xtra' ),
						'help'		=> 'e.g. post,portfolio,product',
						'dependency' => array( 'ajax_search|element', '!=|==', '|search' ),
					),
					array(
						'id'    => 'search_placeholder',
						'type'  => 'text',
						'title' => esc_html__( 'Placeholder / Title', 'xtra' ),
						'dependency' => array( 'element', '==', 'search' ),
					),
					array(
						'id' 			=> 'sk_search_title',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Search Title', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'font-family', 'font-size', 'font-weight', 'font-style', 'letter-spacing', 'line-height', 'color', 'background', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
						'dependency' 	=> array( 'element|search_type', '==|==', 'search|icon_full' )
					),
					array('id' => 'sk_search_title_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'sk_search_title_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array(
						'id'    => 'search_form_width',
						'type'  => 'slider',
						'title' => esc_html__( 'Form width', 'xtra' ),
						'options' => array( 'unit' => 'px', 'step' => 1, 'min' => 100, 'max' => 500 ),
						'dependency' => array( 'element|search_type', '==|any', 'search|form,form_2' ),
					),
					array(
						'id' 			=> 'sk_search_input',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Search Input', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'font-size', 'color', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'dependency' 	=> array( 'element', '==', 'search' )
					),
					array('id' => 'sk_search_input_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'sk_search_input_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array(
						'id' 			=> 'sk_search_con',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Search Container', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'dependency' 	=> array( 'element', '==', 'search' ),
					),
					array('id' => 'sk_search_con_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'sk_search_con_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array(
						'id' 			=> 'sk_search_ajax',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Ajax posts container', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'dependency' 	=> array( 'element', '==', 'search' ),
					),
					array('id' => 'sk_search_ajax_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'sk_search_ajax_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array(
						'id'    => 'search_icon',
						'type'  => 'icon',
						'title' => esc_html__( 'Icon', 'xtra' ),
						'dependency' => array( 'element|search_type', '==|any', 'search|icon_dropdown,icon_full,icon_fullrow' ),
					),
					array(
						'id' 			=> 'sk_search_icon',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Search Icon', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'font-size', 'color', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'dependency' 	=> array( 'element|search_type', '==|any', 'search|icon_dropdown,icon_full,icon_fullrow' ),
					),
					array('id' => 'sk_search_icon_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'sk_search_icon_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array(
						'id' 			=> 'sk_search_icon_in',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Search Inner Icon', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'font-size', 'color', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'dependency' 	=> array( 'element', '==', 'search' ),
					),
					array('id' => 'sk_search_icon_in_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'sk_search_icon_in_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),

					// Offcanvas
					array(
						'type'    => 'notice',
						'class'   => 'info',
						'content' => esc_html__( 'For adding or changing widgets inside offcanvas area, go to Appearance > Widgets > Offcanvas', 'xtra' ),
						'dependency' => array( 'element', '==', 'widgets' ),
					),
					array(
						'id' 	=> 'inview_position_widget',
						'type' 	=> 'select',
						'title' => esc_html__( 'Direction', 'xtra' ),
						'options' 	=> array(
							'inview_left' 	=> esc_html__( 'Left', 'xtra' ),
							'inview_right' => esc_html__( 'Right', 'xtra' ),
						),
						'dependency' => array( 'element', '==', 'widgets' ),
					),
					array(
						'id' 			=> 'sk_offcanvas',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Container', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'dependency' 	=> array( 'element', '==', 'widgets' )
					),
					array('id' => 'sk_offcanvas_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'sk_offcanvas_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array(
						'id'    => 'offcanvas_icon',
						'type'  => 'icon',
						'title' => esc_html__( 'Icon', 'xtra' ),
						'dependency' => array( 'element', '==', 'widgets' ),
					),
					array(
						'id' 			=> 'sk_offcanvas_icon',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Icon', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'font-size', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'dependency' 	=> array( 'element', '==', 'widgets' )
					),
					array('id' => 'sk_offcanvas_icon_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'sk_offcanvas_icon_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),

					// Hidden fullwidth content area
					array(
						'id' 			=> 'hf_elm_page',
						'type' 			=> 'select',
						'title'			=> esc_html__( 'Select', 'xtra' ),
						'options' 		=> Codevz::$array_pages,
						'after' 		=> '<a class="button" href="#" target="_blank" data-url="' . admin_url( '?cz_edit_page=' ) . '" style="margin-left: 2%;line-height: 27px;height: 30px;">' . esc_html__( 'Edit', 'xtra') . '</a>',
						'dependency' 	=> array( 'element', '==', 'hf_elm' ),
					),
					array(
						'id' 			=> 'sk_hf_elm',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Container', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'dependency' 	=> array( 'element', '==', 'hf_elm' )
					),
					array('id' => 'hf_elm_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'hf_elm_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array(
						'id'    => 'hf_elm_icon',
						'type'  => 'icon',
						'title' => esc_html__( 'Icon', 'xtra' ),
						'dependency' => array( 'element', '==', 'hf_elm' ),
					),
					array(
						'id' 			=> 'sk_hf_elm_icon',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Icon', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'font-size', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'dependency' 	=> array( 'element', '==', 'hf_elm' )
					),
					array('id' => 'sk_hf_elm_icon_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'sk_hf_elm_icon_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),

					// Shop
					array(
						'id' 	=> 'shopcart_type',
						'type' 	=> 'select',
						'title' => esc_html__( 'Type', 'xtra' ),
						'options' 	=> array(
							'cart_1' => '1',
							'cart_2' => '2',
						),
						'dependency' => array( 'element', '==', 'shop_cart' ),
					),
					array(
						'id' 			=> 'sk_shop_count',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Count', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'top', 'right', 'color', 'font-size', 'font-weight', 'font-style', 'background', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
						'dependency' 	=> array( 'element', '==', 'shop_cart' )
					),
					array('id' => 'sk_shop_count_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'sk_shop_count_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),

					array(
						'id'    => 'shopcart_icon',
						'type'  => 'icon',
						'title' => esc_html__( 'Icon', 'xtra' ),
						'dependency' => array( 'element', '==', 'shop_cart' ),
					),
					array(
						'id' 			=> 'sk_shop_icon',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Icon', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'font-size', 'font-weight', 'font-style', 'background', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
						'dependency' 	=> array( 'element', '==', 'shop_cart' )
					),
					array('id' => 'sk_shop_icon_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'sk_shop_icon_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array(
						'id' 			=> 'sk_shop_content',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Content', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'dependency' 	=> array( 'element', '==', 'shop_cart' )
					),
					array('id' => 'sk_shop_content_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'sk_shop_content_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),

					// Line
					array(
						'id' 	=> 'line_type',
						'type' 	=> 'select',
						'title' => esc_html__( 'Type', 'xtra' ),
						'options' 	=> array(
              'header_line_2'   => esc_html__( 'Default', 'xtra' ),
							'header_line_1' 	=> esc_html__( 'Full Height', 'xtra' ),
							'header_line_3' 	=> esc_html__( 'Slash', 'xtra' ),
							'header_line_4' 	=> esc_html__( 'Horizontal', 'xtra' ),
						),
						'dependency' => array( 'element', '==', 'line' ),
					),
					array(
						'id' 			=> 'sk_line',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Line', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'dependency' 	=> array( 'element', '==', 'line' )
					),
					array('id' => 'sk_line_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'sk_line_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),

					// Button options
					array(
						'type'    => 'notice',
						'class'   => 'info',
						'content' => esc_html__( 'If you want fully customized button(s), please check Help Center', 'xtra' ),
						'dependency' => array( 'element', '==', 'button' ),
					),
					array(
						'id'    => 'btn_title',
						'type'  => 'text',
						'title' => esc_html__( 'Title', 'xtra' ),
						'dependency' => array( 'element', '==', 'button' ),
					),
					array(
						'id'    => 'btn_link',
						'type'  => 'text',
						'title' => esc_html__( 'Link', 'xtra' ),
						'dependency' => array( 'element', '==', 'button' ),
					),
					array(
						'id' 			=> 'sk_btn',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Button', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'color', 'font-size', 'font-family', 'font-weight', 'font-style', 'line-height', 'background', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
						'dependency' 	=> array( 'element', '==', 'button' )
					),
					array('id' => 'sk_btn_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'sk_btn_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array(
						'id' 			=> 'sk_btn_hover',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Button Hover', 'xtra' ),
						'settings' 		=> array( 'color', 'font-size', 'font-weight', 'font-style', 'line-height', 'background', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
						'dependency' 	=> array( 'element', '==', 'button' )
					),
					array('id' => 'sk_btn_hover_tablet','type' => 'cz_sk_hidden'),
					array('id' => 'sk_btn_hover_mobile','type' => 'cz_sk_hidden'),

					// WPML
					array(
						'id' 	=> 'wpml_title',
						'type' 	=> 'select',
						'title' => esc_html__( 'Title', 'xtra' ),
						'options' 	=> array(
							'translated_name' 	=> esc_html__( 'Translated Name', 'xtra' ),
							'language_code' 	=> esc_html__( 'Language Code', 'xtra' ),
							'native_name' 		=> esc_html__( 'Native Name', 'xtra' ),
							'translated_name' 	=> esc_html__( 'Translated Name', 'xtra' ),
							'no_title' 			=> esc_html__( 'No Title', 'xtra' ),
						),
						'dependency' => array( 'element', '==', 'wpml' ),
					),
					array(
						'id'    => 'wpml_flag',
						'type'  => 'switcher',
						'title' => esc_html__( 'Flag ?', 'xtra' ),
						'dependency' => array( 'element|wpml_title', '==|!=', 'wpml|country_flag_url' ),
					),
					array(
						'id'    => 'wpml_color',
						'type'  => 'color_picker',
						'title' => esc_html__( 'Inner Color', 'xtra' ),
						'dependency' => array( 'element', '==', 'wpml' ),
					),
					array(
						'id'    => 'wpml_background',
						'type'  => 'color_picker',
						'title' => esc_html__( 'Background', 'xtra' ),
						'dependency' => array( 'element', '==', 'wpml' ),
					),

					// Custom Elements
					array(
						'type'    => 'notice',
						'class'   => 'info',
						'content' => esc_html__( 'You can add any element via page builder from Dashboard > Header Elements', 'xtra' ),
						'dependency' => array( 'element', '==', 'custom_element' ),
					),
					array(
						'id' 			=> 'header_elements',
						'type' 			=> 'select',
						'title'			=> esc_html__( 'Select', 'xtra' ),
						'options' 		=> Codevz::$array_pages,
						'after' 		=> '<a class="button" href="#" target="_blank" data-url="' . admin_url( '?cz_edit_page=' ) . '" style="margin-left: 2%;line-height: 27px;height: 30px;">' . esc_html__( 'Edit', 'xtra') . '</a>',
						'dependency' 	=> array( 'element', '==', 'custom_element' ),
					),

					// Custom
					array(
						'id'    => 'custom',
						'type'  => 'textarea',
						'title' => esc_html__( 'Custom Shortcode', 'xtra' ),
						'dependency' => array( 'element', '==', 'custom' ),
					),

					// Avatar
					array(
						'id'    => 'avatar_size',
						'type'  => 'slider',
						'title' => esc_html__( 'Size', 'xtra' ),
						'dependency' => array( 'element', '==', 'avatar' ),
						'default' => '40px'
					),
					array(
						'id' 			=> 'sk_avatar',
						'type' 			=> 'cz_sk',
						'button' 		=> esc_html__( 'Avatar', 'xtra' ),
						'setting_args' 	=> array( 'transport' => 'postMessage' ),
						'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
						'dependency' 	=> array( 'element', '==', 'avatar' )
					),
					array('id' => 'sk_avatar_tablet','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),
					array('id' => 'sk_avatar_mobile','type' => 'cz_sk_hidden','setting_args' => array( 'transport' => 'postMessage' )),

					array(
						'id'    => 'avatar_link',
						'type'  => 'text',
						'title' => esc_html__( 'Link', 'xtra' ),
						'dependency' => array( 'element', '==', 'avatar' ),
					),

					// Others
					array(
						'id' 		=> 'vertical',
						'type' 		=> 'switcher',
						'title'		=> esc_html__( 'Vertical ?', 'xtra' ),
						'dependency' => $is_fixed_side ? array( 'element', 'any', 'social,icon' ) : array( 'element', '==', 'xxx' )
					),
					array(
						'id' 	=> 'elm_on_sticky',
						'type' 	=> 'select',
						'title' => esc_html__( 'Visibility on Sticky', 'xtra' ),
						'help'  => esc_html__( 'You can enable sticky mode from Customize > Header > Sticky Header', 'xtra' ),
						'options' 	=> array(
							'' 					=> esc_html__( 'Default', 'xtra' ),
							'show_on_sticky' 	=> esc_html__( 'Show on Sticky ?', 'xtra' ),
							'hide_on_sticky' 	=> esc_html__( 'Hide on Sticky ?', 'xtra' ),
						),
						'dependency' => $is_1_2_3 ? array( 'element', '!=', '' ) : array( 'element', '==', 'xxx' )
					),
					array(
						'id' 		=> 'elm_center',
						'type' 		=> 'switcher',
						'title'		=> esc_html__( 'Center ?', 'xtra' ),
						'dependency' => $is_fixed_side ? array( 'element', '!=', '' ) : array( 'element', '==', 'xxx' )
					),
					array(
						'id' 		=> 'hide_on_mobile',
						'type' 		=> 'switcher',
						'title'		=> esc_html__( 'Hide on mobile ?', 'xtra' ),
						'dependency' => $is_footer ? array( 'element', '!=', '' ) : array( 'element', '==', 'xxx' )
					),
					array(
						'id' 		=> 'hide_on_tablet',
						'type' 		=> 'switcher',
						'title'		=> esc_html__( 'Hide on tablet ?', 'xtra' ),
						'dependency' => $is_footer ? array( 'element', '!=', '' ) : array( 'element', '==', 'xxx' )
					),
					//array(
					//	'id' 		=> 'show_for_logged_in_users',
					//	'type' 		=> 'switcher',
					//	'title'		=> esc_html__( 'Show only for logged-in users ?', 'xtra' ),
					//	'dependency' => array( 'element', '!=', '' )
					//),
					//array(
					//	'id' 		=> 'class',
					//	'type' 		=> 'text',
					//	'title'		=> esc_html__( 'Extra Class', 'xtra' ),
					//	'help'		=> esc_html__( 'You can add any custom class to this element', 'xtra' ),
					//	'dependency' => array( 'element', '!=', '' )
					//),
					array(
						'id'        => 'margin',
						'type'      => 'codevz_sizes',
						'title'     => esc_html__( 'Margin', 'xtra' ),
						'options'	=> array( 'unit' => 'px', 'step' => 1, 'min' => -20, 'max' => 100 ),
						'default'	=> array(
							'top' 		=> '30px',
							'right' 	=> '',
							'bottom' 	=> '',
							'left' 		=> '',
						),
						'help'		=> self::help('margin'),
						'dependency' => array( 'element', '!=', '' )
					),

				)
			);
		}

		/**
		 *
		 * Header row builder options
		 * 
		 * @return array
		 *
		 */
		public static function row_options( $id, $positions = array('left', 'center', 'right') ) {

			$elm = '.' . $id;
			$out = array();

			// If is sticky so show dropdown option and create dependency
			if ( $id === 'header_5' ) {
				$elm = '.onSticky';
				$dependency = array( 'sticky_header', '==', '5' );
				
				$out[] = array(
					'id' 		=> 'sticky_header',
					'type' 		=> 'select',
					'title' 	=> esc_html__( 'Sticky Header', 'xtra' ),
					'options' 	=> array(
            ''			=> esc_html__( 'Off', 'xtra' ),
            '1'			=> esc_html__( 'Top of Header', 'xtra' ),
            '2'			=> esc_html__( 'Header', 'xtra' ),
            '3'     => esc_html__( 'Bottom of Header', 'xtra' ),
            '12'    => esc_html__( 'Top of Header + Header', 'xtra' ),
            '23'    => esc_html__( 'Header + Bottom of Header', 'xtra' ),
            '13'    => esc_html__( 'Top of Header + Bottom of Header', 'xtra' ),
            '123'	  => esc_html__( 'All Header rows Sticky', 'xtra' ),
						'5'			=> esc_html__( 'Custom Sticky', 'xtra' ),
					)
				);
				$out[] = array(
					'id' 		=> 'smart_sticky',
					'type' 		=> 'switcher',
					'title' 	=> esc_html__( 'Smart Sticky ?', 'xtra' ),
					'dependency' => array( 'sticky_header', '!=', 'false' )
				);
			} else {
				$dependency = array( 'row_type_' . $id, '!=', 'page' );
			}

			// Fixed position before elements
			if ( $id === 'fixed_side_1' ) {
				$out[] = array(
					'id' 		=> 'fixed_side',
					'type' 		=> 'select',
					'title' 	=> esc_html__( 'Position ?', 'xtra' ),
					'options' 	=> array(
						''		=> esc_html__( 'Off', 'xtra' ),
						'left'	=> esc_html__( 'Left', 'xtra' ),
						'right'	=> esc_html__( 'Right', 'xtra' ),
					)
				);
				$dependency = array( 'row_type_' . $id . '|fixed_side', '!=|any', 'page|left,right' );
			}

			if ( $id !== 'header_5' ) {
				$out[] = array(
					'id' 		=> 'row_type_' . $id,
					'type' 		=> 'select',
					'title' 	=> esc_html__( 'Row type', 'xtra' ),
					'options' 	=> array(
						null		=> esc_html__( 'Create new row', 'xtra' ),
						'page'		=> esc_html__( 'Use custom page as row', 'xtra' )
					)
				);
				$out[] = array(
					'id'            => 'page_as_row_' . $id,
					'type'          => 'select',
					'title'         => esc_html__( 'Select page as row', 'xtra' ),
					'options'       => Codevz::$array_pages,
					'dependency' 	=> array( 'row_type_' . $id, '==', 'page' )
				);
			}

			// Tablet/Mobile header
			if ( $id === 'header_4' ) {
        $out[] = array(
          'id'    => 'mobile_header',
          'type'    => 'select',
          'title'   => esc_html__( 'Start showing at', 'xtra' ),
          'options'   => array(
            ''      => esc_html__( 'Default', 'xtra' ),
            'lt'    => esc_html__( 'Landscape Tablet', 'xtra' ),
            'pt'    => esc_html__( 'Portrait Tablet', 'xtra' ),
            'mm'    => esc_html__( 'Mobile', 'xtra' ),
          )
        );
				$out[] = array(
					'id' 		=> 'mobile_sticky',
					'type' 		=> 'select',
					'title' 	=> esc_html__( 'Sticky ?', 'xtra' ),
					'options' 	=> array(
						''								=> esc_html__( 'Select', 'xtra' ),
						'header_is_sticky'				=> esc_html__( 'Sticky', 'xtra' ),
						'header_is_sticky smart_sticky'	=> esc_html__( 'Smart Sticky', 'xtra' ),
					)
				);
			}

			// Left center right elements and style
			foreach ( $positions as $num => $pos ) {
				$num++;
				$out[] = self::elements( $id . '_' . $pos, '', $dependency, $pos );
			}

      // Before after mobile header
      if ( $id === 'header_4' ) {
        $out[] = array(
          'id'            => 'b_mobile_header',
          'type'          => 'select',
          'title'         => esc_html__( 'Assing page content before header', 'xtra' ),
          'options'       => Codevz::$array_pages
        );
        $out[] = array(
          'id'            => 'a_mobile_header',
          'type'          => 'select',
          'title'         => esc_html__( 'Assing page content after header', 'xtra' ),
          'options'       => Codevz::$array_pages
        );
      }

			// If its fixed header so show dropdown option
			$out[] = array(
				'type'    => 'notice',
				'class'   => 'info',
				'content' => esc_html__( 'Styles', 'xtra' ) . self::$sk_advanced,
				'dependency' => $dependency
			);
			if ( $id === 'fixed_side_1' ) {
				$out[] = array(
					'id' 			=> '_css_fixed_side_style',
					'type' 			=> 'cz_sk',
					'button' 		=> esc_html__( 'Container', 'xtra' ),
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'settings' 		=> array( 'background', 'width', 'height', 'font-size', 'padding', 'border', 'box-shadow' ),
					'selector' 		=> '.fixed_side, .fixed_side .theiaStickySidebar'
				);
				$out[] = array(
					'id' 			=> '_css_fixed_side_style_tablet',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> '.fixed_side, .fixed_side .theiaStickySidebar'
				);
				$out[] = array(
					'id' 			=> '_css_fixed_side_style_mobile',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> '.fixed_side, .fixed_side .theiaStickySidebar'
				);
			} else {
				$f_dependency = ( $id === 'header_5' ) ? array( 'sticky_header', '!=', '' ) : array( 'row_type_' . $id, '!=', 'page' );
				$out[] = array(
					'id' 			=> '_css_container_' . $id,
					'type' 			=> 'cz_sk',
					'button' 		=> esc_html__( 'Row Container', 'xtra' ),
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
					'selector' 		=> $elm,
					'dependency' 	=> $f_dependency
				);
				$out[] = array(
					'id' 			=> '_css_container_' . $id . '_tablet',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $elm,
				);
				$out[] = array(
					'id' 			=> '_css_container_' . $id . '_mobile',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $elm,
				);
				$out[] = array(
					'id' 			=> '_css_row_' . $id,
					'type' 			=> 'cz_sk',
					'button' 		=> esc_html__( 'Row Inner', 'xtra' ),
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'settings' 		=> array( 'color', 'background', '_class_shape', 'width', 'padding', 'margin', 'border', 'box-shadow' ),
					'selector' 		=> $elm . ' .row',
					'dependency' 	=> $f_dependency
				);
				$out[] = array(
					'id' 			=> '_css_row_' . $id . '_tablet',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $elm . ' .row',
				);
				$out[] = array(
					'id' 			=> '_css_row_' . $id . '_mobile',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $elm . ' .row',
				);
			}

			// Left center right elements and style
			foreach ( $positions as $num => $pos ) {
				$num++;
				$out[] = array(
					'id' 			=> '_css_' . $id . '_' . $pos,
					'type' 			=> 'cz_sk',
					'button' 		=> ucfirst( $pos ),
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'settings' 		=> array( 'color', 'background', '_class_shape', 'padding', 'margin', 'border', 'box-shadow' ),
					'selector' 		=> $elm . ' .elms_' . $pos,
					'dependency' 	=> $dependency
				);
				$out[] = array(
					'id' 			=> '_css_' . $id . '_' . $pos . '_tablet',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $elm . ' .elms_' . $pos,
				);
				$out[] = array(
					'id' 			=> '_css_' . $id . '_' . $pos . '_mobile',
					'type' 			=> 'cz_sk_hidden',
					'setting_args' 	=> array( 'transport' => 'postMessage' ),
					'selector' 		=> $elm . ' .elms_' . $pos,
				);
			}

			// Menus style for each row
			$menu_unique_id = '#menu_' . $id;
			$out[] = array(
				'type' 			=> 'notice',
				'class' 		=> 'info',
				'content' 		=> esc_html__( 'Menu Styles of this Row', 'xtra' ),
				'dependency' 	=> $dependency
			);
			$out[] = array(
				'id' 			=> '_css_menu_container_' . $id,
				'type' 			=> 'cz_sk',
				'button' 		=> esc_html__( 'Menu Container', 'xtra' ),
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'settings' 		=> array( 'background', 'padding', 'margin', 'border', 'box-shadow' ),
				'selector' 		=> $menu_unique_id,
				'dependency' 	=> $dependency
			);
			$out[] = array(
				'id' 			=> '_css_menu_container_' . $id . '_tablet',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id,
			);
			$out[] = array(
				'id' 			=> '_css_menu_container_' . $id . '_mobile',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id,
			);
			$out[] = array(
				'id' 			=> '_css_menu_li_' . $id,
				'type' 			=> 'cz_sk',
				'button' 		=> esc_html__( 'Each Menu Parent', 'xtra' ),
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'settings' 		=> array( 'float', 'text-align', 'padding', 'margin', 'border' ),
				'selector' 		=> $menu_unique_id . ' > .cz',
				'dependency' 	=> $dependency
			);
			$out[] = array(
				'id' 			=> '_css_menu_li_' . $id . '_tablet',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' > .cz',
			);
			$out[] = array(
				'id' 			=> '_css_menu_li_' . $id . '_mobile',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' > .cz',
			);
			$out[] = array(
				'id' 			=> '_css_menu_a_' . $id,
				'type' 			=> 'cz_sk',
				'button' 		=> esc_html__( 'Menu Links', 'xtra' ),
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'settings' 		=> array( 'color', 'background', 'rotate', 'font-family', 'font-size', 'font-weight', 'font-style', 'text-transform', 'letter-spacing', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
				'selector' 		=> $menu_unique_id . ' > .cz > a',
				'dependency' 	=> $dependency
			);
			$out[] = array(
				'id' 			=> '_css_menu_a_' . $id . '_tablet',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' > .cz > a',
			);
			$out[] = array(
				'id' 			=> '_css_menu_a_' . $id . '_mobile',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' > .cz > a',
			);
			$out[] = array(
				'id' 			=> '_css_menu_a_hover_' . $id,
				'type' 			=> 'cz_sk',
				'button' 		=> esc_html__( 'Menu Links :Hover', 'xtra' ),
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'settings' 		=> array( 'color', 'background', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'border', 'box-shadow', 'text-shadow' ),
				'selector' 		=> $menu_unique_id . ' > .cz > a:hover,' . $menu_unique_id . ' > .cz:hover > a,' . $menu_unique_id . ' > .current_menu > a,' . $menu_unique_id . ' > .current-menu-parent > a',
				'dependency' 	=> $dependency
			);
			$out[] = array(
				'id' 			=> '_css_menu_a_hover_' . $id . '_tablet',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' > .cz > a:hover,' . $menu_unique_id . ' > .cz:hover > a,' . $menu_unique_id . ' > .current_menu > a,' . $menu_unique_id . ' > .current-menu-parent > a',
			);
			$out[] = array(
				'id' 			=> '_css_menu_a_hover_' . $id . '_mobile',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' > .cz > a:hover,' . $menu_unique_id . ' > .cz:hover > a,' . $menu_unique_id . ' > .current_menu > a,' . $menu_unique_id . ' > .current-menu-parent > a',
			);
			$out[] = array(
				'id' 			=> '_css_menu_a_hover_before_' . $id,
				'type' 			=> 'cz_sk',
				'button' 		=> esc_html__( 'Hover Shape', 'xtra' ),
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'settings' 		=> array( '_class_menu_fx', 'background', 'height', 'width', 'left', 'bottom', 'padding', 'border', 'box-shadow' ),
				'selector' 		=> $menu_unique_id . ' > .cz > a:before',
				'dependency' 	=> $dependency
			);
			$out[] = array(
				'id' 			=> '_css_menu_a_hover_before_' . $id . '_tablet',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' > .cz > a:before',
			);
			$out[] = array(
				'id' 			=> '_css_menu_a_hover_before_' . $id . '_mobile',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' > .cz > a:before',
			);
			$out[] = array(
				'id' 			=> '_css_menu_indicator_a_' . $id,
				'type' 			=> 'cz_sk',
				'button' 		=> esc_html__( 'Menu Indicator', 'xtra' ),
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'settings' 		=> array( 'color', 'background', 'rotate', 'font-size', '_class_indicator', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
				'selector' 		=> $menu_unique_id . ' > .cz > a .cz_indicator',
				'dependency' 	=> $dependency
			);
			$out[] = array(
				'id' 			=> '_css_menu_a_indicator_' . $id . '_tablet',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' > .cz > a .cz_indicator',
			);
			$out[] = array(
				'id' 			=> '_css_menu_a_indicator_' . $id . '_mobile',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' > .cz > a .cz_indicator',
			);
			$out[] = array(
				'id' 			=> '_css_menus_separator_' . $id,
				'type' 			=> 'cz_sk',
				'button' 		=> esc_html__( 'Menu Separator', 'xtra' ),
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'settings' 		=> array( 'content', 'rotate', 'color', 'font-size', 'margin' ),
				'selector' 		=> $menu_unique_id . ' > .cz:after',
				'dependency' 	=> $dependency
			);
			$out[] = array(
				'id' 			=> '_css_menus_separator_' . $id . '_tablet',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' > .cz:after',
			);
			$out[] = array(
				'id' 			=> '_css_menus_separator_' . $id . '_mobile',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' > .cz:after',
			);
			$out[] = array(
				'id' 			=> '_css_menu_ul_' . $id,
				'type' 			=> 'cz_sk',
				'button' 		=> esc_html__( 'Dropdown Menu', 'xtra' ),
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'settings' 		=> array( 'width', 'background', 'padding', 'margin', 'border', 'box-shadow' ),
				'selector' 		=> $menu_unique_id . ' .cz .sub-menu:not(.cz_megamenu_inner_ul)',
				'dependency' 	=> $dependency
			);
			$out[] = array(
				'id' 			=> '_css_menu_ul_' . $id . '_tablet',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' .cz .sub-menu:not(.cz_megamenu_inner_ul)',
			);
			$out[] = array(
				'id' 			=> '_css_menu_ul_' . $id . '_mobile',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' .cz .sub-menu:not(.cz_megamenu_inner_ul)',
			);
			$out[] = array(
				'id' 			=> '_css_menu_ul_a_' . $id,
				'type' 			=> 'cz_sk',
				'button' 		=> esc_html__( 'Dropdown Links', 'xtra' ),
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'settings' 		=> array( 'color', 'background', 'font-family', 'text-align', 'font-size', 'font-weight', 'font-style', 'text-transform', 'letter-spacing', 'padding', 'margin', 'border' ),
				'selector' 		=> $menu_unique_id . ' .cz .cz a,' . $menu_unique_id . ' .cz .cz h6',
				'dependency' 	=> $dependency
			);
			$out[] = array(
				'id' 			=> '_css_menu_ul_a_' . $id . '_tablet',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' .cz .cz a,' . $menu_unique_id . ' .cz .cz h6',
			);
			$out[] = array(
				'id' 			=> '_css_menu_ul_a_' . $id . '_mobile',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' .cz .cz a,' . $menu_unique_id . ' .cz .cz h6',
			);
			$out[] = array(
				'id' 			=> '_css_menu_ul_a_hover_' . $id,
				'type' 			=> 'cz_sk',
				'button' 		=> esc_html__( 'Dropdown Links :Hover', 'xtra' ),
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'settings' 		=> array( 'color', 'background', 'font-weight', 'font-style', 'letter-spacing', 'padding', 'border' ),
				'selector' 		=> $menu_unique_id . ' .cz .cz a:hover,' . $menu_unique_id . ' .cz .cz:hover > a,' . $menu_unique_id . ' .cz .current_menu > a,' . $menu_unique_id . ' .cz .current_menu > .current_menu',
				'dependency' 	=> $dependency
			);
			$out[] = array(
				'id' 			=> '_css_menu_ul_a_hover_' . $id . '_tablet',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' .cz .cz a:hover,' . $menu_unique_id . ' .cz .cz:hover > a,' . $menu_unique_id . ' .cz .current_menu > a,' . $menu_unique_id . ' .cz .current_menu > .current_menu',
			);
			$out[] = array(
				'id' 			=> '_css_menu_ul_a_hover_' . $id . '_mobile',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' .cz .cz a:hover,' . $menu_unique_id . ' .cz .cz:hover > a,' . $menu_unique_id . ' .cz .current_menu > a,' . $menu_unique_id . ' .cz .current_menu > .current_menu',
			);
			$out[] = array(
				'id' 			=> '_css_menu_ul_indicator_a_' . $id,
				'type' 			=> 'cz_sk',
				'button' 		=> esc_html__( 'Dropdown Menu Indicator', 'xtra' ),
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'settings' 		=> array( 'color', 'background', 'rotate', 'font-size', '_class_indicator', 'padding', 'margin', 'border', 'box-shadow', 'text-shadow' ),
				'selector' 		=> $menu_unique_id . ' .cz .cz a .cz_indicator',
				'dependency' 	=> $dependency
			);
			$out[] = array(
				'id' 			=> '_css_menu_ul_indicator_a_' . $id . '_tablet',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' .cz .cz a .cz_indicator',
			);
			$out[] = array(
				'id' 			=> '_css_menu_ul_indicator_a_' . $id . '_mobile',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' .cz .cz a .cz_indicator',
			);
			$out[] = array(
				'id' 			=> '_css_menu_ul_ul_' . $id,
				'type' 			=> 'cz_sk',
				'button' 		=> esc_html__( '3rd Level Dropdown', 'xtra' ),
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'settings' 		=> array( 'margin', 'padding', 'background', 'border', 'box-shadow' ),
				'selector' 		=> $menu_unique_id . ' .sub-menu .sub-menu:not(.cz_megamenu_inner_ul)',
				'dependency' 	=> $dependency
			);
			$out[] = array(
				'id' 			=> '_css_menu_ul_ul_' . $id . '_tablet',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' .sub-menu .sub-menu:not(.cz_megamenu_inner_ul)',
			);
			$out[] = array(
				'id' 			=> '_css_menu_ul_ul_' . $id . '_mobile',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' .sub-menu .sub-menu:not(.cz_megamenu_inner_ul)',
			);
			$out[] = array(
				'id' 			=> '_css_menu_inner_megamenu_' . $id,
				'type' 			=> 'cz_sk',
				'button' 		=> esc_html__( 'Megamenu Inner Dropdowns', 'xtra' ),
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'settings' 		=> array( 'margin', 'padding', 'background', 'border', 'box-shadow' ),
				'selector' 		=> $menu_unique_id . ' .cz_parent_megamenu > [class^="cz_megamenu_"] > .cz, .cz_parent_megamenu > [class*=" cz_megamenu_"] > .cz',
				'dependency' 	=> $dependency
			);
			$out[] = array(
				'id' 			=> '_css_menu_inner_megamenu_' . $id . '_tablet',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' .cz_parent_megamenu > [class^="cz_megamenu_"] > .cz, .cz_parent_megamenu > [class*=" cz_megamenu_"] > .cz',
			);
			$out[] = array(
				'id' 			=> '_css_menu_inner_megamenu_' . $id . '_mobile',
				'type' 			=> 'cz_sk_hidden',
				'setting_args' 	=> array( 'transport' => 'postMessage' ),
				'selector' 		=> $menu_unique_id . ' .cz_parent_megamenu > [class^="cz_megamenu_"] > .cz, .cz_parent_megamenu > [class*=" cz_megamenu_"] > .cz',
			);

			return $out;
		}

		/**
		 *
		 * Generate json of options for customize footer and live changes
		 * 
		 * @return string
		 *
		 */
		public static function codevz_wp_footer_options_json() {
			$out = array();

			foreach ( Codevz::option() as $id => $val ) {
				if ( ! empty( $val ) && Codevz::contains( $id, '_css_' ) ) {
					$out[ $id ] = $val;
				}
			}

			wp_add_inline_script( 'codevz-customize', 'var codevz_selectors = ' . json_encode( (array) self::get_selector( 'all' ) ) . ', codevz_customize_json = ' . json_encode( $out ) . ';', 'before' );
		}

		/**
		 *
		 * Get sidebars
		 * 
		 * @return string
		 *
		 */
		public static function sidebars() {
			$options = array( '' => esc_html__( 'Default', 'xtra' ) );
			$sidebars = (array) get_option( 'sidebars_widgets' );
			foreach ( $sidebars as $i => $w ) {
				if ( isset( $i ) && ( $i !== 'array_version' && $i !== 'jr-insta-shortcodes' && $i !== 'wp_inactive_widgets' ) ) {
					$options[ $i ] = ucwords( $i );
				}
			}

			return $options;
		}

		/**
		 *
		 * Get list of Revolution Sliders
		 * 
		 * @return string
		 *
		 */
		public static function revSlider( $o = array() ) {
			if ( class_exists( 'RevSliderAdmin' ) ) {
				$s  = new RevSlider();
				$o = array();
				foreach ( (array) $s->getAllSliderAliases() as $id => $s ) {
					if ( ! empty( $s ) ) {
						$o[ $s ] = $s;
					}
				}
				if ( empty( $o ) ) {
					$o = array( esc_html__('No sliders found, Please create new from Revolution Slider menu', 'xtra') );
				}
			} else {
				$o = array( esc_html__('Sorry! Revolution Slider is not installed or activated', 'xtra') );
			}

			return $o;
		}

		/**
		 *
		 * Get list of Master Sliders
		 * 
		 * @return string
		 *
		 */
		public static function masterSlider( $o = array() ) {
			if ( class_exists( 'Master_Slider' ) ) {
				global $mspdb;
				if ( $ms = $mspdb->get_sliders_list( $limit = 0, $offset  = 0, $orderby = 'ID', $sort = 'ASC' ) ) {
					foreach ( $ms as $slider ) {
						$options[ $slider['ID'] ] = esc_attr( $slider['title'] );
					}
				} else {
					$options = array( __( 'No sliders found, Please create new from MasterSlider menu', 'xtra' ) );
				}
			} else {
				$options = array( __( 'Sorry! MasterSlider is not installed or activated', 'xtra' ) );
			}

			return $options;
		}

    /**
     *
     * Reset all header settings
     * 
     * @return -
     *
     */
    public static function reset_header( $c = 0 ) {
      $required = array(
        'social_hover_fx' => '',
        'social_color_mode' => '',
        'social_inline_title' => '',
        'social_tooltip' => '',
        '_css_social' => '',
        '_css_social_tablet' => '',
        '_css_social_mobile' => '',
        '_css_social_a' => '',
        '_css_social_a_tablet' => '',
        '_css_social_a_mobile' => '',
        '_css_social_a_hover' => '',
        '_css_social_a_hover_tablet' => '',
        '_css_social_a_hover_mobile' => '',
        '_css_social_inline_titles' => '',
        '_css_social_inline_titles_tablet' => '',
        '_css_social_inline_titles_mobile' => '',
        '_css_social_tooltip' => '',
        '_css_social_tooltip_tablet' => '',
        '_css_social_tooltip_mobile' => '',
        'row_type_header_1' => '',
        'page_as_row_header_1' => '',
        'header_1_left' => '',
        'header_1_center' => '',
        'header_1_right' => '',
        '_css_container_header_1' => '',
        '_css_container_header_1_tablet' => '',
        '_css_container_header_1_mobile' => '',
        '_css_row_header_1' => '',
        '_css_row_header_1_tablet' => '',
        '_css_row_header_1_mobile' => '',
        '_css_header_1_left' => '',
        '_css_header_1_left_tablet' => '',
        '_css_header_1_left_mobile' => '',
        '_css_header_1_center' => '',
        '_css_header_1_center_tablet' => '',
        '_css_header_1_center_mobile' => '',
        '_css_header_1_right' => '',
        '_css_header_1_right_tablet' => '',
        '_css_header_1_right_mobile' => '',
        '_css_menu_container_header_1' => '',
        '_css_menu_container_header_1_tablet' => '',
        '_css_menu_container_header_1_mobile' => '',
        '_css_menu_li_header_1' => '',
        '_css_menu_li_header_1_tablet' => '',
        '_css_menu_li_header_1_mobile' => '',
        '_css_menu_a_header_1' => '',
        '_css_menu_a_header_1_tablet' => '',
        '_css_menu_a_header_1_mobile' => '',
        '_css_menu_a_hover_header_1' => '',
        '_css_menu_a_hover_header_1_tablet' => '',
        '_css_menu_a_hover_header_1_mobile' => '',
        '_css_menu_a_hover_before_header_1' => '',
        '_css_menu_a_hover_before_header_1_tablet' => '',
        '_css_menu_a_hover_before_header_1_mobile' => '',
        '_css_menu_indicator_a_header_1' => '',
        '_css_menu_a_indicator_header_1_tablet' => '',
        '_css_menu_a_indicator_header_1_mobile' => '',
        '_css_menus_separator_header_1' => '',
        '_css_menus_separator_header_1_tablet' => '',
        '_css_menus_separator_header_1_mobile' => '',
        '_css_menu_ul_header_1' => '',
        '_css_menu_ul_header_1_tablet' => '',
        '_css_menu_ul_header_1_mobile' => '',
        '_css_menu_ul_a_header_1' => '',
        '_css_menu_ul_a_header_1_tablet' => '',
        '_css_menu_ul_a_header_1_mobile' => '',
        '_css_menu_ul_a_hover_header_1' => '',
        '_css_menu_ul_a_hover_header_1_tablet' => '',
        '_css_menu_ul_a_hover_header_1_mobile' => '',
        '_css_menu_ul_indicator_a_header_1' => '',
        '_css_menu_ul_indicator_a_header_1_tablet' => '',
        '_css_menu_ul_indicator_a_header_1_mobile' => '',
        '_css_menu_ul_ul_header_1' => '',
        '_css_menu_ul_ul_header_1_tablet' => '',
        '_css_menu_ul_ul_header_1_mobile' => '',
        '_css_menu_inner_megamenu_header_1' => '',
        '_css_menu_inner_megamenu_header_1_tablet' => '',
        '_css_menu_inner_megamenu_header_1_mobile' => '',
        'row_type_header_2' => '',
        'page_as_row_header_2' => '',
        'header_2_left' => '',
        'header_2_center' => '',
        'header_2_right' => '',
        '_css_container_header_2' => '',
        '_css_container_header_2_tablet' => '',
        '_css_container_header_2_mobile' => '',
        '_css_row_header_2' => '',
        '_css_row_header_2_tablet' => '',
        '_css_row_header_2_mobile' => '',
        '_css_header_2_left' => '',
        '_css_header_2_left_tablet' => '',
        '_css_header_2_left_mobile' => '',
        '_css_header_2_center' => '',
        '_css_header_2_center_tablet' => '',
        '_css_header_2_center_mobile' => '',
        '_css_header_2_right' => '',
        '_css_header_2_right_tablet' => '',
        '_css_header_2_right_mobile' => '',
        '_css_menu_container_header_2' => '',
        '_css_menu_container_header_2_tablet' => '',
        '_css_menu_container_header_2_mobile' => '',
        '_css_menu_li_header_2' => '',
        '_css_menu_li_header_2_tablet' => '',
        '_css_menu_li_header_2_mobile' => '',
        '_css_menu_a_header_2' => '',
        '_css_menu_a_header_2_tablet' => '',
        '_css_menu_a_header_2_mobile' => '',
        '_css_menu_a_hover_header_2' => '',
        '_css_menu_a_hover_header_2_tablet' => '',
        '_css_menu_a_hover_header_2_mobile' => '',
        '_css_menu_a_hover_before_header_2' => '',
        '_css_menu_a_hover_before_header_2_tablet' => '',
        '_css_menu_a_hover_before_header_2_mobile' => '',
        '_css_menu_indicator_a_header_2' => '',
        '_css_menu_a_indicator_header_2_tablet' => '',
        '_css_menu_a_indicator_header_2_mobile' => '',
        '_css_menus_separator_header_2' => '',
        '_css_menus_separator_header_2_tablet' => '',
        '_css_menus_separator_header_2_mobile' => '',
        '_css_menu_ul_header_2' => '',
        '_css_menu_ul_header_2_tablet' => '',
        '_css_menu_ul_header_2_mobile' => '',
        '_css_menu_ul_a_header_2' => '',
        '_css_menu_ul_a_header_2_tablet' => '',
        '_css_menu_ul_a_header_2_mobile' => '',
        '_css_menu_ul_a_hover_header_2' => '',
        '_css_menu_ul_a_hover_header_2_tablet' => '',
        '_css_menu_ul_a_hover_header_2_mobile' => '',
        '_css_menu_ul_indicator_a_header_2' => '',
        '_css_menu_ul_indicator_a_header_2_tablet' => '',
        '_css_menu_ul_indicator_a_header_2_mobile' => '',
        '_css_menu_ul_ul_header_2' => '',
        '_css_menu_ul_ul_header_2_tablet' => '',
        '_css_menu_ul_ul_header_2_mobile' => '',
        '_css_menu_inner_megamenu_header_2' => '',
        '_css_menu_inner_megamenu_header_2_tablet' => '',
        '_css_menu_inner_megamenu_header_2_mobile' => '',
        'row_type_header_3' => '',
        'page_as_row_header_3' => '',
        'header_3_left' => '',
        'header_3_center' => '',
        'header_3_right' => '',
        '_css_container_header_3' => '',
        '_css_container_header_3_tablet' => '',
        '_css_container_header_3_mobile' => '',
        '_css_row_header_3' => '',
        '_css_row_header_3_tablet' => '',
        '_css_row_header_3_mobile' => '',
        '_css_header_3_left' => '',
        '_css_header_3_left_tablet' => '',
        '_css_header_3_left_mobile' => '',
        '_css_header_3_center' => '',
        '_css_header_3_center_tablet' => '',
        '_css_header_3_center_mobile' => '',
        '_css_header_3_right' => '',
        '_css_header_3_right_tablet' => '',
        '_css_header_3_right_mobile' => '',
        '_css_menu_container_header_3' => '',
        '_css_menu_container_header_3_tablet' => '',
        '_css_menu_container_header_3_mobile' => '',
        '_css_menu_li_header_3' => '',
        '_css_menu_li_header_3_tablet' => '',
        '_css_menu_li_header_3_mobile' => '',
        '_css_menu_a_header_3' => '',
        '_css_menu_a_header_3_tablet' => '',
        '_css_menu_a_header_3_mobile' => '',
        '_css_menu_a_hover_header_3' => '',
        '_css_menu_a_hover_header_3_tablet' => '',
        '_css_menu_a_hover_header_3_mobile' => '',
        '_css_menu_a_hover_before_header_3' => '',
        '_css_menu_a_hover_before_header_3_tablet' => '',
        '_css_menu_a_hover_before_header_3_mobile' => '',
        '_css_menu_indicator_a_header_3' => '',
        '_css_menu_a_indicator_header_3_tablet' => '',
        '_css_menu_a_indicator_header_3_mobile' => '',
        '_css_menus_separator_header_3' => '',
        '_css_menus_separator_header_3_tablet' => '',
        '_css_menus_separator_header_3_mobile' => '',
        '_css_menu_ul_header_3' => '',
        '_css_menu_ul_header_3_tablet' => '',
        '_css_menu_ul_header_3_mobile' => '',
        '_css_menu_ul_a_header_3' => '',
        '_css_menu_ul_a_header_3_tablet' => '',
        '_css_menu_ul_a_header_3_mobile' => '',
        '_css_menu_ul_a_hover_header_3' => '',
        '_css_menu_ul_a_hover_header_3_tablet' => '',
        '_css_menu_ul_a_hover_header_3_mobile' => '',
        '_css_menu_ul_indicator_a_header_3' => '',
        '_css_menu_ul_indicator_a_header_3_tablet' => '',
        '_css_menu_ul_indicator_a_header_3_mobile' => '',
        '_css_menu_ul_ul_header_3' => '',
        '_css_menu_ul_ul_header_3_tablet' => '',
        '_css_menu_ul_ul_header_3_mobile' => '',
        '_css_menu_inner_megamenu_header_3' => '',
        '_css_menu_inner_megamenu_header_3_tablet' => '',
        '_css_menu_inner_megamenu_header_3_mobile' => '',
        'sticky_header' => '',
        'smart_sticky' => '',
        'header_5_left' => '',
        'header_5_center' => '',
        'header_5_right' => '',
        '_css_container_header_5' => '',
        '_css_container_header_5_tablet' => '',
        '_css_container_header_5_mobile' => '',
        '_css_row_header_5' => '',
        '_css_row_header_5_tablet' => '',
        '_css_row_header_5_mobile' => '',
        '_css_header_5_left' => '',
        '_css_header_5_left_tablet' => '',
        '_css_header_5_left_mobile' => '',
        '_css_header_5_center' => '',
        '_css_header_5_center_tablet' => '',
        '_css_header_5_center_mobile' => '',
        '_css_header_5_right' => '',
        '_css_header_5_right_tablet' => '',
        '_css_header_5_right_mobile' => '',
        '_css_menu_container_header_5' => '',
        '_css_menu_container_header_5_tablet' => '',
        '_css_menu_container_header_5_mobile' => '',
        '_css_menu_li_header_5' => '',
        '_css_menu_li_header_5_tablet' => '',
        '_css_menu_li_header_5_mobile' => '',
        '_css_menu_a_header_5' => '',
        '_css_menu_a_header_5_tablet' => '',
        '_css_menu_a_header_5_mobile' => '',
        '_css_menu_a_hover_header_5' => '',
        '_css_menu_a_hover_header_5_tablet' => '',
        '_css_menu_a_hover_header_5_mobile' => '',
        '_css_menu_a_hover_before_header_5' => '',
        '_css_menu_a_hover_before_header_5_tablet' => '',
        '_css_menu_a_hover_before_header_5_mobile' => '',
        '_css_menu_indicator_a_header_5' => '',
        '_css_menu_a_indicator_header_5_tablet' => '',
        '_css_menu_a_indicator_header_5_mobile' => '',
        '_css_menus_separator_header_5' => '',
        '_css_menus_separator_header_5_tablet' => '',
        '_css_menus_separator_header_5_mobile' => '',
        '_css_menu_ul_header_5' => '',
        '_css_menu_ul_header_5_tablet' => '',
        '_css_menu_ul_header_5_mobile' => '',
        '_css_menu_ul_a_header_5' => '',
        '_css_menu_ul_a_header_5_tablet' => '',
        '_css_menu_ul_a_header_5_mobile' => '',
        '_css_menu_ul_a_hover_header_5' => '',
        '_css_menu_ul_a_hover_header_5_tablet' => '',
        '_css_menu_ul_a_hover_header_5_mobile' => '',
        '_css_menu_ul_indicator_a_header_5' => '',
        '_css_menu_ul_indicator_a_header_5_tablet' => '',
        '_css_menu_ul_indicator_a_header_5_mobile' => '',
        '_css_menu_ul_ul_header_5' => '',
        '_css_menu_ul_ul_header_5_tablet' => '',
        '_css_menu_ul_ul_header_5_mobile' => '',
        '_css_menu_inner_megamenu_header_5' => '',
        '_css_menu_inner_megamenu_header_5_tablet' => '',
        '_css_menu_inner_megamenu_header_5_mobile' => '',
        'row_type_header_4' => '',
        'page_as_row_header_4' => '',
        'mobile_header' => '',
        'mobile_sticky' => '',
        'header_4_left' => '',
        'header_4_center' => '',
        'header_4_right' => '',
        '_css_container_header_4' => '',
        '_css_container_header_4_tablet' => '',
        '_css_container_header_4_mobile' => '',
        '_css_row_header_4' => '',
        '_css_row_header_4_tablet' => '',
        '_css_row_header_4_mobile' => '',
        '_css_header_4_left' => '',
        '_css_header_4_left_tablet' => '',
        '_css_header_4_left_mobile' => '',
        '_css_header_4_center' => '',
        '_css_header_4_center_tablet' => '',
        '_css_header_4_center_mobile' => '',
        '_css_header_4_right' => '',
        '_css_header_4_right_tablet' => '',
        '_css_header_4_right_mobile' => '',
        '_css_menu_container_header_4' => '',
        '_css_menu_container_header_4_tablet' => '',
        '_css_menu_container_header_4_mobile' => '',
        '_css_menu_li_header_4' => '',
        '_css_menu_li_header_4_tablet' => '',
        '_css_menu_li_header_4_mobile' => '',
        '_css_menu_a_header_4' => '',
        '_css_menu_a_header_4_tablet' => '',
        '_css_menu_a_header_4_mobile' => '',
        '_css_menu_a_hover_header_4' => '',
        '_css_menu_a_hover_header_4_tablet' => '',
        '_css_menu_a_hover_header_4_mobile' => '',
        '_css_menu_a_hover_before_header_4' => '',
        '_css_menu_a_hover_before_header_4_tablet' => '',
        '_css_menu_a_hover_before_header_4_mobile' => '',
        '_css_menu_indicator_a_header_4' => '',
        '_css_menu_a_indicator_header_4_tablet' => '',
        '_css_menu_a_indicator_header_4_mobile' => '',
        '_css_menus_separator_header_4' => '',
        '_css_menus_separator_header_4_tablet' => '',
        '_css_menus_separator_header_4_mobile' => '',
        '_css_menu_ul_header_4' => '',
        '_css_menu_ul_header_4_tablet' => '',
        '_css_menu_ul_header_4_mobile' => '',
        '_css_menu_ul_a_header_4' => '',
        '_css_menu_ul_a_header_4_tablet' => '',
        '_css_menu_ul_a_header_4_mobile' => '',
        '_css_menu_ul_a_hover_header_4' => '',
        '_css_menu_ul_a_hover_header_4_tablet' => '',
        '_css_menu_ul_a_hover_header_4_mobile' => '',
        '_css_menu_ul_indicator_a_header_4' => '',
        '_css_menu_ul_indicator_a_header_4_tablet' => '',
        '_css_menu_ul_indicator_a_header_4_mobile' => '',
        '_css_menu_ul_ul_header_4' => '',
        '_css_menu_ul_ul_header_4_tablet' => '',
        '_css_menu_ul_ul_header_4_mobile' => '',
        '_css_menu_inner_megamenu_header_4' => '',
        '_css_menu_inner_megamenu_header_4_tablet' => '',
        '_css_menu_inner_megamenu_header_4_mobile' => '',
        'fixed_side' => '',
        'row_type_fixed_side_1' => '',
        'page_as_row_fixed_side_1' => '',
        'fixed_side_1_top' => '',
        'fixed_side_1_middle' => '',
        'fixed_side_1_bottom' => '',
        '_css_fixed_side_style' => '',
        '_css_fixed_side_style_tablet' => '',
        '_css_fixed_side_style_mobile' => '',
        '_css_fixed_side_1_top' => '',
        '_css_fixed_side_1_top_tablet' => '',
        '_css_fixed_side_1_top_mobile' => '',
        '_css_fixed_side_1_middle' => '',
        '_css_fixed_side_1_middle_tablet' => '',
        '_css_fixed_side_1_middle_mobile' => '',
        '_css_fixed_side_1_bottom' => '',
        '_css_fixed_side_1_bottom_tablet' => '',
        '_css_fixed_side_1_bottom_mobile' => '',
        '_css_menu_container_fixed_side_1' => '',
        '_css_menu_container_fixed_side_1_tablet' => '',
        '_css_menu_container_fixed_side_1_mobile' => '',
        '_css_menu_li_fixed_side_1' => '',
        '_css_menu_li_fixed_side_1_tablet' => '',
        '_css_menu_li_fixed_side_1_mobile' => '',
        '_css_menu_a_fixed_side_1' => '',
        '_css_menu_a_fixed_side_1_tablet' => '',
        '_css_menu_a_fixed_side_1_mobile' => '',
        '_css_menu_a_hover_fixed_side_1' => '',
        '_css_menu_a_hover_fixed_side_1_tablet' => '',
        '_css_menu_a_hover_fixed_side_1_mobile' => '',
        '_css_menu_a_hover_before_fixed_side_1' => '',
        '_css_menu_a_hover_before_fixed_side_1_tablet' => '',
        '_css_menu_a_hover_before_fixed_side_1_mobile' => '',
        '_css_menu_indicator_a_fixed_side_1' => '',
        '_css_menu_a_indicator_fixed_side_1_tablet' => '',
        '_css_menu_a_indicator_fixed_side_1_mobile' => '',
        '_css_menus_separator_fixed_side_1' => '',
        '_css_menus_separator_fixed_side_1_tablet' => '',
        '_css_menus_separator_fixed_side_1_mobile' => '',
        '_css_menu_ul_fixed_side_1' => '',
        '_css_menu_ul_fixed_side_1_tablet' => '',
        '_css_menu_ul_fixed_side_1_mobile' => '',
        '_css_menu_ul_a_fixed_side_1' => '',
        '_css_menu_ul_a_fixed_side_1_tablet' => '',
        '_css_menu_ul_a_fixed_side_1_mobile' => '',
        '_css_menu_ul_a_hover_fixed_side_1' => '',
        '_css_menu_ul_a_hover_fixed_side_1_tablet' => '',
        '_css_menu_ul_a_hover_fixed_side_1_mobile' => '',
        '_css_menu_ul_indicator_a_fixed_side_1' => '',
        '_css_menu_ul_indicator_a_fixed_side_1_tablet' => '',
        '_css_menu_ul_indicator_a_fixed_side_1_mobile' => '',
        '_css_menu_ul_ul_fixed_side_1' => '',
        '_css_menu_ul_ul_fixed_side_1_tablet' => '',
        '_css_menu_ul_ul_fixed_side_1_mobile' => '',
        '_css_menu_inner_megamenu_fixed_side_1' => '',
        '_css_menu_inner_megamenu_fixed_side_1_tablet' => '',
        '_css_menu_inner_megamenu_fixed_side_1_mobile' => '',
        '_css_header_container' => '',
        '_css_header_container_tablet' => '',
        '_css_header_container_mobile' => '',
        'hidden_top_bar' => '',
        '_css_hidden_top_bar' => '',
        '_css_hidden_top_bar_tablet' => '',
        '_css_hidden_top_bar_mobile' => '',
        '_css_hidden_top_bar_handle' => '',
        '_css_hidden_top_bar_handle_tablet' => '',
        '_css_hidden_top_bar_handle_mobile' => '',
      );

      if ( $c ) {
        $updated = wp_parse_args( $required, Codevz::option() );
        update_option( Codevz::$options_id, $updated );
      }

      return $required;
    }

	}
	new Codevz_Options;
}
