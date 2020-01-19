<?php

    class Paginate {

        public $page;
        public $items_per_page;
        public $total_items;

        public function __construct($page = 1, $items_per_page = 4, $total_items = 0){
            $this->page = (int)$page;
            $this->items_per_page = (int)$items_per_page;
            $this->total_items = (int)$total_items;
        }

        public function next(){
            return $this->page + 1;
        }

        public function previous(){
            return $this->page - 1;
        }

        public function page_total() {
            return ceil($this->total_items / $this->items_per_page); 
        }

        public function has_previous(){
            return $this->previous() >= 1 ? true : false;
        }

        public function has_next(){
            return $this->next() <= $this->page_total() ? true : false;
        }
        
        public function offset(){
            return ($this->page - 1) * $this->items_per_page;
        }

    }

?>