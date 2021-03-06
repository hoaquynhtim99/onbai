<?php

/**
 * @Project ONBAI 4.x
 * @Author PHAN TAN DUNG (phantandung92@gmail.com)
 * @Copyright (C) 2014 PHAN TAN DUNG. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 1/21/2017, 10:56:09 PM
 */

if (!defined('NV_IS_ONBAI_ADMIN')) {
    die('Stop!!!');
}

if (defined('NV_EDITOR')) {
    require_once (NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php');
}

//khoi tao gia tri
$contents = "";
$error = "";
$rowcontent['title'] = "";
$rowcontent['quession'] = "";
$rowcontent['anwsera'] = "";
$rowcontent['anwserb'] = "";
$rowcontent['anwserc'] = "";
$rowcontent['anwserd'] = "";
$rowcontent['explain_true'] = "";
$rowcontent['explain_false'] = "";
$rowcontent['trueanwser'] = "";

// lay du lieu
$id = $nv_Request->get_int('id', 'get,post', 0);

if ($id == 0) {
    $page_title = $lang_module['addtest'];
} else {
    $page_title = $lang_module['edittest'];
    $sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_test WHERE id = " . $id;
    $resuilt = $db->query($sql);
    $row = $resuilt->fetch();
    $rowcontent['title'] = $row['title'];
    $rowcontent['quession'] = $row['quession'];
    $rowcontent['anwsera'] = $row['anwsera'];
    $rowcontent['anwserb'] = $row['anwserb'];
    $rowcontent['anwserc'] = $row['anwserc'];
    $rowcontent['anwserd'] = $row['anwserd'];
    $rowcontent['explain_true'] = $row['explain_true'];
    $rowcontent['explain_false'] = $row['explain_false'];
    $rowcontent['trueanwser'] = $row['trueanwser'];
}

//sua cau hoi
if ($nv_Request->get_int('edit', 'post', 0) == 1) {
    $rowcontent['title'] = $nv_Request->get_title('title', 'post', '');
    $rowcontent['quession'] = $nv_Request->get_string('ques', 'post', '');
    $rowcontent['anwsera'] = $nv_Request->get_string('anwsera', 'post', '');
    $rowcontent['anwserb'] = $nv_Request->get_string('anwserb', 'post', '');
    $rowcontent['anwserc'] = $nv_Request->get_string('anwserc', 'post', '');
    $rowcontent['anwserd'] = $nv_Request->get_string('anwserd', 'post', '');
    $rowcontent['explain_true'] = $nv_Request->get_textarea('explain_true', '', NV_ALLOWED_HTML_TAGS);
    $rowcontent['explain_false'] = $nv_Request->get_textarea('explain_false', '', NV_ALLOWED_HTML_TAGS);
    $rowcontent['trueanwser'] = $nv_Request->get_int('trueanwser', 'post', '');
    foreach ($rowcontent as $key => $data) {
        $query = $db->query("UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_test SET " . $key . " = " . $db->quote($data) . " WHERE id =" . $id);
    }
    if ($query) {
        Header("Location: " . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=test");
        die();
    } else {
        $error = $lang_module['error_save'];
    }
}

// them cau hoi
if ($nv_Request->get_int('add', 'post', 0) == 1) {

    // lay theo post
    $rowcontent['title'] = $nv_Request->get_title('title', 'post', '');
    $rowcontent['quession'] = $nv_Request->get_string('ques', 'post', '');
    $rowcontent['anwsera'] = $nv_Request->get_string('anwsera', 'post', '');
    $rowcontent['anwserb'] = $nv_Request->get_string('anwserb', 'post', '');
    $rowcontent['anwserc'] = $nv_Request->get_string('anwserc', 'post', '');
    $rowcontent['anwserd'] = $nv_Request->get_string('anwserd', 'post', '');
    $rowcontent['explain_false'] = $nv_Request->get_textarea('explain_false', '', NV_ALLOWED_HTML_TAGS);
    $rowcontent['explain_true'] = $nv_Request->get_textarea('explain_true', '', NV_ALLOWED_HTML_TAGS);
    $rowcontent['trueanwser'] = $nv_Request->get_int('trueanwser', 'post', '');

    if ($rowcontent['title'] == '') {
        $error = $lang_module['error_full_title'];
    } elseif ($rowcontent['quession'] == '') {
        $error = $lang_module['error_full_ques'];
    } elseif (($rowcontent['anwsera'] == '') || ($rowcontent['anwserb'] == '') || ($rowcontent['anwserc'] == '') || ($rowcontent['anwserd'] == '')) {
        $error = $lang_module['error_full_anwser'];
    } elseif ($rowcontent['trueanwser'] == '') {
        $error = $lang_module['error_full_trueanwser'];
    } else {
        $query = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_test 
        (
            id, title, quession, anwsera, anwserb, anwserc, anwserd, explain_true, explain_false, trueanwser
        ) 
        VALUES 
        ( 
            NULL, 
            " . $db->quote($rowcontent['title']) . ", 
            " . $db->quote($rowcontent['quession']) . ", 
            " . $db->quote($rowcontent['anwsera']) . " ,
            " . $db->quote($rowcontent['anwserb']) . " ,
            " . $db->quote($rowcontent['anwserc']) . " ,
            " . $db->quote($rowcontent['anwserd']) . " ,
            " . $db->quote($rowcontent['explain_true']) . " ,
            " . $db->quote($rowcontent['explain_false']) . " ,
            " . $db->quote($rowcontent['trueanwser']) . " 
        )
        ";
        if ($db->insert_id($query, 'id')) {
            Header("Location: " . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=test");
            die();
        } else {
            $error = $lang_module['error_save'];
        }

    }

}
if ($error) {
    $contents .= "<div class=\"quote\" style=\"width: 780px;\">\n
                    <blockquote class=\"error\">
                        <span>" . $error . "</span>
                    </blockquote>
                </div>\n
                <div class=\"clear\">
                </div>";
}

$contents .= "
<form method=\"post\" name=\"add_pic\">
    <div class=\"table-responsive\">
    <table class=\"table table-striped table-bordered table-hover\">
        <thead>
            <tr>
                <td colspan=\"2\">
                    " . $lang_module['ques'] . "
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style=\"width: 250px;\">
                    " . $lang_module['quession_title'] . "
                </td>
                <td>
                    <input name=\"title\" style=\"width: 470px;\" value=\"" . $rowcontent['title'] . "\" type=\"text\" class=\"form-control\">
                </td>
            </tr>
            <tr>
                <td colspan=\"2\"><strong>" . $lang_module['ques_body'] . "</strong></td>
            </tr>
            <tr>
                <td colspan=\"2\">";
if (defined('NV_EDITOR') and function_exists('nv_aleditor')) {
    $contents .= nv_aleditor('ques', '100%', '200px', $rowcontent['quession']);
} else {
    $contents .= "<textarea style=\"width: 100%\" value=\"" . $rowcontent['quession'] . "\" name=\"ques\" id=\"ques\" cols=\"20\" rows=\"15\"></textarea>\n";
}
$contents .= "
                </td>
            </tr>
            <tr>
                <td colspan=\"2\"><strong>" . $lang_module['anwser'] . " A:</strong></td>
            </tr>
            
            <tr>
                <td colspan=\"2\">";
if (defined('NV_EDITOR') and function_exists('nv_aleditor')) {
    $contents .= nv_aleditor('anwsera', '100%', '200px', $rowcontent['anwsera']);
} else {
    $contents .= "<textarea style=\"width: 100%\" value=\"" . $rowcontent['anwsera'] . "\" name=\"anwsera\" id=\"anwsera\" cols=\"20\" rows=\"15\"></textarea>\n";
}
$contents .= "
                </td>
            </tr>
            <tr>
                <td colspan=\"2\"><strong>" . $lang_module['anwser'] . " B:</strong></td>
            </tr>
            
            <tr>
                <td colspan=\"2\">";
if (defined('NV_EDITOR') and function_exists('nv_aleditor')) {
    $contents .= nv_aleditor('anwserb', '100%', '200px', $rowcontent['anwserb']);
} else {
    $contents .= "<textarea style=\"width: 100%\" value=\"" . $rowcontent['anwserb'] . "\" name=\"anwserb\" id=\"anwserb\" cols=\"20\" rows=\"15\"></textarea>\n";
}
$contents .= "
                </td>
            </tr>
            <tr>
                <td colspan=\"2\"><strong>" . $lang_module['anwser'] . " C:</strong></td>
            </tr>
            
            <tr>
                <td colspan=\"2\">";
if (defined('NV_EDITOR') and function_exists('nv_aleditor')) {
    $contents .= nv_aleditor('anwserc', '100%', '200px', $rowcontent['anwserc']);
} else {
    $contents .= "<textarea style=\"width: 100%\" value=\"" . $rowcontent['anwserc'] . "\" name=\"anwserc\" id=\"anwserc\" cols=\"20\" rows=\"15\"></textarea>\n";
}
$contents .= "
                </td>
            </tr>
            <tr>
                <td colspan=\"2\"><strong>" . $lang_module['anwser'] . " D:</strong></td>
            </tr>
            
            <tr>
                <td colspan=\"2\">";
if (defined('NV_EDITOR') and function_exists('nv_aleditor')) {
    $contents .= nv_aleditor('anwserd', '100%', '200px', $rowcontent['anwserd']);
} else {
    $contents .= "<textarea style=\"width: 100%\" value=\"" . $rowcontent['anwserd'] . "\" name=\"anwserd\" id=\"anwserd\" cols=\"20\" rows=\"15\"></textarea>\n";
}
$contents .= "
                </td>
            </tr>
            <tr>
                <td colspan=\"2\"><strong>" . $lang_module['explain_true'] . "</strong></td>
            </tr>

            <tr>
                <td colspan=\"2\">";
$contents .= "<textarea style=\"width: 100%\" value=\"" . $rowcontent['explain_true'] . "\" name=\"explain_true\" id=\"explain_true\" cols=\"20\" rows=\"15\" class=\"form-control\"></textarea>\n";
$contents .= "
                </td>
            </tr>
            <tr>
                <td colspan=\"2\"><strong>" . $lang_module['explain_false'] . "</strong></td>
            </tr>
            
            <tr>
                <td colspan=\"2\">";
$contents .= "<textarea style=\"width: 100%\" value=\"" . $rowcontent['explain_false'] . "\" name=\"explain_false\" id=\"explain_false\" cols=\"20\" rows=\"15\" class=\"form-control\"></textarea>\n";
$contents .= "
                </td>
            </tr>
            
            <tr>
                <td>" . $lang_module['trueanwser'] . "</td>
                <td>
                    <select name=\"trueanwser\" id=\"trueanwser\" style=\"width: 212px\" class=\"form-control\">
                        <option value=\"0\">" . $lang_module['select_anwser'] . "</option>
                        <option value=\"1\"" . ($rowcontent['trueanwser'] == 1 ? " selected=\"selected\"" : "") . ">" . $lang_module['anwser'] . " A</option>
                        <option value=\"2\"" . ($rowcontent['trueanwser'] == 2 ? " selected=\"selected\"" : "") . ">" . $lang_module['anwser'] . " B</option>
                        <option value=\"3\"" . ($rowcontent['trueanwser'] == 3 ? " selected=\"selected\"" : "") . ">" . $lang_module['anwser'] . " C</option>
                        <option value=\"4\"" . ($rowcontent['trueanwser'] == 4 ? " selected=\"selected\"" : "") . ">" . $lang_module['anwser'] . " D</option>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td colspan=\"2\" align=\"center\">\n
                    <input name=\"confirm\" value=\"" . $lang_module['save'] . "\" type=\"submit\" class=\"btn btn-primary\">\n";
if ($id == 0)
    $contents .= "<input type=\"hidden\" name=\"add\" id=\"add\" value=\"1\">\n";
else
    $contents .= "<input type=\"hidden\" name=\"edit\" id=\"edit\" value=\"1\">\n";
$contents .= "<span name=\"notice\" style=\"float: right; padding-right: 50px; color: red; font-weight: bold;\"></span>\n
                </td>\n
            </tr>\n
        </tbody>\n
    </table>\n
    </div>\n
</form>\n";

include (NV_ROOTDIR . "/includes/header.php");
echo nv_admin_theme($contents);
include (NV_ROOTDIR . "/includes/footer.php");
