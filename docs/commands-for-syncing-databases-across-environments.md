# Create databases to copy from
```
mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj <<EOF
CREATE DATABASE IF NOT EXISTS musora_laravel;
CREATE DATABASE IF NOT EXISTS drumeo_laravel;
CREATE DATABASE IF NOT EXISTS guitareo_laravel;
CREATE DATABASE IF NOT EXISTS pianote_laravel;
CREATE DATABASE IF NOT EXISTS singeo_laravel;
CREATE DATABASE IF NOT EXISTS drumeo_blog_wordpress;
CREATE DATABASE IF NOT EXISTS drumlessons_com_wordpress;
CREATE DATABASE IF NOT EXISTS guitareo_blog;
CREATE DATABASE IF NOT EXISTS guitarlessons_laravel;
CREATE DATABASE IF NOT EXISTS guitarsystem_com_wordpress;
CREATE DATABASE IF NOT EXISTS pianote_blog;
CREATE DATABASE IF NOT EXISTS recordeo_laravel;
CREATE DATABASE IF NOT EXISTS singeo_blog;
EOF
```

# Import structure and specific tables of musora_laravel
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert musora_laravel --no-data | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj musora_laravel
```
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert musora_laravel brands carousels cohorts cohort_dropdowns product_types products features specs images sizes size_charts product_sizes bundles benefits ecommerce_products forum_categories forum_post_likes forum_post_replies forum_post_reports forum_posts forum_thread_follows forum_thread_reads forum_threads features_features features_experiments features_branches features_tracking leadgens leadgen_lessons leadgen_lesson_assets leadgen_lesson_assignments maintenance migrations permission_model_has_permissions permission_model_has_roles permission_permissions permission_roles permission_role_has_permissions railcontent_comments railcontent_content railcontent_content_bpm railcontent_content_data railcontent_content_exercises railcontent_content_fields railcontent_content_focus railcontent_content_follows railcontent_content_hierarchy railcontent_content_instructors railcontent_content_keys railcontent_content_key_pitch_types railcontent_content_permissions railcontent_content_playlists railcontent_content_styles railcontent_content_tags railcontent_content_topics railcontent_permissions railcontent_user_permissions railcontent_user_playlists railcontent_user_playlist_content recommendations_drumeo_course_beginner_items recommendations_drumeo_song_beginner_items recommendations_drumeo_quick_tips_beginner_items recommendations_drumeo_workout_beginner_items recommendations_pianote_song_beginner_items recommendations_pianote_quick_tips_beginner_items recommendations_pianote_workout_beginner_items recommendations_singeo_song_beginner_items recommendations_singeo_quick_tips_beginner_items recommendations_singeo_workout_beginner_items recommendations_guitareo_course_beginner_items recommendations_guitareo_song_beginner_items recommendations_guitareo_quick_tips_beginner_items recommendations_guitareo_workout_beginner_items recommendations_drumeo_course recommendations_drumeo_song recommendations_drumeo_quick_tips recommendations_drumeo_workout recommendations_pianote_song recommendations_pianote_quick_tips recommendations_pianote_workout recommendations_singeo_song recommendations_singeo_quick_tips recommendations_singeo_workout recommendations_guitareo_course recommendations_guitareo_song recommendations_guitareo_quick_tips recommendations_guitareo_workout user_abilities user_roles users usora_password_resets usora_user_fields usora_users mentors mentor_students | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj musora_laravel
`````
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert musora_laravel user_access_permissions | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj musora_laravel
```

# Import structure and specific tables of drumeo_laravel
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert drumeo_laravel --no-data | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj drumeo_laravel
````
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert drumeo_laravel maintenance forum_categories forum_posts forum_post_likes forum_post_replies forum_post_reports forum_threads forum_thread_follows forum_thread_reads forum_user_signatures migrations smart_beat | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj drumeo_laravel
```

# Import structure and specific tables of guitareo_laravel
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitareo_laravel --no-data | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj guitareo_laravel
````
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitareo_laravel achievement_history achievements achievement_user experiences forum_categories forum_post_likes forum_post_replies forum_post_reports forum_posts forum_thread_follows forum_thread_reads forum_threads forum_user_signatures maintenance migrations pages password_resets users | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj guitareo_laravel
```

# Import structure and specific tables of pianote_laravel
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert pianote_laravel --no-data | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj pianote_laravel
````
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert pianote_laravel forum_categories forum_posts forum_post_likes forum_post_replies forum_post_reports forum_threads forum_thread_follows forum_thread_reads forum_user_signatures maintenance migrations | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj pianote_laravel
```

# Import structure and specific tables of singeo_laravel
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert singeo_laravel --no-data | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj singeo_laravel
````
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert singeo_laravel forum_categories forum_post_likes forum_post_replies forum_post_reports forum_posts forum_thread_follows forum_thread_reads forum_threads forum_user_signatures maintenance migrations settings | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj singeo_laravel
```

# Import structure and specific tables of recordeo_laravel
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert recordeo_laravel --no-data | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj recordeo_laravel
````

# Import full dumps of remaining databases
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert drumeo_blog_wordpress | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj drumeo_blog_wordpress
```
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert drumlessons_com_wordpress | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj drumlessons_com_wordpress
````
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitareo_blog | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj guitareo_blog
```
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitarlessons_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj guitarlessons_laravel
````
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitarsystem_com_wordpress | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj guitarsystem_com_wordpress
```
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert pianote_blog | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj pianote_blog
````
```
mysqldump -h musora-vapor-production-reader-1.cy1ozfdqtand.us-east-2.rds.amazonaws.com -u railenv -p6uWAuBTptuvKsV9vKe --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert singeo_blog | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj singeo_blog
```

# Create databases for each environment
```
mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj <<EOF
CREATE DATABASE IF NOT EXISTS pre_production_drumeo_laravel;
CREATE DATABASE IF NOT EXISTS pre_production_guitareo_laravel;
CREATE DATABASE IF NOT EXISTS pre_production_guitarlessons_laravel;
CREATE DATABASE IF NOT EXISTS pre_production_musora_laravel;
CREATE DATABASE IF NOT EXISTS pre_production_pianote_laravel;
CREATE DATABASE IF NOT EXISTS pre_production_recordeo_laravel;
CREATE DATABASE IF NOT EXISTS pre_production_singeo_laravel;
CREATE DATABASE IF NOT EXISTS beta_testing_drumeo_laravel;
CREATE DATABASE IF NOT EXISTS beta_testing_guitareo_laravel;
CREATE DATABASE IF NOT EXISTS beta_testing_guitarlessons_laravel;
CREATE DATABASE IF NOT EXISTS beta_testing_musora_laravel;
CREATE DATABASE IF NOT EXISTS beta_testing_pianote_laravel;
CREATE DATABASE IF NOT EXISTS beta_testing_recordeo_laravel;
CREATE DATABASE IF NOT EXISTS beta_testing_singeo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_one_drumeo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_one_guitareo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_one_guitarlessons_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_one_musora_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_one_pianote_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_one_recordeo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_one_singeo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_two_drumeo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_two_guitareo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_two_guitarlessons_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_two_musora_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_two_pianote_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_two_recordeo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_two_singeo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_three_drumeo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_three_guitareo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_three_guitarlessons_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_three_musora_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_three_pianote_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_three_recordeo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_three_singeo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_four_drumeo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_four_guitareo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_four_guitarlessons_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_four_musora_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_four_pianote_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_four_recordeo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_four_singeo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_five_drumeo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_five_guitareo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_five_guitarlessons_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_five_musora_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_five_pianote_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_five_recordeo_laravel;
CREATE DATABASE IF NOT EXISTS web_staging_five_singeo_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_one_drumeo_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_one_guitareo_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_one_guitarlessons_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_one_musora_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_one_pianote_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_one_recordeo_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_one_singeo_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_two_drumeo_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_two_guitareo_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_two_guitarlessons_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_two_musora_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_two_pianote_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_two_recordeo_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_two_singeo_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_three_drumeo_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_three_guitareo_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_three_guitarlessons_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_three_musora_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_three_pianote_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_three_recordeo_laravel;
CREATE DATABASE IF NOT EXISTS app_staging_three_singeo_laravel;
EOF
```

# Copy data to each env database
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert drumeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj pre_production_drumeo_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitareo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj pre_production_guitareo_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitarlessons_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj pre_production_guitarlessons_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert musora_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj pre_production_musora_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert pianote_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj pre_production_pianote_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert recordeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj pre_production_recordeo_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert singeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj pre_production_singeo_laravel
````

```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert drumeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj beta_testing_drumeo_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitareo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj beta_testing_guitareo_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitarlessons_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj beta_testing_guitarlessons_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert musora_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj beta_testing_musora_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert pianote_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj beta_testing_pianote_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert recordeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj beta_testing_recordeo_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert singeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj beta_testing_singeo_laravel
```

```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert drumeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_one_drumeo_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitareo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_one_guitareo_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitarlessons_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_one_guitarlessons_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert musora_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_one_musora_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert pianote_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_one_pianote_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert recordeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_one_recordeo_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert singeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_one_singeo_laravel
````

```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert drumeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_two_drumeo_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitareo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_two_guitareo_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitarlessons_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_two_guitarlessons_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert musora_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_two_musora_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert pianote_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_two_pianote_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert recordeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_two_recordeo_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert singeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_two_singeo_laravel
```

```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert drumeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_three_drumeo_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitareo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_three_guitareo_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitarlessons_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_three_guitarlessons_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert musora_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_three_musora_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert pianote_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_three_pianote_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert recordeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_three_recordeo_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert singeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_three_singeo_laravel
````

```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert drumeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_four_drumeo_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitareo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_four_guitareo_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitarlessons_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_four_guitarlessons_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert musora_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_four_musora_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert pianote_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_four_pianote_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert recordeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_four_recordeo_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert singeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_four_singeo_laravel
```

```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert drumeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_five_drumeo_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitareo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_five_guitareo_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert guitarlessons_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_five_guitarlessons_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert musora_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_five_musora_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert pianote_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_five_pianote_laravel
````
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert recordeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_five_recordeo_laravel
```
```
mysqldump -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj --set-gtid-purged=OFF --compress --no-tablespaces --quick --extended-insert --complete-insert singeo_laravel | mysql -h musora-staging-cluster.cluster-cy1ozfdqtand.us-east-2.rds.amazonaws.com -u musora -pxBRjA7NUMLpUjxAj web_staging_five_singeo_laravel
````
