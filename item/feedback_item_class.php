<?PHP  // $Id: feedback_item_class.php,v 1.3.2.4 2011/06/02 14:00:15 agrabs Exp $

class feedback_item_base {
    var $type;
    /**
     * The class constructor
     *
     */
    function feedback_item_base() {
        $this->init();
    }

    /**
     * Fake constructor to keep PHP5 happy
     *
     */
    function __construct() {
        $this->feedback_item_base();
    }
    
    /**
     * prints the item-related sequenz on the edit-item form
     * 
     * @param $item the db-object from feedback_item
     * @param $usehtmleditor defines whether the editor should be shown or not
     */
    function &show_edit($item, $usehtmleditor = false) {
    }

    /**
     * returns an Array with three values(typ, name, XXX)
     * XXX is also an Array (count of responses on type $this->type)
     * each element is a structure (answertext, answercount)
     * @param $item the db-object from feedback_item
     * @param $groupid if given
     * @param $courseid if given
     * @return array
    */
    function get_analysed($item, $groupid = false, $courseid = false) {
        return array();
    }

    /**
     * @param object $item the db-object from feedback_item
     * @param string $value a item-related value from feedback_values
     * @return string
    */
    function get_printval($item, $value) {
      return '';
    }

    /**
     * @param $item the db-object from feedback_item
     * @param string $itemnr
     * @param integer $groupid
     * @param integer $courseid
     * @return integer the new itemnr
    */
    function print_analysed($item, $itemnr = '', $groupid = false, $courseid = false) {
      return 0;
    }

    /**
     * @param object $worksheet a reference to the pear_spreadsheet-object
     * @param integer $rowOffset
     * @param object $item the db-object from feedback_item
     * @param integer $groupid
     * @param integer $courseid
     * @return integer the new rowOffset
    */
    function excelprint_item(&$worksheet, $rowOffset, $item, $groupid, $courseid = false) {
      return $rowOffset;
    }

    function print_item($item, $value = false, $readonly = false, $edit = false, $highlightrequire = false){
    }

    function check_value($value, $item) {
        return true;
    }
    
    function create_item() {
        $feedbackid = required_param('feedbackid', PARAM_INT);
        $template = optional_param('template', 0, PARAM_INT);
        $position = optional_param('position', 0, PARAM_INT);
        $required = optional_param('required', 0, PARAM_INT);
        
        $str_noitemname = get_string('no_itemname', 'feedback');
        $itemname = optional_param('itemname', $str_noitemname, PARAM_TEXT);
        
        $item = new object;
        $item->id = '';
        $item->feedback = $feedbackid;

        $item->template = $template;

        $item->name = addslashes(trim($itemname));
        
        $item->hasvalue = $this->get_hasvalue();
        $item->typ = $this->type;
        $item->position = $position + 1;

        $item->required = $required;

        $item->presentation = '';
        
        return $item;
    }

    function update_item(&$item) {
        $feedbackid = required_param('feedbackid', PARAM_INT);
        $template = optional_param('template', 0, PARAM_INT);
        $position = optional_param('position', 0, PARAM_INT);
        $required = optional_param('required', 0, PARAM_INT);
        
        $str_noitemname = get_string('no_itemname', 'feedback');
        $itemname = optional_param('itemname', $str_noitemname, PARAM_TEXT);
        
        $item->template = $template;

        $item->name = addslashes(trim($itemname));
        
        $item->position = $position;

        $item->required = $required;

        $item->presentation = '';
        
        return $item;
    }

    function create_value($data) {
        return '';
    }

    function get_presentation($data) {
      return '';
   }

    function get_hasvalue() {
        return 0;
    }
}

//a dummy class to realize pagebreaks
class feedback_item_pagebreak extends feedback_item_base {
    var $type = "pagebreak";
    function init() {
    
    }
}

?>
