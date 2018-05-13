# Notification Service

This is module for reminders that runs on a daily basis to check leases that have invoices that are due , over due and late. If the tenant has at least one early invoice that is not paid that matches the early reminder criteria, we will send sms and email base don tenant settings (if they have sms on or email on).

Each type of reminder will have its own text in body. This process should send only one SMS and/or email to each payer for each type. for example, if I have 10 invoices: 5 are early and 5 are late; we should send one reminder for each type.

Each client has their own configuration for three types of auto reminders:
+ Early: 3 days before star date of invoice:
+ Due : start_date = current date 
+ Late = 4 days (after start_date) 

## How it's works

We deal with tenants and leases. 
One tenant, can have one or more leases. 
One tenant have one invoice for one lesses.
Tenant have a settings in account for set (on/off) sms or email notification. Also, he can choose one of the ways reminder: (Early, Due, Late).

Our system send auto reminder to SMS and Email. 
The system should work automatically, so the entire process will run in the cron. 
Cron is setup to run every day at 9АM.
The system looks for tenants in the database who need to send a reminder message:
+ invoice status is active.
+ check three conditions types of reminders
+ grouped by end_date and last name

### Example: 
Suppose that today 01.04.2018. 
Tenant X have a 2 lease (start=27.02.2018 end 27.03.2018) and 1 lease (start=01.03.2018 end 01.04.2018)
System must send 2-notification. 1-Early for (2 leases) and 1-due for (1 leas).

If the system was sent early message for tenant one time, and his pay for a lease before take due message, we not remove invoice and not update date, we just set status "finish" and create new invoice.
+ the system not send a message again
+ save event history

If the system was sent Late message and tenant not pay. we also set status "block". and not create new invoice. 

## Usage package
+ monolog
+ phpdotenv
+ collision
+ event-dispatcher
+ doctrine-orm
+ cron

## Install
+ run composer install
+ configuration db connection params in the .env file
+ run migration script "migration/script.sql"

##Usage

You can run send notification service once 

```php 

php index.php
```
Or change line in the cron.php file for real path to index.php file

```php
$job->setCommand('php <<<path_to_cron_action>>>');
```
 
and update your server crontab and add line for your cron php file:

```php 

* * * * * /path/to/php /path/to/cron.php >/dev/null 2>&1
```

## Data base uml schema

![image](https://github.com/dykyi-roman/notification-service/blob/master/migration/uml.png)

## Architecture

![image](https://github.com/dykyi-roman/notification-service/blob/master/architecture.png)

## Author
[Dykyi Roman](https://www.linkedin.com/in/roman-dykyi-43428543/), e-mail: [mr.dukuy@gmail.com](mailto:mr.dukuy@gmail.com)
