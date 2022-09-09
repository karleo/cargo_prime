<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA BASIC -  Freight Forwarding & Shipping Software Solutions     *
// * Copyright (c) JAOMWEB. All Rights Reserved                            *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: support@jaom.info                                              *
// * Website: https://deprixa.link/documentation/                          *
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



class Core 
{


  private  $db; 

  function __construct()
  {
    $this->db = new Conexion;
    $this->cdp_getSettings();
  }

  /**
   * Core::cdp_getSettings()
   */
  private function cdp_getSettings()
  {

    $this->db->cdp_query('SELECT * FROM cdb_settings');


    $this->db->cdp_execute();
    $settings = $this->db->cdp_registro();


    $this->site_name = $settings->site_name;
    $this->c_nit = $settings->c_nit;
    $this->c_phone = $settings->c_phone;
    $this->cell_phone = $settings->cell_phone;
    $this->c_address = $settings->c_address;
    $this->locker_address = $settings->locker_address;
    $this->c_country = $settings->c_country;
    $this->c_city = $settings->c_city;
    $this->c_postal = $settings->c_postal;
    $this->site_url = $settings->site_url;

    //EMAIL SMTP
    $this->site_email = $settings->site_email;
    $this->mailer = $settings->mailer;
    $this->smtp_names = $settings->smtp_names;
    $this->email_address = $settings->email_address;
    $this->smtp_host = $settings->smtp_host;
    $this->smtp_user = $settings->smtp_user;
    $this->smtp_password = $settings->smtp_password;
    $this->smtp_port = $settings->smtp_port;
    $this->smtp_secure = $settings->smtp_secure;

    //SETTINGS COMPANY
    $this->interms = $settings->interms;
    $this->signing_customer = $settings->signing_customer;
    $this->signing_company = $settings->signing_company;
    $this->logo = $settings->logo;
    $this->favicon = $settings->favicon;
    $this->backup = $settings->backup;
    $this->thumb_w = $settings->thumb_w;
    $this->thumb_h = $settings->thumb_h;

    $this->logo_web = $settings->logo_web;
    $this->thumb_web = $settings->thumb_web;
    $this->thumb_hweb = $settings->thumb_hweb;

    //APIS SMS TWILIO
    $this->twilio_sms_token = $settings->twilio_sms_token;
    $this->twilio_sms_sid = $settings->twilio_sms_sid;
    $this->twilio_sms_number = $settings->twilio_sms_number;
    $this->active_sms = $settings->active_sms; 


    //SETTINGS TRACK INVOICE AND TAXES
    $this->version = $settings->version;
    $this->prefix = $settings->prefix;
    $this->track_digit = $settings->track_digit;
    $this->digit_random = $settings->digit_random;
    $this->prefix_consolidate = $settings->prefix_consolidate;
    $this->track_consolidate = $settings->track_consolidate;
    $this->track_online_shopping = $settings->track_online_shopping;
    $this->prefix_online_shopping = $settings->prefix_online_shopping;


    $this->active_tax1 = $settings->active_tax1;
    $this->active_tax2 = $settings->active_tax2;
    $this->active_tax3 = $settings->active_tax3;
    $this->active_tax4 = $settings->active_tax4;
    $this->active_tax5 = $settings->active_tax5;
    $this->active_tax6 = $settings->active_tax6;
    $this->active_tax7 = $settings->active_tax7;

    $this->twilio_token = $settings->twilio_token;
    $this->twilio_sid = $settings->twilio_sid;
    $this->twilio_number = $settings->twilio_number;
    $this->active_whatsapp = $settings->active_whatsapp;

    $this->tax = $settings->tax;
    $this->insurance = $settings->insurance;
    $this->value_weight = $settings->value_weight;
    $this->weight_p = $settings->weight_p;
    $this->meter = $settings->meter;
    $this->units = $settings->units;
    $this->c_tariffs = $settings->c_tariffs;

    $this->currency = $settings->currency;
    $this->for_currency = $settings->for_currency;
    $this->for_symbol = $settings->for_symbol;
    $this->for_decimal = $settings->for_decimal;
    $this->cformat = $settings->cformat;
    $this->dec_point = $settings->dec_point;
    $this->thousands_sep = $settings->thousands_sep;
    $this->timezone = $settings->timezone;
    $this->language = $settings->language;
    $this->min_cost_tax = $settings->min_cost_tax;

    $this->declared_tax = $settings->declared_tax;
    $this->min_cost_declared_tax = $settings->min_cost_declared_tax;

    $this->notify_admin  = $settings->notify_admin;
    $this->user_limit  = $settings->user_limit;
    $this->reg_allowed = $settings->reg_allowed;

    $this->auto_verify = $settings->auto_verify;
    $this->reg_verify = $settings->reg_verify;
    $this->code_number = $settings->code_number;
    $this->user_perpage = $settings->user_perpage;



    date_default_timezone_set($this->timezone);
  }




  /**
   * Core::cdp_getZone()
   */
  public function cdp_getZone()
  {

    $sql = "SELECT * FROM cdb_zone ORDER BY id ASC";
    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $row = $this->db->cdp_registros();

    return $row;
  }




  /**
   * Core::cdp_getOffices()
   */
  public function cdp_getOffices()
  {
    $sql = "SELECT * FROM cdb_offices ORDER BY id ASC";


    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $row = $this->db->cdp_registros();

    return $row;
  }



  /**
   * Core::cdp_getBranchoffices()
   */

  public function cdp_getBranchoffices()
  {
    $sql = "SELECT * FROM cdb_branchoffices ORDER BY id ASC";

    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $row = $this->db->cdp_registros();

    return $row;
  }


  /**
   * Core::cdp_getCouriercom()
   */
  public function cdp_getCouriercom()
  {
    $sql = "SELECT * FROM cdb_courier_com ORDER BY id ASC";

    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $row = $this->db->cdp_registros();

    return $row;
  }

  /**
   * Core::cdp_getStatus()
   */
  public function cdp_getStatus()
  {
    $sql = "SELECT * FROM cdb_styles ORDER BY id ASC";
    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $row = $this->db->cdp_registros();

    return $row;
  }


  /**
   * Core::cdp_getStatus()
   */
  public function cdp_getStatusPickup()
  {
    $sql = "SELECT * FROM cdb_styles where id !='14' ORDER BY id ASC";
    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $row = $this->db->cdp_registros();

    return $row;
  }


  /**
   * Core::cdp_getPack()
   */
  public function cdp_getPack()
  {
    $sql = "SELECT * FROM cdb_packaging ORDER BY id ASC";
    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $row = $this->db->cdp_registros();

    return $row;
  }


  /**
   * Core::cdp_getPayment()
   */
  public function cdp_getPayment()
  {
    $sql = "SELECT * FROM cdb_met_payment WHERE is_active = 1 ORDER BY id ASC";
    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $row = $this->db->cdp_registros();

    return $row;
  }

  /**
   * Core::cdp_getPaymentMethod()
   */
  public function cdp_getPaymentMethod()
  {
    $sql = "SELECT * FROM cdb_payment_methods ORDER BY id ASC";
    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $row = $this->db->cdp_registros();

    return $row;
  }

  /**
   * Core::cdp_getItem()
   */

  public function cdp_getItem()
  {
    $sql = "SELECT * FROM cdb_category ORDER BY id ASC";
    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $row = $this->db->cdp_registros();

    return $row;
  }


  /**
   * Core::cdp_getShipmode()
   */
  public function cdp_getShipmode()
  {
    $sql = "SELECT * FROM cdb_shipping_mode ORDER BY id ASC";

    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $row = $this->db->cdp_registros();

    return $row;
  }

  /**
   * Core::cdp_getDelitime()
   */
  public function cdp_getDelitime()
  {
    $sql = "SELECT * FROM cdb_delivery_time ORDER BY id ASC";
    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $row = $this->db->cdp_registros();

    return $row;
  }


  /**
   * Core::cdp_trackDigits()
   */

  public function cdp_trackDigits()
  {
    //Prefix tracking 
    $sql = "SELECT * FROM cdb_settings";

    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $trackd = $this->db->cdp_registro();

    $digits = $trackd->track_digit;

    return $digits;
  }

 

  /**
   * Core::cdp_order_track()
   */
  public function cdp_order_track()
  {
    //Prefix tracking	
    $sql = "SELECT * FROM cdb_settings";

    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $trackd = $this->db->cdp_registro();

    $digitss = $trackd->track_digit;


    $this->db->cdp_query("SELECT MAX(order_no) AS order_no FROM cdb_add_order");
    $this->db->cdp_execute();

    $invNum = $this->db->cdp_fetch_assoc();
    $max_id = $invNum['order_no'];
    $cod = $max_id;
    $sig = $cod + 1;

    $Strsig = (string)$sig;
    $formato = str_pad($Strsig, "" . $digitss . "", "0", STR_PAD_LEFT);



    return $formato;
  }


  /**
   * Core::cdp_getDelitime()
   */
  public function cdp_consolidate_track()
  {
    //Prefix tracking 
    $sql = "SELECT * FROM cdb_settings";

    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $trackd = $this->db->cdp_registro();

    $digits = $trackd->track_digit;

    $this->db->cdp_query("SELECT MAX(c_no) AS c_no FROM cdb_consolidate");
    $this->db->cdp_execute();

    $invNum = $this->db->cdp_fetch_assoc();
    $max_id = $invNum['c_no'];
    $cod = $max_id;
    $sig = $cod + 1;

    $Strsig = (string)$sig;
    $formato = str_pad($Strsig, "" . $digits . "", "0", STR_PAD_LEFT);



    return $formato;
  }


  /**
   * Core::cdp_online_shopping_track()
   */
  public function cdp_online_shopping_track()
  {
    //Prefix tracking 
    $sql = "SELECT * FROM cdb_settings";

    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $trackd = $this->db->cdp_registro();

    $digits = $trackd->track_digit;

    $this->db->cdp_query("SELECT MAX(order_no) AS order_no FROM cdb_customers_packages");
    $this->db->cdp_execute();

    $invNum = $this->db->cdp_fetch_assoc();
    $max_id = $invNum['order_no'];
    $cod = $max_id;
    $sig = $cod + 1;

    $Strsig = (string)$sig;
    $formato = str_pad($Strsig, "" . $digits . "", "0", STR_PAD_LEFT);



    return $formato;
  }


  /**
   * Core::cdp_getCategories()
   */

  public function cdp_getCategories()
  {
    $sql = "SELECT * FROM cdb_category ORDER BY id ASC";
    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $row = $this->db->cdp_registros();

    return $row;
  }


  /**
   * Core::cdp_getUsersEmployeedAdmin()
   */
  public function cdp_getUsersEmployeedAdmin()
  {
    $sql = "SELECT * FROM cdb_users where (userlevel=2 or userlevel=9) ORDER BY id ASC";
    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $row = $this->db->cdp_registros();

    return $row;
  }


  /**
   * Core::cdp_getCodeCountries() 
   */
  public function cdp_getCodeCountries()
  {
    $sql = "SELECT * FROM cdb_countries ORDER BY id ASC";
    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $row = $this->db->cdp_registros();

    return $row;
  }

  /**
   * Core::cdp_getCodeCountriescurrency()
   */
  public function cdp_getCodeCountriescurrency()
  {
    $sql = "SELECT currency_symbol FROM cdb_countries ORDER BY id ASC";
    $this->db->cdp_query($sql);
    $this->db->cdp_execute();
    $row = $this->db->cdp_registros();

    return $row;
  }


}
