<?php if (!defined('ABSPATH')) die('Restricted Access'); ?>
<?php 
    wp_enqueue_script('jquery.min');
    wp_enqueue_script('jquery-ui-sortable');
?>
<script type="text/javascript">// For Earning Graph
    function resetFrom() {
      document.getElementById('searchname').value = '';
      document.getElementById('status').value = '';
      document.getElementById('JSLEANRMANAGER_form_search').submit();
    }   

</script>
<script type="text/javascript">
 jQuery(document).ready(function () {
        jQuery('table#jslm_js-table tbody').sortable({ 
            handle : ".jsst-order-grab-column",
            update  : function () {
                jQuery('.jslms_saveordering_btn').slideDown('slow');
                var abc =  jQuery('table#jslm_js-table tbody').sortable('serialize');
                jQuery('input#fields_ordering_new').val(abc);
            }
        });
    });
</script>


<div id="jslearnmanageradmin-wrapper">
    <div id="jslearnmanageradmin-leftmenu">
        <?php  JSLEARNMANAGERincluder::getClassesInclude('jslearnmanageradminsidemenu'); ?>
    </div>
    <div id="jslearnmanageradmin-data">
    <?php 
    $msgkey = JSLEARNMANAGERincluder::getJSModel('category')->getMessagekey();
    JSLEARNMANAGERmessages::getLayoutMessage($msgkey); 
    ?>

        <div id="jslearnmanageradmin-wrapper-top">
            <div id="jslearnmanageradmin-wrapper-top-left">
                <div id="jslearnmanageradmin-breadcrunbs">
                    <ul>
                        <li>
                            <a href="admin.php?page=jslearnmanager">
                                <?php echo __('Dashboard', 'learn-manager'); ?>
                            </a>
                        </li>
                        <li><?php echo __('Category','js-support-ticket'); ?></li>
                    </ul>
                </div>
            </div>
            <div id="jslearnmanageradmin-wrapper-top-right">
                <div id="jslearnmanageradmin-help-txt">
                   <a href="<?php echo esc_url(admin_url("admin.php?page=jslearnmanager&jslmslay=help")); ?>" title="<?php echo __('Help','learn-manager'); ?>">
                        <img alt="<?php echo __('Help','learn-manager'); ?>" src="<?php echo JSLEARNMANAGER_PLUGIN_URL; ?>includes/images/help.png" />
                    </a>
                </div>
                <div id="jslearnmanageradmin-vers-txt">
                    <?php echo __('Version :'); ?>
                    <span class="jslearnmanageradmin-ver">
                        <?php echo esc_html(JSLEARNMANAGERincluder::getJSModel('configuration')->getConfigValue('versioncode')); ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="jslm_dashboard">
            <span class="jslm_heading-dashboard"><?php echo __('Categories', 'learn-manager'); ?></span>
                    <a class="jslmsadmin-add-link" href="<?php echo esc_url(admin_url('admin.php?page=jslm_category&jslmslay=formcategory')); ?>"><img src="<?php echo JSLEARNMANAGER_PLUGIN_URL ?>includes/images/add_icon.png" /><?php echo __('Add New','learn-manager') .'&nbsp;'. __('Category', 'learn-manager') ?></a>
        </div>            
    <div id="jslms-data-wrp">
     <div class="jslm_page-actions js-row no-margin">
         <a class="jslm_js-bulk-link button multioperation" message="<?php echo esc_attr(JSLEARNMANAGERmessages::getMSelectionEMessage()); ?>" data-for="publish" href="#"><img src="<?php echo JSLEARNMANAGER_PLUGIN_URL ?>includes/images/publish-icon.png" /><?php echo __('Publish', 'learn-manager') ?></a>
        <a class="jslm_js-bulk-link button multioperation" message="<?php echo esc_attr(JSLEARNMANAGERmessages::getMSelectionEMessage()); ?>" data-for="unpublish" href="#"><img src="<?php echo JSLEARNMANAGER_PLUGIN_URL ?>includes/images/unbuplish.png" /><?php echo __('Unpublish', 'learn-manager') ?></a>
        <a class="jslm_js-bulk-link button multioperation" message="<?php echo esc_attr(JSLEARNMANAGERmessages::getMSelectionEMessage()); ?>" confirmmessage="<?php echo __('Are you sure to delete','learn-manager'); ?>" data-for="remove" href="#"><img src="<?php echo JSLEARNMANAGER_PLUGIN_URL ?>includes/images/delete-icon.png" /><?php echo __('Delete','learn-manager') ?></a>
     </div>
     <form class="jslm_js-filter-form" name="jslearnmanagerform" id="jslearnmanagerform" method="post" action="<?php echo esc_url(admin_url("admin.php?page=jslm_category")); ?>">
        <?php                        
        echo wp_kses(JSLEARNMANAGERformfield::select('pagesize', array((object) array('id'=>20,'text'=>20), (object) array('id'=>50,'text'=>50), (object) array('id'=>100,'text'=>100)), jslearnmanager::$_data['filter']['pagesize'],__("Records per page",'learn-manager '), array('class' => 'jslm_js_select_record jslm_js-filter-form','onchange'=>'document.jslearnmanagerform.submit();')), JSLEARNMANAGER_ALLOWED_TAGS); 
       ?>
     </form>
    <form class="jslm_js-filter-form" name="JSLEANRMANAGER_form_search" id="JSLEANRMANAGER_form_search" method="post" action="<?php echo esc_url(admin_url("admin.php?page=jslm_category")); ?>">
        <?php echo wp_kses(JSLEARNMANAGERformfield::text('searchname', jslearnmanager::$_data['filter']['searchname'] , array('class' => 'inputbox', 'placeholder' => __('Name', 'learn-manager'))), JSLEARNMANAGER_ALLOWED_TAGS); ?>
        <?php echo wp_kses(JSLEARNMANAGERformfield::select('status', JSLEARNMANAGERincluder::getJSModel('common')->getstatus(), is_numeric(jslearnmanager::$_data['filter']['status']) ? jslearnmanager::$_data['filter']['status'] : '', __('Select Status', 'learn-manager'), array('class' => 'inputbox')), JSLEARNMANAGER_ALLOWED_TAGS); ?>
        <?php echo wp_kses(JSLEARNMANAGERformfield::hidden('JSLEANRMANAGER_form_search', 'JSLEARNMANGER_SEARCH'), JSLEARNMANAGER_ALLOWED_TAGS); ?>
        <div class="filter-bottom-button">
            <?php echo wp_kses(JSLEARNMANAGERformfield::submitbutton('btnsubmit', __('Search', 'learn-manager'), array('class' => 'button')), JSLEARNMANAGER_ALLOWED_TAGS); ?>
            <?php echo wp_kses(JSLEARNMANAGERformfield::button('reset', __('Reset', 'learn-manager'), array('class' => 'button', 'onclick' => 'resetFrom();')), JSLEARNMANAGER_ALLOWED_TAGS); ?>
         </div>
    </form>
    <?php
    if (!empty(jslearnmanager::$_data[0])) {
        ?>          
        <form id="jslearnmanager-list-form" method="post" action="<?php echo esc_url(admin_url("admin.php?page=jslm_category&task=saveordering")); ?>">
            <table id="jslm_js-table">
                <thead>
                    <tr>
                        <th class="jslm_grid"><input type="checkbox" name="selectall" id="jslm_selectall" value=""></th>
                        <th class="jslm_centered"><?php echo __('Ordering', 'learn-manager'); ?></th>
                        <th class="jslm_left-row"><?php echo __('Category Title', 'learn-manager'); ?></th>
                        <th class="jslm_centered"><?php echo __('Default', 'learn-manager'); ?></th>
                        <th class="jslm_centered"><?php echo __('Published', 'learn-manager'); ?></th>
                        <th class="action"><?php echo __('Action', 'learn-manager'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pagenum = JSLEARNMANAGERrequest::getVar('pagenum', 'get', 1);
                    $pageid = ($pagenum > 1) ? '&pagenum=' . $pagenum : '';
                    $islastordershow = JSLEARNMANAGERpagination::isLastOrdering(jslearnmanager::$_data['total'], $pagenum);
                    for ($i = 0, $n = count(jslearnmanager::$_data[0]); $i < $n; $i++) {
                    $row = jslearnmanager::$_data[0][$i];
                    $upimg = 'uparrow.png';
                    $downimg = 'downarrow.png';
                    ?>
                      <tr valign="top"  id="id_<?php echo esc_attr($row->id);?>">
                            <td class="jslm_grid-rows">
                                <input type="checkbox" class="jslearnmanager-cb" id="jslearnmanager-cb" name="jslearnmanager-cb[]" value="<?php echo esc_attr($row->id); ?>" />
                            </td>
                             <td class="jsst-order-grab-column">
                                        <img alt="<?php echo __('grab','learn-manager'); ?>" src="<?php echo JSLEARNMANAGER_PLUGIN_URL.'includes/images/list-full.png'?>"/>   
                            </td>
                            <td class="jslm_left-row">
                                <a href="<?php echo esc_url(admin_url('admin.php?page=jslm_category&jslmslay=formcategory&jslearnmanagerid='.$row->id)); ?>"><?php echo esc_html(__($row->category_name,'learn-manager')); ?></a>
                            </td>
                            <td>
                                <?php if ($row->isdefault == 1) { ?>
                                    <img src="<?php echo JSLEARNMANAGER_PLUGIN_URL ?>includes/images/default.png" alt="Default" />
                                <?php } else { ?>
                                    <a href="<?php echo admin_url('admin.php?page=jslm_common&task=makedefault&action=jslmstask&for=category&jslmslay=categories&id='.$row->id.$pageid); ?>">
                                        <img src="<?php echo JSLEARNMANAGER_PLUGIN_URL ?>includes/images/notdefault.png" alt="Not Default" />
                                    </a>
                                <?php } ?>  
                            </td>   
                            <td>
                                <?php if ($row->status == 1) { ?> 
                                    <a href="<?php echo admin_url('admin.php?page=jslm_category&task=unpublish&action=jslmstask&jslearnmanager-cb[]='.$row->id.$pageid); ?>">
                                        <img src="<?php echo JSLEARNMANAGER_PLUGIN_URL ?>includes/images/yes.png" alt="<?php echo __('Published', 'learn-manager'); ?>" />
                                    </a>
                                <?php } else { ?>
                                    <a href="<?php echo admin_url('admin.php?page=jslm_category&task=publish&action=jslmstask&jslearnmanager-cb[]='.$row->id.$pageid); ?>">
                                        <img src="<?php echo JSLEARNMANAGER_PLUGIN_URL ?>includes/images/no.png" alt="<?php echo __('Not Published', 'learn-manager'); ?>" />
                                    </a>
                                <?php } ?>  
                            </td>
                            <td class="action">
                                <a href="<?php echo admin_url('admin.php?page=jslm_category&jslmslay=formcategory&jslearnmanagerid='.$row->id); ?>"><img src="<?php echo JSLEARNMANAGER_PLUGIN_URL ?>includes/images/edit.png" title="<?php echo __('Edit', 'learn-manager'); ?>"></a>
                                <a href="<?php echo wp_nonce_url(admin_url('admin.php?page=jslm_category&task=remove&action=jslmstask&jslearnmanager-cb[]='.$row->id),'delete-category'); ?>" onclick="return confirmdelete('<?php echo __('Are you sure to delete', 'learn-manager').' ?'; ?>');"><img src="<?php echo JSLEARNMANAGER_PLUGIN_URL ?>includes/images/remove.png" title="<?php echo __('Delete', 'learn-manager'); ?>"></a>
                            </td>
                        </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
            <?php echo wp_kses(JSLEARNMANAGERformfield::hidden('action', 'category_remove'), JSLEARNMANAGER_ALLOWED_TAGS); ?>
            <?php echo wp_kses(JSLEARNMANAGERformfield::hidden('pagenum', ($pagenum > 1) ? $pagenum : ''), JSLEARNMANAGER_ALLOWED_TAGS); ?>
            <?php echo wp_kses(JSLEARNMANAGERformfield::hidden('task', ''), JSLEARNMANAGER_ALLOWED_TAGS); ?>
            <?php echo wp_kses(JSLEARNMANAGERformfield::hidden('form_request', 'jslearnmanager'), JSLEARNMANAGER_ALLOWED_TAGS); ?>
            <?php echo wp_kses(JSLEARNMANAGERformfield::hidden('_wpnonce', wp_create_nonce('delete-category')), JSLEARNMANAGER_ALLOWED_TAGS); ?>
            <?php echo wp_kses(JSLEARNMANAGERformfield::hidden('fields_ordering_new', '123'), JSLEARNMANAGER_ALLOWED_TAGS); ?>
            <div class="jslms_saveordering_btn" style="display: none;">
                        <?php echo JSLEARNMANAGERformfield::submitbutton('save', __('Save Ordering', 'jslearnmanager'), array('class' => 'button js-form-save')); ?>
          </div>
        </form>
        <?php
        if (jslearnmanager::$_data[1]) {
            echo '<div class="tablenav"><div class="tablenav-pages">' . jslearnmanager::$_data[1] . '</div></div>';
        }
    } else {
        $msg = __('No record found','learn-manager');
        $link[] = array(
                    'link' => 'admin.php?page=jslm_categories&jslmslay=formcategory',
                    'text' => __('Add New','learn-manager') .'&nbsp;'. __('Category','learn-manager')
                );
        echo wp_kses(JSLEARNMANAGERlayout::getNoRecordFound($msg,$link), JSLEARNMANAGER_ALLOWED_TAGS);
    }
    ?>
</div>
</div>
</div>
