<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA PRO -  Integrated Web Shipping System                         *
// * Copyright (c) JAOMWEB. All Rights Reserved                            *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: support@jaom.info                                              *
// * Website: http://www.jaom.info                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// * If you Purchased from Codecanyon, Please read the full License from   *
// * here- http://codecanyon.net/licenses/standard                         *
// *                                                                       *
// *************************************************************************



   require_once ("../../../loader.php");
   require_once ("../../../helpers/backups_function.php");

  /* == Delete SQL Backup == */
  if (isset($_POST['restoreBackup'])):
    
      $ok= doRestore($_POST['restoreBackup']);


      if($ok==1){ ?>

        <div class="alert alert-info" id="success-alert">
            <p><span class="icon-info-sign"></span><i class="close icon-remove-circle"></i>
                Database restored successfully!
           </p>
        </div>
      <?php
      }else{  ?>

        <div class="alert alert-info" id="danger-alert">
            <p><span class="icon-info-sign"></span><i class="close icon-remove-circle"></i>
                <span>Error! </span> There was an error processing the request
           </p>
        </div>
      <?php
      }

  endif;