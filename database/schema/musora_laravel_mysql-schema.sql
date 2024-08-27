/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `action_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `action_events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `batch_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionable_id` bigint unsigned NOT NULL,
  `target_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned DEFAULT NULL,
  `fields` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'running',
  `exception` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `original` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `changes` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `action_events_actionable_type_actionable_id_index` (`actionable_type`,`actionable_id`),
  KEY `action_events_target_type_target_id_index` (`target_type`,`target_id`),
  KEY `action_events_batch_id_model_type_model_id_index` (`batch_id`,`model_type`,`model_id`),
  KEY `action_events_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `add_event_calendars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `add_event_calendars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uniquekey` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `addevent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `addevent` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `addevent_id` int unsigned NOT NULL,
  `content_id` int unsigned NOT NULL,
  `calendar_id` bigint unsigned NOT NULL,
  `brand_overview_calendar_id` bigint unsigned DEFAULT NULL,
  `brand_overview_event_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `addevent_addevent_id_unique` (`addevent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `artists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artists` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `head_shot_picture_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `benefits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `benefits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bundles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bundles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `bundle_id` int NOT NULL,
  `product_id` int NOT NULL,
  `free_bonus` tinyint(1) NOT NULL DEFAULT '0',
  `lifetime_access` tinyint(1) NOT NULL DEFAULT '0',
  `order_number` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `carousels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carousels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `primary_cta_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_cta_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desktop_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `product_id` int DEFAULT NULL,
  `primary_cta_url_alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_cta_text_alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_cta_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_cta_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tablet_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btn_light_mode` tinyint(1) NOT NULL DEFAULT '0',
  `primary_video_src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `draft` tinyint(1) NOT NULL DEFAULT '0',
  `visible_on_desktop` tinyint(1) NOT NULL DEFAULT '1',
  `visible_on_mobile` tinyint(1) NOT NULL DEFAULT '1',
  `mobile_version_above` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_version_below` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skill_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `challenge_id` int DEFAULT NULL,
  `show_on_homepage` tinyint(1) NOT NULL DEFAULT '1',
  `show_on_workouts` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cohort_dropdowns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cohort_dropdowns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cohort_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cohort_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cohort_lists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cohort_id` int NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cohorts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cohorts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` int NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cohort_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `light_mode_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dark_mode_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `headline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subheadline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cohort_trailer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon1_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon1_copy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon2_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon2_copy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon3_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon3_copy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_top_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `body_image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_bottom_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `dropdown_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bottom_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bottom_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enrollment_start_date` datetime DEFAULT NULL,
  `enrollment_end_date` datetime DEFAULT NULL,
  `product_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cohort_start_date` timestamp NULL DEFAULT NULL,
  `cohort_end_date` timestamp NULL DEFAULT NULL,
  `content_id` int NOT NULL,
  `conversation_thread_id` int DEFAULT NULL,
  `icon1_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon2_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon3_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_trailer_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_trailer_1_thumb_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_trailer_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_trailer_2_thumb_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `demo_background_image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `demo_desktop_center_image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `demo_mobile_center_image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `demo_title_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `demo_description_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `demo_label_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `demo_trailer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_day_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_day_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `benefit_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `benefit_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `benefit_3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_product` tinyint(1) NOT NULL DEFAULT '0',
  `product_description_header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_description_body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `product_original_price` double DEFAULT NULL,
  `product_sale_price` double DEFAULT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `course_product_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `get_product_badge` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_cart_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_cart_link_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `custom_cohort` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `customer_io_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_io_customers` (
  `internal_id` int unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `workspace_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `workspace_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `site_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`internal_id`),
  UNIQUE KEY `customer_io_customers_uuid_unique` (`workspace_id`,`uuid`),
  KEY `customer_io_customers_email_index` (`email`),
  KEY `customer_io_customers_workspace_name_index` (`workspace_name`),
  KEY `customer_io_customers_workspace_id_index` (`workspace_id`),
  KEY `customer_io_customers_site_id_index` (`site_id`),
  KEY `customer_io_customers_created_at_index` (`created_at`),
  KEY `customer_io_customers_updated_at_index` (`updated_at`),
  KEY `customer_io_customers_deleted_at_index` (`deleted_at`),
  KEY `customer_io_customers_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_access_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_access_codes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `product_ids` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `is_claimed` tinyint(1) NOT NULL,
  `claimer_id` int DEFAULT NULL,
  `claimed_on` datetime DEFAULT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `source` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_access_code_code_index` (`code`),
  KEY `ecommerce_access_code_product_ids_index` (`product_ids`),
  KEY `ecommerce_access_code_is_claimed_index` (`is_claimed`),
  KEY `ecommerce_access_code_claimer_id_index` (`claimer_id`),
  KEY `ecommerce_access_code_claimed_on_index` (`claimed_on`),
  KEY `ecommerce_access_code_brand_index` (`brand`),
  KEY `ecommerce_access_code_created_on_index` (`created_at`),
  KEY `ecommerce_access_code_updated_on_index` (`updated_at`),
  KEY `ecommerce_access_codes_source_index` (`source`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_addresses` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `street_line_1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `street_line_2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `region` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `shopify_id` bigint DEFAULT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_address_type_index` (`type`),
  KEY `ecommerce_address_brand_index` (`brand`),
  KEY `ecommerce_address_user_id_index` (`user_id`),
  KEY `ecommerce_address_customer_id_index` (`customer_id`),
  KEY `ecommerce_address_first_name_index` (`first_name`),
  KEY `ecommerce_address_last_name_index` (`last_name`),
  KEY `ecommerce_address_created_on_index` (`created_at`),
  KEY `ecommerce_address_updated_on_index` (`updated_at`),
  KEY `ecommerce_addresses_shopify_id_index` (`shopify_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_apple_receipts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_apple_receipts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `receipt` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `request_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `notification_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `notification_request_data` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `validation_error` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `payment_id` int DEFAULT NULL,
  `subscription_id` int DEFAULT NULL,
  `raw_receipt_response` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `purchase_type` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `local_price` decimal(8,2) DEFAULT NULL,
  `local_currency` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `product_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_apple_receipts_transaction_id_index` (`transaction_id`),
  KEY `ecommerce_apple_receipts_request_type_index` (`request_type`),
  KEY `ecommerce_apple_receipts_notification_type_index` (`notification_type`),
  KEY `ecommerce_apple_receipts_email_index` (`email`),
  KEY `ecommerce_apple_receipts_brand_index` (`brand`),
  KEY `ecommerce_apple_receipts_valid_index` (`valid`),
  KEY `ecommerce_apple_receipts_payment_id_index` (`payment_id`),
  KEY `ecommerce_apple_receipts_subscription_id_index` (`subscription_id`),
  KEY `ecommerce_apple_receipts_local_price_index` (`local_price`),
  KEY `ecommerce_apple_receipts_local_currency_index` (`local_currency`),
  KEY `ecommerce_apple_receipts_receipt_index` (`receipt`(255)),
  KEY `ecommerce_apple_receipts_updated_at_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_credit_cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_credit_cards` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `fingerprint` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_four_digits` varchar(4) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cardholder_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `expiration_date` datetime NOT NULL,
  `external_id` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `external_customer_id` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `payment_gateway_name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_credit_card_company_name_index` (`company_name`),
  KEY `ecommerce_credit_card_external_id_index` (`external_id`),
  KEY `ecommerce_credit_card_external_customer_id_index` (`external_customer_id`),
  KEY `ecommerce_credit_card_payment_gateway_name_index` (`payment_gateway_name`),
  KEY `ecommerce_credit_card_created_on_index` (`created_at`),
  KEY `ecommerce_credit_card_updated_on_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_customer_payment_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_customer_payment_methods` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `payment_method_id` int NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_customer_payment_methods_customer_id_index` (`customer_id`),
  KEY `ecommerce_customer_payment_methods_payment_method_id_index` (`payment_method_id`),
  KEY `ecommerce_customer_payment_methods_created_on_index` (`created_at`),
  KEY `ecommerce_customer_payment_methods_updated_on_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_customers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `shopify_id` bigint DEFAULT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_customer_brand_index` (`brand`),
  KEY `ecommerce_customer_created_on_index` (`created_at`),
  KEY `ecommerce_customer_updated_on_index` (`updated_at`),
  KEY `ecommerce_customers_shopify_id_index` (`shopify_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_discount_criteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_discount_criteria` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `products_relation_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `min` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `max` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `discount_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_discount_criteria_name_index` (`name`),
  KEY `ecommerce_discount_criteria_type_index` (`type`),
  KEY `ecommerce_discount_criteria_discount_id_index` (`discount_id`),
  KEY `ecommerce_discount_criteria_created_on_index` (`created_at`),
  KEY `ecommerce_discount_criteria_updated_on_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_discount_criterias_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_discount_criterias_products` (
  `discount_criteria_id` int NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`discount_criteria_id`,`product_id`),
  KEY `ecommerce_discount_criterias_products_discount_criteria_id_index` (`discount_criteria_id`),
  KEY `ecommerce_discount_criterias_products_product_id_index` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_discounts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `product_id` int DEFAULT NULL,
  `product_category` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  `aux` int DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_discount_name_index` (`name`),
  KEY `ecommerce_discount_type_index` (`type`),
  KEY `ecommerce_discount_active_index` (`active`),
  KEY `ecommerce_discount_created_on_index` (`created_at`),
  KEY `ecommerce_discount_updated_on_index` (`updated_at`),
  KEY `ecommerce_discount_product_id_index` (`product_id`),
  KEY `ecommerce_discount_visible_index` (`visible`),
  KEY `ecommerce_discount_product_category_index` (`product_category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_google_receipts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_google_receipts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `purchase_token` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `package_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `product_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `request_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `notification_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `validation_error` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `payment_id` int DEFAULT NULL,
  `order_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `raw_receipt_response` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `purchase_type` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `local_price` decimal(8,2) DEFAULT NULL,
  `local_currency` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_google_receipts_local_price_index` (`local_price`),
  KEY `ecommerce_google_receipts_local_currency_index` (`local_currency`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_membership_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_membership_actions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `action_amount` int DEFAULT NULL,
  `action_reason` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `subscription_id` int NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_membership_actions_action_index` (`action`),
  KEY `ecommerce_membership_actions_action_amount_index` (`action_amount`),
  KEY `ecommerce_membership_actions_user_id_index` (`user_id`),
  KEY `ecommerce_membership_actions_subscription_id_index` (`subscription_id`),
  KEY `ecommerce_membership_actions_brand_index` (`brand`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_membership_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_membership_stats` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `new` int NOT NULL,
  `active_state` int NOT NULL,
  `expired` int NOT NULL,
  `suspended_state` int NOT NULL,
  `canceled` int NOT NULL,
  `canceled_state` int NOT NULL,
  `interval_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `stats_date` date NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_order_discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_order_discounts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `order_item_id` int DEFAULT NULL,
  `discount_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_order_discount_order_id_index` (`order_id`),
  KEY `ecommerce_order_discount_order_item_id_index` (`order_item_id`),
  KEY `ecommerce_order_discount_discount_id_index` (`discount_id`),
  KEY `ecommerce_order_discount_created_on_index` (`created_at`),
  KEY `ecommerce_order_discount_updated_on_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_order_item_fulfillment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_order_item_fulfillment` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `order_item_id` int NOT NULL,
  `status` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tracking_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fulfilled_on` datetime DEFAULT NULL,
  `shopify_id` bigint DEFAULT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_order_item_fulfillment_order_id_index` (`order_id`),
  KEY `ecommerce_order_item_fulfillment_order_item_id_index` (`order_item_id`),
  KEY `ecommerce_order_item_fulfillment_status_index` (`status`),
  KEY `ecommerce_order_item_fulfillment_created_on_index` (`created_at`),
  KEY `ecommerce_order_item_fulfillment_updated_on_index` (`updated_at`),
  KEY `ecommerce_order_item_fulfillment_shopify_id_index` (`shopify_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_order_items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `initial_price` decimal(8,2) NOT NULL,
  `total_discounted` decimal(8,2) NOT NULL,
  `final_price` decimal(8,2) NOT NULL,
  `shopify_id` bigint DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_order_item_order_id_index` (`order_id`),
  KEY `ecommerce_order_item_product_id_index` (`product_id`),
  KEY `ecommerce_order_item_created_on_index` (`created_at`),
  KEY `ecommerce_order_item_updated_on_index` (`updated_at`),
  KEY `ecommerce_order_items_shopify_id_index` (`shopify_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_order_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_order_payments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `payment_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_order_payment_order_id_index` (`order_id`),
  KEY `ecommerce_order_payment_payment_id_index` (`payment_id`),
  KEY `ecommerce_order_payment_created_on_index` (`created_at`),
  KEY `ecommerce_order_payment_updated_on_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_orders` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `total_due` decimal(8,2) NOT NULL,
  `product_due` decimal(8,2) DEFAULT NULL,
  `taxes_due` decimal(8,2) NOT NULL,
  `shipping_due` decimal(8,2) NOT NULL,
  `finance_due` decimal(8,2) DEFAULT NULL,
  `total_paid` decimal(8,2) NOT NULL,
  `user_id` int DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `placed_by_user_id` int DEFAULT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `shipping_address_id` int DEFAULT NULL,
  `billing_address_id` int DEFAULT NULL,
  `shopify_id` bigint DEFAULT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_order_user_id_index` (`user_id`),
  KEY `ecommerce_order_customer_id_index` (`customer_id`),
  KEY `ecommerce_order_brand_index` (`brand`),
  KEY `ecommerce_order_created_on_index` (`created_at`),
  KEY `ecommerce_order_updated_on_index` (`updated_at`),
  KEY `ecommerce_order_deleted_on_index` (`deleted_at`),
  KEY `ecommerce_order_product_due_index` (`product_due`),
  KEY `ecommerce_order_finance_due_index` (`finance_due`),
  KEY `ecommerce_orders_placed_by_user_id_index` (`placed_by_user_id`),
  KEY `ecommerce_orders_shopify_id_index` (`shopify_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_payment_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_payment_methods` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `method_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `method_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `credit_card_id` int DEFAULT NULL,
  `paypal_billing_agreement_id` int DEFAULT NULL,
  `currency` varchar(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `billing_address_id` int DEFAULT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_payment_method_method_id_index` (`method_id`),
  KEY `ecommerce_payment_method_method_type_index` (`method_type`),
  KEY `ecommerce_payment_method_currency_index` (`currency`),
  KEY `ecommerce_payment_method_created_on_index` (`created_at`),
  KEY `ecommerce_payment_method_updated_on_index` (`updated_at`),
  KEY `ecommerce_payment_method_deleted_on_index` (`deleted_at`),
  KEY `ecommerce_payment_methods_credit_card_id_index` (`credit_card_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_payment_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_payment_taxes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `payment_id` int NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `region` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `product_rate` decimal(8,5) DEFAULT NULL,
  `shipping_rate` decimal(8,5) DEFAULT NULL,
  `product_taxes_paid` decimal(8,2) DEFAULT NULL,
  `shipping_taxes_paid` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_payment_taxes_payment_id_index` (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_payments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `total_due` decimal(8,2) NOT NULL,
  `total_paid` decimal(8,2) DEFAULT NULL,
  `total_refunded` decimal(8,2) DEFAULT NULL,
  `attempt_number` int NOT NULL DEFAULT '0',
  `conversion_rate` decimal(8,2) DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `external_id` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `external_provider` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `gateway_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `payment_method_id` int DEFAULT NULL,
  `currency` varchar(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `shopify_id` bigint DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_payment_type_index` (`type`),
  KEY `ecommerce_payment_external_id_index` (`external_id`),
  KEY `ecommerce_payment_external_provider_index` (`external_provider`),
  KEY `ecommerce_payment_status_index` (`status`),
  KEY `ecommerce_payment_payment_method_id_index` (`payment_method_id`),
  KEY `ecommerce_payment_currency_index` (`currency`),
  KEY `ecommerce_payment_created_on_index` (`created_at`),
  KEY `ecommerce_payment_updated_on_index` (`updated_at`),
  KEY `ecommerce_payment_deleted_on_index` (`deleted_at`),
  KEY `ecommerce_payments_shopify_id_index` (`shopify_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_paypal_billing_agreements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_paypal_billing_agreements` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `external_id` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `payment_gateway_name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `legacy_payment_gateway_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_paypal_billing_agreement_external_id_index` (`external_id`),
  KEY `ecommerce_paypal_billing_agreement_payment_gateway_name_index` (`payment_gateway_name`),
  KEY `ecommerce_paypal_billing_agreement_created_on_index` (`created_at`),
  KEY `ecommerce_paypal_billing_agreement_updated_on_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sku` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `inventory_control_sku` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fulfillment_sku` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `thumbnail_url` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `sales_page_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `is_physical` tinyint(1) NOT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `subscription_interval_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `subscription_interval_count` int DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `min_stock_level` int DEFAULT NULL,
  `public_stock_count` int DEFAULT NULL,
  `auto_decrement_stock` tinyint(1) NOT NULL DEFAULT '0',
  `digital_access_permission_names` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `digital_access_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `digital_access_time_interval_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `digital_access_time_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `digital_access_time_interval_length` int DEFAULT NULL,
  `digital_membership_access_expiration_date` datetime DEFAULT NULL,
  `shopify_id` bigint DEFAULT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ecommerce_products_sku_unique` (`sku`),
  KEY `ecommerce_product_brand_index` (`brand`),
  KEY `ecommerce_product_name_index` (`name`),
  KEY `ecommerce_product_sku_index` (`sku`),
  KEY `ecommerce_product_type_index` (`type`),
  KEY `ecommerce_product_active_index` (`active`),
  KEY `ecommerce_product_subscription_interval_type_index` (`subscription_interval_type`),
  KEY `ecommerce_product_subscription_interval_count_index` (`subscription_interval_count`),
  KEY `ecommerce_product_stock_index` (`stock`),
  KEY `ecommerce_product_created_on_index` (`created_at`),
  KEY `ecommerce_product_updated_on_index` (`updated_at`),
  KEY `ecommerce_product_category_index` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_refunds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_refunds` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `payment_id` int NOT NULL,
  `payment_amount` decimal(8,2) NOT NULL,
  `refunded_amount` decimal(8,2) NOT NULL,
  `shopify_id` bigint DEFAULT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `external_provider` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `external_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_refund_payment_id_index` (`payment_id`),
  KEY `ecommerce_refund_external_provider_index` (`external_provider`),
  KEY `ecommerce_refund_external_id_index` (`external_id`),
  KEY `ecommerce_refund_created_on_index` (`created_at`),
  KEY `ecommerce_refund_updated_on_index` (`updated_at`),
  KEY `ecommerce_refunds_shopify_id_index` (`shopify_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_shipping_costs_weight_ranges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_shipping_costs_weight_ranges` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `shipping_option_id` int NOT NULL,
  `min` decimal(8,2) NOT NULL,
  `max` decimal(8,2) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_shipping_costs_weight_range_shipping_option_id_index` (`shipping_option_id`),
  KEY `ecommerce_shipping_costs_weight_range_created_on_index` (`created_at`),
  KEY `ecommerce_shipping_costs_weight_range_updated_on_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_shipping_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_shipping_options` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `country` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `priority` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_shipping_option_country_index` (`country`),
  KEY `ecommerce_shipping_option_active_index` (`active`),
  KEY `ecommerce_shipping_option_priority_index` (`priority`),
  KEY `ecommerce_shipping_option_created_on_index` (`created_at`),
  KEY `ecommerce_shipping_option_updated_on_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_subscription_access_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_subscription_access_codes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `subscription_id` int NOT NULL,
  `access_code_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_subscription_access_code_subscription_id_index` (`subscription_id`),
  KEY `ecommerce_subscription_access_code_access_code_id_index` (`access_code_id`),
  KEY `ecommerce_subscription_access_code_created_on_index` (`created_at`),
  KEY `ecommerce_subscription_access_code_updated_on_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_subscription_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_subscription_payments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `subscription_id` int NOT NULL,
  `payment_id` int NOT NULL,
  `shopify_id` bigint DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_subscription_payment_subscription_id_index` (`subscription_id`),
  KEY `ecommerce_subscription_payment_payment_id_index` (`payment_id`),
  KEY `ecommerce_subscription_payment_created_on_index` (`created_at`),
  KEY `ecommerce_subscription_payment_updated_on_index` (`updated_at`),
  KEY `ecommerce_subscription_payments_shopify_id_index` (`shopify_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_subscriptions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `stopped` tinyint(1) NOT NULL DEFAULT '0',
  `start_date` datetime NOT NULL,
  `paid_until` datetime NOT NULL,
  `canceled_on` datetime DEFAULT NULL,
  `cancellation_reason` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `total_price` decimal(8,2) NOT NULL,
  `tax` double(8,2) NOT NULL DEFAULT '0.00',
  `currency` varchar(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `interval_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `interval_count` int NOT NULL,
  `total_cycles_due` int DEFAULT NULL,
  `total_cycles_paid` int NOT NULL,
  `renewal_attempt` int NOT NULL DEFAULT '0',
  `payment_method_id` int DEFAULT NULL,
  `legacy_payment_method_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `apple_expiration_date` datetime DEFAULT NULL,
  `external_app_store_id` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `paypal_recurring_profile_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `failed_payment_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_subscription_brand_index` (`brand`),
  KEY `ecommerce_subscription_type_index` (`type`),
  KEY `ecommerce_subscription_user_id_index` (`user_id`),
  KEY `ecommerce_subscription_customer_id_index` (`customer_id`),
  KEY `ecommerce_subscription_order_id_index` (`order_id`),
  KEY `ecommerce_subscription_product_id_index` (`product_id`),
  KEY `ecommerce_subscription_is_active_index` (`is_active`),
  KEY `ecommerce_subscription_start_date_index` (`start_date`),
  KEY `ecommerce_subscription_paid_until_index` (`paid_until`),
  KEY `ecommerce_subscription_currency_index` (`currency`),
  KEY `ecommerce_subscription_interval_type_index` (`interval_type`),
  KEY `ecommerce_subscription_payment_method_id_index` (`payment_method_id`),
  KEY `ecommerce_subscription_created_on_index` (`created_at`),
  KEY `ecommerce_subscription_updated_on_index` (`updated_at`),
  KEY `ecommerce_subscription_deleted_on_index` (`deleted_at`),
  KEY `ecommerce_subscriptions_failed_payment_id_index` (`failed_payment_id`),
  KEY `ecommerce_subscriptions_paypal_recurring_profile_id_index` (`paypal_recurring_profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_unify_subscriptions_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_unify_subscriptions_archive` (
  `user_id` int NOT NULL,
  `subscription_id` int NOT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_adjustment_amount` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_user_payment_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_user_payment_methods` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `payment_method_id` int NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_user_payment_methods_user_id_index` (`user_id`),
  KEY `ecommerce_user_payment_methods_payment_method_id_index` (`payment_method_id`),
  KEY `ecommerce_user_payment_methods_created_on_index` (`created_at`),
  KEY `ecommerce_user_payment_methods_updated_on_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_user_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_user_products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_user_product_user_id_index` (`user_id`),
  KEY `ecommerce_user_product_product_id_index` (`product_id`),
  KEY `ecommerce_user_product_quantity_index` (`quantity`),
  KEY `ecommerce_user_product_expiration_date_index` (`expiration_date`),
  KEY `ecommerce_user_product_created_on_index` (`created_at`),
  KEY `ecommerce_user_product_updated_on_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ecommerce_user_stripe_customer_ids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecommerce_user_stripe_customer_ids` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `stripe_customer_id` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `payment_gateway_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ecommerce_user_stripe_customer_ids_user_id_index` (`user_id`),
  KEY `ecommerce_user_stripe_customer_ids_stripe_customer_id_index` (`stripe_customer_id`),
  KEY `ecommerce_user_stripe_customer_ids_created_at_index` (`created_at`),
  KEY `ecommerce_user_stripe_customer_ids_updated_at_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uuid` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `features` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `features_branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `features_branches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `experiment_id` bigint unsigned NOT NULL,
  `priority` int DEFAULT NULL,
  `allow_filter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userid_list` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `weight` int DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `features_branches_experiment_id_foreign` (`experiment_id`),
  CONSTRAINT `features_branches_experiment_id_foreign` FOREIGN KEY (`experiment_id`) REFERENCES `features_experiments` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `features_experiments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `features_experiments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `features_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `features_features` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `allow_filter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `block_filter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userid_list` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `active_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `features_tracking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `features_tracking` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint unsigned NOT NULL,
  `experiment_id` bigint unsigned NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `anonymous_user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_first_touch_handled` tinyint(1) NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `features_tracking_branch_id_foreign` (`branch_id`),
  KEY `features_tracking_user_id_foreign` (`user_id`),
  KEY `features_tracking_experiment_id_foreign` (`experiment_id`),
  CONSTRAINT `features_tracking_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `features_branches` (`id`),
  CONSTRAINT `features_tracking_experiment_id_foreign` FOREIGN KEY (`experiment_id`) REFERENCES `features_experiments` (`id`),
  CONSTRAINT `features_tracking_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `usora_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `forum_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `weight` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `topic` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `last_post_id` int DEFAULT NULL,
  `post_count` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `forum_post_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_post_likes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int unsigned NOT NULL,
  `liker_id` int unsigned NOT NULL,
  `liked_on` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forum_post_likes_post_id_index` (`post_id`),
  KEY `forum_post_likes_liker_id_index` (`liker_id`),
  KEY `forum_post_likes_liked_on_index` (`liked_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `forum_post_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_post_replies` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `child_post_id` int unsigned NOT NULL,
  `parent_post_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `forum_post_replies_child_post_id_index` (`child_post_id`),
  KEY `forum_post_replies_parent_post_id_index` (`parent_post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `forum_post_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_post_reports` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int unsigned NOT NULL,
  `reporter_id` int unsigned NOT NULL,
  `reported_on` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forum_post_reports_post_id_index` (`post_id`),
  KEY `forum_post_reports_reporter_id_index` (`reporter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `forum_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_posts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `thread_id` int unsigned NOT NULL,
  `author_id` int unsigned NOT NULL,
  `prompting_post_id` int unsigned DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `state` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `published_on` datetime DEFAULT NULL,
  `edited_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `version_master_id` int DEFAULT NULL,
  `version_saved_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forum_posts_thread_id_index` (`thread_id`),
  KEY `forum_posts_author_id_index` (`author_id`),
  KEY `forum_posts_prompting_post_id_index` (`prompting_post_id`),
  KEY `forum_posts_state_index` (`state`),
  KEY `forum_posts_published_on_index` (`published_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `forum_search_indexes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_search_indexes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `high_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `medium_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `low_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thread_id` int NOT NULL,
  `post_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forum_search_indexes_thread_id_index` (`thread_id`),
  KEY `forum_search_indexes_post_id_index` (`post_id`),
  FULLTEXT KEY `high_full_text` (`high_value`),
  FULLTEXT KEY `medium_full_text` (`medium_value`),
  FULLTEXT KEY `low_full_text` (`low_value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `forum_thread_follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_thread_follows` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `thread_id` int unsigned NOT NULL,
  `follower_id` int unsigned NOT NULL,
  `followed_on` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forum_thread_follows_thread_id_index` (`thread_id`),
  KEY `forum_thread_follows_follower_id_index` (`follower_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `forum_thread_reads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_thread_reads` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `thread_id` int unsigned NOT NULL,
  `reader_id` int unsigned NOT NULL,
  `read_on` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forum_thread_reads_thread_id_index` (`thread_id`),
  KEY `forum_thread_reads_reader_id_index` (`reader_id`),
  KEY `forum_thread_reads_read_on_index` (`read_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `forum_threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_threads` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int unsigned NOT NULL,
  `author_id` int unsigned NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `pinned` tinyint(1) NOT NULL DEFAULT '0',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `state` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `published_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `version_master_id` int DEFAULT NULL,
  `version_saved_at` timestamp NULL DEFAULT NULL,
  `last_post_id` int DEFAULT NULL,
  `post_count` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `forum_user_signatures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_user_signatures` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `signature` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forum_user_signatures_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genre` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `head_shot_picture_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `helpscout_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `helpscout_customers` (
  `internal_id` int unsigned NOT NULL AUTO_INCREMENT,
  `external_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`internal_id`),
  KEY `helpscout_customers_external_id_index` (`external_id`),
  KEY `helpscout_customers_created_at_index` (`created_at`),
  KEY `helpscout_customers_updated_at_index` (`updated_at`),
  KEY `helpscout_customers_deleted_at_index` (`deleted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `helpscout_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `helpscout_users` (
  `user_id` int unsigned NOT NULL,
  `helpscout_user_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `helpscout_users_helpscout_user_id_index` (`helpscout_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `leadgen_lesson_assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leadgen_lesson_assets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `leadgen_id` int DEFAULT NULL,
  `leadgen_lesson_id` int DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `soundslice` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `leadgen_lesson_assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leadgen_lesson_assignments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `leadgen_lesson_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `soundslice` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `leadgen_lessons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leadgen_lessons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `leadgen_id` int NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int NOT NULL,
  `one_off` tinyint(1) NOT NULL,
  `display_order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `leadgens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leadgens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bg_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `index_tile_view` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `leadtracker_leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leadtracker_leads` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `brand` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `maropost_tag_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `form_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `form_page_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `utm_source` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `utm_medium` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `utm_campaign` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `utm_term` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `submitted_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `leadtracker_leads_brand_index` (`brand`),
  KEY `leadtracker_leads_email_index` (`email`),
  KEY `leadtracker_leads_maropost_tag_name_index` (`maropost_tag_name`(191)),
  KEY `leadtracker_leads_form_name_index` (`form_name`),
  KEY `leadtracker_leads_utm_source_index` (`utm_source`),
  KEY `leadtracker_leads_utm_medium_index` (`utm_medium`),
  KEY `leadtracker_leads_utm_campaign_index` (`utm_campaign`),
  KEY `leadtracker_leads_utm_term_index` (`utm_term`),
  KEY `leadtracker_leads_submitted_at_index` (`submitted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `maintenance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `maintenance` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `status` tinyint(1) NOT NULL,
  `retry_after` int NOT NULL DEFAULT '60',
  `message` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `maintenance_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `mentor_students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mentor_students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int unsigned NOT NULL,
  `primary_brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mentor_user_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mentor_students_mentors_foreign` (`mentor_user_id`),
  KEY `mentor_students_user_id_index` (`user_id`),
  CONSTRAINT `mentor_students_mentor_user_id_foreign` FOREIGN KEY (`mentor_user_id`) REFERENCES `usora_users` (`id`),
  CONSTRAINT `mentor_students_mentors_foreign` FOREIGN KEY (`mentor_user_id`) REFERENCES `mentors` (`user_id`),
  CONSTRAINT `mentor_students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `usora_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `mentors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mentors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int unsigned NOT NULL,
  `supported_brands` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_student_max_count` int unsigned NOT NULL,
  `active_student_count` int unsigned NOT NULL,
  `total_student_count` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mentors_user_id_index` (`user_id`),
  CONSTRAINT `mentors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `usora_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `mewsora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mewsora` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image_url` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `notification_broadcasts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification_broadcasts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `channel` varchar(1500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `report` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `notification_id` int NOT NULL,
  `aggregation_group_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `broadcast_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_broadcasts_channel_index` (`channel`(255)),
  KEY `notification_broadcasts_type_index` (`type`),
  KEY `notification_broadcasts_status_index` (`status`),
  KEY `notification_broadcasts_notification_id_index` (`notification_id`),
  KEY `notification_broadcasts_aggregation_group_id_index` (`aggregation_group_id`),
  KEY `notification_broadcasts_broadcast_on_index` (`broadcast_on`),
  KEY `notification_broadcasts_created_at_index` (`created_at`),
  KEY `notification_broadcasts_updated_at_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `notification_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification_settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `setting_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_value` tinyint(1) NOT NULL DEFAULT '1',
  `brand` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_settings_usn` (`user_id`,`setting_name`),
  KEY `notification_settings_user_id_index` (`user_id`),
  KEY `notification_settings_setting_name_index` (`setting_name`),
  KEY `notification_settings_brand_index` (`brand`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT ' ',
  `subject_id` int DEFAULT NULL,
  `recipient_id` int DEFAULT NULL,
  `author_avatar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `author_display_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `content_title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `content_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `content_mobile_app_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `comment` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT ' ',
  `author_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `read_on` datetime DEFAULT NULL,
  `brand` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_subject_id_index` (`subject_id`),
  KEY `notifications_recipient_id_index` (`recipient_id`),
  KEY `notifications_read_on_index` (`read_on`),
  KEY `notifications_created_on_index` (`created_on`),
  KEY `notifications_type_index` (`type`),
  KEY `notifications_created_at_index` (`created_at`),
  KEY `notifications_updated_at_index` (`updated_at`),
  KEY `notifications_brand_index` (`brand`),
  KEY `notifications_author_id_index` (`author_id`),
  KEY `notifications_author_avatar_index` (`author_avatar`),
  KEY `notifications_author_display_name_index` (`author_display_name`),
  KEY `notifications_content_title_index` (`content_title`),
  KEY `notifications_content_url_index` (`content_url`),
  KEY `notifications_content_mobile_app_url_index` (`content_mobile_app_url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `nova_field_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nova_field_attachments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `attachable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachable_id` bigint unsigned NOT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `disk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nova_field_attachments_attachable_type_attachable_id_index` (`attachable_type`,`attachable_id`),
  KEY `nova_field_attachments_url_index` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `nova_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nova_notifications` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nova_notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `nova_pending_field_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nova_pending_field_attachments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `draft_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `disk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nova_pending_field_attachments_draft_id_index` (`draft_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `onboarding_answer_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `onboarding_answer_history` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `onboarding_question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `onboarding_answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `coach_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `onboarding_answer_history_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `onboarding_experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `onboarding_experience` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `onboarding_experience_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `onboarding_gears`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `onboarding_gears` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gear` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `onboarding_gears_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `onboarding_genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `onboarding_genres` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `onboarding_genres_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `onboarding_goals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `onboarding_goals` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `goals` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `onboarding_goals_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `onboarding_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `onboarding_topics` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `onboarding_topics_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `permission_model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `permission_model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permission_permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `permission_model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `permission_model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `permission_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `permission_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission_permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `permission_role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permission_permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `permission_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `permission_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission_roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `points_user_points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `points_user_points` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `trigger_hash` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `trigger_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `trigger_hash_data` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `points` bigint NOT NULL DEFAULT '0',
  `points_description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_t_b` (`user_id`,`trigger_hash`,`brand`),
  KEY `points_user_points_user_id_index` (`user_id`),
  KEY `points_user_points_trigger_hash_index` (`trigger_hash`),
  KEY `points_user_points_trigger_name_index` (`trigger_name`),
  KEY `points_user_points_points_index` (`points`),
  KEY `points_user_points_created_at_index` (`created_at`),
  KEY `points_user_points_updated_at_index` (`updated_at`),
  KEY `points_user_points_user_id_brand_points_index` (`user_id`,`brand`,`points`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `product_sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_sizes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `size_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `product_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` int NOT NULL,
  `product_type_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `promo_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `badge_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subheader_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `discounted_price` decimal(8,2) DEFAULT NULL,
  `spread_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overview` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `study_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructor_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructor_desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `size_chart_id` int DEFAULT NULL,
  `sold_out` tinyint(1) NOT NULL DEFAULT '0',
  `guaranteed` tinyint(1) NOT NULL DEFAULT '0',
  `shop_card_visible` tinyint(1) NOT NULL DEFAULT '1',
  `free_shipping` tinyint(1) NOT NULL DEFAULT '0',
  `included_edge` tinyint(1) NOT NULL DEFAULT '0',
  `size_case_sensitive` tinyint(1) NOT NULL DEFAULT '0',
  `bundle_free_shipping` tinyint(1) NOT NULL DEFAULT '0',
  `bundle_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bundle_desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `display_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_seasonal` tinyint(1) NOT NULL DEFAULT '0',
  `sales_page_visible` tinyint(1) NOT NULL DEFAULT '1',
  `sales_page_start_date` timestamp NULL DEFAULT NULL,
  `sales_page_end_date` timestamp NULL DEFAULT NULL,
  `shop_card_start_date` timestamp NULL DEFAULT NULL,
  `shop_card_end_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railactionlog_actions_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railactionlog_actions_log` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `resource_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `resource_id` int NOT NULL,
  `action_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `actor_id` int DEFAULT NULL,
  `actor_role` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_comment_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_comment_assignment` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` int NOT NULL,
  `user_id` int NOT NULL,
  `assigned_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `railcontent_comment_assignment_comment_id_index` (`comment_id`),
  KEY `railcontent_comment_assignment_user_id_index` (`user_id`),
  KEY `railcontent_comment_assignment_assigned_on_index` (`assigned_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_comment_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_comment_likes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `railcontent_comment_likes_comment_id_index` (`comment_id`),
  KEY `railcontent_comment_likes_user_id_index` (`user_id`),
  KEY `railcontent_comment_likes_created_on_index` (`created_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_comments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `parent_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `assigned_moderator_id` int DEFAULT NULL,
  `conversation_status` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'open',
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `temporary_display_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `railcontent_comments_content_id_index` (`content_id`),
  KEY `railcontent_comments_parent_id_index` (`parent_id`),
  KEY `railcontent_comments_user_id_index` (`user_id`),
  KEY `railcontent_comments_created_on_index` (`created_on`),
  KEY `railcontent_comments_deleted_at_index` (`deleted_at`),
  KEY `railcontent_comments_conversation_status_index` (`conversation_status`),
  KEY `parent_id_deleted_at_index` (`parent_id`,`deleted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sort` int NOT NULL DEFAULT '0',
  `status` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `brand` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `language` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `album` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `artist` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `associated_user_id` int DEFAULT NULL,
  `avatar_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bands` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cd_tracks` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `chord_or_scale` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `difficulty` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `difficulty_range` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `endorsements` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `episode_number` int DEFAULT NULL,
  `exercise_book_pages` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fast_bpm` int DEFAULT NULL,
  `forum_thread_id` int DEFAULT NULL,
  `high_soundslice_slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `high_video` int DEFAULT NULL,
  `home_staff_pick_rating` int DEFAULT NULL,
  `includes_song` tinyint(1) DEFAULT NULL,
  `is_active` int DEFAULT NULL,
  `is_coach` int DEFAULT NULL,
  `is_coach_of_the_month` int DEFAULT NULL,
  `is_featured` int DEFAULT NULL,
  `is_house_coach` int DEFAULT NULL,
  `length_in_seconds` int DEFAULT NULL,
  `live_event_start_time` datetime DEFAULT NULL,
  `live_event_end_time` datetime DEFAULT NULL,
  `live_event_youtube_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `live_stream_feed_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `low_soundslice_slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `low_video` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `original_video` int DEFAULT NULL,
  `pdf` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `pdf_in_g` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `qna_video` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `show_in_new_feed` tinyint(1) DEFAULT NULL,
  `slow_bpm` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `song_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `soundslice_slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `soundslice_xml_file_url` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `staff_pick_rating` int DEFAULT NULL,
  `student_id` int DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `transcriber_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `video` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `external_video_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `vimeo_video_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `youtube_video_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `xp` int DEFAULT NULL,
  `week` int DEFAULT NULL,
  `released` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `total_xp` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `popularity` int DEFAULT NULL,
  `web_url_path` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `mobile_app_url_path` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `child_count` int DEFAULT NULL,
  `hierarchy_position_number` int DEFAULT NULL,
  `parent_content_data` json DEFAULT NULL,
  `compiled_view_data` json DEFAULT NULL,
  `instrument` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `instrumentless` tinyint(1) DEFAULT NULL,
  `like_count` int DEFAULT NULL,
  `enrollment_start_time` datetime DEFAULT NULL,
  `enrollment_end_time` datetime DEFAULT NULL,
  `published_on` datetime DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `archived_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `railcontent_content_slug_index` (`slug`),
  KEY `railcontent_content_language_index` (`language`),
  KEY `railcontent_content_user_id_index` (`user_id`),
  KEY `railcontent_content_archived_on_index` (`archived_on`),
  KEY `railcontent_content_sort_index` (`sort`),
  KEY `t_s_b` (`type`,`status`,`brand`),
  KEY `railcontent_content_total_xp_index` (`total_xp`),
  KEY `railcontent_content_popularity_index` (`popularity`),
  KEY `railcontent_content_album_index` (`album`),
  KEY `railcontent_content_artist_index` (`artist`),
  KEY `railcontent_content_associated_user_id_index` (`associated_user_id`),
  KEY `railcontent_content_chord_or_scale_index` (`chord_or_scale`),
  KEY `railcontent_content_difficulty_index` (`difficulty`),
  KEY `railcontent_content_difficulty_range_index` (`difficulty_range`),
  KEY `railcontent_content_episode_number_index` (`episode_number`),
  KEY `railcontent_content_fast_bpm_index` (`fast_bpm`),
  KEY `railcontent_content_home_staff_pick_rating_index` (`home_staff_pick_rating`),
  KEY `railcontent_content_is_active_index` (`is_active`),
  KEY `railcontent_content_is_coach_index` (`is_coach`),
  KEY `railcontent_content_is_coach_of_the_month_index` (`is_coach_of_the_month`),
  KEY `railcontent_content_is_featured_index` (`is_featured`),
  KEY `railcontent_content_is_house_coach_index` (`is_house_coach`),
  KEY `railcontent_content_length_in_seconds_index` (`length_in_seconds`),
  KEY `railcontent_content_live_event_start_time_index` (`live_event_start_time`),
  KEY `railcontent_content_live_event_end_time_index` (`live_event_end_time`),
  KEY `railcontent_content_name_index` (`name`),
  KEY `railcontent_content_show_in_new_feed_index` (`show_in_new_feed`),
  KEY `railcontent_content_song_name_index` (`song_name`),
  KEY `railcontent_content_staff_pick_rating_index` (`staff_pick_rating`),
  KEY `railcontent_content_student_id_index` (`student_id`),
  KEY `railcontent_content_title_index` (`title`),
  KEY `railcontent_content_transcriber_name_index` (`transcriber_name`),
  KEY `railcontent_content_xp_index` (`xp`),
  KEY `railcontent_content_week_index` (`week`),
  KEY `railcontent_content_child_count_index` (`child_count`),
  KEY `railcontent_content_hierarchy_position_number_index` (`hierarchy_position_number`),
  KEY `railcontent_content_like_count_index` (`like_count`),
  KEY `published_on_index` (`published_on`),
  KEY `created_on_index` (`created_on`),
  KEY `t_s_b_p_index` (`type`,`status`,`brand`,`published_on`),
  KEY `p_c_index` (`published_on`,`created_on`),
  KEY `vimeo_video_id_index` (`vimeo_video_id`),
  KEY `youtube_video_id_index` (`youtube_video_id`),
  KEY `railcontent_content_external_video_id_index` (`external_video_id`),
  KEY `railcontent_content_enrollment_start_time_index` (`enrollment_start_time`),
  KEY `railcontent_content_enrollment_end_time_index` (`enrollment_end_time`),
  KEY `t_s_b_e` (`type`,`status`,`brand`,`enrollment_end_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_bpm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_bpm` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `bpm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bmc` (`bpm`,`content_id`),
  KEY `railcontent_content_bpm_content_id_index` (`content_id`),
  KEY `railcontent_content_bpm_bpm_index` (`bpm`),
  KEY `railcontent_content_bpm_position_index` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_creativity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_creativity` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `creativity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cc` (`creativity`,`content_id`),
  KEY `railcontent_content_creativity_content_id_index` (`content_id`),
  KEY `railcontent_content_creativity_creativity_index` (`creativity`),
  KEY `railcontent_content_creativity_position_index` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_data` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `position` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `railcontent_content_data_content_id_index` (`content_id`),
  KEY `railcontent_content_data_key_index` (`key`),
  KEY `railcontent_content_data_position_index` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_essentials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_essentials` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `essentials` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `essc` (`essentials`,`content_id`),
  KEY `railcontent_content_essentials_content_id_index` (`content_id`),
  KEY `railcontent_content_essentials_essentials_index` (`essentials`),
  KEY `railcontent_content_essentials_position_index` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_exercises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_exercises` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `exercise_id` int NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ec` (`exercise_id`,`content_id`),
  KEY `railcontent_content_exercises_content_id_index` (`content_id`),
  KEY `railcontent_content_exercises_exercise_id_index` (`exercise_id`),
  KEY `railcontent_content_exercises_position_index` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_fields` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `position` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kvtc` (`key`,`value`,`type`,`content_id`),
  KEY `railcontent_content_fields_content_id_index` (`content_id`),
  KEY `railcontent_content_fields_value_index` (`value`),
  KEY `railcontent_content_fields_type_index` (`type`),
  KEY `railcontent_content_fields_position_index` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_focus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_focus` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `focus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `railcontent_content_focus_content_id_index` (`content_id`),
  KEY `railcontent_content_focus_focus_index` (`focus`),
  KEY `railcontent_content_focus_position_index` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_follows` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `railcontent_content_follows_content_id_index` (`content_id`),
  KEY `railcontent_content_follows_user_id_index` (`user_id`),
  KEY `railcontent_content_follows_created_on_index` (`created_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_gears`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_gears` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `gear` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gc` (`gear`,`content_id`),
  KEY `railcontent_content_gears_content_id_index` (`content_id`),
  KEY `railcontent_content_gears_gear_index` (`gear`),
  KEY `railcontent_content_gears_position_index` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_genres` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `genre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `grc` (`genre`,`content_id`),
  KEY `railcontent_content_genres_content_id_index` (`content_id`),
  KEY `railcontent_content_genres_genre_index` (`genre`),
  KEY `railcontent_content_genres_position_index` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_hierarchy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_hierarchy` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT NULL,
  `child_id` int NOT NULL,
  `child_position` int NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `railcontent_content_hierarchy_child_id_parent_id_unique` (`child_id`,`parent_id`),
  KEY `railcontent_content_hierarchy_parent_id_index` (`parent_id`),
  KEY `railcontent_content_hierarchy_child_id_index` (`child_id`),
  KEY `railcontent_content_hierarchy_child_position_index` (`child_position`),
  KEY `railcontent_content_hierarchy_created_on_index` (`created_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_instructors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_instructors` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `instructor_id` int NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ic` (`instructor_id`,`content_id`),
  KEY `railcontent_content_instructors_content_id_index` (`content_id`),
  KEY `railcontent_content_instructors_instructor_id_index` (`instructor_id`),
  KEY `railcontent_content_instructors_position_index` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_key_pitch_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_key_pitch_types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `key_pitch_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kpc` (`key_pitch_type`,`content_id`),
  KEY `railcontent_content_key_pitch_types_content_id_index` (`content_id`),
  KEY `railcontent_content_key_pitch_types_key_pitch_type_index` (`key_pitch_type`),
  KEY `railcontent_content_key_pitch_types_position_index` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_keys` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kc` (`key`,`content_id`),
  KEY `railcontent_content_keys_content_id_index` (`content_id`),
  KEY `railcontent_content_keys_key_index` (`key`),
  KEY `railcontent_content_keys_position_index` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_lifestyle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_lifestyle` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `lifestyle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lc` (`lifestyle`,`content_id`),
  KEY `railcontent_content_lifestyle_content_id_index` (`content_id`),
  KEY `railcontent_content_lifestyle_lifestyle_index` (`lifestyle`),
  KEY `railcontent_content_lifestyle_position_index` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_likes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `railcontent_content_likes_content_id_index` (`content_id`),
  KEY `railcontent_content_likes_user_id_index` (`user_id`),
  KEY `railcontent_content_likes_created_on_index` (`created_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int DEFAULT NULL,
  `content_type` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `permission_id` int NOT NULL,
  `brand` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `railcontent_content_permissions_content_id_index` (`content_id`),
  KEY `railcontent_content_permissions_content_type_index` (`content_type`),
  KEY `railcontent_content_permissions_permission_id_index` (`permission_id`),
  KEY `railcontent_content_permissions_brand_index` (`brand`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_playlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_playlists` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `playlist` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pc` (`playlist`,`content_id`),
  KEY `railcontent_content_playlists_content_id_index` (`content_id`),
  KEY `railcontent_content_playlists_playlist_index` (`playlist`),
  KEY `railcontent_content_playlists_position_index` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_statistics` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `content_type` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `content_published_on` datetime DEFAULT NULL,
  `completes` int NOT NULL,
  `starts` int NOT NULL,
  `comments` int NOT NULL,
  `likes` int NOT NULL,
  `added_to_list` int NOT NULL,
  `start_interval` datetime NOT NULL,
  `end_interval` datetime NOT NULL,
  `week_of_year` int NOT NULL,
  `stats_epoch` int DEFAULT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `railcontent_content_statistics_content_id_index` (`content_id`),
  KEY `railcontent_content_statistics_content_type_index` (`content_type`),
  KEY `railcontent_content_statistics_content_published_on_index` (`content_published_on`),
  KEY `railcontent_content_statistics_completes_index` (`completes`),
  KEY `railcontent_content_statistics_starts_index` (`starts`),
  KEY `railcontent_content_statistics_comments_index` (`comments`),
  KEY `railcontent_content_statistics_likes_index` (`likes`),
  KEY `railcontent_content_statistics_added_to_list_index` (`added_to_list`),
  KEY `railcontent_content_statistics_start_interval_index` (`start_interval`),
  KEY `railcontent_content_statistics_end_interval_index` (`end_interval`),
  KEY `railcontent_content_statistics_week_of_year_index` (`week_of_year`),
  KEY `railcontent_content_statistics_created_on_index` (`created_on`),
  KEY `railcontent_content_statistics_stats_epoch_index` (`stats_epoch`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_styles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_styles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `style` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sc` (`style`,`content_id`),
  KEY `railcontent_content_styles_content_id_index` (`content_id`),
  KEY `railcontent_content_styles_style_index` (`style`),
  KEY `railcontent_content_styles_position_index` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_tags` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tgc` (`tag`,`content_id`),
  KEY `railcontent_content_tags_content_id_index` (`content_id`),
  KEY `railcontent_content_tags_tag_index` (`tag`),
  KEY `railcontent_content_tags_position_index` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_theory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_theory` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `theory` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `thec` (`theory`,`content_id`),
  KEY `railcontent_content_theory_content_id_index` (`content_id`),
  KEY `railcontent_content_theory_theory_index` (`theory`),
  KEY `railcontent_content_theory_position_index` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_content_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_content_topics` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `topic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tc` (`topic`,`content_id`),
  KEY `railcontent_content_topics_content_id_index` (`content_id`),
  KEY `railcontent_content_topics_topic_index` (`topic`),
  KEY `railcontent_content_topics_position_index` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `brand` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `railcontent_permissions_name_index` (`name`),
  KEY `railcontent_permissions_brand_index` (`brand`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_pinned_playlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_pinned_playlists` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `playlist_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ppub` (`user_id`,`brand`),
  KEY `ppup` (`user_id`,`playlist_id`),
  KEY `railcontent_pinned_playlists_playlist_id_index` (`playlist_id`),
  KEY `railcontent_pinned_playlists_user_id_index` (`user_id`),
  KEY `railcontent_pinned_playlists_created_at_index` (`created_at`),
  KEY `railcontent_pinned_playlists_brand_index` (`brand`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_playlist_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_playlist_likes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `playlist_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `railcontent_playlist_likes_playlist_id_index` (`playlist_id`),
  KEY `railcontent_playlist_likes_user_id_index` (`user_id`),
  KEY `railcontent_playlist_likes_created_at_index` (`created_at`),
  KEY `plub` (`user_id`,`brand`),
  KEY `railcontent_playlist_likes_brand_index` (`brand`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_reported_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_reported_comments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` int NOT NULL,
  `reporter_id` int NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cr` (`comment_id`,`reporter_id`),
  KEY `railcontent_reported_comments_comment_id_index` (`comment_id`),
  KEY `railcontent_reported_comments_reporter_id_index` (`reporter_id`),
  KEY `railcontent_reported_comments_created_on_index` (`created_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_reported_playlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_reported_playlists` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `playlist_id` int NOT NULL,
  `reporter_id` int NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pr` (`playlist_id`,`reporter_id`),
  KEY `railcontent_reported_playlists_playlist_id_index` (`playlist_id`),
  KEY `railcontent_reported_playlists_reporter_id_index` (`reporter_id`),
  KEY `railcontent_reported_playlists_created_on_index` (`created_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_search_indexes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_search_indexes` (
  `content_id` int NOT NULL,
  `high_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medium_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `low_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `content_type` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `content_status` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `content_instructors` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `content_published_on` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`content_id`),
  KEY `railcontent_search_indexes_brand_index` (`brand`),
  KEY `railcontent_search_indexes_content_type_index` (`content_type`),
  KEY `railcontent_search_indexes_content_published_on_index` (`content_published_on`),
  KEY `railcontent_search_indexes_content_status_index` (`content_status`),
  KEY `railcontent_search_indexes_content_instructors_index` (`content_instructors`),
  FULLTEXT KEY `high_full_text` (`high_value`),
  FULLTEXT KEY `medium_full_text` (`medium_value`),
  FULLTEXT KEY `low_full_text` (`low_value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_user_content_progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_user_content_progress` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `user_id` int NOT NULL,
  `state` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `progress_percent` int NOT NULL DEFAULT '0',
  `higher_key_progress` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `updated_on` datetime NOT NULL,
  `started_on` datetime DEFAULT NULL,
  `completed_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `railcontent_user_content_progress_content_id_index` (`content_id`),
  KEY `railcontent_user_content_progress_user_id_index` (`user_id`),
  KEY `railcontent_user_content_progress_state_index` (`state`),
  KEY `railcontent_user_content_progress_progress_percent_index` (`progress_percent`),
  KEY `railcontent_user_content_progress_updated_on_index` (`updated_on`),
  KEY `c_s` (`content_id`,`state`),
  KEY `railcontent_user_content_progress_higher_key_progress_index` (`higher_key_progress`),
  KEY `c_u` (`content_id`,`user_id`),
  KEY `railcontent_user_content_progress_started_on_index` (`started_on`),
  KEY `railcontent_user_content_progress_completed_on_index` (`completed_on`),
  KEY `railcontent_user_content_progress_popularity` (`content_id`,`state`,`updated_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_user_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_user_permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `permission_id` int NOT NULL,
  `start_date` datetime NOT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `railcontent_user_permissions_start_date_index` (`start_date`),
  KEY `railcontent_user_permissions_created_on_index` (`created_on`),
  KEY `railcontent_user_permissions_updated_on_index` (`updated_on`),
  KEY `ui_pi_ed` (`user_id`,`permission_id`,`expiration_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_user_playlist_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_user_playlist_content` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `user_playlist_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `position` int NOT NULL,
  `extra_data` json DEFAULT NULL,
  `start_second` int DEFAULT NULL,
  `end_second` int DEFAULT NULL,
  `content_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `playlist_item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upc` (`user_playlist_id`,`content_id`),
  KEY `railcontent_user_playlist_content_content_id_index` (`content_id`),
  KEY `railcontent_user_playlist_content_user_playlist_id_index` (`user_playlist_id`),
  KEY `railcontent_user_playlist_content_created_at_index` (`created_at`),
  KEY `railcontent_user_playlist_content_updated_at_index` (`updated_at`),
  KEY `railcontent_user_playlist_content_position_index` (`position`),
  KEY `railcontent_user_playlist_content_content_name_index` (`content_name`),
  KEY `railcontent_user_playlist_content_playlist_item_name_index` (`playlist_item_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_user_playlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_user_playlists` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `brand` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `thumbnail_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `private` int NOT NULL DEFAULT '1',
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_progress` datetime DEFAULT NULL,
  `migrated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `railcontent_user_playlists_brand_index` (`brand`),
  KEY `railcontent_user_playlists_type_index` (`type`),
  KEY `railcontent_user_playlists_user_id_index` (`user_id`),
  KEY `railcontent_user_playlists_created_at_index` (`created_at`),
  KEY `railcontent_user_playlists_updated_at_index` (`updated_at`),
  KEY `railcontent_user_playlists_name_index` (`name`),
  KEY `railcontent_user_playlists_category_index` (`category`),
  KEY `railcontent_user_playlists_private_index` (`private`),
  KEY `publ` (`user_id`,`brand`,`last_progress`),
  KEY `railcontent_user_playlists_last_progress_index` (`last_progress`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_user_requested_songs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_user_requested_songs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `song` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `artist` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `urssa` (`song`,`artist`,`brand`),
  KEY `railcontent_user_requested_songs_user_id_index` (`user_id`),
  KEY `railcontent_user_requested_songs_song_index` (`song`),
  KEY `railcontent_user_requested_songs_artist_index` (`artist`),
  KEY `railcontent_user_requested_songs_brand_index` (`brand`),
  KEY `railcontent_user_requested_songs_created_at_index` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railcontent_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railcontent_versions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `author_id` int DEFAULT NULL,
  `state` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `saved_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `railcontent_versions_content_id_index` (`content_id`),
  KEY `railcontent_versions_author_id_index` (`author_id`),
  KEY `railcontent_versions_state_index` (`state`),
  KEY `railcontent_versions_saved_on_index` (`saved_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_agent_browser_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_agent_browser_versions` (
  `agent_browser_version` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `agent_browser_version_index` (`agent_browser_version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_agent_browsers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_agent_browsers` (
  `agent_browser` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `agent_browser_index` (`agent_browser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_agent_strings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_agent_strings` (
  `agent_string` varchar(560) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `agent_string_hash` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `agent_string_hash_index` (`agent_string_hash`),
  KEY `agent_string_index` (`agent_string`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_device_kinds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_device_kinds` (
  `device_kind` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `device_kind_index` (`device_kind`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_device_models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_device_models` (
  `device_model` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `device_model_index` (`device_model`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_device_platforms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_device_platforms` (
  `device_platform` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `device_platform_index` (`device_platform`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_device_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_device_versions` (
  `device_version` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `device_version_index` (`device_version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_exception_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_exception_classes` (
  `exception_class` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `exception_class_hash` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `exception_class_hash_index` (`exception_class_hash`),
  KEY `exception_class_index` (`exception_class`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_exception_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_exception_codes` (
  `exception_code` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `exception_code_index` (`exception_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_exception_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_exception_files` (
  `exception_file` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `exception_file_hash` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `exception_file_hash_index` (`exception_file_hash`),
  KEY `exception_file_index` (`exception_file`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_exception_lines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_exception_lines` (
  `exception_line` int unsigned NOT NULL,
  UNIQUE KEY `exception_line_index` (`exception_line`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_exception_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_exception_messages` (
  `exception_message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `exception_message_hash` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `exception_message_hash_index` (`exception_message_hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_exception_traces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_exception_traces` (
  `exception_trace` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `exception_trace_hash` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `exception_trace_hash_index` (`exception_trace_hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_geo_ip_intermediary_lib`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_geo_ip_intermediary_lib` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip_latitude` decimal(11,8) DEFAULT NULL,
  `ip_longitude` decimal(11,8) DEFAULT NULL,
  `ip_country_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip_country_name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip_region` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip_city` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip_postal_zip_code` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip_timezone` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip_currency` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `private` tinyint(1) DEFAULT NULL,
  `failed` tinyint(1) DEFAULT NULL,
  `created` datetime(5) NOT NULL,
  `filled` datetime(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `railtracker4_geo_ip_intermediary_lib_ip_address_index` (`ip_address`),
  KEY `railtracker4_geo_ip_intermediary_lib_ip_latitude_index` (`ip_latitude`),
  KEY `railtracker4_geo_ip_intermediary_lib_ip_longitude_index` (`ip_longitude`),
  KEY `railtracker4_geo_ip_intermediary_lib_ip_country_code_index` (`ip_country_code`),
  KEY `railtracker4_geo_ip_intermediary_lib_ip_country_name_index` (`ip_country_name`),
  KEY `railtracker4_geo_ip_intermediary_lib_ip_region_index` (`ip_region`),
  KEY `railtracker4_geo_ip_intermediary_lib_ip_city_index` (`ip_city`),
  KEY `railtracker4_geo_ip_intermediary_lib_ip_postal_zip_code_index` (`ip_postal_zip_code`),
  KEY `railtracker4_geo_ip_intermediary_lib_ip_timezone_index` (`ip_timezone`),
  KEY `railtracker4_geo_ip_intermediary_lib_ip_currency_index` (`ip_currency`),
  KEY `railtracker4_geo_ip_intermediary_lib_created_index` (`created`),
  KEY `railtracker4_geo_ip_intermediary_lib_filled_index` (`filled`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_ip_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_ip_addresses` (
  `ip_address` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `ip_address_index` (`ip_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_ip_cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_ip_cities` (
  `ip_city` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `ip_city_index` (`ip_city`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_ip_country_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_ip_country_codes` (
  `ip_country_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `ip_country_code_index` (`ip_country_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_ip_country_names`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_ip_country_names` (
  `ip_country_name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `ip_country_name_index` (`ip_country_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_ip_currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_ip_currencies` (
  `ip_currency` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `ip_currency_index` (`ip_currency`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_ip_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_ip_data` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_latitude` decimal(11,8) DEFAULT NULL,
  `ip_longitude` decimal(11,8) DEFAULT NULL,
  `ip_country_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_country_name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_region` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_city` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_postal_zip_code` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_timezone` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_currency` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `railtracker4_ip_data_ip_address_unique` (`ip_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_ip_latitudes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_ip_latitudes` (
  `ip_latitude` decimal(11,8) NOT NULL,
  UNIQUE KEY `ip_latitude_index` (`ip_latitude`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_ip_longitudes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_ip_longitudes` (
  `ip_longitude` decimal(11,8) NOT NULL,
  UNIQUE KEY `ip_longitude_index` (`ip_longitude`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_ip_postal_zip_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_ip_postal_zip_codes` (
  `ip_postal_zip_code` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `ip_postal_zip_code_index` (`ip_postal_zip_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_ip_regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_ip_regions` (
  `ip_region` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `ip_region_index` (`ip_region`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_ip_timezones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_ip_timezones` (
  `ip_timezone` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `ip_timezone_index` (`ip_timezone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_language_preferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_language_preferences` (
  `language_preference` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `language_preference_index` (`language_preference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_language_ranges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_language_ranges` (
  `language_range` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `language_range_index` (`language_range`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_methods` (
  `method` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `method_index` (`method`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `cookie_id` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `url_protocol` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `url_domain` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `url_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `referer_url_protocol` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `referer_url_domain` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `referer_url_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `method` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `route_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `device_kind` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `device_model` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `device_platform` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `device_version` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `device_is_mobile` tinyint(1) NOT NULL,
  `agent_browser` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `agent_browser_version` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `language_preference` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `language_range` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip_address` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip_latitude` decimal(11,8) DEFAULT NULL,
  `ip_longitude` decimal(11,8) DEFAULT NULL,
  `ip_country_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip_country_name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip_region` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip_city` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip_postal_zip_code` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip_timezone` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip_currency` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `is_robot` tinyint(1) NOT NULL,
  `response_status_code` int unsigned DEFAULT NULL,
  `response_duration_ms` bigint unsigned DEFAULT NULL,
  `exception_code` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `exception_line` int unsigned DEFAULT NULL,
  `requested_on` datetime(5) NOT NULL,
  `responded_on` datetime(5) DEFAULT NULL,
  `url_query_hash` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `referer_url_query_hash` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `route_action_hash` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `agent_string_hash` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `exception_class_hash` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `exception_file_hash` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `exception_message_hash` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `exception_trace_hash` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `railtracker4_requests_uuid_unique` (`uuid`),
  KEY `railtracker4_requests_cookie_id_index` (`cookie_id`),
  KEY `railtracker4_requests_user_id_index` (`user_id`),
  KEY `railtracker4_requests_url_path_index` (`url_path`),
  KEY `railtracker4_requests_ip_address_index` (`ip_address`),
  KEY `railtracker4_requests_requested_on_index` (`requested_on`),
  KEY `railtracker4_requests_url_query_hash_index` (`url_query_hash`),
  KEY `railtracker4_requests_referer_url_query_hash_index` (`referer_url_query_hash`),
  KEY `railtracker4_requests_route_action_hash_index` (`route_action_hash`),
  KEY `railtracker4_requests_agent_string_hash_index` (`agent_string_hash`),
  KEY `railtracker4_requests_exception_class_hash_index` (`exception_class_hash`),
  KEY `railtracker4_requests_exception_file_hash_index` (`exception_file_hash`),
  KEY `railtracker4_requests_exception_message_hash_index` (`exception_message_hash`),
  KEY `railtracker4_requests_exception_trace_hash_index` (`exception_trace_hash`),
  KEY `railtracker4_requests_ip_address_requested_on_index` (`ip_address`,`requested_on`),
  KEY `railtracker4_requests_user_id_cookie_id_index` (`user_id`,`cookie_id`),
  CONSTRAINT `railtracker4_requests_agent_string_hash_foreign` FOREIGN KEY (`agent_string_hash`) REFERENCES `railtracker4_agent_strings` (`agent_string_hash`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `railtracker4_requests_exception_class_hash_foreign` FOREIGN KEY (`exception_class_hash`) REFERENCES `railtracker4_exception_classes` (`exception_class_hash`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `railtracker4_requests_exception_file_hash_foreign` FOREIGN KEY (`exception_file_hash`) REFERENCES `railtracker4_exception_files` (`exception_file_hash`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `railtracker4_requests_exception_message_hash_foreign` FOREIGN KEY (`exception_message_hash`) REFERENCES `railtracker4_exception_messages` (`exception_message_hash`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `railtracker4_requests_exception_trace_hash_foreign` FOREIGN KEY (`exception_trace_hash`) REFERENCES `railtracker4_exception_traces` (`exception_trace_hash`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `railtracker4_requests_referer_url_query_hash_foreign` FOREIGN KEY (`referer_url_query_hash`) REFERENCES `railtracker4_url_queries` (`url_query_hash`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `railtracker4_requests_route_action_hash_foreign` FOREIGN KEY (`route_action_hash`) REFERENCES `railtracker4_route_actions` (`route_action_hash`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `railtracker4_requests_url_query_hash_foreign` FOREIGN KEY (`url_query_hash`) REFERENCES `railtracker4_url_queries` (`url_query_hash`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_response_durations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_response_durations` (
  `response_duration_ms` bigint unsigned NOT NULL,
  UNIQUE KEY `railtracker4_response_durations_response_duration_ms_unique` (`response_duration_ms`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_response_status_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_response_status_codes` (
  `response_status_code` int unsigned NOT NULL,
  UNIQUE KEY `response_status_code_index` (`response_status_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_route_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_route_actions` (
  `route_action` varchar(840) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `route_action_hash` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `route_action_hash_index` (`route_action_hash`),
  KEY `route_action_index` (`route_action`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_route_names`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_route_names` (
  `route_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `route_name_index` (`route_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_url_domains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_url_domains` (
  `url_domain` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `url_domain_index` (`url_domain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_url_paths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_url_paths` (
  `url_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `url_path_index` (`url_path`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_url_protocols`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_url_protocols` (
  `url_protocol` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `url_protocol_index` (`url_protocol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker4_url_queries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker4_url_queries` (
  `url_query` varchar(1280) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `url_query_hash` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `url_query_hash_index` (`url_query_hash`),
  KEY `url_query_index` (`url_query`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker_content_last_engaged`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker_content_last_engaged` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `content_id` int NOT NULL,
  `parent_content_id` int DEFAULT NULL,
  `parent_playlist_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upp` (`user_id`,`parent_playlist_id`),
  KEY `upc` (`user_id`,`parent_content_id`),
  KEY `railtracker_content_last_engaged_user_id_index` (`user_id`),
  KEY `railtracker_content_last_engaged_content_id_index` (`content_id`),
  KEY `railtracker_content_last_engaged_parent_content_id_index` (`parent_content_id`),
  KEY `railtracker_content_last_engaged_parent_playlist_id_index` (`parent_playlist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker_content_last_engaged_seconds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker_content_last_engaged_seconds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `content_id` int NOT NULL,
  `resume_time_seconds` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `railtracker_content_last_engaged_seconds_user_content_index` (`user_id`,`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker_media_playback_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker_media_playback_sessions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `media_id` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `media_length_seconds` int unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `type_id` bigint unsigned NOT NULL,
  `seconds_played` bigint unsigned NOT NULL,
  `current_second` bigint unsigned NOT NULL,
  `started_on` datetime NOT NULL,
  `last_updated_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `railtracker_media_playback_sessions_uuid_unique` (`uuid`),
  KEY `railtracker_media_playback_sessions_media_id_index` (`media_id`),
  KEY `railtracker_media_playback_sessions_media_length_seconds_index` (`media_length_seconds`),
  KEY `railtracker_media_playback_sessions_user_id_index` (`user_id`),
  KEY `railtracker_media_playback_sessions_type_id_index` (`type_id`),
  KEY `railtracker_media_playback_sessions_seconds_played_index` (`seconds_played`),
  KEY `railtracker_media_playback_sessions_current_second_index` (`current_second`),
  KEY `railtracker_media_playback_sessions_started_on_index` (`started_on`),
  KEY `railtracker_media_playback_sessions_last_updated_on_index` (`last_updated_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `railtracker_media_playback_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `railtracker_media_playback_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `category` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `railtracker_media_playback_types_type_index` (`type`),
  KEY `railtracker_media_playback_types_category_index` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `rch_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rch_temp` (
  `id` int unsigned NOT NULL DEFAULT '0',
  `parent_id` int DEFAULT NULL,
  `child_id` int NOT NULL,
  `child_position` int NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_drumeo_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_drumeo_course` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `content_id` int DEFAULT NULL,
  `recommendation_rank` bigint DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`),
  KEY `content_id_index` (`content_id`),
  KEY `recommendation_rank_index` (`recommendation_rank`),
  KEY `user_id_rec_rank_index` (`user_id`,`recommendation_rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_drumeo_course_beginner_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_drumeo_course_beginner_items` (
  `id` int NOT NULL,
  `content_id` int NOT NULL,
  `rank` int NOT NULL,
  KEY `content_id_index` (`content_id`),
  KEY `rank_index` (`rank`),
  KEY `user_id_rec_rank_index` (`content_id`,`rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_drumeo_quick_tips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_drumeo_quick_tips` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `content_id` int DEFAULT NULL,
  `recommendation_rank` bigint DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`),
  KEY `content_id_index` (`content_id`),
  KEY `recommendation_rank_index` (`recommendation_rank`),
  KEY `user_id_rec_rank_index` (`user_id`,`recommendation_rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_drumeo_quick_tips_beginner_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_drumeo_quick_tips_beginner_items` (
  `id` int NOT NULL,
  `content_id` int NOT NULL,
  `rank` int NOT NULL,
  KEY `content_id_index` (`content_id`),
  KEY `rank_index` (`rank`),
  KEY `user_id_rec_rank_index` (`content_id`,`rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_drumeo_song`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_drumeo_song` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `content_id` int DEFAULT NULL,
  `recommendation_rank` bigint DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`),
  KEY `content_id_index` (`content_id`),
  KEY `recommendation_rank_index` (`recommendation_rank`),
  KEY `user_id_rec_rank_index` (`user_id`,`recommendation_rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_drumeo_song_beginner_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_drumeo_song_beginner_items` (
  `id` int NOT NULL,
  `content_id` int NOT NULL,
  `rank` int NOT NULL,
  KEY `content_id_index` (`content_id`),
  KEY `rank_index` (`rank`),
  KEY `user_id_rec_rank_index` (`content_id`,`rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_drumeo_workout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_drumeo_workout` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `content_id` int DEFAULT NULL,
  `recommendation_rank` bigint DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`),
  KEY `content_id_index` (`content_id`),
  KEY `recommendation_rank_index` (`recommendation_rank`),
  KEY `user_id_rec_rank_index` (`user_id`,`recommendation_rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_drumeo_workout_beginner_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_drumeo_workout_beginner_items` (
  `id` int NOT NULL,
  `content_id` int NOT NULL,
  `rank` int NOT NULL,
  KEY `content_id_index` (`content_id`),
  KEY `rank_index` (`rank`),
  KEY `user_id_rec_rank_index` (`content_id`,`rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_guitareo_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_guitareo_course` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `content_id` int DEFAULT NULL,
  `recommendation_rank` bigint DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`),
  KEY `content_id_index` (`content_id`),
  KEY `recommendation_rank_index` (`recommendation_rank`),
  KEY `user_id_rec_rank_index` (`user_id`,`recommendation_rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_guitareo_course_beginner_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_guitareo_course_beginner_items` (
  `id` int NOT NULL,
  `content_id` int NOT NULL,
  `rank` int NOT NULL,
  KEY `content_id_index` (`content_id`),
  KEY `rank_index` (`rank`),
  KEY `user_id_rec_rank_index` (`content_id`,`rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_guitareo_quick_tips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_guitareo_quick_tips` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `content_id` int DEFAULT NULL,
  `recommendation_rank` bigint DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`),
  KEY `content_id_index` (`content_id`),
  KEY `recommendation_rank_index` (`recommendation_rank`),
  KEY `user_id_rec_rank_index` (`user_id`,`recommendation_rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_guitareo_quick_tips_beginner_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_guitareo_quick_tips_beginner_items` (
  `id` int NOT NULL,
  `content_id` int NOT NULL,
  `rank` int NOT NULL,
  KEY `content_id_index` (`content_id`),
  KEY `rank_index` (`rank`),
  KEY `user_id_rec_rank_index` (`content_id`,`rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_guitareo_song`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_guitareo_song` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `content_id` int DEFAULT NULL,
  `recommendation_rank` bigint DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`),
  KEY `content_id_index` (`content_id`),
  KEY `recommendation_rank_index` (`recommendation_rank`),
  KEY `user_id_rec_rank_index` (`user_id`,`recommendation_rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_guitareo_song_beginner_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_guitareo_song_beginner_items` (
  `id` int NOT NULL,
  `content_id` int NOT NULL,
  `rank` int NOT NULL,
  KEY `content_id_index` (`content_id`),
  KEY `rank_index` (`rank`),
  KEY `user_id_rec_rank_index` (`content_id`,`rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_guitareo_workout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_guitareo_workout` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `content_id` int DEFAULT NULL,
  `recommendation_rank` bigint DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`),
  KEY `content_id_index` (`content_id`),
  KEY `recommendation_rank_index` (`recommendation_rank`),
  KEY `user_id_rec_rank_index` (`user_id`,`recommendation_rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_guitareo_workout_beginner_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_guitareo_workout_beginner_items` (
  `id` int NOT NULL,
  `content_id` int NOT NULL,
  `rank` int NOT NULL,
  KEY `content_id_index` (`content_id`),
  KEY `rank_index` (`rank`),
  KEY `user_id_rec_rank_index` (`content_id`,`rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_pianote_quick_tips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_pianote_quick_tips` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `content_id` int DEFAULT NULL,
  `recommendation_rank` bigint DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`),
  KEY `content_id_index` (`content_id`),
  KEY `recommendation_rank_index` (`recommendation_rank`),
  KEY `user_id_rec_rank_index` (`user_id`,`recommendation_rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_pianote_quick_tips_beginner_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_pianote_quick_tips_beginner_items` (
  `id` int NOT NULL,
  `content_id` int NOT NULL,
  `rank` int NOT NULL,
  KEY `content_id_index` (`content_id`),
  KEY `rank_index` (`rank`),
  KEY `user_id_rec_rank_index` (`content_id`,`rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_pianote_song`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_pianote_song` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `content_id` int DEFAULT NULL,
  `recommendation_rank` bigint DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`),
  KEY `content_id_index` (`content_id`),
  KEY `recommendation_rank_index` (`recommendation_rank`),
  KEY `user_id_rec_rank_index` (`user_id`,`recommendation_rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_pianote_song_beginner_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_pianote_song_beginner_items` (
  `id` int NOT NULL,
  `content_id` int NOT NULL,
  `rank` int NOT NULL,
  KEY `content_id_index` (`content_id`),
  KEY `rank_index` (`rank`),
  KEY `user_id_rec_rank_index` (`content_id`,`rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_pianote_workout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_pianote_workout` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `content_id` int DEFAULT NULL,
  `recommendation_rank` bigint DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`),
  KEY `content_id_index` (`content_id`),
  KEY `recommendation_rank_index` (`recommendation_rank`),
  KEY `user_id_rec_rank_index` (`user_id`,`recommendation_rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_pianote_workout_beginner_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_pianote_workout_beginner_items` (
  `id` int NOT NULL,
  `content_id` int NOT NULL,
  `rank` int NOT NULL,
  KEY `content_id_index` (`content_id`),
  KEY `rank_index` (`rank`),
  KEY `user_id_rec_rank_index` (`content_id`,`rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_singeo_quick_tips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_singeo_quick_tips` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `content_id` int DEFAULT NULL,
  `recommendation_rank` bigint DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`),
  KEY `content_id_index` (`content_id`),
  KEY `recommendation_rank_index` (`recommendation_rank`),
  KEY `user_id_rec_rank_index` (`user_id`,`recommendation_rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_singeo_quick_tips_beginner_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_singeo_quick_tips_beginner_items` (
  `id` int NOT NULL,
  `content_id` int NOT NULL,
  `rank` int NOT NULL,
  KEY `content_id_index` (`content_id`),
  KEY `rank_index` (`rank`),
  KEY `user_id_rec_rank_index` (`content_id`,`rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_singeo_song`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_singeo_song` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `content_id` int DEFAULT NULL,
  `recommendation_rank` bigint DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`),
  KEY `content_id_index` (`content_id`),
  KEY `recommendation_rank_index` (`recommendation_rank`),
  KEY `user_id_rec_rank_index` (`user_id`,`recommendation_rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_singeo_song_beginner_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_singeo_song_beginner_items` (
  `id` int NOT NULL,
  `content_id` int NOT NULL,
  `rank` int NOT NULL,
  KEY `content_id_index` (`content_id`),
  KEY `rank_index` (`rank`),
  KEY `user_id_rec_rank_index` (`content_id`,`rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_singeo_workout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_singeo_workout` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `content_id` int DEFAULT NULL,
  `recommendation_rank` bigint DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`),
  KEY `content_id_index` (`content_id`),
  KEY `recommendation_rank_index` (`recommendation_rank`),
  KEY `user_id_rec_rank_index` (`user_id`,`recommendation_rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recommendations_singeo_workout_beginner_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations_singeo_workout_beginner_items` (
  `id` int NOT NULL,
  `content_id` int NOT NULL,
  `rank` int NOT NULL,
  KEY `content_id_index` (`content_id`),
  KEY `rank_index` (`rank`),
  KEY `user_id_rec_rank_index` (`content_id`,`rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `referral_referrers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `referral_referrers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_program_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referrals_performed` smallint NOT NULL,
  `claimed_user_ids` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `referral_referrers_user_id_index` (`user_id`),
  KEY `referral_referrers_referral_program_id_index` (`referral_program_id`),
  KEY `referral_referrers_referral_code_index` (`referral_code`),
  KEY `referral_referrers_referral_link_index` (`referral_link`),
  KEY `referral_referrers_referrals_performed_index` (`referrals_performed`),
  KEY `referral_referrers_created_at_index` (`created_at`),
  KEY `referral_referrers_updated_at_index` (`updated_at`),
  KEY `referral_referrers_deleted_at_index` (`deleted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `revisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `revisions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revisionable_id` int NOT NULL,
  `revisionable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `old_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `new_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `payload` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `shopify_order_fixes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shopify_order_fixes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `original_shopify_order_id` bigint NOT NULL,
  `ecommerce_modelable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ecommerce_modelable_id` bigint unsigned NOT NULL,
  `shopify_order_price` decimal(8,2) NOT NULL,
  `shopify_order_currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `true_payment_amount` decimal(8,2) NOT NULL,
  `replacement_shopify_order_id` bigint DEFAULT NULL,
  `action_taken` enum('matched','replaced','failure') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('processing','cloned','paid','fulfilled','completed','evaluated') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'processing',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `processed_at` datetime NOT NULL,
  `is_fixed` tinyint(1) NOT NULL DEFAULT '0',
  `order_total_usd` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shopify_order_fixes_ecommerce_modelable_index` (`ecommerce_modelable_type`,`ecommerce_modelable_id`),
  KEY `shopify_order_fixes_original_shopify_order_id_index` (`original_shopify_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `shopify_syncs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shopify_syncs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `resource` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `started_at` timestamp NOT NULL,
  `finished_at` timestamp NULL DEFAULT NULL,
  `shopify_ids` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `size_charts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `size_charts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `chart` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sizes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `specs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `specs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `temp_lead_emails_nov_30_2021`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `temp_lead_emails_nov_30_2021` (
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  KEY `email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `temporary_customer_io_dupes_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `temporary_customer_io_dupes_table` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `customer_uuid` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `customer_workspace` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `customer_email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `time_dimension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `time_dimension` (
  `id` int NOT NULL,
  `db_date` date NOT NULL,
  `year` int NOT NULL,
  `month` int NOT NULL,
  `month_name` varchar(9) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `td_dbdate_idx` (`db_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `trial_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trial_sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desktop_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tablet_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int NOT NULL,
  `trailer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `upload_ecommerce_physical_products_export_stock_counts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `upload_ecommerce_physical_products_export_stock_counts` (
  `id` int DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `min_stock_level` int DEFAULT NULL,
  `auto_decrement_stock` binary(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user_abilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_abilities` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `ability` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_abilities_user_id_index` (`user_id`),
  KEY `user_abilities_ability_index` (`ability`),
  KEY `user_abilities_created_at_index` (`created_at`),
  KEY `user_abilities_updated_at_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user_access_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_access_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `permission_id` int unsigned NOT NULL,
  `product_id` int DEFAULT NULL,
  `source` enum('manual','web','access-code','challenges','apple','google','migration') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'manual',
  `source_hash` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime GENERATED ALWAYS AS ((case when (`time_lifetime` = 1) then cast((`start_time` + interval 50 year) as datetime) else cast(((`start_time` + interval `time_days` day) + interval `time_months` month) as datetime) end)) STORED,
  `time_minutes` int NOT NULL,
  `time_days` int NOT NULL,
  `time_months` int NOT NULL,
  `time_lifetime` tinyint(1) NOT NULL DEFAULT '0',
  `time_fixed` datetime DEFAULT NULL,
  `status` enum('active','revoked') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `revoked_at` timestamp NULL DEFAULT NULL,
  `manually_revoked` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `source_hash_unique` (`user_id`,`source`,`source_hash`),
  KEY `user_access_permissions_permission_id_foreign` (`permission_id`),
  KEY `user_access_permissions_user_id_index` (`user_id`),
  KEY `user_access_permissions_product_id_index` (`product_id`),
  KEY `start_time_index` (`start_time`),
  KEY `end_time_index` (`end_time`),
  KEY `start_end_time_index` (`start_time`,`end_time`),
  CONSTRAINT `user_access_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `railcontent_permissions` (`id`),
  CONSTRAINT `user_access_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `usora_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `role` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_roles_user_id_index` (`user_id`),
  KEY `user_roles_role_index` (`role`),
  KEY `user_roles_created_at_index` (`created_at`),
  KEY `user_roles_updated_at_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `permission_level` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_permission_level_index` (`permission_level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `usora_blocked_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usora_blocked_users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `blocker_id` int NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ub` (`user_id`,`blocker_id`),
  KEY `usora_blocked_users_user_id_index` (`user_id`),
  KEY `usora_blocked_users_blocker_id_index` (`blocker_id`),
  KEY `usora_blocked_users_created_on_index` (`created_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `usora_email_changes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usora_email_changes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'drumeo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usora_email_changes_user_id_unique` (`user_id`),
  KEY `usora_email_changes_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `usora_password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usora_password_resets` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usora_password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `usora_remember_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usora_remember_tokens` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `device_information` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usora_remember_tokens_user_id_index` (`user_id`),
  KEY `usora_remember_tokens_token_index` (`token`),
  KEY `usora_remember_tokens_expires_at_index` (`expires_at`),
  KEY `usora_remember_tokens_created_at_index` (`created_at`),
  KEY `usora_remember_tokens_updated_at_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `usora_reported_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usora_reported_users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `reporter_id` int NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ur` (`user_id`,`reporter_id`),
  KEY `usora_reported_users_user_id_index` (`user_id`),
  KEY `usora_reported_users_reporter_id_index` (`reporter_id`),
  KEY `usora_reported_users_created_on_index` (`created_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `usora_user_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usora_user_fields` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `key` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `index` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usora_user_fields_user_id_index` (`user_id`),
  KEY `usora_user_fields_key_index` (`key`),
  KEY `usora_user_fields_index_index` (`index`),
  KEY `usora_user_fields_created_at_index` (`created_at`),
  KEY `usora_user_fields_updated_at_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `usora_user_firebase_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usora_user_firebase_tokens` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `brand` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usora_user_firebase_tokens_user_id_index` (`user_id`),
  KEY `usora_user_firebase_tokens_created_at_index` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `usora_user_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usora_user_topics` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `topic` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usora_user_topics_user_id_index` (`user_id`),
  KEY `usora_user_topics_created_at_index` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `usora_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usora_users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `session_salt` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `region` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone_number` bigint DEFAULT NULL,
  `profile_picture_url` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `timezone` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `permission_level` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `last_used_brand` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `membership_level` enum('basic','plus') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `membership_start_date` timestamp NULL DEFAULT NULL,
  `membership_expiration_date` datetime DEFAULT NULL,
  `is_lifetime_member` tinyint(1) NOT NULL DEFAULT '0',
  `revenuecat_origin_app_user_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `is_drumeo_lifetime_member` tinyint(1) NOT NULL DEFAULT '0',
  `access_level` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `total_xp` int DEFAULT NULL,
  `brand_method_levels` json DEFAULT NULL,
  `brand_total_xp` json DEFAULT NULL,
  `brand_minutes_practiced` json DEFAULT NULL,
  `legacy_drumeo_id` int DEFAULT NULL,
  `legacy_pianote_id` int DEFAULT NULL,
  `legacy_guitareo_id` int DEFAULT NULL,
  `legacy_drumeo_wordpress_id` int DEFAULT NULL,
  `legacy_drumeo_ipb_id` int DEFAULT NULL,
  `piano_gear_keyboard_brands` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `piano_gear_piano_brands` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `piano_gear_photo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `piano_playing_since_year` int DEFAULT NULL,
  `guitar_gear_string_brands` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `guitar_gear_pedal_brands` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `guitar_gear_amp_brands` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `guitar_gear_guitar_brands` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `guitar_gear_photo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `guitar_playing_since_year` int DEFAULT NULL,
  `drums_gear_stick_brands` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `drums_gear_hardware_brands` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `drums_gear_set_brands` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `drums_gear_cymbal_brands` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `drums_gear_photo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `drums_playing_since_year` int DEFAULT NULL,
  `drumeo_onboarding_skip_setup` tinyint(1) NOT NULL DEFAULT '0',
  `pianote_onboarding_skip_setup` tinyint(1) NOT NULL DEFAULT '0',
  `guitareo_onboarding_skip_setup` tinyint(1) NOT NULL DEFAULT '0',
  `singeo_onboarding_skip_setup` tinyint(1) NOT NULL DEFAULT '0',
  `drumeo_trial_section_hide` tinyint(1) NOT NULL DEFAULT '0',
  `pianote_trial_section_hide` tinyint(1) NOT NULL DEFAULT '0',
  `guitareo_trial_section_hide` tinyint(1) NOT NULL DEFAULT '0',
  `singeo_trial_section_hide` tinyint(1) NOT NULL DEFAULT '0',
  `notify_on_lesson_comment_like` tinyint(1) NOT NULL DEFAULT '1',
  `notifications_summary_frequency_minutes` int DEFAULT NULL,
  `notify_on_forum_post_reply` tinyint(1) NOT NULL DEFAULT '1',
  `notify_on_forum_followed_thread_reply` tinyint(1) NOT NULL DEFAULT '1',
  `notify_on_forum_post_like` tinyint(1) NOT NULL DEFAULT '1',
  `notify_weekly_update` tinyint(1) NOT NULL DEFAULT '1',
  `notify_on_lesson_comment_reply` tinyint(1) NOT NULL DEFAULT '1',
  `send_mobile_app_push_notifications` tinyint(1) NOT NULL DEFAULT '1',
  `send_email_notifications` tinyint(1) NOT NULL DEFAULT '1',
  `use_legacy_video_player` tinyint(1) NOT NULL DEFAULT '0',
  `drums_skill_level` int DEFAULT NULL,
  `guitar_skill_level` int DEFAULT NULL,
  `piano_skill_level` int DEFAULT NULL,
  `drumeo_ship_magazine` tinyint(1) DEFAULT NULL,
  `magazine_shipping_address_id` int DEFAULT NULL,
  `ios_latest_review_display_date` timestamp NULL DEFAULT NULL,
  `ios_count_review_display` int NOT NULL DEFAULT '0',
  `google_latest_review_display_date` timestamp NULL DEFAULT NULL,
  `google_count_review_display` int NOT NULL DEFAULT '0',
  `biography` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `support_note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `singing_since_year` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `singing_gear_mic_brands` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `singing_gear_photo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `is_pack_owner` tinyint(1) NOT NULL DEFAULT '0',
  `shopify_id` bigint DEFAULT NULL,
  `has_recharge_subscription` tinyint(1) NOT NULL DEFAULT '0',
  `recharge_interval` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `has_apple_subscription` tinyint(1) NOT NULL DEFAULT '0',
  `has_google_subscription` tinyint(1) NOT NULL DEFAULT '0',
  `requires_password_update` tinyint(1) NOT NULL DEFAULT '0',
  `cio_synced_workspaces` int DEFAULT NULL,
  `recharge_renewal_date` datetime DEFAULT NULL,
  `trial_expiration_date` datetime DEFAULT NULL,
  `is_trial` tinyint(1) NOT NULL DEFAULT '0',
  `legacy_expiration_date` datetime DEFAULT NULL,
  `needs_logout` tinyint(1) NOT NULL DEFAULT '0',
  `primary_brand` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_email` (`email`),
  KEY `usora_users_display_name_index` (`display_name`),
  KEY `usora_users_created_at_index` (`created_at`),
  KEY `usora_users_gender_index` (`gender`),
  KEY `usora_users_notify_on_lesson_comment_reply_index` (`notify_on_lesson_comment_reply`),
  KEY `usora_users_last_used_brand_index` (`last_used_brand`),
  KEY `usora_users_membership_expiration_date_index` (`membership_expiration_date`),
  KEY `usora_users_is_lifetime_member_index` (`is_lifetime_member`),
  KEY `usora_users_revenuecat_origin_app_user_id_index` (`revenuecat_origin_app_user_id`),
  KEY `usora_users_shopify_id_index` (`shopify_id`),
  KEY `usora_users_trial_expiration_date_index` (`trial_expiration_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `webhooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `webhooks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contents` text COLLATE utf8mb4_unicode_ci,
  `job_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `webhooks_source_source_id_index` (`source`,`source_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `weekly_user_statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `weekly_user_statistics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `week` date NOT NULL,
  `user_id` int NOT NULL,
  `last_used_brand` enum('drumeo','pianote','guitareo','singeo','musora','basseo','none') COLLATE utf8mb4_unicode_ci NOT NULL,
  `most_content_starts_brand` enum('drumeo','pianote','guitareo','singeo','musora','basseo','none') COLLATE utf8mb4_unicode_ci NOT NULL,
  `count_of_content_starts_drumeo` int NOT NULL,
  `count_of_content_starts_pianote` int NOT NULL,
  `count_of_content_starts_guitareo` int NOT NULL,
  `count_of_content_starts_singeo` int NOT NULL,
  `count_of_content_starts_basseo` int NOT NULL,
  `count_of_content_starts_musora` int NOT NULL,
  `access_type` enum('plus','basic') COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_frequency` enum('1 month','2 month','3 month','6 month','5 year','1 year','lifetime','other','trial') COLLATE utf8mb4_unicode_ci NOT NULL,
  `in_trial_period` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `generated_at` datetime NOT NULL,
  `started` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `weekly_user_statistics_week_index` (`week`),
  KEY `weekly_user_statistics_user_id_index` (`user_id`),
  KEY `weekly_user_statistics_last_used_brand_index` (`last_used_brand`),
  KEY `weekly_user_statistics_most_content_starts_brand_index` (`most_content_starts_brand`),
  KEY `weekly_user_statistics_count_of_content_starts_drumeo_index` (`count_of_content_starts_drumeo`),
  KEY `weekly_user_statistics_count_of_content_starts_pianote_index` (`count_of_content_starts_pianote`),
  KEY `weekly_user_statistics_count_of_content_starts_guitareo_index` (`count_of_content_starts_guitareo`),
  KEY `weekly_user_statistics_count_of_content_starts_singeo_index` (`count_of_content_starts_singeo`),
  KEY `weekly_user_statistics_count_of_content_starts_basseo_index` (`count_of_content_starts_basseo`),
  KEY `weekly_user_statistics_count_of_content_starts_musora_index` (`count_of_content_starts_musora`),
  KEY `weekly_user_statistics_access_type_index` (`access_type`),
  KEY `weekly_user_statistics_in_trial_period_index` (`in_trial_period`),
  KEY `weekly_user_statistics_active_index` (`active`),
  KEY `weekly_user_statistics_expired_index` (`expired`),
  KEY `weekly_user_statistics_generated_at_index` (`generated_at`),
  KEY `weekly_user_statistics_access_frequency_index` (`access_frequency`),
  KEY `weekly_user_statistics_started_index` (`started`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2,'2017_06_19_172849_create_content_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3,'2017_06_19_172850_create_content_hierarchy_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4,'2017_06_19_172851_create_content_versions_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5,'2017_06_19_172853_create_content_fields_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6,'2017_06_19_172855_create_content_data_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7,'2017_09_07_060314_create_permissions_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8,'2017_09_07_061740_create_content_permissions_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9,'2017_09_13_121130_create_user_content_progress_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10,'2017_11_09_061318_create_comments_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11,'2017_11_14_094949_create_comment_assignment_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12,'2017_11_20_073350_create_search_indexes',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13,'2017_12_15_223526_add_content_status_to_search_indexes',2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (14,'2017_12_18_225351_add_permission_level_to_users',3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (15,'2017_12_21_170908_add_created_on_to_content_hierarchy',4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (16,'2018_03_06_184530_add_sort_column_to_content_table',5);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (17,'2018_04_03_180854_create_sessions_table',6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (18,'2018_04_30_185531_add_updated_on_index_to_user_content_progress_table',7);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (19,'2018_02_09_082532_create_product_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (20,'2018_02_09_092849_create_order_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (21,'2018_02_09_093172_create_order_item_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (22,'2018_02_09_101961_create_address_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (23,'2018_02_09_102974_create_customer_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (24,'2018_02_09_110012_create_order_payment_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (25,'2018_02_09_112075_create_payment_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (26,'2018_02_09_113014_create_payment_method_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (27,'2018_02_09_113121_create_credit_card_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (28,'2018_02_09_114181_create_refund_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (29,'2018_02_09_120124_create_subscription_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (30,'2018_02_09_131114_create_subscription_payment_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (31,'2018_02_09_133815_create_discount_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (32,'2018_02_09_140246_create_discount_criteria_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (33,'2018_02_09_140721_create_order_discount_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (34,'2018_02_09_158157_create_order_item_fulfillment_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (35,'2018_02_09_161815_create_shipping_option_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (36,'2018_02_09_162209_create_shipping_costs_weight_range_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (37,'2018_03_02_073909_create_paypal_billing_agreement_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (38,'2018_03_05_151243_create_customer_payment_methods_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (39,'2018_03_05_160012_create_user_payment_methods_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (40,'2018_03_13_074935_create_user_abilities_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (41,'2018_03_15_135323_create_user_roles_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (42,'2018_04_05_172852_usora_create_users_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (43,'2018_04_16_110842_create_payment_gateways_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (44,'2018_04_17_172853_usora_create_password_resets_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (45,'2018_04_26_184534_create_comment_likes_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (46,'2018_05_09_172937_usora_create_user_fields_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (47,'2018_05_16_144917_create_email_change_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (48,'2017_01_20_182407_create_forum_table_categories',9);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (49,'2017_01_20_182415_create_forum_table_threads',9);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (50,'2017_01_20_182418_create_forum_table_posts',9);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (51,'2017_01_20_182443_create_forum_table_thread_reads',9);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (52,'2017_01_26_182643_create_forum_table_post_likes',9);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (53,'2017_02_27_184924_create_forum_thread_follows',9);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (54,'2017_03_10_181815_create_forums_table_post_reports',9);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (55,'2018_05_31_083510_create_forums_table_post_replies',9);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (56,'2018_06_26_192412_add_deleted_on_columns',10);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (57,'2018_06_26_195412_delete_payment_gateways_table',10);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (58,'2018_07_24_145433_optimize_content_indexes',11);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (59,'2018_06_05_105551_create_forums_table_search_indexes',12);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (60,'2018_06_29_081215_create_user_permissions_table',13);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (61,'2018_07_24_145433_optimize_user_permission_indexes',13);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (62,'2018_08_02_195455_optimize_user_content_progress_indexes',13);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (63,'2018_08_02_195455_remove_user_content_fields_key_index',14);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (64,'2018_09_25_204530_add_brand_column_to_content_permissions_table',15);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (65,'2018_09_25_160012_create_user_product_table',16);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (66,'2018_09_26_151445_add_product_id_on_discount',16);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (67,'2018_10_15_206399_add_user_permissions_unique_index',16);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (68,'2018_10_19_151445_add_visible_to_dicounts_table',17);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (69,'2018_11_02_072133_create_access_codes_table',17);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (70,'2018_11_06_072133_create_subscription_access_code_table',17);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (71,'2018_10_18_472992_create_user_points_table',18);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (72,'2018_11_20_081417_add_category_to_product_table',19);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (73,'2018_11_20_091542_add_product_category_to_discounts_table',19);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (74,'2018_11_22_209488_create_content_likes_table',19);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (75,'2018_10_04_000000_db_maintenance_table',20);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (76,'2019_02_21_458248_add_brand_to_categories_table',20);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (77,'2019_02_21_473462_drop_user_content_progress_unique_index',20);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (78,'2018_12_18_122409_add_updated_at_on_email_change_table',21);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (79,'2019_01_15_142883_add_core_columns_to_users_table',21);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (80,'2019_01_21_13468_add_core_brand_columns_to_users_table',21);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (81,'2019_02_07_16144_remember_tokens_table',21);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (82,'2019_02_20_19885_add_notification_summary_frequency_to_users_table',21);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (83,'2019_04_24_136492_remove_slow_created_published_content_indexes',22);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (84,'2019_04_23_160727_create_add_event_table',23);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (85,'2019_01_10_449371_rename_datetime_columns',24);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (86,'2019_02_06_069221_update_payment_table',24);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (87,'2019_02_06_174936_update_due_columns_order_table',24);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (88,'2019_02_06_911282_update_order_item_table',24);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (89,'2019_02_08_182234_update_subscriptions_table',24);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (90,'2019_03_19_538202_pluralize_tables',24);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (91,'2019_03_25_093475_make_sku_unique_product_table',24);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (92,'2019_04_10_188372_create_user_stripe_customer_ids_table',24);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (93,'2019_04_29_083723_add_soft_delete_columns',24);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (94,'2019_05_02_085255_update_stripe_customer_id_column_user_stripe_customer_ids_table',24);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (95,'2019_05_09_092383_split_method_id_for_payment_methods_table',24);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (96,'2019_05_13_167343_add_gateway_to_payments_table',24);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (97,'2019_05_15_294931_add_note_column_to_tables',24);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (98,'2019_05_22_384753_add_tax_column_to_subscriptions_table',24);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (99,'2019_06_04_973241_change_comments_collation',25);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (100,'2019_06_04_973241_change_comments_collation',25);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (101,'2019_05_31_082214_create_discount_criterias_products_table',26);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (102,'2019_06_03_124800_update_products_relation_discount_criteria_table',26);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (103,'2019_06_04_104458_rename_state_region_address_table',26);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (104,'2019_06_28_065719_create_ecommerce_payment_taxes_table',26);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (105,'2019_07_04_112019_add_placed_by_user_id_to_orders_table',26);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (106,'2019_07_10_075735_create_apple_receipts_table',26);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (107,'2019_07_11_071100_add_external_app_store_id_to_subscriptions_table',26);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (108,'2019_07_16_081913_create_google_receipts_table',26);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (109,'2019_07_17_081941_add_apple_expiration_date_to_subscriptions_table',26);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (110,'2019_07_22_115949_add_expiration_date_to_discounts_table',26);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (111,'2019_07_23_103057_create_actions_log_table',26);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (112,'2019_08_05_112105_add_deleted_at_to_user_products_table',26);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (113,'2019_09_06_279352_add_payment_gateway_to_stripe_customers_table',27);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (114,'2019_09_12_219042_fix_comment_reply_notification_setting_users_table',28);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (115,'2019_09_12_219042_fix_comment_reply_notification_setting_users_table',28);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (116,'2019_08_01_145219_create_request_association_tables',29);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (117,'2019_09_30_102300_create_media_tracking_tables',29);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (118,'2019_10_03_118432_extend_ip_location_columns_in_requests_table',29);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (119,'2019_10_03_128492_extend_ip_location_columns_in_linked_tables',29);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (120,'2019_10_07_294732_add_support_note_column_to_users_table',30);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (121,'2019_10_22_158293_create_request_association_tables',31);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (122,'2019_10_22_166211_create_media_tracking_tables',31);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (123,'2019_11_06_080334_add_failed_payment_to_subscriptions_table',32);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (124,'2019_11_11_152230_add_higher_key_progress_to_user_content_progress_table',33);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (125,'2019_11_07_080639_add_transaction_id_to_apple_receipts_table',34);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (126,'2019_11_21_073046_add_auto_decrement_stock_to_products_table',34);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (127,'2019_11_21_105514_add_total_xp_to_content_table',35);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (128,'2019_12_23_102327_add_cancellation_reason',36);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (129,'2020_01_15_081514_add_order_id_to_google_receipts_table',37);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (130,'2020_01_27_189342_make_email_unique_users_table',38);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (131,'2020_01_27_094732_add_raw_receipts_to_iap_tables',39);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (132,'2020_01_23_135710_create_content_statistics_table',40);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (133,'2020_02_12_073149_add_stats_epoch_to_content_statistics_table',41);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (134,'2020_02_13_073715_add_paypal_recurring_profile_id_to_subscriptions_table',42);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (135,'2020_02_24_074521_create_membership_stats_table',43);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (136,'2020_03_03_197482_create_leads_table',44);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (137,'2020_03_03_094732_add_purchase_type_to_google_receipt_table',45);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (138,'2020_03_04_094732_add_purchase_type_to_apple_receipt_table',45);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (139,'2020_03_06_074111_add_brand_to_membership_stats_table',46);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (140,'2020_03_11_140137_create_retention_stats_table',47);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (141,'2020_03_25_114732_add_firebase_token_columns_to_users_table',48);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (142,'2020_03_31_184344_create_mewsora_table',49);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (143,'2020_03_16_123456_create_geo_ip_fix_temp_library_table',50);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (144,'2020_04_02_191853_remove_retention_stats_table',51);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (145,'2020_04_08_112937_usora_create_user_tokens_table',52);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (146,'2020_04_08_114732_drop_firebase_token_columns_from_users_table',52);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (147,'2020_03_27_071300_add_renewal_attempt_to_subscriptions_table',53);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (148,'2020_03_30_124748_add_stopped_to_subscriptions_table',53);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (149,'2020_04_07_123113_add_deleted_at_to_products_table',53);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (150,'2020_04_14_110440_add_attempt_number_to_payments_table',53);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (151,'2020_04_27_597335_add_ip_address_requested_on_index',54);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (152,'2020_05_14_427734_add_legacy_video_player_toggle_setting_to_users_table',55);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (153,'2020_05_27_087734_add_app_reviews_date_to_users_table',56);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (154,'2020_06_05_080639_add_notification_request_data_to_apple_receipts_table',57);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (155,'2020_06_18_094823_add_magazine_shipment_options_to_users_table',58);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (156,'2020_07_09_487273_user_content_progress_index_c_u',59);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (157,'2020_07_24_895734_add_membership_actions_table',60);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (158,'2020_07_27_883321_add_paused_until_to_user_product_table',60);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (159,'2020_07_28_847732_add_action_reason_to_membership_actions_table',61);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (160,'2020_07_28_847732_change_action_reason_to_string_membership_actions_table',62);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (161,'2020_07_29_583732_change_note_to_nullable_membership_actions_table',63);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (162,'2020_08_21_859273_add_comment_conversation_status',64);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (163,'2020_10_06_050112_add_index_to_sessions_table',65);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (164,'2020_10_07_133789_add_user_id_cookie_id_index',66);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (165,'2020_10_09_155800_add_user_id_brand_points_index',67);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (166,'2020_06_09_182937_usora_create_user_topics_table',68);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (167,'2020_06_09_187734_add_skill_level_to_users_table',68);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (168,'2020_07_22_100412_add_brand_to_user_topics_table',68);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (169,'2020_10_22_130241_add_brand_to_usora_user_firebase_tokens_table',68);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (170,'2017_02_24_181248_create_notifications_table',69);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (171,'2017_02_24_181346_create_notification_broadcasts_table',69);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (172,'2019_08_30_546891_change_post_text_collation_for_emoji_support',69);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (173,'2020_01_13_19388_add_main_indexes_table',69);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (174,'2020_04_23_083311_create_notification_settings_table',69);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (175,'2020_04_28_181124_add_brand_to_notification_setting_table',69);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (176,'2020_09_17_195514_add_brand_to_notifications_table',69);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (177,'2020_11_17_100113_add_sales_page_url_to_products_table',70);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (178,'2020_12_03_842735_add_fulfillment_sku_to_products_table',71);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (179,'2021_01_07_090112_drop_content_id_unique_index_from_add_event_table',72);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (180,'2021_02_01_093459_add_simple_indexes_to_apple_receipt_table',73);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (181,'2021_02_12_112732_add_local_price_and_currency_to_apple_receipt_table',74);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (182,'2021_02_12_112732_add_local_price_and_currency_to_google_receipt_table',74);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (183,'2021_05_19_196317_make_maropost_tag_nullable',75);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (184,'2021_05_19_196317_make_maropost_tag_nullable',75);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (185,'2021_05_19_196317_make_maropost_tag_nullable',75);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (186,'2021_05_20_134361_create_customer_id_table',75);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (187,'2021_06_08_141892_add_user_id_to_customers_table',76);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (188,'2021_06_17_225831_create_jobs_table',76);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (189,'2021_06_17_225902_create_failed_jobs_table',76);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (190,'2021_07_05_84459_add_inventory_control_sku_to_products_table',77);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (191,'2021_06_25_739742_user_content_progress_add_started_completed_on_columns',78);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (192,'2021_07_20_572731_add_apple_receipt_index',79);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (193,'2021_07_23_125007_create_helpscout_customers_table',80);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (194,'2021_09_23_124131_update_cc_last_digits',81);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (195,'2021_09_23_124131_update_cc_last_digits',81);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (196,'2021_09_23_124131_update_cc_last_digits',81);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (197,'2021_10_15_135710_create_content_follows_table',82);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (198,'2021_10_21_223526_add_content_instructors_to_search_indexes',82);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (199,'2021_10_21_223526_add_popularity_to_content',82);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (200,'2021_07_30_195514_add_author_and_content_to_notifications_table',83);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (201,'2021_09_08_546891_change_comment_collation_for_emoji_support',83);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (202,'2022_03_17_245678_temporary_customer_io_dupes_table',84);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (203,'2022_02_03_000000_update_ecommerce_product',85);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (204,'2022_03_31_000000_add_aux_to_discounts_table',86);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (205,'2022_05_26_130241_add_send_notifications_type_to_usora_users_table',87);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (206,'2022_08_09_000000_add_min_stock_level_to_ecommerce_product',88);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (207,'2018_01_01_000000_create_action_events_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (208,'2019_05_10_000000_add_fields_to_action_events_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (209,'2019_12_14_000001_create_personal_access_tokens_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (210,'2021_08_25_193039_create_nova_notifications_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (211,'2022_04_05_0827521_create_content_tag_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (212,'2022_04_05_08352723_create_content_key_pitch_type_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (213,'2022_04_05_08352723_create_content_key_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (214,'2022_04_05_106129_add_core_columns_to_content_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (215,'2022_04_05_1321523_create_content_exercise_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (216,'2022_04_05_1321523_create_content_instructor_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (217,'2022_04_05_1321523_create_content_playlist_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (218,'2022_04_05_1321523_create_content_styles_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (219,'2022_04_05_1321523_create_content_topic_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (220,'2022_04_06_08352723_create_content_focus_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (221,'2022_04_06_1421523_create_content_bpm_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (222,'2022_04_07_180210_create_usora_users_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (223,'2022_04_07_180222_create_usora_email_changes_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (224,'2022_04_07_180222_create_usora_password_resets_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (225,'2022_04_07_180222_create_usora_remember_tokens_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (226,'2022_04_07_180222_create_usora_user_firebase_tokens_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (227,'2022_04_11_08002723_create_user_playlists_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (228,'2022_04_11_1121523_create_content_user_playlist_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (229,'2022_04_11_149582_add_updated_at_to_usora_remember_tokens_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (230,'2022_04_12_152671_add_last_used_brand_to_users_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (231,'2022_04_12_221955_create_permission_tables',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (232,'2022_04_22_163572_add_access_and_xp_and_level_columns_to_users_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (233,'2022_04_26_000000_add_fields_to_nova_notifications_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (234,'2022_05_17_175281_add_membership_expiration_date_to_users_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (235,'2022_06_01_282187_add_url_count_position_columns_to_content_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (236,'2022_06_09_582831_add_date_indexes_to_content_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (237,'2022_06_16_000000_add_singing_gear_columns_to_users_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (238,'2022_06_16_972341_add_parent_data_column_to_content_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (239,'2022_06_17_000000_create_onboarding_tables',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (240,'2022_07_05_000000_add_is_pack_owner_column_to_users_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (241,'2022_07_12_000000_add_onboarding_skip_attributes_to_users_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (242,'2022_07_21_215502_create_mentor_tables',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (243,'2022_08_03_857314_add_compiled_view_data_column_to_content_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (244,'2022_08_15_643464_create_helpscout_users_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (245,'2022_08_18_000000_create_onboarding_answer_history_table',89);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (246,'2021_10_11_081852_create_referral_referrers_table',90);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (247,'2022_08_04_272234_add_brand_column_to_referral_referrers_table',90);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (248,'2017_01_10_182407_rename_legacy_tables',91);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (249,'2021_04_01_080924_add_topic_to_categories_table',91);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (250,'2021_04_02_080998_add_icon_to_categories_table',91);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (251,'2021_04_07_184303_create_forums_table_user_signature',91);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (252,'2021_05_20_182912_change_forums_posts_content',91);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (253,'2021_06_04_546891_change_search_indexes_text_collation_for_emoji_support',91);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (254,'2021_07_19_080998_add_published_on_to_search_indexes_table',91);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (255,'2021_07_20_583912_add_indexes_to_core_tables',91);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (256,'2021_09_14_578273_add_unique_key_to_search_index_table',91);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (257,'2022_05_31_572303_change_remaining_search_indexes_text_collation_for_emoji_support',91);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (258,'2022_09_19_080998_add_last_post_id_and_post_count',91);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (259,'2022_19_09_000000_add_brand_column_to_usora_email_changes_table',91);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (260,'2022_09_30_080998_change_search_index_high_value_to_text',92);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (261,'2022_10_07_063572_add_total_xp_brand_to_users_table',93);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (262,'2022_10_05_174928_create_job_batches_table',94);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (263,'2022_10_05_214543_unify_subscriptions_archive',94);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (264,'2022_10_13_531724_change_notifications_text_columns_to_medium',95);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (265,'2022_10_13_531724_change_notifications_text_columns_to_medium',95);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (266,'2022_10_14_123532_add_minutest_practiced_to_users_table',96);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (267,'2022_10_18_104414_add_instrument_to_content_table',96);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (268,'2022_11_25_000000_add_instrumentless_to_content_table',97);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (269,'2022_12_01_000000_update_apple_receipts',98);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (270,'2022_04_20_225723_create_brands_table',99);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (271,'2022_04_20_225811_create_product_types_table',100);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (272,'2022_04_20_225822_create_products_table',101);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (273,'2022_04_28_185249_create_features_table',102);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (274,'2022_05_04_172019_create_specs_table',103);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (275,'2022_05_09_213518_create_images_table',104);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (276,'2022_05_10_211821_create_sizes_table',105);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (277,'2022_06_06_230803_create_size_charts_table',106);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (278,'2022_06_08_213222_create_product_sizes_table',107);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (279,'2022_06_22_002935_create_bundles_table',108);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (280,'2022_08_10_221807_create_benefits_table',109);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (281,'2022_12_05_1121523_create_user_requested_songs_table',110);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (282,'product_revisions',111);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (283,'2022_12_29_194423_add_membership_level_to_users_table',112);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (284,'2023_01_05_122831_add_video_indexes_to_content_table',113);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (285,'2023_01_06_104414_add_external_video_id_to_content_table',114);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (286,'2023_01_05_212638_create_carousels_table',115);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (287,'2023_01_13_100000_add_is_drumeo_lifetime_member_column_to_users_table',116);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (288,'2023_01_17_225439_products_table_update',117);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (289,'2023_01_18_230826_product_sku_update',118);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (290,'2023_01_24_203323_product_add_isseasonal',119);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (291,'2023_02_03_205106_product_add_membership_expiration_date',120);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (292,'2023_01_18_184945_carousel-table-updates',121);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (293,'2023_02_06_194602_carousel-more-updates',121);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (294,'2023_02_09_225834_carousel-title-nullable',122);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (295,'2022_12_19_000000_create_field_attachments_table',123);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (296,'2023_02_16_084534_create_reported_comments_table',124);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (297,'2023_02_16_120000_create_reported_users_table',124);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (298,'2023_01_11_174104_create_leadgen_lessons_table',125);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (299,'2023_01_11_175212_create_leadgen_lesson_assets_table',125);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (300,'2023_01_11_180516_create_leadgens_table',125);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (301,'2023_01_25_221019_create_leadgen_lesson_assignments_table',125);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (302,'2023_03_01_120000_create_blocked_users_table',126);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (303,'2023_02_22_000000_add_source_to_access_codes_table',127);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (304,'2023_04_12_000000_increase_payment_taxes_decimal_places',128);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (305,'2023_04_14_155543_leadgen_add_bg_img',129);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (306,'2023_04_21_173021_apple_receipts_index',130);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (307,'2023_04_24_053631_railtracker_requests_index_cleanup',131);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (308,'2023_04_25_194210_railtracker_requests_index_cleanup2',132);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (309,'2023_04_25_213144_railtracker_requests_index_cleanup3',133);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (310,'2023_03_08_203203_carousel_v2',134);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (311,'2023_04_10_112638_create_cohorts_table',134);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (312,'2023_04_14_165408_update_cohorts_table',134);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (313,'2023_04_18_102208_update_cohorts_table_2',134);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (314,'2023_04_21_132208_update_cohorts_table_3',134);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (315,'2023_05_19_175841_add_event_calendars',135);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (316,'2023_05_10_215550_leadgens_visibility',136);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (317,'2023_05_16_211655_carousel_title_color',136);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (318,'2023_05_17_152502_cohort_thread_id_nullable',136);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (319,'2023_05_26_205307_products_sales_page_visible',137);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (320,'2022_12_12_080000_add_playlists_data_to_playlists_table',138);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (321,'2023_02_02_083400_add_brand_on_playlists_like_table',138);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (322,'2023_02_13_163400_add_last_progress_on_playlists_table',138);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (323,'2023_03_07_113400_add_parent_id_on_playlists_table',138);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (324,'2023_03_07_113400_remove_parent_id_from_playlists_table',138);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (325,'2023_05_04_166211_create_content_last_engaged_table',138);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (326,'2023_05_04_210648_railtracker_content_last_engaged_seconds',138);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (327,'2023_06_13_080234_create_reported_playlists_table',138);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (328,'2023_06_08_152612_carousel_primary_video',139);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (329,'2023_06_09_181926_carousel_description_optional',139);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (330,'2023_06_23_163400_add_name_on_playlist_item_table',140);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (331,'2023_06_26_199312_add_deleted_at_parent_id_index_to_comments_table',141);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (332,'2023_06_26_041154_railtracker_ip',142);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (333,'2023_06_28_175740_leadgen_index_view',143);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (334,'2023_06_07_112638_create_cohort_list_table',144);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (335,'2023_07_07_152502_cohort_trailers',144);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (336,'2023_07_10_152727_cohort-demo-section',144);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (337,'2023_07_13_152727_cohort-timeline-section',144);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (338,'2023_07_13_184955_cohort-benefits',144);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (339,'2023_08_01_204923_paypal_billing_aggreement_legacy',145);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (340,'2023_08_01_204955_stripe_subscription_legacy',146);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (341,'2023_08_08_000000_add_ecommerce_shopify_id',147);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (342,'2023_06_28_104232_update_user_table_add_membership_start_date',148);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (343,'2023_06_21_182339_carousel_web_app_option',149);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (344,'2023_09_13_094955_carousel_mobile_version',149);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (345,'2023_09_22_094955_carousel_mobile_version_above',149);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (346,'2023_09_11_100000_add_revenuecat_original_app_user_id_column_to_users_table',150);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (347,'2023_09_27_000000_create_onboarding_goals_table',150);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (348,'2023_08_08_135027_add_shopify_id',151);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (349,'2023_08_10_202740_create_shopify_syncs_table',151);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (350,'2023_08_28_162333_add_shopify_id_to_permissions',151);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (351,'2023_09_19_161817_ecommerce_user_permissions',151);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (352,'2023_09_20_000000_add_ecommerce_payments_shopify_id',151);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (353,'2023_09_25_000000_add_ecommerce_subscription_payments_shopify_id',151);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (354,'2023_09_25_181339_update_user_access_permissions_source_column',151);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (355,'2023_09_27_162333_remove_shopify_id_from_permissions',151);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (356,'2023_10_04_215803_add_subscription_type_to_user',151);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (357,'2023_10_10_000000_add_index_to_address_and_order_item_shopify_id',151);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (358,'2023_10_11_215550_access_permission_revoke_date',151);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (359,'2023_10_17_174832_update_access_permissions',151);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (360,'2023_10_17_192422_update_access_permissions_source',151);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (361,'2023_10_17_216558_update_access_permissions',151);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (362,'2023_10_31_112510_access_permission_time_minutes',152);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (363,'2023_11_01_043023_user_customerio_flags',152);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (364,'2023_11_02_053121_cio_unique_constraint',152);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (365,'2023_11_04_222532_permissions_fixed',152);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (366,'2023_10_24_224215_user_default_password',153);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (367,'2023_11_07_232549_cio_synced_workspaces',153);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (368,'2023_11_27_213419_recharge_renewal_date',154);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (369,'2023_11_06_150443_increase_search_indexes_content_instructors_length',155);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (370,'2023_12_01_170401_user_permissions_access_product_id',156);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (371,'2023_11_06_162611_carousel_challenges_columns',157);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (372,'2023_12_12_062611_carousel_challenge_id_column',157);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (373,'2023_12_14_213430_carousel_featured_product_show_on_homepage',157);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (374,'2024_01_04_102532_enrollment_dates_on_content',158);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (375,'2024_01_05_102532_enrollment_dates_index_content',158);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (376,'2024_01_11_132929_add_shopify_id_index',159);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (377,'2024_01_22_100000_add_trial_expiration_date_to_users_table',160);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (378,'2024_01_19_212638_create_trial_section_table',161);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (379,'2024_01_23_000000_add_trial_section_hide_attributes_to_users_table',161);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (380,'2024_02_07_2176054_legacy_expiration_date',162);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (381,'2024_02_05_213430_carousel_featured_product_show_on_workouts',163);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (382,'2024_02_07_150228_add_needs_logout_to_usora_users',164);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (383,'2024_01_08_102532_filter_v2_tables',165);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (384,'2024_02_15_102532_filter_v2_gear_table',165);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (385,'2024_02_15_152532_filter_v2_genre_table',165);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (386,'2024_02_28_233012_add_features_tables',166);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (387,'2024_02_05_204653_comment_assigned_moderator',167);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (388,'2024_03_26_112650_access_permission_time_manual_revoke',168);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (389,'2024_04_04_085831_create_artists_table',169);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (390,'2024_04_08_085831_create_genre_table',169);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (391,'2024_03_25_113430_cohort_template_updates_03_2024',170);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (392,'2024_04_02_013430_cohort_prices_not_required_2024',170);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (445,'2024_04_09_181814_add_webhooks_table',171);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (446,'2024_04_29_181641_add_blocklist_to_features_features_table',171);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (447,'2024_05_21_194015_add_index_to_webhooks_table',171);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (448,'2024_05_27_162621_create_weekly_user_statistics_table',171);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (454,'2024_05_28_214412_add_recommendation_tables',172);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (455,'2024_06_24_162938_add_recommendation_table_indexes',172);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (458,'2024_06_25_222712_update_weekly_user_stats_access_frequency',173);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (460,'2024_06_25_222712_weekly_user_stats_update_access_frequency_membership_starts',174);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (461,'2024_06_19_225525_add_interacted_to_features_tracking',175);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (462,'2024_06_26_190009_add_primary_brand_to_user',175);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (463,'2024_07_03_215515_add_recharge_interval_to_usora_users_table',175);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (464,'2024_07_08_162522_create_shopify_order_fixes_table',175);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (465,'2024_07_10_225437_usora_users_index_cleanup',176);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (466,'2024_07_19_212338_add_artists_table',176);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (467,'2024_07_22_170914_cohort_custom_template_toggle',176);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (468,'2024_08_09_000000_add_expires_at_to_personal_access_tokens_table',176);
