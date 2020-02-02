
Update database schema
----------------------

The last thing you need to do is updating your database schema by applying the migrations. Make sure that you have properly configured db application component and run the following command:

```
$ php yii migrate/up --migrationPath=@vendor/omny/yii2-ticket-component/src/migrations
```