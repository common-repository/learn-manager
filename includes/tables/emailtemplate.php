<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSLEARNMANAGERemailtemplateTable extends JSLEARNMANAGERtable {

    public $id = '';
    public $uid = '';
    public $templatefor = '';
    public $title = '';
    public $subject = '';
    public $body = '';
    public $status = '';
    public $created = '';

    function __construct() {
        parent::__construct('emailtemplates', 'id'); // tablename, primarykey
    }

}

?>