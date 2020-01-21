@component('mail::message')
    # A new book named {{ $book->title }} by {{ $book->user->name }} was published!

    {{ $book->description }}

    Sencerely yours,
    The bookstore team
@endcomponent
