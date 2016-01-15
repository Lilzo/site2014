<?php
class Pagination {
    
    private $number_of_items;
    private $items_per_page;
    private $current_page;
    private $number_of_pages;
    private $number_of_page_boxes;

    public function __construct(){
        
      //  echo '<form id="paginator" method = "get" action = "">';
    }
    
    public function close_form_and_div(){
       // echo '</form>';
        
    }

        public function set_pagination_parameters($num_of_items, $items_per_page, $current_page = 1, $number_of_page_boxes = 5){
        $this->number_of_items = $num_of_items;
        $this->items_per_page = $items_per_page;
        $this->current_page = $current_page;
        $this->number_of_page_boxes = $number_of_page_boxes;
        $this->number_of_pages = ceil($this->number_of_items / $this->items_per_page);
    }
    
     private function display_pagination_input_with_value($value){
        $additional_class = ($value == $this->current_page)? 'active' : 'gradient';
            echo $page_input = '<input onclick="pageNumber(this.value)" class="pageing '.$additional_class .'" type="submit" name="page" value = "'.$value.'">';
        //return $page_input;
       
    }
    
    private function get_pagination_up_to_6_pages(){
        
        for($t = 1; $t<=$this->number_of_pages; $t++){
            $this->display_pagination_input_with_value($t);
        }
    }
    
    private function get_full_size_pagination(){
        $space = '&nbsp;&nbsp;&nbsp;';
        $half_of_pageboxes = floor($this->number_of_page_boxes/2);
        $page_boxes = '';
            if ($this->current_page <= $half_of_pageboxes+1){
                for($t = 1; $t<$this->number_of_page_boxes+1; $t++){
                    $page_boxes .= $this->display_pagination_input_with_value($t);
               }
               $page_boxes .= $space . $this->display_pagination_input_with_value($this->number_of_pages);
            } else if ($this->current_page > $this->number_of_pages - $this->number_of_page_boxes +1){
                $page_boxes = $this->display_pagination_input_with_value(1).$space;
                for($t = $this->number_of_pages - $this->number_of_page_boxes+1; $t<=$this->number_of_pages; $t++){
                  $page_boxes .= $this->display_pagination_input_with_value($t);
                }
            } else {
             $page_boxes = $this->display_pagination_input_with_value(1) .$space;
                for($t = $this->current_page - $half_of_pageboxes; $t<=$this->current_page + $half_of_pageboxes; $t++){
                    $page_boxes .= $this->display_pagination_input_with_value($t);
                }
            $page_boxes .= $space . $this->display_pagination_input_with_value($this->number_of_pages);
            }
            echo $page_boxes;
        }
        
    public function get_pagination(){
        echo '<div class="paginations">';
            if ($this->number_of_pages >6){
                echo $this->get_full_size_pagination();
            } else {
                echo $this->get_pagination_up_to_6_pages($this->number_of_pages);
            }
        echo '</div>';
    }
}
