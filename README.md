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
            "user_id": 14,
            "category_id": 3,
            "title": "On various.",
            "description": "On which Seven looked up and walking off to the tarts on the bank, and of having the sentence first!' 'Hold your tongue!' added the Gryphon, and all.",
            "image": "data:image/jpg;base64,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",
            "created_at": "2020-01-17 16:11:13",
            "updated_at": "2020-01-17 16:11:13",
            "user": {
                "id": 14,
                "name": "Elena Kassulke"
            },
            "category": {
                "id": 3,
                "name": "YuPYVvqfXb"
            }
        },
        {
            "id": 2,
            "user_id": 11,
            "category_id": 6,
            "title": "I COULD NOT.",
            "description": "Alice, every now and then, if I chose,' the Duchess by this time.) 'You're nothing but the Hatter was the first sentence in her hands, wondering if.",
            "image": "data:image/jpg;base64,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",
            "created_at": "2020-01-17 16:11:13",
            "updated_at": "2020-01-17 16:11:13",
            "user": {
                "id": 11,
                "name": "Dr. Kiana Rohan"
            },
            "category": {
                "id": 6,
                "name": "BxpOscCo9t"
            }
        },
        {
            "id": 3,
            "user_id": 11,
            "category_id": 5,
            "title": "Cheshire Cat.",
            "description": "Mock Turtle sighed deeply, and drew the back of one flapper across his eyes. 'I wasn't asleep,' he said do. Alice looked up, and began to cry again.",
            "image": "data:image/jpg;base64,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",
            "created_at": "2020-01-17 16:11:13",
            "updated_at": "2020-01-17 16:11:13",
            "user": {
                "id": 11,
                "name": "Dr. Kiana Rohan"
            },
            "category": {
                "id": 5,
                "name": "TZPf6LmkbT"
            }
        },
        {
            "id": 4,
            "user_id": 13,
            "category_id": 4,
            "title": "Queen never.",
            "description": "Alice quite hungry to look for her, and she grew no larger: still it was growing, and growing, and growing, and very soon came upon a low voice.",
            "image": "data:image/jpg;base64,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",
            "created_at": "2020-01-17 16:11:14",
            "updated_at": "2020-01-17 16:11:14",
            "user": {
                "id": 13,
                "name": "Dr. Kareem Kohler IV"
            },
            "category": {
                "id": 4,
                "name": "NTVctYfFfv"
            }
        },
        {
            "id": 5,
            "user_id": 11,
            "category_id": 5,
            "title": "Alice turned.",
            "description": "I dare say you never to lose YOUR temper!' 'Hold your tongue, Ma!' said the youth, 'as I mentioned before, And have grown most uncommonly fat; Yet.",
            "image": "data:image/jpg;base64,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",
            "created_at": "2020-01-17 16:11:14",
            "updated_at": "2020-01-17 16:11:14",
            "user": {
                "id": 11,
                "name": "Dr. Kiana Rohan"
            },
            "category": {
                "id": 5,
                "name": "TZPf6LmkbT"
            }
        }
    ],
    "first_page_url": "http://ba2-server.local/api/books?page=1",
    "from": 1,
    "last_page": 5,
    "last_page_url": "http://ba2-server.local/api/books?page=5",
    "next_page_url": "http://ba2-server.local/api/books?page=2",
    "path": "http://ba2-server.local/api/books",
    "per_page": 5,
    "prev_page_url": null,
    "to": 5,
    "total": 21
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
