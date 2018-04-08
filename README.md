# paginator # cli-progress-bar [![Build Status](https://travis-ci.org/dariuszp/paginator.png?branch=master)](https://travis-ci.org/dariuszp/paginator)

## Installation

```bash
composer require dariuszp/paginator
```

## Usage

```php
$paginator = new \Dariuszp\Paginator\Paginator\Simple(
    '/article?page={page}&onPage={onPage}',
    $itemsAmount,
    4, // current page
    10, // items per page
    2, // amount of links on the left and right of the current page
    true, // show next page link
    true, // show prev page link
    true, // show first page link
    true // show last page link
);

$data = $paginator->getData();

$render = new \Dariuszp\Paginator\Render\Spaghetti();
$html = $render->render($data);

echo $html;
```

will display:

```html
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item first-page"><a href="/article?page=1&onPage=10" class="page-link">First</a></li>            
        <li class="page-item previous-page"><a href="/article?page=3&onPage=10" class="page-link">Previous</a></li>      
        <li class="page-item page"><a href="/article?page=2&onPage=10" class="page-link">2</a></li>
        <li class="page-item page"><a href="/article?page=3&onPage=10" class="page-link">3</a></li>
        <li class="page-item page active"><a href="/article?page=4&onPage=10" class="page-link">4</a></li>
        <li class="page-item page"><a href="/article?page=5&onPage=10" class="page-link">5</a></li>
        <li class="page-item page"><a href="/article?page=6&onPage=10" class="page-link">6</a></li>      
        <li class="page-item next-page"><a href="/article?page=5&onPage=10" class="page-link">Next</a></li>            
        <li class="page-item last-page"><a href="/article?page=10&onPage=10" class="page-link">Last</a></li>            
    </ul>
</nav>
```

----

License: [MIT](https://opensource.org/licenses/MIT)

Author: Półtorak Dariusz