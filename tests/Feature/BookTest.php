<?php

namespace Tests\Feature;

use App\Book;
use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;
    /* * @test */
    /*public function a_book_can_be_stored_in_library()
    {
//        Category::
//
//        $this->withoutExceptionHandling();
        $response = $this->post('api/books/publish', [
            'title' => 'Cool book title',
            'description' => 'Some description',
            'category_id' => 1,
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAADvUlEQVR42rWXV2gVQRSGT+wxokZfVGyJJdYoir2ABQt2LNiw64MIBrGCBQt2RAUbJlbUBxUJGgW7ib1hrEhMsWFvDyrW+P+es3i5uXs3WXXgI7m7szP/njobIf5HJCgHPoF3fheJKOD86mAi6A1qgUJ2/TU4ARLB8f8hoDCYC2aA52APuARegihQH/QF7cExMAY8/VcCioF9oBOYBdaD7y5zW4MkUBp0Bvf+hQCadQDoam/tNbh5CqgCmoC3fyOgGzgM+oCD+djcGQzOdPnjDt8CLoAXov4t6BgCdooGa7YfATVAhqgvT/oQwMB9AtaCJX4EjAAbRX36XfyNXaAM6OlHwGwwHNTxuTnHfNAPxPsRwLwfDOr9hYB5YCBo4EfAOLAKlAU/fQrYAiqDLn4EUPUt0FLyl/+hRpZoHMzxI4DjDrgMRvvY3KkhjexFfAkYBraDtuBiATYvAa6aBXqHm5ifUpxib9HeFvQaRUSbVUfRUvzQSwBbanHw2WUO85gtlrWdgXkozHrVwFbQDPQAqR5W+koBy8B08AE8ANfBKVH/fbDJpcAGUZecFS2xdMkrUFI0YFmuWX6z7W960Et0Bx3MKjVFs2s5BTBKY0VTJg40By1EU28vWAru2kKMhQTRAIsK2IBzr4l2Tlrgm11nDeEZYpBZmtnEoL4v2qSyKGCHKewTpJgteDKoC9aJngUcNxUVbTLlRY9kmeB9wPM8ri0Gk0w8+8G+AItyJPM3BawE7eytQ8XISNGClGN+fSbhRwXRwI0BU0SzKDfEPFojjRuMBavNJz9cFo2xmOBoI+6HjGhwzv7vIe5tuLBZLIECaptPmGZpYd6soqm+Ie65TbM2Fq2e4SxFizND4pw6cNMWH+9hXoo8LdrhkoPuUdQB0UhP9Vhns6jL4x0BE8Aa0Sx45PHwflAJtAq6ft7eur/H81XN4symTY4ARjXrNetAT48FeEI6KpoFmXYt1p5l1/P6LuDZkm5vKFaInNHazMu8nxtmAYrllxBTNMmuMaeZagzCb2GeXQBmirrpd7AG9wIutNkWmx5msSvgDJhqv5nKjI/mLvPZH5abaMbZFudGqGbEU1CimZfF54jkzWOa8Q0YZb+3iRalXiHWY9XkobSWbb4n8KZbN+RkFh/mco5oYWGpfQw+ghWinXGkzWexYRxME+0NbFxN7fkYe55FKSN4I692zCYzVPSzjEETGXBvkfw56SwUPcQ6gyWbQc0P1t3gttsGBfk65txoE/HFXJAbcI8ucNr6OwldfvOMXxgnygjn13seAAAAAElFTkSuQmCC'
        ]);

        $response->assertCreated();
//        $response->assertOk();

        $this->assertCount(1, Book::all());
    }*/

    /** @test */
    public function a_title_is_required()
    {
        $response = $this->post('api/books/publish', [
            'title' => '',
            'description' => 'Some description',
            'category_id' => 1,
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAADvUlEQVR42rWXV2gVQRSGT+wxokZfVGyJJdYoir2ABQt2LNiw64MIBrGCBQt2RAUbJlbUBxUJGgW7ib1hrEhMsWFvDyrW+P+es3i5uXs3WXXgI7m7szP/njobIf5HJCgHPoF3fheJKOD86mAi6A1qgUJ2/TU4ARLB8f8hoDCYC2aA52APuARegihQH/QF7cExMAY8/VcCioF9oBOYBdaD7y5zW4MkUBp0Bvf+hQCadQDoam/tNbh5CqgCmoC3fyOgGzgM+oCD+djcGQzOdPnjDt8CLoAXov4t6BgCdooGa7YfATVAhqgvT/oQwMB9AtaCJX4EjAAbRX36XfyNXaAM6OlHwGwwHNTxuTnHfNAPxPsRwLwfDOr9hYB5YCBo4EfAOLAKlAU/fQrYAiqDLn4EUPUt0FLyl/+hRpZoHMzxI4DjDrgMRvvY3KkhjexFfAkYBraDtuBiATYvAa6aBXqHm5ifUpxib9HeFvQaRUSbVUfRUvzQSwBbanHw2WUO85gtlrWdgXkozHrVwFbQDPQAqR5W+koBy8B08AE8ANfBKVH/fbDJpcAGUZecFS2xdMkrUFI0YFmuWX6z7W960Et0Bx3MKjVFs2s5BTBKY0VTJg40By1EU28vWAru2kKMhQTRAIsK2IBzr4l2Tlrgm11nDeEZYpBZmtnEoL4v2qSyKGCHKewTpJgteDKoC9aJngUcNxUVbTLlRY9kmeB9wPM8ri0Gk0w8+8G+AItyJPM3BawE7eytQ8XISNGClGN+fSbhRwXRwI0BU0SzKDfEPFojjRuMBavNJz9cFo2xmOBoI+6HjGhwzv7vIe5tuLBZLIECaptPmGZpYd6soqm+Ie65TbM2Fq2e4SxFizND4pw6cNMWH+9hXoo8LdrhkoPuUdQB0UhP9Vhns6jL4x0BE8Aa0Sx45PHwflAJtAq6ft7eur/H81XN4symTY4ARjXrNetAT48FeEI6KpoFmXYt1p5l1/P6LuDZkm5vKFaInNHazMu8nxtmAYrllxBTNMmuMaeZagzCb2GeXQBmirrpd7AG9wIutNkWmx5msSvgDJhqv5nKjI/mLvPZH5abaMbZFudGqGbEU1CimZfF54jkzWOa8Q0YZb+3iRalXiHWY9XkobSWbb4n8KZbN+RkFh/mco5oYWGpfQw+ghWinXGkzWexYRxME+0NbFxN7fkYe55FKSN4I692zCYzVPSzjEETGXBvkfw56SwUPcQ6gyWbQc0P1t3gttsGBfk65txoE/HFXJAbcI8ucNr6OwldfvOMXxgnygjn13seAAAAAElFTkSuQmCC'
        ]);

        $response->assertJsonStructure(['message', 'data']);
        $response->assertStatus(400);
    }
}
