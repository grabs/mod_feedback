<?PHP  // $Id: lib.php,v 1.7.2.3 2011/06/02 14:00:16 agrabs Exp $
defined('FEEDBACK_INCLUDE_TEST') OR die('not allowed');
require_once($CFG->dirroot.'/mod/feedback/item/feedback_item_class.php');

class feedback_item_label extends feedback_item_base {
    var $type = "label";
    function init() {
    
    }
    
    function &show_edit($item) {
        global $CFG;
        
        require_once('label_form.php');
        
        $item_form = new feedback_label_form();
        
        $item->presentation = isset($item->presentation) ? $item->presentation : '';
        
        $item_form->area->setValue($item->presentation);
        return $item_form;
    }
    function print_item($item){
    ?>
        <td colspan="2">
            <?php echo format_text($item->presentation);?>
        </td>
    <?php
    }

    function create_item() {
        $item = parent::create_item();
        $labeltext = optional_param('presentation', '', PARAM_CLEANHTML);
        $item->presentation = $labeltext;
        return $item;
    }

    function update_item(&$item) {
        $item = parent::update_item($item);
        $labeltext = optional_param('presentation', '', PARAM_CLEANHTML);
        $item->presentation = $labeltext;
        return $item;
    }

    function create_value($data) {
        return false;
    }

    function get_hasvalue() {
        return 0;
    }
}
?>