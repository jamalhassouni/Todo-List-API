## Todo List API
## Details
Todo List PHP Application Programming Interface

PHP 7 script that adds a REST API to a MySQL 5.5 InnoDB database

Related projects:

[React todoApp](https://github.com/jamalhassouni/todoApp)
This is a sample todo App written by React js and php

### Requirements
* PHP 7.0 or higher with PDO drivers for MySQL, PgSQL or SqlSrv enabled
* MySQL 5.6 / MariaDB 10.0 or higher for spatial features in MySQL

## Installation

Upload script folder somewhere and enjoy!

For local development you may run PHP's built-in web server:

`php -S localhost:8080`

Test the script by opening the following URL:

`http://localhost:8080/index.php/`

Don't forget to modify the configuration at the bottom of the file.

## Configuration

Edit the following lines in the bottom of the file "config/Database.php":

```php
    private $host = 'xxx';
    private $db_name = 'xxx';
    private $username = 'xxx';
    private $password = 'xxx';
```

### CRUD + List

The example todo has only a a few fields:

```code 
todo
=======
 id
 item
 sort
 todoStatu
 addDate
 completDate
 ```

The CRUD + List operations below act on this table.

### Create

If you want to create a record the request can be written in URL format as:

`POST create/task/`

You have to send a body containing:

```json
{
  "item":"Learn PHP"
 }
```
And it will return the status code 200 And message " Task  Created " :

```json
{
 "status":200,
 "message":"Task  Created"
}
```

### Read

To read a record from this table the request can be written in URL format as:


`GET /task/1`

Where "1" is the value of the primary key of the record that you want to read. It will return:

```json
{

"id": 1,
"item": "Learn PHP",
"sort": "1",
"todoStatu": "1",
"addDate": "2018-09-06 16:07:38",
"completDate": "0000-00-00 00:00:00"
}
```

### Update

To update a record in this table the request can be written in URL format as:

* Edit task title 

`PUT /update.php`

Send as a body:

```json
{
    "id": 1,
    "item":"PHP"
}
```
Where "id: 1" is the value of the primary key of the record that you want to update.

This adjusts the title of the task. And it will return the status code 200 And message " Task  Updated " :

```json
{
 "status":200,
 "message":"Task Updated"
}
```
* Mark as Completed

  Send as a body:
  
  ```json
  {
      "id": 1,
      "sort":2,
      "type":2
  }
  ```
  Where "id: 1" is the value of the primary key of the record that you want to mark as completed.

This adjusts the status of the task. And it will return the status code 200 And message " Task  Completed " :

```json
{
 "status":200,
 "message":"Task Completed"
}
```

* Mark as Uncompleted

  Send as a body:
  
  ```json
  {
      "id": 1,
      "sort":2,
      "type":1
  }
  ```
  Where "id: 1" is the value of the primary key of the record that you want to mark as Uncompleted.

This adjusts the status of the task. And it will return the status code 200 And message " Task  uncompleted " :

```json
{
 "status":200,
 "message":"Task Uncompleted"
}
```

### Delete

`DELETE /delete.php/`

If you want to delete a record from this table the request can be written in URL format as:

```json
{
"id":1,
"type":2,
"sort":2
}
```
  Where "id: 1" is the value of the primary key of the record that you want to delete
  and type is status of task (completed =2 or uncompleted =1) sort is the task position in list .

### Sort 

To update a record sort in this table the request can be written in URL format as:


`PUT /update.php`

Send as a body:

```json
{
    "from": 1,
    "posFrom":2,
    "to":2,
    "posTo":1
}
```
* from :  the id of the item you want to change
* posFrom : the sort of item want to change
* to : The id of the item you want to change to
* posTo: The sort of the item you want to change to

This adjusts the position of the task. And it will return the status code 200 And message " Tasks Sort Updated " :

```json
{
 "status":200,
 "message":"Tasks Sort Updated"
}
```


### List

To list records from this table the request can be written in URL format as:

`GET  http://localhost:8080/` or
`GET http://localhost:8080/index.php/`

It will return:

```json
{
"uncompleted": [
   {
      "id": "2",
       "item": "Learn React js",
       "sort": "1",
       "todoStatu": "1",
       "addDate": "2018-09-07 22:29:26",
       "completDate": "0000-00-00 00:00:00"
  }
],
"completed": [
    {
      "id": "2",
      "item": "Learn  PHP",
      "sort": "1",
      "todoStatu": "2",
      "addDate": "2018-07-27 14:25:00",
      "completDate": "2018-09-07 23:20:13"
   }
  ]
}

```
