Instruction:
1.import and connect database attached in main folder named 'api-cpt-cron-v2.sql'
2. login:admin 
   password:admin
3. enter into wp-admin panel, click at Tools -> Cron Events -> Add New:
    'Event Type' set to: PHP cron event
    'PHP Code' field, just paste it: $AMLP = new AllMyLittleProducts();
    'Next Run' set to: Now
    'Recurrence' set to: Once Daily(daily)

    
    