Last login: Sun Aug 20 22:10:31 on ttys001
KAHOLICSs-MacBook-Pro:~ joinpaintball$ ssh hoteluat@sipuk1-27.nexcess.netdiff -bur -x '.*' /Applications/MAMP/htdocs/rhexpat_svn/ /Applications/MAMP/htdocs/rhexpat
ssh: Could not resolve hostname sipuk1-27.nexcess.netdiff: nodename nor servname provided, or not known
KAHOLICSs-MacBook-Pro:~ joinpaintball$ diff -bur -x '.*' /Applications/MAMP/htdocs/rhexpat_svn/ /Applications/MAMP/htdocs/rhexpat
Only in /Applications/MAMP/htdocs/rhexpat_svn/DEV_TOOLS: expatlive_20170302.sql
Only in /Applications/MAMP/htdocs/rhexpat_svn/DEV_TOOLS: rh-2016-11-17_devsquad_save.sql
diff -bur -x '.*' /Applications/MAMP/htdocs/rhexpat_svn/application/config/config.php /Applications/MAMP/htdocs/rhexpat/application/config/config.php
--- /Applications/MAMP/htdocs/rhexpat_svn/application/config/config.php	2017-03-02 14:14:55.000000000 +0100
+++ /Applications/MAMP/htdocs/rhexpat/application/config/config.php	2016-11-15 17:36:30.000000000 +0100
@@ -18,9 +18,8 @@
|
*/

-$config['base_url'] = 'http://devsquad.hu/expatlive';
-
-//$config['base_url'] = 'http://localhost:8888/rhexpat';
+//$config['base_url'] = 'http://devsquad.hu/expatlive';
+$config['base_url'] = 'http://localhost:8888/rhexpat';


/*
diff -bur -x '.*' /Applications/MAMP/htdocs/rhexpat_svn/application/config/database.php /Applications/MAMP/htdocs/rhexpat/application/config/database.php
--- /Applications/MAMP/htdocs/rhexpat_svn/application/config/database.php	2017-03-02 14:14:55.000000000 +0100
+++ /Applications/MAMP/htdocs/rhexpat/application/config/database.php	2016-11-15 17:34:58.000000000 +0100
@@ -59,7 +59,7 @@
| the query builder class.
*/

-$active_group = 'devsquad';
+$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
diff -bur -x '.*' /Applications/MAMP/htdocs/rhexpat_svn/application/controllers/User.php /Applications/MAMP/htdocs/rhexpat/application/controllers/User.php
--- /Applications/MAMP/htdocs/rhexpat_svn/application/controllers/User.php	2017-03-02 14:14:56.000000000 +0100
+++ /Applications/MAMP/htdocs/rhexpat/application/controllers/User.php	2016-11-14 14:07:46.000000000 +0100
@@ -211,14 +211,14 @@
else
{
$data = $this->upload->data();
-                   /* if ($data['image_width'] != $data['image_height']) {
+                    if ($data['image_width'] != $data['image_height']) {
$msg .= lang('upload_picture_cubic') . '<br/>';
$this->session->set_flashdata('message', $msg);
$user_pic_real = null;
@unlink($data['full_path']);
-                    } else {*/
+                    } else {
$user_pic_real = $data["file_name"];
-                   // }
+                    }
}

}else{
diff -bur -x '.*' /Applications/MAMP/htdocs/rhexpat_svn/application/controllers/Users.php /Applications/MAMP/htdocs/rhexpat/application/controllers/Users.php
--- /Applications/MAMP/htdocs/rhexpat_svn/application/controllers/Users.php	2017-03-02 14:14:56.000000000 +0100
+++ /Applications/MAMP/htdocs/rhexpat/application/controllers/Users.php	2016-11-14 14:07:46.000000000 +0100
@@ -102,15 +102,15 @@

} else {
$data = $this->upload->data();
-                    /*if ($data['image_width'] != $data['image_height']) {
+                    if ($data['image_width'] != $data['image_height']) {
$msg .= lang('upload_picture_cubic') . '<br/>';
$this->session->set_flashdata('message', $msg);
$user_pic_real = null;
@unlink($data['full_path']);
-                    } else {*/
+                    } else {
$user_pic_real = $data["file_name"];
$_SESSION['upload_user'] = $user_pic_real;
-                    //}
+                    }
}
} else {
$user_pic_real = $_SESSION['upload_user'];
@@ -275,14 +275,14 @@
$user_pic_real = null;
} else {
$data = $this->upload->data();
-                        /*if ($data['image_width'] != $data['image_height']) {
+                        if ($data['image_width'] != $data['image_height']) {
$msg .= lang('upload_picture_cubic') . '<br/>';
$this->session->set_flashdata('message', $msg);
$user_pic_real = null;
@unlink($data['full_path']);
-                        } else {*/
+                        } else {
$user_pic_real = $data["file_name"];
-                       // }
+                        }
}
} else {
$user_pic_real = "";
diff -bur -x '.*' /Applications/MAMP/htdocs/rhexpat_svn/application/views/templates/_parts/admin_master_header_view.php /Applications/MAMP/htdocs/rhexpat/application/views/templates/_parts/admin_master_header_view.php
--- /Applications/MAMP/htdocs/rhexpat_svn/application/views/templates/_parts/admin_master_header_view.php	2017-03-02 14:15:50.000000000 +0100
+++ /Applications/MAMP/htdocs/rhexpat/application/views/templates/_parts/admin_master_header_view.php	2016-11-14 14:07:37.000000000 +0100
@@ -194,10 +194,9 @@
if($this->session->userdata['user_picture'] != null){ ?>
<img class="profile-img" width="100" height="100" class="img-thumbnail user_pic"
     src="<?php echo base_url("uploads/user/" . $this->session->userdata['user_picture']) ?>" alt="">
-	                <?php    }else{?>
    -								<img class="profile-img" width="100" height="100" class="img-thumbnail user_pic"
                                          -	                            src="<?php echo base_url("uploads/user/no_profile_image.jpg") ?>" alt="">
    - 	                <?php  }} ?>
    +	                <?php    }  } else { ?>
    +
    + 	                <?php  } ?>
<a class="navbar-brand"
   href="<?php echo site_url('user/profile'); ?>"><?php echo $this->session->userdata['username'] ?></a>
<a class="navbar-brand logout"
   diff -bur -x '.*' /Applications/MAMP/htdocs/rhexpat_svn/application/views/user/profile_view.php /Applications/MAMP/htdocs/rhexpat/application/views/user/profile_view.php
    --- /Applications/MAMP/htdocs/rhexpat_svn/application/views/user/profile_view.php	2017-03-02 14:15:53.000000000 +0100
    +++ /Applications/MAMP/htdocs/rhexpat/application/views/user/profile_view.php	2016-11-14 14:07:38.000000000 +0100
    @@ -102,11 +102,11 @@
<div class="form-group">
    <label for="userPicture"><?php echo lang("current_picture") ?></label>
    <br />
    -                        <?php if($user->user_picture == null){ ?>
    -							<img height="50" src=<?php echo base_url("uploads/user/no_profile_image.jpg") ?>>
    -						 <?php }else{ ?>
        +                        <?php if($user->user_picture != null){ ?>
    <img height="50" src=<?php echo base_url("uploads/user/".$user->user_picture) ?>>
    -                       <?php } ?>
        +                        <?php }else{
    +                            echo label('label_no_current_picture');
    +                        } ?>
</div>

<?php echo form_submit('submit', lang('save_profile'), 'class="btn btn-primary btn-lg btn-block"');?>
Only in /Applications/MAMP/htdocs/rhexpat_svn/uploads/user: no_profile_image.jpg
KAHOLICSs-MacBook-Pro:~ joinpaintball$
