Instruction:

1.import and connect database attached in main folder named 'db.sql'
2. login:admin 
   password:admin
3. enter into wp-admin panel, click at Tools -> Cron Events -> Add New:
    'Event Type' set to: PHP cron event
    'PHP Code' field, just paste it: $AMLP = new AllMyLittleProducts();
    'Next Run' set to: Now
    'Recurrence' set to: Once Daily(daily)
4. You can choose 3 posts to show at the front page by edit Sample Page

    
    
