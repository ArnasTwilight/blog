<?php


class Pagination
{
    private $count;
    private $currentPage;
    private $postInPage;
    private $index;

    private $totalPages;

    private $maxLinks = 10;

    public function __construct($countNews, $currentPageGet, $newsOnePage, $index)
    {
        $this->count = $countNews;
        $this->postInPage = $newsOnePage;
        $this->index = $index;

//        echo 'Количество постов: ' . $this->count . '<br>';
//        echo 'Страница: ' . $this->currentPage . '<br>';
//        echo 'Количество постов на одной странице: ' . $this->postInPage . '<br>';

        $this->totalPages = $this->amountPages();

//        echo 'Количество страниц с постами: ' . $this->totalPages . '<br>';

        $this->setCurrentPage($currentPageGet);
    }

    private function amountPages ()
    {
        return ceil($this->count / $this->postInPage);
    }

    private function setCurrentPage ($currentPageGet)
    {
        $this->currentPage = $currentPageGet;

        if ($this->currentPage > 0)
        {
            if ($this->currentPage > $this->totalPages)
            {
                $this->currentPage = $this->totalPages;
            }
        } else {
            $this->currentPage = 1;
        }
    }

    public function getLinks ()
    {
        $links = null;
        $limits = $this->limitPage();
        $html = '<ul class="pagination list_reset">';

        for ($page = $limits['start']; $page <= $limits['end']; $page++)
        {
            if ($page == $this->currentPage) {
                $links .= '<li class="active"><a href="#">' . $page . '</a></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }

        if (!is_null($links))
        {
            if ($this->currentPage > 1)
            {
                $links = $this->generateHtml(1, '&lt;') . $links;
            }
            if ($this->currentPage < $this->totalPages)
            {
                $links .= $this->generateHtml($this->totalPages, '&gt');
            }
        }

        $html .= $links . '</ul>';

        return $html;
    }

    private function generateHtml ($page, $nameTextLink = null)
    {
        if (!$nameTextLink){
            $nameTextLink = $page;
        }

        $uri = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $uri = preg_replace('~/page-[0-9]+~', '', $uri);

        return '<li><a href="' . $uri . $this->index . $page . '">' . $nameTextLink . '</a></li>';
    }

    private function limitPage ()
    {
        $left = $this->currentPage - round($this->maxLinks / 2);

        $start = $left > 0 ? $left : 1;

        if ($start + $this->maxLinks <= $this->totalPages)
        {
            $end = $start > 1 ? $start + $this->maxLinks : $this->maxLinks;
        } else {
            $end = $this->totalPages;

            $start = $this->totalPages - $this->maxLinks > 0 ? $this->totalPages - $this->maxLinks : 1;
        }

        $arr = array('start' => $start, 'end' => $end);

        return $arr;



    }
}