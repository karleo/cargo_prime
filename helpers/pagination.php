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


 
    function cdp_paginate($page, $total_pages, $pageVisible) {

    $prevlabel = "Previous";
    $nextlabel = "Next";
    $out = '<nav>';
    $out .= '<ul class="pagination  pagination-sm  pull-right">';
    
    // previous label

    if($page==1) {
        $out.= "<li class='page-item disabled'><a class='page-link'>$prevlabel</a></li>";
    } else if($page==2) {
        $out.= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cdp_load(1)'>$prevlabel</a></li>";
    }else {
        $out.= "<li class='page-item'><a  class='page-link' href='javascript:void(0);' onclick='cdp_load(".($page-1).")'>$prevlabel</a></li>";

    }
    
    // first label
    if($page>($pageVisible+1)) {
        $out.= "<li class='page-item'><a  class='page-link' href='javascript:void(0);' onclick='cdp_load(1)'>1</a></li>";
    }
    // interval
    if($page>($pageVisible+2)) {
        $out.= "<li class='page-item'><a  class='page-link'>...</a></li>";
    }

    // pages

    $pmin = ($page>$pageVisible) ? ($page-$pageVisible) : 1;
    $pmax = ($page<($total_pages-$pageVisible)) ? ($page+$pageVisible) : $total_pages;
    for($i=$pmin; $i<=$pmax; $i++) {
        if($i==$page) {
            $out.= "<li class='active page-item'><a class='page-link'>$i</a></li>";
        }else if($i==1) {
            $out.= "<li class='page-item'><a  class='page-link' href='javascript:void(0);' onclick='cdp_load(1)'>$i</a></li>";
        }else {
            $out.= "<li class='page-item'><a  class='page-link' href='javascript:void(0);' onclick='cdp_load(".$i.")'>$i</a></li>";
        }
    }

    // interval

    if($page<($total_pages-$pageVisible-1)) {
        $out.= "<li class='page-item'><a  class='page-link'>...</a></li>";
    }

    // last

    if($page<($total_pages-$pageVisible)) {
        $out.= "<li class='page-item'><a  class='page-link' href='javascript:void(0);' onclick='cdp_load($total_pages)'>$total_pages</a></li>";
    }

    // next

    if($page<$total_pages) {
        $out.= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cdp_load(".($page+1).")'>$nextlabel</a></li>";
    }else {
        $out.= "<li class='disabled page-item'><a  class='page-link'>$nextlabel</a></li>";
    }
    
    $out.= "</ul>";
    $out.= "</nav>";
    return $out;
}
