<?php

return [

    'show_db_details_id' => env('SHOW_GENERATED_DB_DETAILS_ID', false),

    'enable_server_delete' => env('SERVER_DELETE_ENABLED', 'false'),

    'show_server_details_id' => env('SHOW_GENERATED_SERVER_DETAILS_ID', false),

    'registrations' => env('ENABLE_REGISTRATIONS', false),

    'autorefresh' => env('ENABLE_AUTOREFRESH', false),

    'allow_password_change' => env('ALLOW_PASSWORD_CHANGES', true),

    'send_internal_emails' => env('SEND_INTERNAL_EMAILS', false),

    'send_internal_emails_to' => env('SEND_INTERNAL_EMAILS_TO', 'ntikku@ptc.com'),

    'show_milestone' => env('SHOW_RELEASE_MILESTONES', false),

    'beta_version' => env('BETA_VERSION', 'CHAMBAL'),

    'spodash_version' => env('SPOD_VERSION', '2.6'),

    'copyright' => env('COPYRIGHT_YEAR', '2020'),

];
