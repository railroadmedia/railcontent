ALTER TABLE `musora_laravel`.`railcontent_search_indexes` DROP INDEX `high_full_text`, ADD FULLTEXT `high_full_text` (`high_value`(767));

TRUNCATE TABLE musora_laravel.railcontent_search_indexes;
TRUNCATE TABLE musora_laravel.forum_search_indexes;
TRUNCATE TABLE drumeo_laravel.forum_search_indexes;
TRUNCATE TABLE guitareo_laravel.forum_search_indexes;
TRUNCATE TABLE pianote_laravel.forum_search_indexes;
TRUNCATE TABLE singeo_laravel.forum_search_indexes;

ALTER TABLE drumeo_ipb.forums_archive_posts DROP INDEX `archive_content`;
ALTER TABLE drumeo_ipb.message_posts DROP INDEX `msg_post`;
ALTER TABLE drumeo_ipb.posts DROP INDEX `post`;
ALTER TABLE drumeo_laravel.search_indexes DROP INDEX `high_full_text`;
ALTER TABLE drumeo_laravel.search_indexes DROP INDEX `medium_full_text`;
ALTER TABLE drumeo_laravel.search_indexes DROP INDEX `low_full_text`;
ALTER TABLE pianote_laravel.articles DROP INDEX `body`;
ALTER TABLE drumeo_blog_wordpress.wp_posts DROP INDEX `yarpp_title`;
ALTER TABLE drumeo_blog_wordpress.wp_posts DROP INDEX `yarpp_content`;
ALTER TABLE guitareo_blog.wp_posts DROP INDEX `yarpp_title`;
ALTER TABLE guitareo_blog.wp_posts DROP INDEX `yarpp_content`;
ALTER TABLE pianote_blog.wp_posts DROP INDEX `yarpp_title`;
ALTER TABLE pianote_blog.wp_posts DROP INDEX `yarpp_content`;
ALTER TABLE singeo_blog.wp_posts DROP INDEX `yarpp_title`;
ALTER TABLE singeo_blog.wp_posts DROP INDEX `yarpp_content`;

ALTER TABLE musora_laravel.forum_search_indexes CHANGE `high_value` `high_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE musora_laravel.forum_search_indexes CHANGE `medium_value` `medium_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE musora_laravel.forum_search_indexes CHANGE `low_value` `low_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE musora_laravel.railcontent_search_indexes CHANGE `high_value` `high_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE musora_laravel.railcontent_search_indexes CHANGE `medium_value` `medium_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE musora_laravel.railcontent_search_indexes CHANGE `low_value` `low_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE drumeo_laravel.forum_search_indexes CHANGE `high_value` `high_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE drumeo_laravel.forum_search_indexes CHANGE `medium_value` `medium_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE drumeo_laravel.forum_search_indexes CHANGE `low_value` `low_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE guitareo_laravel.forum_search_indexes CHANGE `high_value` `high_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE guitareo_laravel.forum_search_indexes CHANGE `medium_value` `medium_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE guitareo_laravel.forum_search_indexes CHANGE `low_value` `low_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE pianote_laravel.forum_search_indexes CHANGE `high_value` `high_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE pianote_laravel.forum_search_indexes CHANGE `medium_value` `medium_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE pianote_laravel.forum_search_indexes CHANGE `low_value` `low_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE singeo_laravel.forum_search_indexes CHANGE `high_value` `high_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE singeo_laravel.forum_search_indexes CHANGE `medium_value` `medium_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE singeo_laravel.forum_search_indexes CHANGE `low_value` `low_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;

ALTER TABLE `railcontent_search_indexes` CHANGE `high_value` `high_value` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;

# set proper default

ALTER TABLE users MODIFY created datetime  NULL DEFAULT '1970-01-02'
UPDATE  `users` SET `created` = NULL WHERE `created` = '0000-00-00 00:00:00'



ALTER TABLE drumeo_blog_wordpress.wp_actionscheduler_actions MODIFY scheduled_date_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_actionscheduler_actions SET scheduled_date_gmt = NULL WHERE scheduled_date_gmt = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_actionscheduler_actions MODIFY scheduled_date_local datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_actionscheduler_actions SET scheduled_date_local = NULL WHERE scheduled_date_local = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_actionscheduler_actions MODIFY last_attempt_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_actionscheduler_actions SET last_attempt_gmt = NULL WHERE last_attempt_gmt = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_actionscheduler_actions MODIFY last_attempt_local datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_actionscheduler_actions SET last_attempt_local = NULL WHERE last_attempt_local = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_actionscheduler_claims MODIFY date_created_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_actionscheduler_claims SET date_created_gmt = NULL WHERE date_created_gmt = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_actionscheduler_logs MODIFY log_date_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_actionscheduler_logs SET log_date_gmt = NULL WHERE log_date_gmt = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_actionscheduler_logs MODIFY log_date_local datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_actionscheduler_logs SET log_date_local = NULL WHERE log_date_local = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_comments MODIFY comment_date datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_comments SET comment_date = NULL WHERE comment_date = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_comments MODIFY comment_date_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_comments SET comment_date_gmt = NULL WHERE comment_date_gmt = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_et_bloom_stats MODIFY record_date datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_et_bloom_stats SET record_date = NULL WHERE record_date = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_links MODIFY link_updated datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_links SET link_updated = NULL WHERE link_updated = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_pmxe_exports MODIFY registered_on datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_pmxe_exports SET registered_on = NULL WHERE registered_on = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_pmxe_exports MODIFY canceled_on datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_pmxe_exports SET canceled_on = NULL WHERE canceled_on = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_pmxe_exports MODIFY settings_update_on datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_pmxe_exports SET settings_update_on = NULL WHERE settings_update_on = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_pmxe_exports MODIFY last_activity datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_pmxe_exports SET last_activity = NULL WHERE last_activity = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_posts MODIFY post_date datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_posts SET post_date = NULL WHERE post_date = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_posts MODIFY post_date_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_posts SET post_date_gmt = NULL WHERE post_date_gmt = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_posts MODIFY post_modified datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_posts SET post_modified = NULL WHERE post_modified = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_posts MODIFY post_modified_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_posts SET post_modified_gmt = NULL WHERE post_modified_gmt = '0000-00-00 00:00:00';

ALTER TABLE drumeo_blog_wordpress.wp_users MODIFY user_registered datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_blog_wordpress.wp_users SET user_registered = NULL WHERE user_registered = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.addresses MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.addresses SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.addresses MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.addresses SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.answers MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.answers SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.answers MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.answers SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.beta_keys MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.beta_keys SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.beta_keys MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.beta_keys SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.countries MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.countries SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.countries MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.countries SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.credit_cards MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.credit_cards SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.credit_cards MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.credit_cards SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.customer_orders MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.customer_orders SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.customer_orders MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.customer_orders SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.customer_payment_methods MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.customer_payment_methods SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.customer_payment_methods MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.customer_payment_methods SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.customer_stripe_customer MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.customer_stripe_customer SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.customer_stripe_customer MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.customer_stripe_customer SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.customers MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.customers SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.customers MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.customers SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.discount_criteria MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.discount_criteria SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.discount_criteria MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.discount_criteria SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.discount_criterion MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.discount_criterion SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.discount_criterion MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.discount_criterion SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.discounts MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.discounts SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.discounts MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.discounts SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.members_area_carousel_frames MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.members_area_carousel_frames SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.members_area_carousel_frames MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.members_area_carousel_frames SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.order_discounts MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.order_discounts SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.order_discounts MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.order_discounts SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.order_items MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.order_items SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.order_items MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.order_items SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.order_payments MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.order_payments SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.order_payments MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.order_payments SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.order_upsells MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.order_upsells SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.order_upsells MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.order_upsells SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.paypal_reference_agreements MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.paypal_reference_agreements SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.paypal_reference_agreements MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.paypal_reference_agreements SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.products MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.products SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.products MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.products SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_action_codes MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_action_codes SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_action_codes MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_action_codes SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_cc_expiry_info MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_cc_expiry_info SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_cc_expiry_info MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_cc_expiry_info SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_email_history MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_email_history SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_email_history MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_email_history SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_inf_ppal_sub_map MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_inf_ppal_sub_map SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_inf_ppal_sub_map MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_inf_ppal_sub_map SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_levels MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_levels SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_levels MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_levels SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_order_account MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_order_account SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_order_account MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_order_account SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_order_customers MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_order_customers SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_order_customers MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_order_customers SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_order_discounts MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_order_discounts SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_order_discounts MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_order_discounts SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_order_inf_data MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_order_inf_data SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_order_inf_data MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_order_inf_data SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_order_items MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_order_items SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_order_items MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_order_items SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_order_payment MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_order_payment SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_order_payment MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_order_payment SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_order_payment_plan MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_order_payment_plan SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_order_payment_plan MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_order_payment_plan SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_order_ppal_data MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_order_ppal_data SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_order_ppal_data MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_order_ppal_data SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_orders MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_orders SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_orders MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_orders SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_ppal_suspended_recurring_profiles MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_ppal_suspended_recurring_profiles SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_ppal_suspended_recurring_profiles MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_ppal_suspended_recurring_profiles SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_product_images MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_product_images SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_product_images MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_product_images SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_products MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_products SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_products MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_products SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_renewal_history_inf_ppal MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_renewal_history_inf_ppal SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_renewal_history_inf_ppal MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_renewal_history_inf_ppal SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_user_level_links MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_user_level_links SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.railcenter_user_level_links MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.railcenter_user_level_links SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.refunds MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.refunds SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.refunds MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.refunds SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.shipping_options MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.shipping_options SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.shipping_options MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.shipping_options SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.shipping_weight_ranges MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.shipping_weight_ranges SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.shipping_weight_ranges MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.shipping_weight_ranges SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.specialties MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.specialties SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.specialties MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.specialties SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.subscription_payments MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.subscription_payments SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.subscription_payments MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.subscription_payments SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.teacher_badges MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.teacher_badges SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.teacher_badges MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.teacher_badges SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.teacher_specialties MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.teacher_specialties SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.teacher_specialties MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.teacher_specialties SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.teachers MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.teachers SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.teachers MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.teachers SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.user_api_keys MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.user_api_keys SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.user_api_keys MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.user_api_keys SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.user_notifications MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.user_notifications SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.user_notifications MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.user_notifications SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.user_orders MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.user_orders SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.user_orders MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.user_orders SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.user_payment_methods MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.user_payment_methods SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.user_payment_methods MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.user_payment_methods SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.wp_comments MODIFY comment_date datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.wp_comments SET comment_date = NULL WHERE comment_date = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.wp_comments MODIFY comment_date_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.wp_comments SET comment_date_gmt = NULL WHERE comment_date_gmt = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.wp_links MODIFY link_updated datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.wp_links SET link_updated = NULL WHERE link_updated = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.wp_posts MODIFY post_date datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.wp_posts SET post_date = NULL WHERE post_date = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.wp_posts MODIFY post_date_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.wp_posts SET post_date_gmt = NULL WHERE post_date_gmt = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.wp_posts MODIFY post_modified datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.wp_posts SET post_modified = NULL WHERE post_modified = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.wp_posts MODIFY post_modified_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.wp_posts SET post_modified_gmt = NULL WHERE post_modified_gmt = '0000-00-00 00:00:00';

ALTER TABLE drumeo_laravel.wp_users MODIFY user_registered datetime  NULL DEFAULT '1970-01-02';
UPDATE drumeo_laravel.wp_users SET user_registered = NULL WHERE user_registered = '0000-00-00 00:00:00';

ALTER TABLE guitareo_blog.wp_comments MODIFY comment_date datetime  NULL DEFAULT '1970-01-02';
UPDATE guitareo_blog.wp_comments SET comment_date = NULL WHERE comment_date = '0000-00-00 00:00:00';

ALTER TABLE guitareo_blog.wp_comments MODIFY comment_date_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE guitareo_blog.wp_comments SET comment_date_gmt = NULL WHERE comment_date_gmt = '0000-00-00 00:00:00';

ALTER TABLE guitareo_blog.wp_links MODIFY link_updated datetime  NULL DEFAULT '1970-01-02';
UPDATE guitareo_blog.wp_links SET link_updated = NULL WHERE link_updated = '0000-00-00 00:00:00';

ALTER TABLE guitareo_blog.wp_posts MODIFY post_date datetime  NULL DEFAULT '1970-01-02';
UPDATE guitareo_blog.wp_posts SET post_date = NULL WHERE post_date = '0000-00-00 00:00:00';

ALTER TABLE guitareo_blog.wp_posts MODIFY post_date_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE guitareo_blog.wp_posts SET post_date_gmt = NULL WHERE post_date_gmt = '0000-00-00 00:00:00';

ALTER TABLE guitareo_blog.wp_posts MODIFY post_modified datetime  NULL DEFAULT '1970-01-02';
UPDATE guitareo_blog.wp_posts SET post_modified = NULL WHERE post_modified = '0000-00-00 00:00:00';

ALTER TABLE guitareo_blog.wp_posts MODIFY post_modified_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE guitareo_blog.wp_posts SET post_modified_gmt = NULL WHERE post_modified_gmt = '0000-00-00 00:00:00';

ALTER TABLE guitareo_blog.wp_users MODIFY user_registered datetime  NULL DEFAULT '1970-01-02';
UPDATE guitareo_blog.wp_users SET user_registered = NULL WHERE user_registered = '0000-00-00 00:00:00';

ALTER TABLE guitareo_laravel.password_resets MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE guitareo_laravel.password_resets SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE guitareo_laravel.uploaded_files MODIFY created_at datetime  NULL DEFAULT '1970-01-02';
UPDATE guitareo_laravel.uploaded_files SET created_at = NULL WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE guitareo_laravel.uploaded_files MODIFY updated_at datetime  NULL DEFAULT '1970-01-02';
UPDATE guitareo_laravel.uploaded_files SET updated_at = NULL WHERE updated_at = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_actionscheduler_actions MODIFY scheduled_date_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_actionscheduler_actions SET scheduled_date_gmt = NULL WHERE scheduled_date_gmt = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_actionscheduler_actions MODIFY scheduled_date_local datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_actionscheduler_actions SET scheduled_date_local = NULL WHERE scheduled_date_local = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_actionscheduler_actions MODIFY last_attempt_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_actionscheduler_actions SET last_attempt_gmt = NULL WHERE last_attempt_gmt = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_actionscheduler_actions MODIFY last_attempt_local datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_actionscheduler_actions SET last_attempt_local = NULL WHERE last_attempt_local = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_actionscheduler_claims MODIFY date_created_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_actionscheduler_claims SET date_created_gmt = NULL WHERE date_created_gmt = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_actionscheduler_logs MODIFY log_date_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_actionscheduler_logs SET log_date_gmt = NULL WHERE log_date_gmt = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_actionscheduler_logs MODIFY log_date_local datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_actionscheduler_logs SET log_date_local = NULL WHERE log_date_local = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_comments MODIFY comment_date datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_comments SET comment_date = NULL WHERE comment_date = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_comments MODIFY comment_date_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_comments SET comment_date_gmt = NULL WHERE comment_date_gmt = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_links MODIFY link_updated datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_links SET link_updated = NULL WHERE link_updated = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_pmxi_files MODIFY registered_on datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_pmxi_files SET registered_on = NULL WHERE registered_on = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_pmxi_history MODIFY date datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_pmxi_history SET date = NULL WHERE date = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_pmxi_imports MODIFY registered_on datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_pmxi_imports SET registered_on = NULL WHERE registered_on = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_pmxi_imports MODIFY canceled_on datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_pmxi_imports SET canceled_on = NULL WHERE canceled_on = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_pmxi_imports MODIFY failed_on datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_pmxi_imports SET failed_on = NULL WHERE failed_on = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_pmxi_imports MODIFY settings_update_on datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_pmxi_imports SET settings_update_on = NULL WHERE settings_update_on = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_pmxi_imports MODIFY last_activity datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_pmxi_imports SET last_activity = NULL WHERE last_activity = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_posts MODIFY post_date datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_posts SET post_date = NULL WHERE post_date = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_posts MODIFY post_date_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_posts SET post_date_gmt = NULL WHERE post_date_gmt = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_posts MODIFY post_modified datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_posts SET post_modified = NULL WHERE post_modified = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_posts MODIFY post_modified_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_posts SET post_modified_gmt = NULL WHERE post_modified_gmt = '0000-00-00 00:00:00';

ALTER TABLE pianote_blog.wp_users MODIFY user_registered datetime  NULL DEFAULT '1970-01-02';
UPDATE pianote_blog.wp_users SET user_registered = NULL WHERE user_registered = '0000-00-00 00:00:00';

ALTER TABLE singeo_blog.wp_comments MODIFY comment_date datetime  NULL DEFAULT '1970-01-02';
UPDATE singeo_blog.wp_comments SET comment_date = NULL WHERE comment_date = '0000-00-00 00:00:00';

ALTER TABLE singeo_blog.wp_comments MODIFY comment_date_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE singeo_blog.wp_comments SET comment_date_gmt = NULL WHERE comment_date_gmt = '0000-00-00 00:00:00';

ALTER TABLE singeo_blog.wp_links MODIFY link_updated datetime  NULL DEFAULT '1970-01-02';
UPDATE singeo_blog.wp_links SET link_updated = NULL WHERE link_updated = '0000-00-00 00:00:00';

ALTER TABLE singeo_blog.wp_posts MODIFY post_date datetime  NULL DEFAULT '1970-01-02';
UPDATE singeo_blog.wp_posts SET post_date = NULL WHERE post_date = '0000-00-00 00:00:00';

ALTER TABLE singeo_blog.wp_posts MODIFY post_date_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE singeo_blog.wp_posts SET post_date_gmt = NULL WHERE post_date_gmt = '0000-00-00 00:00:00';

ALTER TABLE singeo_blog.wp_posts MODIFY post_modified datetime  NULL DEFAULT '1970-01-02';
UPDATE singeo_blog.wp_posts SET post_modified = NULL WHERE post_modified = '0000-00-00 00:00:00';

ALTER TABLE singeo_blog.wp_posts MODIFY post_modified_gmt datetime  NULL DEFAULT '1970-01-02';
UPDATE singeo_blog.wp_posts SET post_modified_gmt = NULL WHERE post_modified_gmt = '0000-00-00 00:00:00';

ALTER TABLE singeo_blog.wp_users MODIFY user_registered datetime  NULL DEFAULT '1970-01-02';
UPDATE singeo_blog.wp_users SET user_registered = NULL WHERE user_registered = '0000-00-00 00:00:00';
