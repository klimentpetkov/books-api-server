# books-api2-server
Simple CRUD API access for managing books, works with user roles and 
restricts books access for every single request.

## If you enjoy this API example, please give a star to this repo 

<p>
    <b>The goal of this example is to show how API (server part) 
    can be done in Laravel with passport authentication.
    There are books that can be managed by authors 
    (each author has access to every one of the books). Each of the books can be read by reader, each reader only has the ability to ready any kind of data related with any book. Also to list all books.
    Every book is part of a category.
    </b>
</p>
<p>
    <b>
    <u><i>Categories</i></u> have: id, name
    </b>
</p>
<p>
    <b>
    <u><i>Users</i></u> have: name, email, password, role - [author, reader], receive notifications.
    </b>
</p>
<p>
    <b>
        <u><i>Books</i></u> have: title, description, author, category, cover image (base64 passed to API)
    </b>
</p>





## Authentication - works for both user and admin
##### Login
##### Register
##### Me

> The following two sections are accessable only after successful authorization
> for both author and reader
## Categories - restricts access for every request to the data
#### List all (both author and reader)
#### Create new 


## Books - restricts access for every request to the data
#### List all (both author and reader)
#### Create new (author only)
#### Show (both author and user)
#### Update (admin only)
#### Delete (admin only)


<p> &nbsp;</p>
> Let's start setting up the application

<p> &nbsp;</p>

1) Create an .env file with database settings<br>, set the QUEUE_CONNECTION=database
2) Create a database - for MySQL I suggest you to set up the encoding as <b>UTF8MB4_UNICODE_CI</b><br>
3) Run <b>composer install</b> to install all project dependencies<br>
4) Create and seed the database <b>php artisan migrate:fresh --seed</b><br>
5) Run <b>php artisan passport:keys --force</b> (In case of auth problems try <b>php artisan passport:install</b>)
6) Run <b>php artisan passport:client --personal</b> and set for name BooksApiPac
7) Run <b>php artisan storage:link</b>

<p>&nbsp;</p>
Here are the routes that navigate the API - run: <b>php artisan routes:list</b>
<p>&nbsp;</p>
Start the server <b>php artisan serve</b>
<p>&nbsp;</p>
Then run postman and inside try the routes:
<p>&nbsp;</p>

> REGISTER  http://127.0.0.1:8000/api/register

###### Method: <b>POST</b>

<p> &nbsp;</p>

###### Headers:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>Accept</td><td>application/json</td></tr>
</table>

<p> &nbsp;</p>

###### Params (Body->form-data): 
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>name</td><td>_new_name_</td></tr>
    <tr><td>email</td><td>_new_email_</td></tr>
    <tr><td>password</td><td>_new_password_</td></tr>
    <tr><td>confirm_password</td><td>_new_password_confirmation_</td></tr>
    <tr><td>role</td><td>author / reader </td></tr>
    <tr><td>receive_notifications</td><td>0 / 1</td></tr>
</table>

<p> &nbsp;</p>

###### On success the response shall be similar to this
<p> &nbsp;</p>
<code>
{
    "success": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYmQyZmY3ZmIxMzdkZjZiNGQ5MjRlZTJiNDllODE2ODNkNWYzNDYzMWNhYjY5Y2MwMzdhNTViZTQ5MzJlZTM1NTZiNDVkNDAxZDk5NDVkODkiLCJpYXQiOjE1NzkxNjg4MzUsIm5iZiI6MTU3OTE2ODgzNSwiZXhwIjoxNjEwNzkxMjM0LCJzdWIiOiI4Iiwic2NvcGVzIjpbXX0.O2zk3xl7MZ0kpzWcNX9PCz1_X_40srqu2VrZAfWUIfwETPsCrRRp_GZCeLsezZzsOOJYapZTR_piyYtsP5fq_z4UcrYfW7scy7wE3Rhip2XUexQKhvzQJvkkOl__3q-3jCU1j5XCIXH8ANzWwfo8UyPhYfcvI1Kq8WfGw1tWcV8NToqDUA9krfQlFqsz5TIRkBE2ps5ukuI-wqy5UoSlI-MTnhJgMUYUdilqQQKSOofhhX-4_yhk7-0sxfbnsbNx5ny16BJHYJ_jKWtPSdoKdh4hJNJPvKnVxqM7eOyUd1JtkJvr_gAGhpoNInrcsUC_8dXKc5aPCJvkbGItjW5HBMVCXOIoK9y_0xbxYr1iltnl4HtiCpYxX7SRfqpYMMBeFo05AGYZX1wQ45Lq0xzDJ6xbU5-38xgSrXcVwF5A-MZ9nsB_5_zB4ME1xkjCC08B3i4jqdvhIivnMtiLlagnEeX6BTJF_P3jsv-E4i_L9cVKTAbcCvMQic-xSQMW6cqeOlECRH8dgwvCrVAz--nAJAffp0AY-lEvgsPdq9R64K_pA6P7rRpYn_mGSSUw_RXZO85zI5QktHdfii3GJjD__XH2YcguUVOp142nyS_k3ukHX6qD21fniH_X6LOxccoHiixLkAnYtvgJw6_yyhs899j8CIINArs67KNqLbI1Bbg",
        "name": "_registered_name_"
    }
}
</code>

###### Since the email has to be unique in the DB, if someone try to register the user with same email, then this error appear
<code>
{
    "error": {
        "email": [
            "The email has already been taken."
        ]
    }
}
</code>
<p> &nbsp;</p>

> LOGIN  http://127.0.0.1:8000/api/auth/login

###### Method: <b>POST</b>

<p> &nbsp;</p>

###### Headers:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>Accept</td><td>application/json</td></tr>
</table>

<p> &nbsp;</p>

###### Params (Body->form-data): 
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>email</td><td>_email_</td></tr>
    <tr><td>password</td><td>_password_</td></tr>
</table>

<p> &nbsp;</p>

###### The response shall be similar to this
<p> &nbsp;</p>
<code>
{
    "success": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNGZkOWYxMTdmNTk0NmY5Y2Q4NzMzYzk4ODQxNmRjOWUxYzZhOGVlYWJkOGZlNTJjYzQzODk3OTk5NTE0OTY3ZGU3NTkyOWZlM2ZiNWQ0MmYiLCJpYXQiOjE1NzkxNzA3NzUsIm5iZiI6MTU3OTE3MDc3NSwiZXhwIjoxNjEwNzkzMTc1LCJzdWIiOiI4Iiwic2NvcGVzIjpbXX0.feLNMwcTNP1mHHs-B-ULe7CtfNEXjcay7byrgurRatre22wrourvudkGSlwb2Ni8-45u25dINGfaDIMbj9_kwIeJlSrbKqyfBKJBI9KFKZWvmr704iAfuNet05UEhJXbavq-KW94PcKojKaxLeFY5JF3AlR404tcixLWpA7n9FURY8_v2ha_LfAx7Ne6VuEUUULDropoXM-StHTKD33EVskqHM7gsSaLLiIbAe-gmzJ3EU5LxrjJQAZ8lqR4bVPQ-dkQm5iWUa9THg_TPLa77yBXU-VVmJ4F252GTZwpGyeVAQneYTv1XE9OmUka-cOWCkjyz0eGl-6N9p4t97U_6vAW9thoudS1CfEYPCGBRv2sW8C54K1rEVAT6NPefteDqni9YUWCdA_YBgwp56NIVNHhknZ4XMVZvUYgM5wdzKjgl3gK2IHNjcz-TyWxfWrmjyly6-7MylloAJi3RiOuAAhnNPlYDhJeQDlfJaFxt_eERkqEyAd9WfbeFgGaaetrcgVLTZ1prNYY88SRrUEQw1DumyO9XTDV-_NiXgVcBY_ic2UbT4HheEo9xVab3pxUULyhW69Y4jCGMa7PKyXwwnTQAW1vVLyfnlhL-d1O82IqiuRP04hJ5aeJ9jSpPLtcPBKiCGrWl-fxfzk3xneSgKdgojBdsgB5gxXAoTasYCY"
    }
}
</code>

###### If some or both of credentials are wrong, the response will give status of 401 and will be
<code>
{
    "error": "Unauthorized"
}
</code> 

<p>&nbsp;</p>

> Me  http://127.0.0.1:8000/api/me

<p>&nbsp;</p>

###### Method: <b>POST</b>

<p>&nbsp;</p>

###### Headers:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>Authorization</td><td>Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYmQyZmY3ZmIxMzdkZjZiNGQ5MjRlZTJiNDllODE2ODNkNWYzNDYzMWNhYjY5Y2MwMzdhNTViZTQ5MzJlZTM1NTZiNDVkNDAxZDk5NDVkODkiLCJpYXQiOjE1NzkxNjg4MzUsIm5iZiI6MTU3OTE2ODgzNSwiZXhwIjoxNjEwNzkxMjM0LCJzdWIiOiI4Iiwic2NvcGVzIjpbXX0.O2zk3xl7MZ0kpzWcNX9PCz1_X_40srqu2VrZAfWUIfwETPsCrRRp_GZCeLsezZzsOOJYapZTR_piyYtsP5fq_z4UcrYfW7scy7wE3Rhip2XUexQKhvzQJvkkOl__3q-3jCU1j5XCIXH8ANzWwfo8UyPhYfcvI1Kq8WfGw1tWcV8NToqDUA9krfQlFqsz5TIRkBE2ps5ukuI-wqy5UoSlI-MTnhJgMUYUdilqQQKSOofhhX-4_yhk7-0sxfbnsbNx5ny16BJHYJ_jKWtPSdoKdh4hJNJPvKnVxqM7eOyUd1JtkJvr_gAGhpoNInrcsUC_8dXKc5aPCJvkbGItjW5HBMVCXOIoK9y_0xbxYr1iltnl4HtiCpYxX7SRfqpYMMBeFo05AGYZX1wQ45Lq0xzDJ6xbU5-38xgSrXcVwF5A-MZ9nsB_5_zB4ME1xkjCC08B3i4jqdvhIivnMtiLlagnEeX6BTJF_P3jsv-E4i_L9cVKTAbcCvMQic-xSQMW6cqeOlECRH8dgwvCrVAz--nAJAffp0AY-lEvgsPdq9R64K_pA6P7rRpYn_mGSSUw_RXZO85zI5QktHdfii3GJjD__XH2YcguUVOp142nyS_k3ukHX6qD21fniH_X6LOxccoHiixLkAnYtvgJw6_yyhs899j8CIINArs67KNqLbI1Bbg </td></tr>
    <tr><td>Accept</td><td>application/json</td></tr>
</table>

<p> &nbsp;</p>

###### The response shall be similar to this
<code>
{
    "success": {
        "id": 8,
        "name": "some.user",
        "email": "some.user@example.cxm",
        "role": "author",
        "receive_notifications": 0,
        "created_at": "2020-01-16 10:00:34",
        "updated_at": "2020-01-16 10:00:34"
    }
}
</code>

<p>&nbsp;</p>

> BOOKS index http://127.0.0.1:8000/api/books

<p> &nbsp;</p>

###### Method: <b>GET</b>

<p> &nbsp;</p>

###### Headers:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>Accept</td><td>application/json</td></tr>
    <tr><td>Authorization</td><td>Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9yZWZyZXNoIiwiaWF0IjoxNTc0MzM5NTUxLCJleHAiOjE1NzQzNDAxNzIsIm5iZiI6MTU3NDMzOTU3MiwianRpIjoiYkQ1d25VSnhJbGd1c3hzdSIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSIsIm5hbSI6IlNvbWV0aGluZyJ9.Mi6Uea92c29VsKlT8r_KTuZulGquSRNFgrGl2-1P9dc</td></tr>
</table>

<p> Eventually you can put a query string parameter to set the page you want to receive </p>

###### Params:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>page</td><td>3</td></tr>
</table>

<p> &nbsp;</p>

###### The response will be a paginated list by 5 books similar to this
<p> &nbsp;</p>
<code>
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "user_id": 11,
            "category_id": 2,
            "title": "Now I growl.",
            "description": "March Hare had just begun to repeat it, but her voice close to her that she ought not to make out exactly what they WILL do next! As for pulling me.",
            "image": "http://ba2-server.local/api/image/2.jpg",
            "created_at": "2020-01-20 15:19:02",
            "updated_at": "2020-01-20 15:19:02",
            "user": {
                "id": 11,
                "name": "Abdiel Cremin DDS"
            },
            "category": {
                "id": 2,
                "name": "TGPot2Ejot"
            }
        },
        {
            "id": 2,
            "user_id": 11,
            "category_id": 7,
            "title": "Hatter. He.",
            "description": "Dormouse into the roof of the guinea-pigs cheered, and was surprised to find that she wasn't a really good school,' said the Caterpillar. Alice.",
            "image": "http://ba2-server.local/api/image/3.jpg",
            "created_at": "2020-01-20 15:19:02",
            "updated_at": "2020-01-20 15:19:02",
            "user": {
                "id": 11,
                "name": "Abdiel Cremin DDS"
            },
            "category": {
                "id": 7,
                "name": "qjdzPNJTa3"
            }
        },
        {
            "id": 3,
            "user_id": 15,
            "category_id": 8,
            "title": "Alice, 'and.",
            "description": "White Rabbit blew three blasts on the look-out for serpents night and day! Why, I wouldn't be in a sorrowful tone; 'at least there's no use in the.",
            "image": "http://ba2-server.local/api/image/3.jpg",
            "created_at": "2020-01-20 15:19:02",
            "updated_at": "2020-01-20 15:19:02",
            "user": {
                "id": 15,
                "name": "Dolly Rath"
            },
            "category": {
                "id": 8,
                "name": "sAFr7PEh9Z"
            }
        },
        {
            "id": 4,
            "user_id": 11,
            "category_id": 5,
            "title": "Alice. 'I.",
            "description": "King; and the three gardeners, oblong and flat, with their heads!' and the whole head appeared, and then added them up, and there stood the Queen.",
            "image": "http://ba2-server.local/api/image/1.jpg",
            "created_at": "2020-01-20 15:19:02",
            "updated_at": "2020-01-20 15:19:02",
            "user": {
                "id": 11,
                "name": "Abdiel Cremin DDS"
            },
            "category": {
                "id": 5,
                "name": "UnEvAZj7r9"
            }
        },
        {
            "id": 5,
            "user_id": 13,
            "category_id": 2,
            "title": "Hatter. 'Does.",
            "description": "Mock Turtle. 'No, no! The adventures first,' said the Duchess, digging her sharp little chin into Alice's head. 'Is that the Mouse only growled in.",
            "image": "http://ba2-server.local/api/image/4.jpg",
            "created_at": "2020-01-20 15:19:02",
            "updated_at": "2020-01-20 15:19:02",
            "user": {
                "id": 13,
                "name": "Elmira Hodkiewicz"
            },
            "category": {
                "id": 2,
                "name": "TGPot2Ejot"
            }
        }
    ],
    "first_page_url": "http://ba2-server.local/api/books?page=1",
    "from": 1,
    "last_page": 6,
    "last_page_url": "http://ba2-server.local/api/books?page=6",
    "next_page_url": "http://ba2-server.local/api/books?page=2",
    "path": "http://ba2-server.local/api/books",
    "per_page": 5,
    "prev_page_url": null,
    "to": 5,
    "total": 29
}
</code>

<p> &nbsp;</p>

And if we decide to pass the page parameter like <b>http://127.0.0.1:8000/api/books?page=2</b>
then if the page is one of the valid pages then corresponding information will show
otherwise you can see this
<p> &nbsp;</p>
<code>
{
    "current_page": 7,
    "data": [],
    "first_page_url": "http://127.0.0.1:8000/api/books?page=1",
    "from": null,
    "last_page": 5,
    "last_page_url": "http://127.0.0.1:8000/api/books?page=5",
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/api/books",
    "per_page": 5,
    "prev_page_url": "http://127.0.0.1:8000/api/books?page=6",
    "to": null,
    "total": 21
}
</code>

<p> &nbsp;</p>

> BOOKS publish http://127.0.0.1:8000/api/books/publish

<p> &nbsp;</p>

###### Method: <b>POST</b>

<p> &nbsp;</p>

###### Headers:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>Accept</td><td>application/json</td></tr>
    <tr><td>Authorization</td><td>Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9yZWZyZXNoIiwiaWF0IjoxNTc0MzM5NTUxLCJleHAiOjE1NzQzNDAxNzIsIm5iZiI6MTU3NDMzOTU3MiwianRpIjoiYkQ1d25VSnhJbGd1c3hzdSIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSIsIm5hbSI6IlNvbWV0aGluZyJ9.Mi6Uea92c29VsKlT8r_KTuZulGquSRNFgrGl2-1P9dc</td></tr>
</table>

<p> &nbsp;</p>

###### Params:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>title</td><td>New book title</td></tr>
    <tr><td>description</td><td>Some long description text</td></tr>
    <tr><td>category_id</td><td>5</td></tr>
    <tr><td>image</td><td>data:image/jpg;base64,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</td></tr>
</table>

<p> &nbsp;</p>

###### When the data is correct the result will be
<p> &nbsp;</p>
<code>
{
    "message": "Resource saved"
}
</code>

<p> &nbsp;</p>

###### Else if validation is not passed the result is
<p> &nbsp;</p>
<code>
{
    "message": "Validation error",
    "data": {
        "title": [
            "The title field is required."
        ],
        "description": [
            "The description field is required."
        ],
        "category_id": [
            "The category id field is required."
        ],
        "image": [
            "The image field is required."
        ]
    }
}
</code>

<p> There are other validation messages also for example</p>
<code>
{
    "message": "Validation error",
    "data": {
        "title": [
            "The title field is required."
        ],
        "description": [
            "The description field is required."
        ],
        "category_id": [
            "The category id must be a number."
        ],
        "image": [
            "The image field is not a valid base64 image representation."
        ]
    }
}
</code>

<p> &nbsp;</p>

> CATEGORIES list http://127.0.0.1:8000/api/categories

<p> &nbsp;</p>

###### Method: <b>GET</b>

<p> &nbsp;</p>

###### Headers:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>Accept</td><td>application/json</td></tr>
    <tr><td>Authorization</td><td>Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9yZWZyZXNoIiwiaWF0IjoxNTc0MzM5NTUxLCJleHAiOjE1NzQzNDAxNzIsIm5iZiI6MTU3NDMzOTU3MiwianRpIjoiYkQ1d25VSnhJbGd1c3hzdSIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSIsIm5hbSI6IlNvbWV0aGluZyJ9.Mi6Uea92c29VsKlT8r_KTuZulGquSRNFgrGl2-1P9dc</td></tr>
</table>

<p> &nbsp;</p>

###### When proper token authentication is provided the result will be similar to 
<p> &nbsp;</p>
<code>
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name": "YqK857SFXf",
            "created_at": "2020-01-20 15:19:00",
            "updated_at": "2020-01-20 15:19:00"
        },
        {
            "id": 2,
            "name": "TGPot2Ejot",
            "created_at": "2020-01-20 15:19:01",
            "updated_at": "2020-01-20 15:19:01"
        },
        {
            "id": 3,
            "name": "3QIaiWGJbL",
            "created_at": "2020-01-20 15:19:01",
            "updated_at": "2020-01-20 15:19:01"
        },
        {
            "id": 4,
            "name": "2LPDVpPpZG",
            "created_at": "2020-01-20 15:19:01",
            "updated_at": "2020-01-20 15:19:01"
        },
        {
            "id": 5,
            "name": "UnEvAZj7r9",
            "created_at": "2020-01-20 15:19:01",
            "updated_at": "2020-01-20 15:19:01"
        },
        {
            "id": 6,
            "name": "tYDqaWvCKJ",
            "created_at": "2020-01-20 15:19:01",
            "updated_at": "2020-01-20 15:19:01"
        },
        {
            "id": 7,
            "name": "qjdzPNJTa3",
            "created_at": "2020-01-20 15:19:01",
            "updated_at": "2020-01-20 15:19:01"
        },
        {
            "id": 8,
            "name": "sAFr7PEh9Z",
            "created_at": "2020-01-20 15:19:01",
            "updated_at": "2020-01-20 15:19:01"
        },
        {
            "id": 9,
            "name": "7wB7PXXnUS",
            "created_at": "2020-01-20 15:19:01",
            "updated_at": "2020-01-20 15:19:01"
        },
        {
            "id": 10,
            "name": "oCunZnPwgR",
            "created_at": "2020-01-20 15:19:01",
            "updated_at": "2020-01-20 15:19:01"
        }
    ],
    "first_page_url": "http://ba2-server.local/api/categories?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://ba2-server.local/api/categories?page=1",
    "next_page_url": null,
    "path": "http://ba2-server.local/api/categories",
    "per_page": 10,
    "prev_page_url": null,
    "to": 10,
    "total": 10
}
</code>

<p> &nbsp;</p>
