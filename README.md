## Commands

To create a new resource, you need to create a command and execute this command by specifying the name of your resource and the table in the database that belongs to it.
```
php artisan vstack:make-resource {resource} {model} {table}
```

to process vstack queue
```
php artisan queue:work --queue=mail,resource-import,broadcasts
```

to run websocket server
```
php artisan websockets:serve
```