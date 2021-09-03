<?php

namespace app\lib;

class Pagination
{
    private $maxVisiblePages = 21;
    private $route;
    private $currentPage;
    private $totalPages;
    private $limitOnPage;
    private $pageAmount;

    public function __construct($route, $totalPages, $limitOnPage = 10)
    {
        $this->route = $route;
        $this->totalPages = $totalPages;
        $this->limitOnPage = $limitOnPage;
        $this->pageAmount = $this->calcPageAmount();
        $this->setCurrentPage();
    }

    public function getHtml()
    {
        $links = null;
        $limits = $this->limits();
        $html = '<nav><ul class="pagination">';
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            if ($page == $this->currentPage) {
                $links .= '<li class="page-item active"><span class="page-link">'.$page.'</span></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }
        if (!is_null($links)) {
            if ($this->currentPage > 1) {
                $links = $this->generateHtml(1, '<i class="fa fa-fast-backward" aria-hidden="true"></i>').$links;
            }
            if ($this->currentPage < $this->pageAmount) {
                $links .= $this->generateHtml($this->pageAmount, '<i class="fa fa-fast-forward" aria-hidden="true"></i>');
            }
        }
        $html .= $links.' </ul></nav>';
        return $html;
    }

    private function generateHtml($page, $text = null)
    {
        if (!$text) {
            $text = $page;
        }

        $sortOrEmptyString = '';
        if (isset($this->route['sort'])) {
            $sortOrEmptyString = '/'.$this->route['sort'];
        }
        return '<li class="page-item"><a class="page-link" href="/'.$page.$sortOrEmptyString.'">'.$text.'</a></li>';
    }

    private function limits()
    {
        $left = $this->currentPage - floor($this->maxVisiblePages / 2);
        $start = $left > 0 ? $left : 1;
        $end = $start + $this->maxVisiblePages - 1;
        if ($end > $this->pageAmount) {
            $end = $this->pageAmount;
            $start = ($end - $this->maxVisiblePages + 1 > 0) ? ($end - $this->maxVisiblePages + 1) : 1;
        }
        return array((int)$start, (int)$end);
    }

    private function setCurrentPage()
    {
        if (isset($this->route['page'])) {
            $currentPage = $this->route['page'];
        } else {
            $currentPage = 1;
        }
        $this->currentPage = $currentPage;
        if ($this->currentPage > 0) {
            if ($this->currentPage > $this->pageAmount) {
                $this->currentPage = $this->pageAmount;
            }
        } else {
            $this->currentPage = 1;
        }
    }

    private function calcPageAmount()
    {
        return (int)ceil($this->totalPages / $this->limitOnPage);
    }
}