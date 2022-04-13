php artisan iseed action_histories --force

php artisan iseed database_details --force

php artisan iseed database_types --force

php artisan iseed instance_details --exclude=product_versions_id,instance_owner --force

php artisan iseed instance_has_teams --force

php artisan iseed model_has_permissions --force

php artisan iseed model_has_roles --force

php artisan iseed os_types --force

php artisan iseed permissions --force

php artisan iseed product_names --force

php artisan iseed product_versions --force

php artisan iseed release_milestones --force

php artisan iseed release_numbers --force

php artisan iseed role_has_permissions --force

php artisan iseed roles --force

php artisan iseed server_details --force

php artisan iseed server_uses --force

php artisan iseed sprint_calendars --force

php artisan iseed teams --force

php artisan iseed user_has_teams --force

php artisan iseed users --exclude=role_id --force


