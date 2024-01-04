<?php

namespace classes;

class Pagination
{
    public $countPages = 1;
    public $currentPage = 1;
    public $uri = '';
    public $midSize = 2;
    public $allPages = 8;


    public function __construct(
        public $page = 1,
        public $perPage = 1,
        public $total = 1
    )
    {
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPages();
        $this->uri = $this->getParams();
        $this->midSize = $this->getMidSize();
    }

    public function  getCountPages(){
        return ceil($this->total / $this->perPage) ?: 1;
    }
    public function  getCurrentPages(){
        if($this->page < 1){
            $this->page = 1;
        }
        if($this->page > $this->countPages){
            $this->page = $this->countPages;
        }
        return $this->page;
    }
    public function  getStart(){
        return ($this->page - 1) * $this->perPage;
    }

    private function getParams(){
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = $url[0];
        if(isset($url[1]) && $url[1] !== ''){
            $uri .= '?';
            $params = explode('&', $url[1]);
            foreach ($params as $param) {
                if(!str_contains($param, 'page=')){
                    $uri .= "{$param}&";
                }
            }
        }
        return $uri;
    }
    public function getHtml() {
        $back = '';
        $forward = '';
        $startPage = '';
        $endPage = '';
        $pagesLeft = '';
        $pagesRight = '';

        if($this->currentPage > 1){
            $back =  "<a href='" . $this->getLink($this->currentPage - 1 ) . "' class='pagination__item'>&lt;</a>";
        }

        if($this->currentPage < $this->countPages){
            $forward =  "<a href='" . $this->getLink($this->currentPage + 1 ) . "' class='pagination__item'>&gt;</a>";
        }

        if($this->currentPage > $this->midSize + 1){
            $startPage = "<a href='" . $this->getLink(1 ) . "' class='pagination__item'>&laquo;</a>";
        }

        if($this->currentPage < ($this->countPages - $this->midSize) ){
            $endPage = "<a href='" . $this->getLink($this->countPages ) . "' class='pagination__item'>&raquo;</a>";
        }

        for ($i = $this->midSize; $i > 0; $i--){
            if($this->currentPage - $i > 0 ) {
                $pagesLeft .= "<a href='" . $this->getLink($this->currentPage - $i ) . "' class='pagination__item'>" . ($this->currentPage - $i) . "</a>";
            }
        }

        for ($i = 1; $i <= $this->midSize; $i++){
            if($this->currentPage + $i <= $this->countPages ) {
                $pagesRight .= "<a href='" . $this->getLink($this->currentPage + $i ) . "' class='pagination__item'>" . ($this->currentPage + $i) . "</a>";
            }
        }

        return "<div class='pagination'>" . $startPage . $back . $pagesLeft . "<span class='pagination__item active'>" . $this->currentPage .'</span>' .  $pagesRight . $forward . $endPage . '</div>';
    }

    public function getLinks() {
        $links = [];
        if($this->countPages < 2){
            return $links;
        }


        $start = $this->currentPage > $this->midSize + 1;
        $end = $this->currentPage < ($this->countPages - $this->midSize);
        if($this->currentPage > $this->midSize + 1){
            $links[] = [
                'link' => $this->getLink(1),
                'type' => 'link',
                'active' => false,
                'number' => 1
            ];
        }

//        if($this->currentPage > 1){
//            $links[] = [
//                'link' => $this->getLink($this->currentPage - 1),
//                'type' => 'prev',
//                'active' => false,
//                'number' => $this->currentPage - 1
//            ];
//        }

        if($this->currentPage > 1 && $start){
            $links[] = [
                'type' => 'fake',
            ];
        }

        for ($i = $this->midSize; $i > 0; $i--){
            if($this->currentPage - $i > 0 ) {
                $links[] = [
                    'link' => $this->getLink($this->currentPage - $i) ,
                    'type' => 'link',
                    'active' => false,
                    'number' => $this->currentPage - $i
                ];
            }
        }

        $links[] = [
            'link' => $this->getLink($this->currentPage),
            'type' => 'link',
            'active' => true,
            'number' => $this->currentPage - $i
        ];

        for ($i = 1; $i <= $this->midSize; $i++){
            if($this->currentPage + $i <= $this->countPages ) {
                $links[] = [
                    'link' => $this->getLink($this->currentPage + $i),
                    'type' => 'link',
                    'active' => false,
                    'number' => $this->currentPage + $i
                ];
            }
        }

        if($this->currentPage < $this->countPages && $end){
            $links[] = [
                'type' => 'fake',
            ];
        }
//        if($this->currentPage < $this->countPages){
//            $links[] = [
//                'link' => $this->getLink($this->currentPage + 1),
//                'type' => 'fake',
//                'active' => false,
//                'number' => $this->currentPage + 1
//            ];
//        }

        if($this->currentPage < ($this->countPages - $this->midSize)){
            $links[] = [
                'link' => $this->getLink($this->countPages),
                'type' => 'link',
                'active' => false,
                'number' => $this->countPages
            ];
        }
            return $links;
    }

    private function getLink($page){
        if($page == 1) {
            return rtrim($this->uri, '?&');
        }
        if(str_contains($this->uri, '&') || str_contains($this->uri, '?')){
            return "{$this->uri}page={$page}";
        } else {
            return"{$this->uri}?page={$page}";
        }

    }

    private function getMidSize() {
        return $this->countPages <= $this->allPages ? $this->countPages : $this->midSize;
    }

    public function __toString()  {
        return $this->getHtml();
    }
}