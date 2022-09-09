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



// ===========================================================
// MODULE ALL TOOLS
// ===========================================================


// ===========================================================
// USERS
// ===========================================================


function cdp_insertUserfp40f($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_users
        (
            username,
            name_off,
            password,
            userlevel,
            email,
            fname,
            lname,
            avatar,
            created,
            notes,
            phone,
            gender,
            newsletter,
            active
            
        )

        VALUES (
            :username,
            :branch_office,
            :password,
            :userlevel,
            :email,
            :fname,
            :lname,
            :avatar,
            :created,
            :notes,
            :phone,
            :gender,
            :newsletter,
            :active 
        )');


    $db->bind(':username', $datos['username']);
    $db->bind(':branch_office', $datos['branch_office']);
    $db->bind(':password', $datos['password']);
    $db->bind(':userlevel', $datos['userlevel']);
    $db->bind(':email', $datos['email']);
    $db->bind(':fname', $datos['fname']);
    $db->bind(':lname', $datos['lname']);
    $db->bind(':avatar', $datos['avatar']);
    $db->bind(':created', $datos['created']);
    $db->bind(':notes', $datos['notes']);
    $db->bind(':phone', $datos['phone']);
    $db->bind(':gender', $datos['gender']);
    $db->bind(':newsletter', $datos['newsletter']);
    $db->bind(':active', $datos['active']);




    return $db->cdp_execute();
}

function cdp_updateUserrx0xr($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_users SET
    
            name_off =:branch_office,
            password =:password,
            email =:email,
            document_type =:document_type,
            document_number =:document_number,
            fname =:fname,
            lname =:lname,
            notes =:notes,
            phone =:phone,
            userlevel =:userlevel,
            gender =:gender,
            newsletter =:newsletter,
            active =:active,
            avatar =:avatar

            where id = :id
            
        ');


    $db->bind(':userlevel', $datos['userlevel']);
    $db->bind(':branch_office', $datos['branch_office']);
    $db->bind(':password', $datos['password']);
    $db->bind(':email', $datos['email']);
    $db->bind(':fname', $datos['fname']);
    $db->bind(':lname', $datos['lname']);
    $db->bind(':notes', $datos['notes']);
    $db->bind(':phone', $datos['phone']);
    $db->bind(':gender', $datos['gender']);
    $db->bind(':newsletter', $datos['newsletter']);
    $db->bind(':active', $datos['active']);
    $db->bind(':avatar', $datos['avatar']);
    $db->bind(':document_type', $datos['document_type']);
    $db->bind(':document_number', $datos['document_number']);
    $db->bind(':id', $datos['id']);




    return $db->cdp_execute();
}



function cdp_getUserEdit4bozo($id)
{
    $db = new Conexion;

    $db->cdp_query('SELECT * FROM cdb_users WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}

function cdp_deleteUsersrhv5($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_users WHERE id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}




// ===========================================================
// USERS SINGUP
// ===========================================================



function cdp_insertUserSignUp($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_users
        (
            username,
            password,
            locker,
            userlevel,
            email,
            fname,
            lname,
            country,
            city,
            postal,
            created,
            address,
            terms
            
        )

        VALUES (
            :username,
            :password,
            :locker,
            :userlevel,
            :email,
            :fname,
            :lname,
            :country,
            :city,
            :postal,
            :created,
            :address,
            :terms
        )');


    $db->bind(':username', $datos['username']);
    $db->bind(':password', $datos['password']);
    $db->bind(':userlevel', $datos['userlevel']);
    $db->bind(':email', $datos['email']);
    $db->bind(':fname', $datos['fname']);
    $db->bind(':lname', $datos['lname']);
    $db->bind(':created', $datos['created']);
    $db->bind(':locker', $datos['locker']);
    $db->bind(':terms', $datos['terms']);

    $db->bind(':country', $datos['country']);
    $db->bind(':city', $datos['city']);
    $db->bind(':postal', $datos['postal']);
    $db->bind(':address', $datos['address']);




    return $db->cdp_execute();
}



function cdp_verifyEmailt1xle($email)
{
    $db = new Conexion;

    $db->cdp_query("SELECT * FROM cdb_users WHERE  email=:email");
    $db->bind(':email', $email);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result == 1) {

        return true;
    } else {

        return false;
    }
}


function cdp_updatePassword5glmh($datos)
{
    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_users SET  password=:password where email=:email');
    $db->bind(':password', $datos['password']);
    $db->bind(':email', $datos['email']);

    return $db->cdp_execute();
}


// ===========================================================
// USERS TEMPLATE EMAIL
// ===========================================================

function cdp_getEmailTemplatesdg1i4($id)
{
    $db = new Conexion;

    $db->cdp_query("SELECT * FROM cdb_email_templates WHERE  id=:id");
    $db->bind(':id', $id);
    $db->cdp_execute();
    return $result = $db->cdp_registro();
}



// ===========================================================
// USERS TEMPLATE EMAIL
// ===========================================================

function cdp_getEmailTemplatesSMS($id)
{
    $db = new Conexion;

    $db->cdp_query("SELECT * FROM cdb_sms_templates WHERE  id=:id");
    $db->bind(':id', $id);
    $db->cdp_execute();
    return $result = $db->cdp_registro();
}


function cdp_getUserForEmail($email)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_users WHERE email=:email');

    $db->bind(':email', $email);

    $db->cdp_execute();

    return $data = $db->cdp_registro();
}


// ===========================================================
// USERS TEMPLATE SMS
// ===========================================================

function cdp_getsmsTemplates($id)
{
    $db = new Conexion;

    $db->cdp_query("SELECT * FROM cdb_sms_templates WHERE  id=:id");
    $db->bind(':id', $id);
    $db->cdp_execute();
    return  $db->cdp_registro();
}


// ===========================================================
// USERS DRIVERS
// ===========================================================

function cdp_insertDrivers1fcoe($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_users
        (
            username,
            password,
            locker,
            userlevel,
            email,
            fname,
            lname,
            avatar,
            created,
            notes,
            phone,
            enrollment,
            vehiclecode,
            gender,
            newsletter,
            active
            
        )

        VALUES (
            :username,
            :password,
            :locker,
            :userlevel,
            :email,
            :fname,
            :lname,
            :avatar,
            :created,
            :notes,
            :phone,
            :enrollment,
            :vehiclecode,
            :gender,
            :newsletter,
            :active 
        )');


    $db->bind(':username', $datos['username']);
    $db->bind(':locker', $datos['locker']);
    $db->bind(':password', $datos['password']);
    $db->bind(':userlevel', $datos['userlevel']);
    $db->bind(':email', $datos['email']);
    $db->bind(':fname', $datos['fname']);
    $db->bind(':lname', $datos['lname']);
    $db->bind(':avatar', $datos['avatar']);
    $db->bind(':created', $datos['created']);
    $db->bind(':notes', $datos['notes']);
    $db->bind(':phone', $datos['phone']);
    $db->bind(':gender', $datos['gender']);
    $db->bind(':newsletter', $datos['newsletter']);
    $db->bind(':active', $datos['active']);
    $db->bind(':enrollment', $datos['enrollment']);
    $db->bind(':vehiclecode', $datos['vehiclecode']);




    return $db->cdp_execute();
}





function cdp_updateDrivers($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_users SET
    
            password =:password,
            email =:email,
            fname =:fname,
            lname =:lname,
            notes =:notes,
            phone =:phone,
            gender =:gender,
            newsletter =:newsletter,
            active =:active,
            avatar =:avatar,
            enrollment=:enrollment,
            vehiclecode=:vehiclecode

            where id = :id
            
        ');


    $db->bind(':password', $datos['password']);
    $db->bind(':email', $datos['email']);
    $db->bind(':fname', $datos['fname']);
    $db->bind(':lname', $datos['lname']);
    $db->bind(':notes', $datos['notes']);
    $db->bind(':phone', $datos['phone']);
    $db->bind(':gender', $datos['gender']);
    $db->bind(':newsletter', $datos['newsletter']);
    $db->bind(':active', $datos['active']);
    $db->bind(':avatar', $datos['avatar']);
    $db->bind(':id', $datos['id']);
    $db->bind(':enrollment', $datos['enrollment']);
    $db->bind(':vehiclecode', $datos['vehiclecode']);




    return $db->cdp_execute();
}





// ===========================================================
// UPDATE CONFIG GENERAL
// ===========================================================

function cdp_updateConfigGeneral0gqr5($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_settings SET
    
            language =:language,
            currency =:currency,
            for_currency =:for_currency,
            for_symbol =:for_symbol,
            for_decimal =:for_decimal,
            cformat =:cformat,
            dec_point =:dec_point,
            thousands_sep =:thousands_sep,
            timezone =:timezone            
            
        ');

    $db->bind(':language', $datos['language']);
    $db->bind(':currency', $datos['currency']);
    $db->bind(':for_currency', $datos['for_currency']);
    $db->bind(':for_symbol', $datos['for_symbol']);
    $db->bind(':for_decimal', $datos['for_decimal']);
    $db->bind(':cformat', $datos['cformat']);
    $db->bind(':dec_point', $datos['dec_point']);
    $db->bind(':thousands_sep', $datos['thousands_sep']);
    $db->bind(':timezone', $datos['timezone']);




    return $db->cdp_execute();
}

// ===========================================================
// UPDATE CONFIG SYSTEM
// ===========================================================

function cdp_updateConfigSystemytdb1($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_settings SET
    
            site_name =:site_name,            
            c_nit =:c_nit,
            c_phone =:c_phone,
            cell_phone =:cell_phone,
            c_address =:c_address,
            locker_address =:locker_address,
            c_country =:c_country,
            c_city =:c_city,
            c_postal =:c_postal,
            site_email =:site_email,
            reg_allowed =:reg_allowed,
            reg_verify =:reg_verify,
            notify_admin =:notify_admin,
            auto_verify =:auto_verify,
            thumb_w =:thumb_w,
            thumb_h =:thumb_h,
            logo =:logo,
            favicon =:favicon            
            
        ');


    $db->bind(':site_name', $datos['site_name']);
    $db->bind(':c_nit', $datos['c_nit']);
    $db->bind(':c_phone', $datos['c_phone']);
    $db->bind(':cell_phone', $datos['cell_phone']);
    $db->bind(':c_address', $datos['c_address']);
    $db->bind(':locker_address', $datos['locker_address']);
    $db->bind(':c_country', $datos['c_country']);
    $db->bind(':c_city', $datos['c_city']);
    $db->bind(':c_postal', $datos['c_postal']);
    $db->bind(':site_email', $datos['site_email']);
    $db->bind(':reg_allowed', $datos['reg_allowed']);
    $db->bind(':reg_verify', $datos['reg_verify']);
    $db->bind(':notify_admin', $datos['notify_admin']);
    $db->bind(':auto_verify', $datos['auto_verify']);
    $db->bind(':thumb_w', $datos['thumb_w']);
    $db->bind(':thumb_h', $datos['thumb_h']);
    $db->bind(':logo', $datos['logo']);
    $db->bind(':favicon', $datos['favicon']);



    return $db->cdp_execute();
}






// ===========================================================
// UPDATE CONFIG TAXES
// ===========================================================

function cdp_updateConfigTaxesx4spw($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_settings SET
    
            tax =:tax,
            insurance =:insurance,
            value_weight =:value_weight,
            weight_p =:weight_p,
            meter =:meter,
            units =:units,
            min_cost_tax=:min_cost_tax,
            c_tariffs =:c_tariffs, 
            min_cost_declared_tax =:min_cost_declared_tax,
            declared_tax = :declared_tax                 
            
        ');


    $db->bind(':tax', $datos['tax']);
    $db->bind(':insurance', $datos['insurance']);
    $db->bind(':value_weight', $datos['value_weight']);
    $db->bind(':weight_p', $datos['weight_p']);
    $db->bind(':min_cost_tax', $datos['min_cost_tax']);
    $db->bind(':meter', $datos['meter']);
    $db->bind(':units', $datos['units']);
    $db->bind(':c_tariffs', $datos['c_tariffs']);
    $db->bind(':declared_tax', $datos['declared_tax']);
    $db->bind(':min_cost_declared_tax', $datos['min_cost_declared_tax']);



    return $db->cdp_execute();
}


// ===========================================================
// UPDATE CONFIG INFO SHIP DEFAULT
// ===========================================================

function cdp_updateConfigInfoShipDefault4xiw0($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_info_ship_default SET
    
            logistics_default1 =:logistics_default1,
            packaging_default2 =:packaging_default2,
            courier_default3 =:courier_default3,
            service_default4 =:service_default4,
            time_default5 =:time_default5,
            pay_default6 =:pay_default6, 
            payment_default7 =:payment_default7,
            status_default8 = :status_default8                 
            
        ');


    $db->bind(':logistics_default1', $datos['logistics_default1']);
    $db->bind(':packaging_default2', $datos['packaging_default2']);
    $db->bind(':courier_default3', $datos['courier_default3']);
    $db->bind(':service_default4', $datos['service_default4']);
    $db->bind(':time_default5', $datos['time_default5']);
    $db->bind(':pay_default6', $datos['pay_default6']);
    $db->bind(':payment_default7', $datos['payment_default7']);
    $db->bind(':status_default8', $datos['status_default8']);



    return $db->cdp_execute();
}



// ===========================================================
// UPDATE CONFIG EMAIL SMTP
// ===========================================================

function cdp_updateConfigSmtpemailr2g61($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_settings SET
    
            mailer =:mailer,
            smtp_names =:smtp_names,
            email_address =:email_address,
            smtp_host =:smtp_host,
            smtp_user =:smtp_user,
            smtp_password =:smtp_password,
            smtp_port =:smtp_port,
            smtp_secure =:smtp_secure
            
        ');


    $db->bind(':mailer', $datos['mailer']);
    $db->bind(':smtp_names', $datos['smtp_names']);
    $db->bind(':email_address', $datos['email_address']);
    $db->bind(':smtp_host', $datos['smtp_host']);
    $db->bind(':smtp_user', $datos['smtp_user']);
    $db->bind(':smtp_password', $datos['smtp_password']);
    $db->bind(':smtp_port', $datos['smtp_port']);
    $db->bind(':smtp_secure', $datos['smtp_secure']);



    return $db->cdp_execute();
}



// ===========================================================
// UPDATE CONFIG TRACK INVOICE
// ===========================================================

function cdp_updateConfigTrackInvoicepn8vt($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_settings SET
    
            interms =:interms,
            signing_customer =:signing_customer,
            signing_company =:signing_company,
            prefix =:prefix,
            track_digit =:track_digit,
            code_number =:code_number,
            digit_random =:digit_random,
            prefix_consolidate =:prefix_consolidate,
            track_consolidate =:track_consolidate                              
            
        ');


    $db->bind(':interms', $datos['interms']);
    $db->bind(':signing_customer', $datos['signing_customer']);
    $db->bind(':signing_company', $datos['signing_company']);
    $db->bind(':prefix', $datos['prefix']);
    $db->bind(':track_digit', $datos['track_digit']);
    $db->bind(':code_number', $datos['code_number']);
    $db->bind(':digit_random', $datos['digit_random']);
    $db->bind(':prefix_consolidate', $datos['prefix_consolidate']);
    $db->bind(':track_consolidate', $datos['track_consolidate']);


    return $db->cdp_execute();
}





// ===========================================================
// UPDATE CONFIG PAYMENT
// ===========================================================

function cdp_updateConfigPaymentgowxl($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_settings SET
    
            account_paypal =:account_paypal,
            client_id =:client_id            
        ');

    $db->bind(':client_id', $datos['client_id']);
    $db->bind(':account_paypal', $datos['account_paypal']);




    return $db->cdp_execute();
}

// ===========================================================
// UPDATE CONFIG API GOOGLE 
// ===========================================================

function cdp_updateConfigApiGoogle($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_settings SET
    
            longitude =:longitude,
            latitude =:latitude,          
            apikey =:apikey           
        ');

    $db->bind(':apikey', $datos['apikey']);
    $db->bind(':latitude', $datos['latitude']);
    $db->bind(':longitude', $datos['longitude']);






    return $db->cdp_execute();
}





// ===========================================================
// UPDATE STATUS SMSTWILIO
// ===========================================================

function cdp_updateStatusTwilo($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_textsms SET    
                     
            active_twi =:active_twi
            where  id=:id      
        ');

    $db->bind(':active_twi', $datos['active_twi']);
    $db->bind(':id', $datos['id']);



    return $db->cdp_execute();
}



// ===========================================================
// UPDATE TEMPLATES EMAIL
// ===========================================================
function cdp_updateTemplatesEmail($datos)
{
    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_email_templates SET

          name=:name,
          subject=:subject,
          body=:body,
          help=:help

         where id=:id');


    $db->bind(':name', $datos['name']);
    $db->bind(':subject', $datos['subject']);
    $db->bind(':body', $datos['body']);
    $db->bind(':help', $datos['help']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}




// ===========================================================
// UPDATE TEMPLATES SMS
// ===========================================================
function cdp_updateTemplatesSMSc2rbi($datos)
{
    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_sms_templates SET

          name=:name,
          subject=:subject,
          body=:body,
          help=:help

         where id=:id');


    $db->bind(':name', $datos['name']);
    $db->bind(':subject', $datos['subject']);
    $db->bind(':body', $datos['body']);
    $db->bind(':help', $datos['help']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}


// ===========================================================
// CRUD SHIP LINE
// ===========================================================



function cdp_lineExists($ship_line, $id = null)
{

    $db = new Conexion;

    $where = '';
    if ($id != null) {

        $where = "and id!='$id'";
    }

    $db->cdp_query("SELECT * FROM cdb_shipping_line WHERE  ship_line=:ship_line $where");
    $db->bind(':ship_line', $ship_line);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result == 1) {

        return true;
    } else {

        return false;
    }
}




function cdp_insertShipLine($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_shipping_line
        (
            ship_line,
            detail
            
        )

        VALUES (

            :ship_line,
            :detail
            
        )');


    $db->bind(':ship_line', $datos['ship_line']);
    $db->bind(':detail', $datos['detail']);

    return $db->cdp_execute();
}



function cdp_getShiplineEdit($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_shipping_line WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}


function cdp_updateShipLine($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_shipping_line SET    
                     
            ship_line =:ship_line,
            detail =:detail

            where  id=:id      
        ');


    $db->bind(':ship_line', $datos['ship_line']);
    $db->bind(':detail', $datos['detail']);
    $db->bind(':id', $datos['id']);



    return $db->cdp_execute();
}



function cdp_deleteShipline($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_shipping_line WHERE id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}


// ===========================================================
// CRUD INCOTERMS
// ===========================================================


function cdp_incoExists($inco_name, $id = null)
{

    $db = new Conexion;

    $where = '';
    if ($id != null) {

        $where = "and id!='$id'";
    }

    $db->cdp_query("SELECT * FROM cdb_incoterm WHERE  inco_name=:inco_name $where");
    $db->bind(':inco_name', $inco_name);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result == 1) {

        return true;
    } else {

        return false;
    }
}



function cdp_insertIncoterms($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_incoterm
        (
            inco_name,
            detail
            
        )

        VALUES (

            :inco_name,
            :detail
            
        )');


    $db->bind(':inco_name', $datos['inco_name']);
    $db->bind(':detail', $datos['detail']);

    return $db->cdp_execute();
}


function cdp_getSIncotermsEdit($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_incoterm WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}



function cdp_updateIncoterms($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_incoterm SET    
                     
            inco_name =:inco_name,
            detail =:detail

            where  id=:id      
        ');


    $db->bind(':inco_name', $datos['inco_name']);
    $db->bind(':detail', $datos['detail']);
    $db->bind(':id', $datos['id']);



    return $db->cdp_execute();
}



function cdp_deleteIncoterms($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_incoterm WHERE id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}

// ===========================================================
// CRUD OFFICES
// ===========================================================


function cdp_officeExistsjmbj1($name_off, $id = null)
{

    $db = new Conexion;

    $where = '';
    if ($id != null) {

        $where = "and id!='$id'";
    }

    $db->cdp_query("SELECT * FROM cdb_offices WHERE  name_off=:name_off $where");
    $db->bind(':name_off', $name_off);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result == 1) {

        return true;
    } else {

        return false;
    }
}



function cdp_codeofficeExists($code_off, $id = null)
{

    $db = new Conexion;

    $where = '';
    if ($id != null) {

        $where = "and id!='$id'";
    }

    $db->cdp_query("SELECT * FROM cdb_offices WHERE  code_off=:code_off $where");
    $db->bind(':code_off', $code_off);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result == 1) {

        return true;
    } else {

        return false;
    }
}




function cdp_insertOffices($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_offices
        (
            name_off,
            code_off,
            address,
            city,
            phone_off            
        )

        VALUES (

            :name_off,
            :code_off,
            :address,
            :city,
            :phone_off            
        )');




    $db->bind(':name_off', $datos['name_off']);
    $db->bind(':code_off', $datos['code_off']);
    $db->bind(':address', $datos['address']);
    $db->bind(':city', $datos['city']);
    $db->bind(':phone_off', $datos['phone_off']);

    return $db->cdp_execute();
}


function cdp_getOfficesEdit($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_offices WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}



function cdp_updateOffices($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_offices SET    
                     
            name_off =:name_off,
            code_off =:code_off,
            address =:address,
            city =:city,
            phone_off =:phone_off
            where  id=:id      
        ');


    $db->bind(':name_off', $datos['name_off']);
    $db->bind(':code_off', $datos['code_off']);
    $db->bind(':address', $datos['address']);
    $db->bind(':city', $datos['city']);
    $db->bind(':phone_off', $datos['phone_off']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}



function cdp_deleteOffices($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_offices WHERE id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}


// ===========================================================
// CRUD BRANCHOFFICES
// ===========================================================

function cdp_branchofficeExistsr9ufr($name_branch, $id = null)
{

    $db = new Conexion;

    $where = '';
    if ($id != null) {

        $where = "and id!='$id'";
    }

    $db->cdp_query("SELECT * FROM cdb_branchoffices WHERE  name_branch=:name_branch $where");
    $db->bind(':name_branch', $name_branch);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result == 1) {

        return true;
    } else {

        return false;
    }
}


function cdp_insertBranchOffices($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_branchoffices
        (
            name_branch,
            branch_address,
            branch_city,
            phone_branch
        )

        VALUES (

            :name_branch,
            :branch_address,
            :branch_city,
            :phone_branch
        )');



    $db->bind(':name_branch', $datos['name_branch']);
    $db->bind(':branch_address', $datos['branch_address']);
    $db->bind(':branch_city', $datos['branch_city']);
    $db->bind(':phone_branch', $datos['phone_branch']);

    return $db->cdp_execute();
}


function cdp_getBranchOfficesEdit($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_branchoffices WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}



function cdp_updateBranchOffices($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_branchoffices SET    
                     
            name_branch =:name_branch,
            branch_address =:branch_address,
            branch_city =:branch_city,
            phone_branch =:phone_branch

            where  id=:id      
        ');


    $db->bind(':name_branch', $datos['name_branch']);
    $db->bind(':branch_address', $datos['branch_address']);
    $db->bind(':branch_city', $datos['branch_city']);
    $db->bind(':phone_branch', $datos['phone_branch']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}



function cdp_deleteBranchOffices($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_branchoffices WHERE id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}


// ===========================================================
// CRUD COURIER COMPANY
// ===========================================================

function cdp_courierExists9y45g($name_com, $id = null)
{

    $db = new Conexion;

    $where = '';
    if ($id != null) {

        $where = "and id!='$id'";
    }

    $db->cdp_query("SELECT * FROM cdb_courier_com WHERE  name_com=:name_com $where");
    $db->bind(':name_com', $name_com);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result == 1) {

        return true;
    } else {

        return false;
    }
}


function cdp_insertCourierCompany($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_courier_com
        (
            name_com,
            address_cou,
            phone_cou,
            country_cou,
            city_cou,
            postal_cou
        )

        VALUES (

            :name_com,
            :address_cou,
            :phone_cou,
            :country_cou,
            :city_cou,
            :postal_cou
        )');



    $db->bind(':name_com', $datos['name_com']);
    $db->bind(':address_cou', $datos['address_cou']);
    $db->bind(':phone_cou', $datos['phone_cou']);
    $db->bind(':country_cou', $datos['country_cou']);
    $db->bind(':city_cou', $datos['city_cou']);
    $db->bind(':postal_cou', $datos['postal_cou']);

    return $db->cdp_execute();
}


function cdp_getCourierCompanyEdit($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_courier_com WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}



function cdp_updateCourierCompany($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_courier_com SET    
                     
            name_com =:name_com,
            address_cou =:address_cou,
            phone_cou =:phone_cou,
            country_cou =:country_cou,
            city_cou =:city_cou,
            postal_cou =:postal_cou

            where  id=:id      
        ');


    $db->bind(':name_com', $datos['name_com']);
    $db->bind(':address_cou', $datos['address_cou']);
    $db->bind(':phone_cou', $datos['phone_cou']);
    $db->bind(':country_cou', $datos['country_cou']);
    $db->bind(':city_cou', $datos['city_cou']);
    $db->bind(':postal_cou', $datos['postal_cou']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}



function cdp_deleteCourierCompany($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_courier_com WHERE id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}





// ===========================================================
// CRUD DELIVERY TIME
// ===========================================================

function cdp_DelitimeExists($delitime, $id = null)
{

    $db = new Conexion;

    $where = '';
    if ($id != null) {

        $where = "and id!='$id'";
    }

    $db->cdp_query("SELECT * FROM cdb_delivery_time WHERE  delitime=:delitime $where");
    $db->bind(':delitime', $delitime);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result == 1) {

        return true;
    } else {

        return false;
    }
}


function cdp_insertDeliverytime($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_delivery_time
        (
            delitime,
            detail            
        )

        VALUES (

            :delitime,
            :detail
            
        )');




    $db->bind(':detail', $datos['detail']);
    $db->bind(':delitime', $datos['delitime']);

    return $db->cdp_execute();
}


function cdp_updateDeliverytime($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_delivery_time SET    
                     
            detail =:detail,
            delitime =:delitime          

            where  id=:id      
        ');


    $db->bind(':detail', $datos['detail']);
    $db->bind(':delitime', $datos['delitime']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}


function cdp_getDeliveryTimeEdit($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_delivery_time WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}


function cdp_deleteDeliverytime($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_delivery_time WHERE id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}


// ===========================================================
// CRUD SHIPPING MODE
// ===========================================================

function cdp_statusExists($ship_mode, $id = null)
{

    $db = new Conexion;

    $where = '';
    if ($id != null) {

        $where = "and id!='$id'";
    }

    $db->cdp_query("SELECT * FROM cdb_shipping_mode WHERE  ship_mode=:ship_mode $where");
    $db->bind(':ship_mode', $ship_mode);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result == 1) {

        return true;
    } else {

        return false;
    }
}


function cdp_insertShippinMode($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_shipping_mode
        (
            ship_mode,
            detail            
        )

        VALUES (

            :ship_mode,
            :detail
            
        )');




    $db->bind(':detail', $datos['detail']);
    $db->bind(':ship_mode', $datos['ship_mode']);

    return $db->cdp_execute();
}


function cdp_updateShippinMode($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_shipping_mode SET    
                     
            detail =:detail,
            ship_mode =:ship_mode          

            where  id=:id      
        ');


    $db->bind(':detail', $datos['detail']);
    $db->bind(':ship_mode', $datos['ship_mode']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}


function cdp_getShippinModeEdit($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_shipping_mode WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}


function cdp_getShipRateEdit($rates_id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_add_ship_rates WHERE rates_id=:rates_id');

    $db->bind(':rates_id', $rates_id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}


function cdp_deleteShippinMode($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_shipping_mode WHERE id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}



// ===========================================================
// CRUD STATUS/ STYLES COURIER
// ===========================================================
function cdp_statusCourierExists($mod_style, $id = null)
{

    $db = new Conexion;

    $where = '';
    if ($id != null) {

        $where = "and id!='$id'";
    }

    $db->cdp_query("SELECT * FROM cdb_styles WHERE  mod_style=:mod_style $where");
    $db->bind(':mod_style', $mod_style);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result == 1) {

        return true;
    } else {

        return false;
    }
}


function cdp_colorStatusCourierExists($color, $id = null)
{

    $db = new Conexion;

    $where = '';
    if ($id != null) {

        $where = "and id!='$id'";
    }

    $db->cdp_query("SELECT * FROM cdb_styles WHERE  color=:color $where");
    $db->bind(':color', $color);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result == 1) {

        return true;
    } else {

        return false;
    }
}

function cdp_insertStatusCourier($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_styles
        (
            mod_style,
            detail,          
            color          
        )

        VALUES (

            :mod_style,
            :detail,
            :color            
        )');



    $db->bind(':detail', $datos['detail']);
    $db->bind(':mod_style', $datos['mod_style']);
    $db->bind(':color', $datos['color']);

    return $db->cdp_execute();
}


function cdp_updateStatusCourier($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_styles SET    
                     
            detail =:detail,
            mod_style =:mod_style,        
            color =:color   

            where  id=:id      
        ');


    $db->bind(':detail', $datos['detail']);
    $db->bind(':mod_style', $datos['mod_style']);
    $db->bind(':color', $datos['color']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}


function cdp_getStatusCourierEdit($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_styles WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}



function cdp_deleteStatusCourier($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_styles WHERE id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}

// ===========================================================
//  CRUD PAYMENT METHODS
// ===========================================================

function cdp_paymentMethodExists($name_pay, $id = null)
{

    $db = new Conexion;

    $where = '';
    if ($id != null) {

        $where = "and id!='$id'";
    }

    $db->cdp_query("SELECT * FROM cdb_met_payment WHERE  name_pay=:name_pay $where");
    $db->bind(':name_pay', $name_pay);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result == 1) {

        return true;
    } else {

        return false;
    }
}

function cdp_paymentMethods2Exists($label, $id = null)
{

    $db = new Conexion;

    $where = '';
    if ($id != null) {

        $where = "and id!='$id'";
    }

    $db->cdp_query("SELECT * FROM cdb_payment_methods WHERE  label=:label $where");
    $db->bind(':label', $label);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result == 1) {

        return true;
    } else {

        return false;
    }
}




function cdp_insertPaymentMethods2($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_payment_methods
        (
            label,
            days
        )

        VALUES (

            :met_payment,
            :detail
            
        )');




    $db->bind(':met_payment', $datos['met_payment']);
    $db->bind(':detail', $datos['detail']);


    return $db->cdp_execute();
}


function cdp_updatePaymentMethod_cash($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_met_payment SET    
                     
            name_pay =:name_pay,
            detail_pay =:detail_pay,
            is_active =:is_active     

            where  id=:id      
        ');


    $db->bind(':name_pay', $datos['name_pay']);
    $db->bind(':detail_pay', $datos['detail_pay']);
    $db->bind(':is_active', $datos['is_active']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}

function cdp_updatePaymentMethod_paypal($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_met_payment SET    
                     
            name_pay =:name_pay,
            detail_pay =:detail_pay,
            paypal_client_id =:paypal_client_id,
            is_active =:is_active     

            where  id=:id      
        ');


    $db->bind(':name_pay', $datos['name_pay']);
    $db->bind(':detail_pay', $datos['detail_pay']);
    $db->bind(':paypal_client_id', $datos['paypal_client_id']);
    $db->bind(':is_active', $datos['is_active']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}

function cdp_updatePaymentMethod_stripe($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_met_payment SET    
                     
            name_pay =:name_pay,
            detail_pay =:detail_pay,
            public_key =:public_key,
            secret_key =:secret_key,
            is_active =:is_active     

            where  id=:id      
        ');


    $db->bind(':name_pay', $datos['name_pay']);
    $db->bind(':detail_pay', $datos['detail_pay']);
    $db->bind(':public_key', $datos['public_key']);
    $db->bind(':secret_key', $datos['secret_key']);
    $db->bind(':is_active', $datos['is_active']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}

function cdp_updatePaymentMethod_paystack($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_met_payment SET    
                     
            name_pay =:name_pay,
            detail_pay =:detail_pay,
            public_key =:public_key,
            secret_key =:secret_key,
            is_active =:is_active     

            where  id=:id      
        ');


    $db->bind(':name_pay', $datos['name_pay']);
    $db->bind(':detail_pay', $datos['detail_pay']);
    $db->bind(':public_key', $datos['public_key']);
    $db->bind(':secret_key', $datos['secret_key']);
    $db->bind(':is_active', $datos['is_active']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}

function cdp_updatePaymentMethod_wire($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_met_payment SET    
                     
            name_pay =:name_pay,
            detail_pay =:detail_pay,
            is_active =:is_active     

            where  id=:id      
        ');


    $db->bind(':name_pay', $datos['name_pay']);
    $db->bind(':detail_pay', $datos['detail_pay']);
    $db->bind(':is_active', $datos['is_active']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}


function cdp_updatePaymentMethods2($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_payment_methods SET    
                     
            label =:met_payment,
            days =:detail    

            where  id=:id      
        ');


    $db->bind(':met_payment', $datos['met_payment']);
    $db->bind(':detail', $datos['detail']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}



function cdp_getPaymentMethod2Edit($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_payment_methods WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}


function cdp_getPaymentMethodAPIEdit($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_met_payment WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}

function cdp_deletePaymentMode($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_met_payment WHERE id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}


function cdp_deletePaymentMethod2($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_payment_methods WHERE id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}

// ==========================================================
// CRUD PACKAGING
// ===========================================================

function cdp_packExists($name_pack, $id = null)
{

    $db = new Conexion;

    $where = '';
    if ($id != null) {

        $where = "and id!='$id'";
    }

    $db->cdp_query("SELECT * FROM cdb_packaging WHERE  name_pack=:name_pack $where");
    $db->bind(':name_pack', $name_pack);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result == 1) {

        return true;
    } else {

        return false;
    }
}


function cdp_insertPackaging($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_packaging
        (
            name_pack,
            detail_pack
        )

        VALUES (

            :name_pack,
            :detail_pack
            
        )');




    $db->bind(':name_pack', $datos['name_pack']);
    $db->bind(':detail_pack', $datos['detail_pack']);


    return $db->cdp_execute();
}


function cdp_updatePackaging($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_packaging SET    
                     
            detail_pack =:detail_pack,
            name_pack =:name_pack     

            where  id=:id      
        ');


    $db->bind(':name_pack', $datos['name_pack']);
    $db->bind(':detail_pack', $datos['detail_pack']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}


function cdp_getPackagingEdit($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_packaging WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}


function cdp_deletePackaging($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_packaging WHERE id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}


// ==========================================================
// CRUD CATEGORY ITEM
// ===========================================================

function cdp_itemExists($name_item, $id = null)
{

    $db = new Conexion;

    $where = '';
    if ($id != null) {

        $where = "and id!='$id'";
    }

    $db->cdp_query("SELECT * FROM cdb_category WHERE  name_item=:name_item $where");
    $db->bind(':name_item', $name_item);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result == 1) {

        return true;
    } else {

        return false;
    }
}


function cdp_insertCategoryItem($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_category
        (
            name_item,
            detail_item
        )

        VALUES (

            :name_item,
            :detail_item
            
        )');




    $db->bind(':name_item', $datos['name_item']);
    $db->bind(':detail_item', $datos['detail_item']);


    return $db->cdp_execute();
}


function cdp_updateCategory($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_category SET    
                     
            detail_item =:detail_item,
            name_item =:name_item     

            where  id=:id      
        ');


    $db->bind(':name_item', $datos['name_item']);
    $db->bind(':detail_item', $datos['detail_item']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}


function cdp_getCategoryEdit($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_category WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}


function cdp_deleteCategory($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_category WHERE id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}





function cdp_getCourierPrint($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_add_order WHERE order_id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}


function cdp_getConsolidatePrint($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_consolidate WHERE consolidate_id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}


function cdp_getCourierPrintMultiple($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_add_order WHERE order_no=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}


function cdp_getPackagePrintMultiple($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_customers_packages WHERE order_no=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}

function cdp_getConsolidatePrintMultiple($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_consolidate WHERE c_no=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}


function cdp_deleteCourier($datos)
{

    $db = new Conexion;

    $db->cdp_query("UPDATE cdb_add_order SET                
           
            status_courier ='21', reason_cancel=:reason_cancel        

            where  order_id=:id      
        ");



    $db->bind(':id', $datos['id']);
    $db->bind(':reason_cancel', $datos['message']);

    return $db->cdp_execute();
}

function cdp_deleteFullCourier($datos)
{

    $db = new Conexion;


    $db->cdp_query('DELETE cdb_add_order, cdb_add_order_item, cdb_address_shipments, cdb_courier_track, cdb_notifications FROM cdb_add_order
        INNER JOIN cdb_add_order_item 
        INNER JOIN cdb_address_shipments
        INNER JOIN cdb_courier_track
        INNER JOIN cdb_notifications


        ON cdb_add_order.order_id = cdb_add_order_item.order_id 
        AND cdb_address_shipments.order_id = cdb_add_order.order_id
        AND cdb_add_order.order_id = cdb_courier_track.order_id
        AND cdb_add_order.order_id = cdb_notifications.order_id


        WHERE cdb_add_order.order_id=:id');

    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}


function cdp_deleteFullCourierpackage($datos)
{

    $db = new Conexion;


    $db->cdp_query('DELETE cdb_customers_packages, cdb_add_order_item, cdb_address_shipments, cdb_courier_track, cdb_notifications FROM cdb_customers_packages
        INNER JOIN cdb_add_order_item 
        INNER JOIN cdb_address_shipments
        INNER JOIN cdb_courier_track
        INNER JOIN cdb_notifications


        ON cdb_customers_packages.order_id = cdb_add_order_item.order_id 
        AND cdb_address_shipments.order_id = cdb_customers_packages.order_id
        AND cdb_customers_packages.order_id = cdb_courier_track.order_id
        AND cdb_customers_packages.order_id = cdb_notifications.order_id


        WHERE cdb_customers_packages.order_id=:id');

    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}

function cdp_deleteConsolidate($datos)
{

    $db = new Conexion;

    $db->cdp_query("UPDATE cdb_consolidate SET                
           
            status_courier ='21'          

            where  consolidate_id=:id      
        ");



    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}

function cdp_deleteItemConsolidate($datos)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_consolidate_detail WHERE order_id=:id');
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}


function cdp_updateItemConsolidate($datos)
{

    $db = new Conexion;

    $db->cdp_query("UPDATE cdb_add_order SET                
           
            is_consolidate ='0'          

            where  order_id=:id      
        ");



    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}


function cdp_updateConsolidateDelete($id)
{

    $db = new Conexion;

    $db->cdp_query("UPDATE cdb_add_order SET                
           
            is_consolidate ='0'          

            where  order_id=:id      
        ");



    $db->bind(':id', $id);

    return $db->cdp_execute();
}


function cdp_getItemdeleteConsolidate($datos)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_consolidate_detail WHERE consolidate_id=:id');

    $db->bind(':id', $datos['id']);

    $db->cdp_execute();

    $data = $db->cdp_registros();

    return $data;
}


function cdp_refuesePickup($datos)
{

    $db = new Conexion;

    $db->cdp_query("UPDATE cdb_add_order SET                
           
            status_courier ='12'          

            where  order_id=:id      
        ");



    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}



function cdp_updateStatusCourierMultiple($order_no, $status)
{

    $db = new Conexion;

    $db->cdp_query("UPDATE cdb_add_order SET                
           
            status_courier =:status_courier          

            where  order_no=:id      
        ");



    $db->bind(':id', $order_no);
    $db->bind(':status_courier', $status);

    return $db->cdp_execute();
}

function cdp_updateStatusConsolidateMultiple($order_no, $status)
{

    $db = new Conexion;

    $db->cdp_query("UPDATE cdb_consolidate SET                
           
            status_courier =:status_courier          

            where  c_no=:id      
        ");



    $db->bind(':id', $order_no);
    $db->bind(':status_courier', $status);

    return $db->cdp_execute();
}


function cdp_updateShipTrackingMultiple($order_track, $status, $comments, $office, $user)
{

    $db = new Conexion;

    $date = date('Y-m-d');
    $time = date("H:i:s");
    $date = $date . ' ' . $time;

    $db->cdp_query("
                INSERT INTO cdb_courier_track 
                (
                    order_track,                    
                    comments,
                    t_date,
                    status_courier,
                    office_id,
                    user_id
                    )
                VALUES
                    (
                    :order_track,                    
                    :comments,
                    :t_date,
                    :status_courier,
                    :office,                   
                    :user_id
                    )
            ");



    $db->bind(':order_track',  $order_track);
    $db->bind(':comments', $comments);
    $db->bind(':t_date',  trim($date));
    $db->bind(':status_courier', $status);
    $db->bind(':office', $office);
    $db->bind(':user_id',  $user);

    $db->cdp_execute();
}

function cdp_updateConsolidateTrackingMultiple($order_track, $status, $comments, $office, $user)
{

    $db = new Conexion;

    $date = date('Y-m-d');
    $time = date("H:i:s");
    $date = $date . ' ' . $time;

    $db->cdp_query("
                INSERT INTO cdb_courier_track 
                (
                    order_track,                    
                    comments,
                    t_date,
                    status_courier,
                    office_id,
                    user_id
                    )
                VALUES
                    (
                    :order_track,                    
                    :comments,
                    :t_date,
                    :status_courier,
                    :office,                   
                    :user_id
                    )
            ");



    $db->bind(':order_track',  $order_track);
    $db->bind(':comments', $comments);
    $db->bind(':t_date',  trim($date));
    $db->bind(':status_courier', $status);
    $db->bind(':office', $office);
    $db->bind(':user_id',  $user);

    $db->cdp_execute();
}



function cdp_getCourierMultiple($order_no)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_add_order WHERE order_no=:order_no');

    $db->bind(':order_no', $order_no);

    $db->cdp_execute();

    $data = $db->cdp_registro();


    return $data;
}

function cdp_getConsolidateMultiple($order_no)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_consolidate WHERE c_no=:order_no');

    $db->bind(':order_no', $order_no);

    $db->cdp_execute();

    $data = $db->cdp_registro();


    return $data;
}


function cdp_insertCharges($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_charges_order
        (
            order_id,
            charge_date,
            total,
            payment_type,
            user_id,
            note
        )

        VALUES (
            :order_id,
            :charge_date,
            :total,
            :payment_type,
            :user_id,
            :notes
            
        )');


    $db->bind(':order_id', $datos['order_id']);
    $db->bind(':charge_date',  date("Y-m-d H:i:s"));
    $db->bind(':total', $datos['total']);
    $db->bind(':payment_type', $datos['payment_type']);
    $db->bind(':notes', $datos['notes']);
    $db->bind(':user_id',  $datos['user']);



    return $db->cdp_execute();
}

function cdp_deleteCharge($datos)
{

    $db = new Conexion;

    $db->cdp_query("DELETE FROM  cdb_charges_order   where  id_charge=:id      
        ");



    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}


function cdp_updateCharges($datos)
{

    $db = new Conexion;

    $db->cdp_query("UPDATE cdb_charges_order SET                
           
            total =:total,         
            payment_type =:payment_type,         
            note =:notes      

            where  id_charge=:id      
        ");


    $db->bind(':total', $datos['total']);
    $db->bind(':payment_type', $datos['payment_type']);
    $db->bind(':notes', $datos['notes']);
    $db->bind(':id', $datos['charge_id']);


    return $db->cdp_execute();
}


function cdp_getChargePrint($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_charges_order WHERE id_charge=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}



function cdp_getUsersAdminEmployees()
{
    $db = new Conexion;

    $db->cdp_query('SELECT * FROM cdb_users WHERE (userlevel=2 or userlevel=9)');

    $db->cdp_execute();

    $data = $db->cdp_registros();

    return $data;
}



function cdp_insertNotificationsUsers($notification_id, $user)
{
    $db = new Conexion;

    $db->cdp_query("
            INSERT INTO cdb_notifications_users 
            (
                user_id,
                notification_id                   
            )
            VALUES
                (
                :user_id,                    
                :notification_id                                      
                )
        ");



    $db->bind(':notification_id',  $notification_id);
    $db->bind(':user_id', $user);

    return $db->cdp_execute();
}



function cdp_updateNotificationRead($user, $notification_id)
{

    $db = new Conexion;

    $db->cdp_query("UPDATE cdb_notifications_users SET                
           
            notification_read ='1'                    
            where  notification_id=:notification_id 
            and user_id = :user_id  
        ");


    $db->bind(':user_id', $user);
    $db->bind(':notification_id', $notification_id);


    return $db->cdp_execute();
}



function cdp_updateNotificationStatus($user, $notification_id)
{

    $db = new Conexion;

    $db->cdp_query("UPDATE cdb_notifications_users SET                
           
            notification_status ='1'                    
            where  notification_id=:notification_id 
            and user_id = :user_id  
        ");


    $db->bind(':user_id', $user);
    $db->bind(':notification_id', $notification_id);


    return $db->cdp_execute();
}



function cdp_updateNotificatonsRea($user)
{

    $db = new Conexion;

    $db->cdp_query("UPDATE cdb_notifications_users SET                
           
            notification_read ='1'   

            where user_id = :user_id  
        ");


    $db->bind(':user_id', $user);

    return $db->cdp_execute();
}


function cdp_insertOrdersFiles($order_id, $target_file, $image_name, $date, $is_consolidate, $imageFileType)
{

    $db = new Conexion;

    $db->cdp_query("
            INSERT INTO cdb_order_files 
            (
                url,
                order_id,
                date_file,
                name,
                is_consolidate,
                file_type                   
            )
            VALUES
                (
                :url,
                :order_id,
                :date_file,
                :name,
                :is_consolidate,
                :file_type                                     
                )
        ");



    $db->bind(':order_id',  $order_id);
    $db->bind(':url', $target_file);
    $db->bind(':name', $image_name);
    $db->bind(':is_consolidate', $is_consolidate);
    $db->bind(':date_file', $date);
    $db->bind(':file_type', $imageFileType);

    return $db->cdp_execute();
}


function cdp_getCourierTrack($order_track)
{

    $db = new Conexion;


    $db->cdp_query("SELECT  a.photo_delivered, a.volumetric_percentage,  a.order_datetime, a.order_deli_time, a.status_invoice,  a.is_consolidate, a.is_pickup,  a.total_order, a.order_id, a.order_prefix, a.order_no, a.order_date, a.sender_id, a.receiver_id, a.order_courier, a.order_pay_mode, a.status_courier, a.driver_id, a.order_service_options,  b.mod_style, b.color FROM
             cdb_add_order as a
             INNER JOIN cdb_styles as b ON a.status_courier = b.id
             
             WHERE CONCAT(a.order_prefix,a.order_no)=:order_track
             
             ");

    $db->bind(':order_track', $order_track);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}




function cdp_updateDriverCourier($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_add_order SET    
                     
            driver_id =:driver_id              

            where  order_id=:id_shipment     
        ');


    $db->bind(':id_shipment', $datos['id_shipment']);
    $db->bind(':driver_id', $datos['driver_id']);

    return $db->cdp_execute();
}



function cdp_updateDriverConsolidate($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_consolidate SET    
                     
            driver_id =:driver_id              

            where  consolidate_id=:id_shipment     
        ');


    $db->bind(':id_shipment', $datos['id_shipment']);
    $db->bind(':driver_id', $datos['driver_id']);

    return $db->cdp_execute();
}






// ===========================================================
// PRE ALERTS ADD
// ===========================================================

function cdp_insertPreAlert($datos)
{


    $db = new Conexion;

    $db->cdp_query("
            INSERT INTO cdb_pre_alert 
            (
                tracking,
                provider_shop,
                courier_com,
                customer_id,
                purchase_price,
                package_description,                 
                estimated_date,
                prealert_date,
                url_invoice                    
                )
            VALUES
                (
                :tracking,
                :provider_shop,
                :courier_com,
                :customer_id,
                :purchase_price,
                :package_description,                 
                :estimated_date,
                :prealert_date,
                :url_invoice
                )
        ");


    $db->bind(':tracking', $datos["tracking_prealert"]);
    $db->bind(':provider_shop', $datos["provider_prealert"]);
    $db->bind(':courier_com', $datos["courier_prealert"]);
    $db->bind(':customer_id',  $datos['customer_id']);
    $db->bind(':purchase_price', $datos["price_prealert"]);
    $db->bind(':package_description', $datos["description_prealert"]);
    $db->bind(':estimated_date', $datos['estimated_date']);
    $db->bind(':prealert_date',  $datos['prealert_date']);
    $db->bind(':url_invoice',  $datos['file_invoice']);




    return $db->cdp_execute();
}

function cdp_getCustomerPackagePrint($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_customers_packages WHERE order_id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}



function cdp_updateStatusCustomerPackageMultiple($order_no, $status)
{

    $db = new Conexion;

    $db->cdp_query("UPDATE cdb_customers_packages SET                
           
            status_courier =:status_courier          

            where  order_no=:id      
        ");



    $db->bind(':id', $order_no);
    $db->bind(':status_courier', $status);

    return $db->cdp_execute();
}



function cdp_getPackageMultiple($order_no)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_customers_packages WHERE order_no=:order_no');

    $db->bind(':order_no', $order_no);

    $db->cdp_execute();

    $data = $db->cdp_registro();


    return $data;
}



function cdp_updatePackageMultiple($order_track, $status, $comments, $office, $user)
{

    $db = new Conexion;

    $date = date('Y-m-d');
    $time = date("H:i:s");
    $date = $date . ' ' . $time;

    $db->cdp_query("
                INSERT INTO cdb_courier_track 
                (
                    order_track,                    
                    comments,
                    t_date,
                    status_courier,
                    office_id,
                    user_id
                    )
                VALUES
                    (
                    :order_track,                    
                    :comments,
                    :t_date,
                    :status_courier,
                    :office,                   
                    :user_id
                    )
            ");



    $db->bind(':order_track',  $order_track);
    $db->bind(':comments', $comments);
    $db->bind(':t_date',  trim($date));
    $db->bind(':status_courier', $status);
    $db->bind(':office', $office);
    $db->bind(':user_id',  $user);

    $db->cdp_execute();
}


function cdp_updateDriverPackage($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_customers_packages SET    
                     
            driver_id =:driver_id              

            where  order_id=:id_shipment     
        ');


    $db->bind(':id_shipment', $datos['id_shipment']);
    $db->bind(':driver_id', $datos['driver_id']);

    return $db->cdp_execute();
}







function cdp_updatePaymentPackagesCustomer($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_customers_packages SET    
                     
            notes =:notes,              
            status_invoice =:status_invoice,  
            url_payment_attach=:file_invoice,
            order_pay_mode=:mode_pay,
            payment_date=:payment_date          

            where  order_id=:order_id     
        ');


    $db->bind(':notes', $datos['notes']);
    $db->bind(':status_invoice', $datos['status_invoice']);
    $db->bind(':file_invoice', $datos['file_invoice']);
    $db->bind(':payment_date', $datos['payment_date']);
    $db->bind(':mode_pay', $datos['mode_pay']);
    $db->bind(':order_id', $datos['order_id']);

    return $db->cdp_execute();
}



function cdp_updatePaymentCourierCustomer($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_add_order SET    
                     
            notes =:notes,              
            status_invoice =:status_invoice,  
            url_payment_attach=:file_invoice,
            order_pay_mode=:mode_pay,
            payment_date=:payment_date          

            where  order_id=:order_id     
        ');


    $db->bind(':notes', $datos['notes']);
    $db->bind(':status_invoice', $datos['status_invoice']);
    $db->bind(':file_invoice', $datos['file_invoice']);
    $db->bind(':payment_date', $datos['payment_date']);
    $db->bind(':mode_pay', $datos['mode_pay']);
    $db->bind(':order_id', $datos['order_id']);

    return $db->cdp_execute();
}


function cdp_updatePaymentConsolidate($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_consolidate SET    
                     
            notes =:notes,              
            status_invoice =:status_invoice,  
            url_payment_attach=:file_invoice,
            order_pay_mode=:mode_pay,
            payment_date=:payment_date          

            where  consolidate_id=:order_id     
        ');


    $db->bind(':notes', $datos['notes']);
    $db->bind(':status_invoice', $datos['status_invoice']);
    $db->bind(':file_invoice', $datos['file_invoice']);
    $db->bind(':payment_date', $datos['payment_date']);
    $db->bind(':mode_pay', $datos['mode_pay']);
    $db->bind(':order_id', $datos['order_id']);

    return $db->cdp_execute();
}




function cdp_confirmPaymentPackages($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_customers_packages SET    
                           
            status_invoice =:status_invoice                    

            where  order_id=:order_id     
        ');


    $db->bind(':status_invoice', $datos['status_invoice']);

    $db->bind(':order_id', $datos['order_id']);

    return $db->cdp_execute();
}


function cdp_confirmPaymentCourier($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_add_order SET    
                           
            status_invoice =:status_invoice                    

            where  order_id=:order_id     
        ');


    $db->bind(':status_invoice', $datos['status_invoice']);

    $db->bind(':order_id', $datos['order_id']);

    return $db->cdp_execute();
}


function cdp_confirmPaymentConsolidate($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_consolidate SET    
                           
            status_invoice =:status_invoice                    

            where  consolidate_id=:order_id     
        ');


    $db->bind(':status_invoice', $datos['status_invoice']);

    $db->bind(':order_id', $datos['order_id']);

    return $db->cdp_execute();
}


function cdp_updateDriverCourierMultiple($order_no, $driver)
{

    $db = new Conexion;

    $db->cdp_query("UPDATE cdb_add_order SET                
           
            driver_id =:driver_id          

            where  order_no=:id      
        ");



    $db->bind(':id', $order_no);
    $db->bind(':driver_id', $driver);

    return $db->cdp_execute();
}



function cdp_updateDriverConsolidateMultiple($order_no, $driver)
{

    $db = new Conexion;

    $db->cdp_query("UPDATE cdb_consolidate SET                
           
            driver_id =:driver_id          

            where  c_no=:id      
        ");



    $db->bind(':id', $order_no);
    $db->bind(':driver_id', $driver);

    return $db->cdp_execute();
}


function cdp_updateDriverCustomersPackageMultiple($order_no, $driver)
{

    $db = new Conexion;

    $db->cdp_query("UPDATE cdb_customers_packages SET                
           
            driver_id =:driver_id          

            where  order_no=:id      
        ");



    $db->bind(':id', $order_no);
    $db->bind(':driver_id', $driver);

    return $db->cdp_execute();
}



function cdp_getPreAlert($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_pre_alert WHERE pre_alert_id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}



function cdp_getCustomersPackagesTrack($order_track)
{

    $db = new Conexion;


    $db->cdp_query("SELECT  a.photo_delivered, a.volumetric_percentage,  a.order_datetime, a.order_deli_time, a.status_invoice, a.total_order, a.order_id, a.order_prefix, a.order_no, a.order_date, a.sender_id, a.order_courier, a.order_pay_mode, a.status_courier, a.driver_id, a.order_service_options,  b.mod_style, b.color FROM cdb_customers_packages as a
         INNER JOIN cdb_styles as b ON a.status_courier = b.id
         
         WHERE CONCAT(a.order_prefix,a.order_no)=:order_track
         
         ");

    $db->bind(':order_track', $order_track);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}



function cdp_insertPaymentGateway($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_payments_gateway
        (

            order_track,
            order_track_customer_id,
            gateway,
            payment_transaction,
            amount,
            status,
            type_transaccition_courier,
            currency,
            date_payment
        )

        VALUES (
            :order_track,
            :order_track_customer_id,
            :gateway,
            :payment_id,
            :amount,
            :status,
            :type_transaccition_courier,
            :currency_code,
            :date_payment
            
        )');




    $db->bind(':amount', $datos['amount']);
    $db->bind(':gateway', $datos['gateway']);
    $db->bind(':currency_code', $datos['currency_code']);
    $db->bind(':status', $datos['status']);
    $db->bind(':payment_id', $datos['payment_id']);
    $db->bind(':type_transaccition_courier', $datos['type_transaccition_courier']);
    $db->bind(':date_payment', $datos['date']);
    $db->bind(':order_track', $datos['order_track']);
    $db->bind(':order_track_customer_id', $datos['order_track_customer_id']);


    return $db->cdp_execute();
}



function cdp_updateTwilioConfig($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_settings SET
    
            twilio_token =:twilio_token,                
            twilio_sid =:twilio_sid,            
            twilio_number =:twilio_number                
            
        ');


    $db->bind(':twilio_token', $datos['twilio_token']);
    $db->bind(':twilio_sid', $datos['twilio_sid']);
    $db->bind(':twilio_number', $datos['twilio_number']);


    return $db->cdp_execute();
}


function cdp_updateTwiliosmsConfig($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_settings SET
    
            twilio_sms_token =:twilio_sms_token,                
            twilio_sms_sid =:twilio_sms_sid,            
            twilio_sms_number =:twilio_sms_number                
            
        ');


    $db->bind(':twilio_sms_token', $datos['twilio_sms_token']);
    $db->bind(':twilio_sms_sid', $datos['twilio_sms_sid']);
    $db->bind(':twilio_sms_number', $datos['twilio_sms_number']);


    return $db->cdp_execute();
}



function cdp_updatePaymentConfig($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_settings SET


            public_key_paystack =:paystack_public_key,                
            secret_key_paystack =:paystack_secret_key,  
            public_key_stripe =:stripe_public_key,                
            secret_key_stripe =:stripe_secret_key,
            paypal_client_id =:client_id,
            active_paystack =:active_paystack,                
            active_stripe =:active_stripe,            
            active_attach_proof =:active_attach_proof,              
            active_paypal =:active_paypal               
            
        ');


    $db->bind(':paystack_public_key', $datos['paystack_public_key']);
    $db->bind(':paystack_secret_key', $datos['paystack_secret_key']);
    $db->bind(':stripe_public_key', $datos['stripe_public_key']);
    $db->bind(':stripe_secret_key', $datos['stripe_secret_key']);
    $db->bind(':client_id', $datos['client_id']);
    $db->bind(':active_paystack', $datos['active_paystack']);
    $db->bind(':active_stripe', $datos['active_stripe']);
    $db->bind(':active_attach_proof', $datos['active_attach_proof']);
    $db->bind(':active_paypal', $datos['active_paypal']);


    return $db->cdp_execute();
}



function cdp_updateTwilioWhatssapConfig($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_settings SET
    
            active_whatsapp =:active_whatsapp              
            
        ');


    $db->bind(':active_whatsapp', $datos['active_whatsapp']);


    return $db->cdp_execute();
}


function cdp_updateTwiliosmsactiveConfig($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_settings SET
    
            active_sms =:active_sms              
            
        ');


    $db->bind(':active_sms', $datos['active_sms']);


    return $db->cdp_execute();
}


function cdp_getAddressesUsers($id)
{
    $db = new Conexion;

    $db->cdp_query('SELECT * FROM cdb_users_multiple_addresses WHERE user_id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registros();

    return $data;
}


function cdp_deleteAddressesUsers($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_users_multiple_addresses WHERE user_id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}



function cdp_deleteFileCourier($datos)
{

    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_order_files WHERE id=:id');

    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}


function cdp_deleteFileCustomerPackages($datos)
{

    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_customer_package_files WHERE id=:id');

    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}


function cdp_insertDriverFiles($driver_id, $target_file, $image_name, $date, $imageFileType)
{

    $db = new Conexion;

    $db->cdp_query("
            INSERT INTO cdb_driver_files 
            (
                url,
                driver_id,
                date_file,
                name,
                file_type                   
            )
            VALUES
                (
                :url,
                :driver_id,
                :date_file,
                :name,
                :file_type                                     
                )
        ");



    $db->bind(':driver_id',  $driver_id);
    $db->bind(':url', $target_file);
    $db->bind(':name', $image_name);
    $db->bind(':date_file', $date);
    $db->bind(':file_type', $imageFileType);

    return $db->cdp_execute();
}



function cdp_insertCustomerPackagesFiles($order_id, $target_file, $image_name, $date, $imageFileType)
{

    $db = new Conexion;

    $db->cdp_query("
            INSERT INTO cdb_customer_package_files 
            (
                url,
                order_id,
                date_file,
                name,
                file_type                   
            )
            VALUES
                (
                :url,
                :order_id,
                :date_file,
                :name,
                :file_type                                     
                )
        ");



    $db->bind(':order_id',  $order_id);
    $db->bind(':url', $target_file);
    $db->bind(':name', $image_name);
    $db->bind(':date_file', $date);
    $db->bind(':file_type', $imageFileType);

    return $db->cdp_execute();
}




function cdp_deleteFileDrivers($datos)
{

    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_driver_files WHERE id=:id');

    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}


// ===========================================================
// CRUD COUNTRIES
// ===========================================================

function cdp_countryExists($name, $id = null)
{

    $db = new Conexion;

    $where = '';
    if ($id != null) {

        $where = "and id!='$id'";
    }

    $db->cdp_query("SELECT * FROM cdb_countries WHERE  name=:name $where");
    $db->bind(':name', $name);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result == 1) {

        return true;
    } else {

        return false;
    }
}


function cdp_insertCountry($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_countries
        (
            name,
            iso3,
            phone_code,
            capital,
            currency_name,
            currency_symbol,
            is_active,
            region
        )

        VALUES (

            :name,
            :iso3,
            :phone_code,
            :capital,
            :currency_name,
            :currency_symbol,
            :is_active,
            :region
        )');



    $db->bind(':name', $datos['name']);
    $db->bind(':iso3', $datos['iso3']);
    $db->bind(':region', $datos['region']);
    $db->bind(':capital', $datos['capital']);
    $db->bind(':currency_name', $datos['currency_name']);
    $db->bind(':currency_symbol', $datos['currency_symbol']);
    $db->bind(':is_active', $datos['is_active']);
    $db->bind(':phone_code', $datos['phone_code']);

    return $db->cdp_execute();
}


function cdp_getCountry($id)
{
    $db = new Conexion;

    $db->cdp_query('SELECT * FROM cdb_countries WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}



function cdp_updateCountry($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_countries SET    
            name=:name,
            iso3=:iso3,
            phone_code=:phone_code,
            capital=:capital,
            currency_name=:currency_name,
            currency_symbol=:currency_symbol,
            is_active=:is_active,
            region=:region
            where  id=:id      
        ');


    $db->bind(':name', $datos['name']);
    $db->bind(':iso3', $datos['iso3']);
    $db->bind(':region', $datos['region']);
    $db->bind(':capital', $datos['capital']);
    $db->bind(':currency_name', $datos['currency_name']);
    $db->bind(':currency_symbol', $datos['currency_symbol']);
    $db->bind(':phone_code', $datos['phone_code']);
    $db->bind(':is_active', $datos['is_active']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}

function cdp_verifyReferentialIntegrityCounty($id)
{
    $db = new Conexion;

    $db->cdp_query('SELECT * FROM cdb_states WHERE country_id=:id');
    $db->bind(':id', $id);

    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}

function cdp_deleteCounty($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_countries WHERE id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}


// ===========================================================
// CRUD STATES
// ===========================================================

function cdp_stateExists($name, $id = null)
{

    $db = new Conexion;

    $where = '';
    if ($id != null) {

        $where = "and id!='$id'";
    }

    $db->cdp_query("SELECT * FROM cdb_states WHERE  name=:name $where");
    $db->bind(':name', $name);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result == 1) {

        return true;
    } else {

        return false;
    }
}


function cdp_insertState($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_states
        (
            name,
            country_id,
            iso
        )

        VALUES (

            :state_name,
            :country,
            :iso
        )');



    $db->bind(':state_name', $datos['state_name']);
    $db->bind(':iso', $datos['iso']);
    $db->bind(':country', $datos['country']);

    return $db->cdp_execute();
}


function cdp_getState($id)
{
    $db = new Conexion;

    $db->cdp_query('SELECT * FROM cdb_states WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}



function cdp_updateState($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_states SET    
            name=:state_name,
            country_id=:country,
            iso=:iso

            where  id=:id      
        ');


    $db->bind(':id', $datos['id']);
    $db->bind(':state_name', $datos['state_name']);
    $db->bind(':iso', $datos['iso']);
    $db->bind(':country', $datos['country']);

    return $db->cdp_execute();
}

function cdp_verifyReferentialIntegrityState($id)
{
    $db = new Conexion;

    $db->cdp_query('SELECT * FROM cdb_cities WHERE state_id=:id');
    $db->bind(':id', $id);

    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}

function cdp_deleteState($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_states WHERE id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}


// ===========================================================
// CRUD CITIES
// ===========================================================

function cdp_cityExists($name, $id = null)
{

    $db = new Conexion;

    $where = '';
    if ($id != null) {

        $where = "and id!='$id'";
    }

    $db->cdp_query("SELECT * FROM cdb_cities WHERE  name=:name $where");
    $db->bind(':name', $name);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result == 1) {

        return true;
    } else {

        return false;
    }
}


function cdp_insertCity($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_cities
        (
            name,
            state_id        
        )

        VALUES (
            :city_name,
            :state            
        )');

    $db->bind(':city_name', $datos['city_name']);
    $db->bind(':state', $datos['state']);

    return $db->cdp_execute();
}


function cdp_getCity($id)
{
    $db = new Conexion;

    $db->cdp_query('SELECT * FROM cdb_cities WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}



function cdp_updateCity($datos)
{

    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_cities SET    
            name=:city_name,
            state_id=:state

            where  id=:id      
        ');

    $db->bind(':id', $datos['id']);
    $db->bind(':city_name', $datos['city_name']);
    $db->bind(':state', $datos['state']);

    return $db->cdp_execute();
}



function cdp_deleteCity($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_cities WHERE id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}



// ===========================================================
// CRUD RECIPIENTS
// ===========================================================


function cdp_insertRecipient($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_recipients
              (   
                  email,
                  fname,
                  lname,
                  phone,
                  sender_id      
              )

              VALUES (

                  :email,
                  :fname,
                  :lname,           
                  :phone,
                  :sender_id
                  
              )');

    $db->bind(':email', $datos['email']);
    $db->bind(':fname', $datos['fname']);
    $db->bind(':lname', $datos['lname']);
    $db->bind(':phone', $datos['phone']);
    $db->bind(':sender_id', $datos['sender_id']);

    $db->cdp_execute();

    return $db->dbh->lastInsertId();
}

function cdp_insertAddressRecipient($datos)
{

    $db = new Conexion;

    $db->cdp_query("
        INSERT INTO cdb_recipients_addresses 
        (
            country,
            state,
            city,
            zip_code,
            address,
            recipient_id                                
        )
        VALUES 
        (
            :country,
            :state,
            :city, 
            :zip_code,
            :address,
            :recipient_id                            
        )
    ");

    $db->bind(':recipient_id',   $datos['recipient_id']);
    $db->bind(':address',  $datos["address"]);
    $db->bind(':country',  $datos["country"]);
    $db->bind(':city',  $datos["city"]);
    $db->bind(':state',  $datos["state"]);
    $db->bind(':zip_code',  $datos["postal"]);

    return  $db->cdp_execute();
}
function cdp_updateRecipientAddress($datos)
{
    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_recipients_addresses SET
    
        country =:country,
        state =:state,
        city =:city,
        zip_code =:zip_code,
        address =:address
  
        where id_addresses = :id_addresses
    ');

    $db->bind(':id_addresses',   $datos['address_id']);
    $db->bind(':address',  $datos["address"]);
    $db->bind(':country',  $datos["country"]);
    $db->bind(':city',  $datos["city"]);
    $db->bind(':state',  $datos["state"]);
    $db->bind(':zip_code',  $datos["postal"]);

    return $db->cdp_execute();
}

function cdp_deleteRecipientAddress($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_recipients_addresses WHERE id_addresses=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}


function cdp_updateRecipient($datos)
{
    $db = new Conexion;

    $db->cdp_query("
    UPDATE cdb_recipients SET                
        
      fname=:fname,
      lname=:lname,           
      phone=:phone,
      email=:email                  

    WHERE id=:id_recipient                
    
  ");

    $db->bind(':id_recipient',   $datos['id_recipient']);
    $db->bind(':email', $datos['email']);
    $db->bind(':fname', $datos['fname']);
    $db->bind(':lname', $datos['lname']);
    $db->bind(':phone', $datos['phone']);

    return $db->cdp_execute();
}


function cdp_getRecipientEdit($id)
{
    $db = new Conexion;


    $db->cdp_query('SELECT * FROM cdb_recipients WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}

function cdp_deleteRecipient($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_recipients WHERE id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}

function cdp_recipientEmailExists($email, $id = null)
{
    $db = new Conexion;

    $where = '';
    if ($id != null) {

        $where = "and id!='$id'";
    }

    $db->cdp_query("SELECT email FROM cdb_recipients where email = :email $where LIMIT 1");

    $db->bind(':email', trim($email));

    $db->cdp_execute();


    if ($db->cdp_rowCount() == 1) {
        return true;
    } else {

        return false;
    }
}


// ===========================================================
// USERS CUSTOMERS
// ===========================================================



function cdp_insertCustomer($datos)
{

    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_users
    (
        username,
        password,
        locker,
        userlevel,
        email,
        document_type,
        document_number,
        fname,
        lname,
        avatar,
        created,
        notes,
        phone,
        gender,
        newsletter,
        active
        
    )

    VALUES (
        :username,
        :password,
        :locker,
        :userlevel,
        :email,
        :document_type,
        :document_number,
        :fname,
        :lname,
        :avatar,
        :created,
        :notes,
        :phone,
        :gender,
        :newsletter,
        :active 
    )');


    $db->bind(':username', $datos['username']);
    $db->bind(':locker', $datos['locker']);
    $db->bind(':password', $datos['password']);
    $db->bind(':userlevel', $datos['userlevel']);
    $db->bind(':email', $datos['email']);
    $db->bind(':fname', $datos['fname']);
    $db->bind(':lname', $datos['lname']);
    $db->bind(':avatar', $datos['avatar']);
    $db->bind(':created', $datos['created']);
    $db->bind(':notes', $datos['notes']);
    $db->bind(':phone', $datos['phone']);
    $db->bind(':gender', $datos['gender']);
    $db->bind(':newsletter', $datos['newsletter']);
    $db->bind(':active', $datos['active']);
    $db->bind(':document_type', $datos['document_type']);
    $db->bind(':document_number', $datos['document_number']);

    $db->cdp_execute();
    return $db->dbh->lastInsertId();
}

function cdp_updateCustomers($datos)
{
    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_users SET
    
        password =:password,
        email =:email,
        document_type =:document_type,
        document_number =:document_number,
        fname =:fname,
        lname =:lname,
        notes =:notes,
        phone =:phone,
        gender =:gender,
        newsletter =:newsletter,
        active =:active,
        avatar =:avatar
        where id = :id
    ');

    $db->bind(':password', $datos['password']);
    $db->bind(':email', $datos['email']);
    $db->bind(':fname', $datos['fname']);
    $db->bind(':lname', $datos['lname']);
    $db->bind(':notes', $datos['notes']);
    $db->bind(':phone', $datos['phone']);
    $db->bind(':gender', $datos['gender']);
    $db->bind(':newsletter', $datos['newsletter']);
    $db->bind(':active', $datos['active']);
    $db->bind(':avatar', $datos['avatar']);
    $db->bind(':document_type', $datos['document_type']);
    $db->bind(':document_number', $datos['document_number']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}

function cdp_insertAddressCustomer($datos)
{

    $db = new Conexion;

    $db->cdp_query("
        INSERT INTO cdb_senders_addresses 
        (
            country,
            state,
            city,
            zip_code,
            address,
            user_id                                
        )
        VALUES 
        (
            :country,
            :state,
            :city, 
            :zip_code,
            :address,
            :user_id                            
        )
    ");

    $db->bind(':user_id',   $datos['user_id']);
    $db->bind(':address',  $datos["address"]);
    $db->bind(':country',  $datos["country"]);
    $db->bind(':city',  $datos["city"]);
    $db->bind(':state',  $datos["state"]);
    $db->bind(':zip_code',  $datos["postal"]);

    return  $db->cdp_execute();
}

function cdp_updateCustomerAddress($datos)
{
    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_senders_addresses SET
    
        country =:country,
        state =:state,
        city =:city,
        zip_code =:zip_code,
        address =:address
  
        where id_addresses = :id_addresses
    ');

    $db->bind(':id_addresses',   $datos['address_id']);
    $db->bind(':address',  $datos["address"]);
    $db->bind(':country',  $datos["country"]);
    $db->bind(':city',  $datos["city"]);
    $db->bind(':state',  $datos["state"]);
    $db->bind(':zip_code',  $datos["postal"]);

    return $db->cdp_execute();
}

function cdp_deleteCustomerAddress($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_senders_addresses WHERE id_addresses=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}


function cdp_verifyReferentialIntegrity($table, $field, $id)
{
    $db = new Conexion;
    $db->cdp_query("SELECT * FROM  $table WHERE $field = $id");
    $db->bind(':id', $id);

    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}




// ===========================================================
//  tariffs
// ===========================================================

function cdp_insertTariffs($datos)
{
    $db = new Conexion;

    $db->cdp_query('INSERT INTO cdb_shipping_fees
    (
        origin,
        destiny,
        state,
        city,
        initial_range,
        final_range,
        price        
    )
    VALUES (
        :country_origin,
        :country_destiny,
        :state_destinystates,
        :city_destinycities,
        :initial_range,
        :final_range,
        :tariff_price
    )');

    $db->bind(':country_origin', $datos['country_origin']);
    $db->bind(':country_destiny', $datos['country_destiny']);
    $db->bind(':state_destinystates', $datos['state_destinystates']);
    $db->bind(':city_destinycities', $datos['city_destinycities']);
    $db->bind(':initial_range', $datos['initial_range']);
    $db->bind(':final_range', $datos['final_range']);
    $db->bind(':tariff_price', $datos['tariff_price']);

    return  $db->cdp_execute();
}

function cdp_verifyRangeTariffsExist($origin, $destiny, $initial_range, $final_range, $id = null)
{
    $db = new Conexion;
    $initial_range = floatval($initial_range);
    $final_range = floatval($final_range);
    $where = '';

    if ($id != null) {
        $where = "and id!='$id'";
    }

    $sql = "SELECT * FROM cdb_shipping_fees 
    WHERE (origin=$origin AND destiny=$destiny)
    AND ($initial_range BETWEEN initial_range AND final_range) and ($final_range between initial_range AND final_range)
    $where";

    $db->cdp_query($sql);
    $db->cdp_execute();
    $result = $db->cdp_rowCount();

    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}

function cdp_getTariffsEdit($id)
{
    $db = new Conexion;

    $db->cdp_query('SELECT * FROM cdb_shipping_fees WHERE id=:id');
    $db->bind(':id', $id);
    $db->cdp_execute();

    $data = $db->cdp_registro();
    $rowCount = $db->cdp_rowCount();

    $datos = [
        'data' => $data,
        'rowCount' => $rowCount
    ];

    return $datos;
}

function cdp_updateTariffs($datos)
{
    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_shipping_fees SET
    
        origin =:country_origin,
        destiny =:country_destiny,
        state =:state_destinystates,
        city =:city_destinycities,
        initial_range =:initial_range,
        final_range =:final_range,
        price =:tariff_price

        where id = :id
    ');

    $db->bind(':country_origin', $datos['country_origin']);
    $db->bind(':country_destiny', $datos['country_destiny']);
    $db->bind(':state_destinystates', $datos['state_destinystates']);
    $db->bind(':city_destinycities', $datos['city_destinycities']);
    $db->bind(':initial_range', $datos['initial_range']);
    $db->bind(':final_range', $datos['final_range']);
    $db->bind(':tariff_price', $datos['tariff_price']);
    $db->bind(':id', $datos['id']);

    return $db->cdp_execute();
}

function cdp_deleteTariffs($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_shipping_fees WHERE id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}





// ===========================================================
//  COURIER SHIPMENTS
// ===========================================================

function cdp_getCourier($id)
{
    $db = new Conexion;

    $db->cdp_query('SELECT * FROM cdb_add_order WHERE order_id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    return  $db->cdp_registro();
}
function cdp_deleteCourierAddress($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_address_shipments WHERE order_track=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}

function cdp_deleteCourierPackages($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_add_order_item WHERE order_id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}

function cdp_insertCourierShipment($datos)
{
    $db = new Conexion;

    $db->cdp_query("
    INSERT INTO cdb_add_order 
    (
        user_id,
        order_prefix,
        order_no,
        order_date,
        sender_id,
        sender_address_id,
        receiver_id,                
        receiver_address_id,
        volumetric_percentage,
        order_datetime,
        agency,
        origin_off,
        order_item_category, 
        order_package,
        order_courier,
        order_service_options,
        order_deli_time,                   
        order_pay_mode,
        order_payment_method,
        status_courier,
        driver_id,
        is_pickup,
        due_date,
        status_invoice,
        order_incomplete                 
        )
    VALUES
        (
        :user_id,
        :order_prefix,
        :order_no,
        :order_date,
        :sender_id,
        :sender_address_id,
        :receiver_id,       
        :receiver_address_id,    
        :volumetric_percentage,
        :order_datetime,
        :agency,
        :origin_off,
        :order_item_category, 
        :order_package,
        :order_courier,
        :order_service_options,
        :order_deli_time,                   
        :order_pay_mode,
        :order_payment_method,
        :status_courier,
        :driver_id,
        :is_pickup,
        :due_date,
        :status_invoice,
        :order_incomplete         

        )
");

    $db->bind(':order_incomplete',  $datos['order_incomplete']);
    $db->bind(':is_pickup',  $datos['is_pickup']);
    $db->bind(':user_id',  $datos['user_id']);
    $db->bind(':order_prefix',  $datos['order_prefix']);
    $db->bind(':order_no', $datos["order_no"]);
    $db->bind(':order_datetime',  $datos['order_datetime']);
    $db->bind(':sender_id',  $datos["sender_id"]);
    $db->bind(':receiver_id',  $datos["recipient_id"]);
    $db->bind(':sender_address_id',  $datos["sender_address_id"]);
    $db->bind(':receiver_address_id',  $datos["recipient_address_id"]);
    $db->bind(':order_date',  $datos['order_date']);
    $db->bind(':agency',  $datos["agency"]);
    $db->bind(':origin_off',  $datos["origin_off"]);
    $db->bind(':order_package',  $datos["order_package"]);
    $db->bind(':order_item_category',  $datos["order_item_category"]);
    $db->bind(':order_courier',  $datos["order_courier"]);
    $db->bind(':order_service_options',  $datos["order_service_options"]);
    $db->bind(':order_deli_time',  $datos["order_deli_time"]);
    $db->bind(':order_pay_mode',  $datos["order_pay_mode"]);
    $db->bind(':order_payment_method',  $datos["order_payment_method"]);
    $db->bind(':status_courier',  $datos["status_courier"]);
    $db->bind(':driver_id',  $datos["driver_id"]);
    $db->bind(':due_date',   $datos["due_date"]);
    $db->bind(':status_invoice',   $datos["status_invoice"]);
    $db->bind(':volumetric_percentage',   $datos["volumetric_percentage"]);

    $db->cdp_execute();
    return $db->dbh->lastInsertId();
}


function cdp_insertCourierPickupFromCustomer($datos)
{
    $db = new Conexion;

    $db->cdp_query("
    INSERT INTO cdb_add_order 
    (
        user_id,
        order_prefix,
        order_no,
        order_date,
        sender_id,
        sender_address_id,
        receiver_id,                
        receiver_address_id,
        volumetric_percentage,
        order_datetime,
        order_item_category, 
        order_package,
        order_pay_mode,
        status_courier,
        is_pickup,
        due_date,
        status_invoice,
        order_incomplete                 
        )
    VALUES
        (
        :user_id,
        :order_prefix,
        :order_no,
        :order_date,
        :sender_id,
        :sender_address_id,
        :receiver_id,       
        :receiver_address_id,    
        :volumetric_percentage,
        :order_datetime,
        :order_item_category, 
        :order_package,
        :order_pay_mode,
        :status_courier,
        :is_pickup,
        :due_date,
        :status_invoice,
        :order_incomplete         

        )
");

    $db->bind(':user_id',  $datos['user_id']);
    $db->bind(':order_prefix',  $datos['order_prefix']);
    $db->bind(':order_incomplete',  $datos['order_incomplete']);
    $db->bind(':is_pickup',  $datos['is_pickup']);
    $db->bind(':order_no', $datos["order_no"]);
    $db->bind(':order_datetime',  $datos['order_datetime']);
    $db->bind(':sender_id',  $datos["sender_id"]);
    $db->bind(':receiver_id',  $datos["recipient_id"]);
    $db->bind(':sender_address_id',  $datos["sender_address_id"]);
    $db->bind(':receiver_address_id',  $datos["recipient_address_id"]);
    $db->bind(':order_date',  $datos['order_date']);
    $db->bind(':order_package',  $datos["order_package"]);
    $db->bind(':order_item_category',  $datos["order_item_category"]);
    $db->bind(':order_pay_mode',  $datos["order_pay_mode"]);
    $db->bind(':status_courier',  $datos["status_courier"]);
    $db->bind(':due_date',   $datos["due_date"]);
    $db->bind(':status_invoice',   $datos["status_invoice"]);
    $db->bind(':volumetric_percentage',   $datos["volumetric_percentage"]);

    $db->cdp_execute();
    return $db->dbh->lastInsertId();
}

function cdp_updateCourierShipmentFromCustomer($datos)
{
    $db = new Conexion;

    $db->cdp_query("
        UPDATE  cdb_add_order SET   

        driver_id =:driver_id,
        sender_id =:sender_id,
        receiver_id =:receiver_id,  
        sender_address_id=:sender_address_id,
        receiver_address_id =:receiver_address_id,
        agency =:agency,
        origin_off =:origin_off,
        order_package =:order_package,
        order_item_category =:order_item_category,
        order_courier =:order_courier,
        order_service_options =:order_service_options,
        order_deli_time =:order_deli_time,                   
        order_pay_mode =:order_pay_mode,
        order_payment_method =:order_payment_method,
        status_courier =:status_courier,
        due_date=:due_date,
        status_invoice=:status_invoice,
        order_incomplete=:order_incomplete

        WHERE
        order_id=:order_id
");

    $db->bind(':order_incomplete',  $datos['order_incomplete']);
    $db->bind(':order_id',  $datos['order_id']);
    $db->bind(':driver_id',  $datos["driver_id"]);
    $db->bind(':sender_id',  $datos["sender_id"]);
    $db->bind(':receiver_id',  $datos["recipient_id"]);
    $db->bind(':sender_address_id',  $datos["sender_address_id"]);
    $db->bind(':receiver_address_id',  $datos["recipient_address_id"]);
    $db->bind(':agency',  $datos["agency"]);
    $db->bind(':origin_off',  $datos["origin_off"]);
    $db->bind(':order_package',  $datos["order_package"]);
    $db->bind(':order_item_category',  $datos["order_item_category"]);
    $db->bind(':order_courier',  $datos["order_courier"]);
    $db->bind(':order_service_options',  $datos["order_service_options"]);
    $db->bind(':order_deli_time',  $datos["order_deli_time"]);
    $db->bind(':order_pay_mode',  $datos["order_pay_mode"]);
    $db->bind(':order_payment_method',  $datos["order_payment_method"]);
    $db->bind(':status_courier',  $datos["status_courier"]);
    $db->bind(':due_date',   $datos["due_date"]);
    $db->bind(':status_invoice',   $datos["status_invoice"]);

    return $db->cdp_execute();
}

function cdp_updateCourierShipment($datos)
{
    $db = new Conexion;

    $db->cdp_query("
        UPDATE  cdb_add_order SET   

        driver_id =:driver_id,
        sender_id =:sender_id,
        receiver_id =:receiver_id,  
        sender_address_id=:sender_address_id,
        receiver_address_id =:receiver_address_id,
        agency =:agency,
        origin_off =:origin_off,
        order_package =:order_package,
        order_item_category =:order_item_category,
        order_courier =:order_courier,
        order_service_options =:order_service_options,
        order_deli_time =:order_deli_time,                   
        order_pay_mode =:order_pay_mode,
        order_payment_method =:order_payment_method,
        status_courier =:status_courier,
        due_date=:due_date,
        status_invoice=:status_invoice

        WHERE
        order_id=:order_id
");

    $db->bind(':order_id',  $datos['order_id']);
    $db->bind(':driver_id',  $datos["driver_id"]);
    $db->bind(':sender_id',  $datos["sender_id"]);
    $db->bind(':receiver_id',  $datos["recipient_id"]);
    $db->bind(':sender_address_id',  $datos["sender_address_id"]);
    $db->bind(':receiver_address_id',  $datos["recipient_address_id"]);
    $db->bind(':agency',  $datos["agency"]);
    $db->bind(':origin_off',  $datos["origin_off"]);
    $db->bind(':order_package',  $datos["order_package"]);
    $db->bind(':order_item_category',  $datos["order_item_category"]);
    $db->bind(':order_courier',  $datos["order_courier"]);
    $db->bind(':order_service_options',  $datos["order_service_options"]);
    $db->bind(':order_deli_time',  $datos["order_deli_time"]);
    $db->bind(':order_pay_mode',  $datos["order_pay_mode"]);
    $db->bind(':order_payment_method',  $datos["order_payment_method"]);
    $db->bind(':status_courier',  $datos["status_courier"]);
    $db->bind(':due_date',   $datos["due_date"]);
    $db->bind(':status_invoice',   $datos["status_invoice"]);

    return $db->cdp_execute();
}


function cdp_updateCourierShipmentTotals($datos)
{
    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_add_order SET
    
    tax_value=:tax_value,
    tax_discount=:tax_discount,
    tax_insurance_value=:tax_insurance_value,
    total_insured_value=:total_insured_value,
    tax_custom_tariffis_value=:tax_custom_tariffis_value,
    value_weight=:value_weight,
    declared_value=:declared_value,
    total_weight=:total_weight,
    sub_total=:sub_total,
    total_tax_insurance=:total_tax_insurance,
    total_tax_custom_tariffis=:total_tax_custom_tariffis,
    total_tax=:total_tax,
    total_declared_value=:total_declared_value,
    total_fixed_value=:total_fixed_value,
    total_tax_discount=:total_tax_discount,
    total_reexp=:total_reexp,
    total_order=:total_order        

        where order_id  = :order_id
    ');

    $db->bind(':order_id', $datos['order_id']);
    $db->bind(':tax_value', $datos['tax_value']);
    $db->bind(':tax_discount', $datos['tax_discount']);
    $db->bind(':tax_insurance_value', $datos['tax_insurance_value']);
    $db->bind(':value_weight', $datos['value_weight']);
    $db->bind(':sub_total', $datos['sub_total']);
    $db->bind(':total_insured_value', $datos['total_insured_value']);
    $db->bind(':tax_custom_tariffis_value', $datos['tax_custom_tariffis_value']);
    $db->bind(':declared_value', $datos['declared_value']);
    $db->bind(':total_reexp', $datos['total_reexp']);
    $db->bind(':total_declared_value', $datos['total_declared_value']);
    $db->bind(':total_fixed_value', $datos['total_fixed_value']);
    $db->bind(':total_tax_discount', $datos['total_tax_discount']);
    $db->bind(':total_tax_insurance', $datos['total_tax_insurance']);
    $db->bind(':total_tax_custom_tariffis', $datos['total_tax_custom_tariffis']);
    $db->bind(':total_tax', $datos['total_tax']);
    $db->bind(':total_weight', $datos['total_weight']);
    $db->bind(':total_order', $datos['total_order']);

    return $db->cdp_execute();
}

function cdp_insertCourierShipmentPackages($datos)
{

    $db = new Conexion;

    $db->cdp_query("
    INSERT INTO cdb_add_order_item 
    (
    order_id,
    order_item_description,
    order_item_quantity,
    order_item_weight,
    order_item_length,
    order_item_width,
    order_item_height,
    order_item_fixed_value,
    order_item_declared_value
                    
    )
    VALUES 
    (
    :order_id,
    :order_item_description,
    :order_item_quantity,
    :order_item_weight,
    :order_item_length,
    :order_item_width,
    :order_item_height,
    :order_item_fixed_value,
    :order_item_declared_value               
    )
  ");

    $db->bind(':order_id',   $datos["order_id"]);
    $db->bind(':order_item_description',  $datos["description"]);
    $db->bind(':order_item_quantity',  $datos["qty"]);
    $db->bind(':order_item_weight',  $datos["weight"]);
    $db->bind(':order_item_length',  $datos["length"]);
    $db->bind(':order_item_width',  $datos["width"]);
    $db->bind(':order_item_height',  $datos["height"]);
    $db->bind(':order_item_fixed_value',  $datos["fixed_value"]);
    $db->bind(':order_item_declared_value',  $datos["declared_value"]);

    return  $db->cdp_execute();
}

function cdp_getPaymentMethodCourier($id)
{
    $db = new Conexion;

    $db->cdp_query('SELECT * FROM cdb_payment_methods WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    return  $db->cdp_registro();
}

function cdp_getSettingsCourier()
{
    $db = new Conexion;

    $db->cdp_query('SELECT * FROM cdb_settings');

    $db->cdp_execute();

    return  $db->cdp_registro();
}

function cdp_insertCourierShipmentTrack($datos)
{

    $db = new Conexion;
    $db->cdp_query("
        INSERT INTO cdb_courier_track 
        (
            order_id,
            order_track, 
            comments,                                  
            t_date,
            status_courier,
            office_id,
            user_id
            )
        VALUES
            (
            :order_id,    
            :order_track, 
            :comments,                                     
            :t_date,
            :status_courier,
            :office,                   
            :user_id
            )
    ");

    $db->bind(':user_id',  $datos["user_id"]);
    $db->bind(':order_id', $datos["order_id"]);
    $db->bind(':order_track',  $datos["order_track"]);
    $db->bind(':t_date',  $datos["t_date"]);
    $db->bind(':status_courier', $datos["status_courier"]);
    $db->bind(':comments', $datos["comments"]);
    $db->bind(':office', $datos["office"]);

    return  $db->cdp_execute();
}

function cdp_getSenderCourier($id)
{
    $db = new Conexion;

    $db->cdp_query('SELECT * FROM cdb_users WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    return $db->cdp_registro();
}

function cdp_getRecipientCourier($id)
{
    $db = new Conexion;

    $db->cdp_query('SELECT * FROM cdb_recipients WHERE id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    return $db->cdp_registro();
}

function cdp_insertCourierShipmentUserHistory($datos)
{
    $db = new Conexion;
    $db->cdp_query("
                INSERT INTO cdb_order_user_history 
                (
                    user_id,
                    order_id,
                    order_track,
                    action,
                    date_history                   
                    )
                VALUES
                    (
                    :user_id,
                    :order_id,
                    :order_track,
                    :action,
                    :date_history
                    )
            ");

    $db->bind(':order_id', $datos["order_id"]);
    $db->bind(':order_track', $datos["order_track"]);
    $db->bind(':user_id', $datos["user_id"]);
    $db->bind(':action', $datos["action"]);
    $db->bind(':date_history',  $datos["date_history"]);

    return  $db->cdp_execute();
}

function cdp_insertNotification($datos)
{
    $db = new Conexion;

    $db->cdp_query("
    INSERT INTO cdb_notifications 
    (
        user_id,
        order_id,
        notification_description,
        shipping_type,
        notification_date

    )
    VALUES
        (
        :user_id,                    
        :order_id,
        :notification_description,
        :shipping_type,
        :notification_date                    
        )
");
    $db->bind(':user_id', $datos["user_id"]);
    $db->bind(':order_id', $datos["order_id"]);
    $db->bind(':notification_description', $datos["notification_description"]);
    $db->bind(':shipping_type', $datos["shipping_type"]);
    $db->bind(':notification_date',  $datos["notification_date"]);

    $db->cdp_execute();
    return $db->dbh->lastInsertId();
}

function cdp_getSenderAddress($id)
{
    $db = new Conexion;

    $db->cdp_query('SELECT * FROM cdb_senders_addresses WHERE id_addresses=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    return  $db->cdp_registro();
}

function cdp_getRecipientAddress($id)
{
    $db = new Conexion;

    $db->cdp_query('SELECT * FROM cdb_recipients_addresses WHERE id_addresses=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    return  $db->cdp_registro();
}


function cdp_insertCourierShipmentAddresses($datos)
{
    $db = new Conexion;
    $db->cdp_query("
                    INSERT INTO cdb_address_shipments
                    (
                        order_id,
                        order_track,
                        sender_country,
                        sender_state,
                        sender_city,
                        sender_zip_code,
                        sender_address,
                        recipient_country,
                        recipient_state,
                        recipient_city,
                        recipient_zip_code,
                        recipient_address
                    )
                    VALUES
                        (
                        :order_id,    
                        :order_track,
                        :sender_country,
                        :sender_state,
                        :sender_city,
                        :sender_zip_code,
                        :sender_address,
                        :recipient_country,
                        :recipient_state,
                        :recipient_city,
                        :recipient_zip_code,                
                        :recipient_address
                        )
                ");

    $db->bind(':order_id',  $datos["order_id"]);
    $db->bind(':order_track',  $datos["order_track"]);
    $db->bind(':sender_country',   $datos["sender_country"]);
    $db->bind(':sender_state',  $datos["sender_state"]);
    $db->bind(':sender_city',  $datos["sender_city"]);
    $db->bind(':sender_zip_code',   $datos["sender_zip_code"]);
    $db->bind(':sender_address',  $datos["sender_address"]);
    $db->bind(':recipient_country',   $datos["recipient_country"]);
    $db->bind(':recipient_state',   $datos["recipient_state"]);
    $db->bind(':recipient_city',   $datos["recipient_city"]);
    $db->bind(':recipient_zip_code',   $datos["recipient_zip_code"]);
    $db->bind(':recipient_address',  $datos["recipient_address"]);

    return  $db->cdp_execute();
}


// ===========================================================
//  CUSTOMERS PACKAGES
// ===========================================================

function cdp_insertCustomerPackagesItems($datos)
{

    $db = new Conexion;

    $db->cdp_query("
        INSERT INTO cdb_customers_packages_detail 
        (
        order_id,
        order_item_description,
        order_item_quantity,
        order_item_weight,
        order_item_length,
        order_item_width,
        order_item_height,
        order_item_fixed_value,
        order_item_declared_value
                        
        )
        VALUES 
        (
        :order_id,
        :order_item_description,
        :order_item_quantity,
        :order_item_weight,
        :order_item_length,
        :order_item_width,
        :order_item_height,
        :order_item_fixed_value,
        :order_item_declared_value               
        )
    ");


    $db->bind(':order_id',   $datos["order_id"]);
    $db->bind(':order_item_description',  $datos["description"]);
    $db->bind(':order_item_quantity',  $datos["qty"]);
    $db->bind(':order_item_weight',  $datos["weight"]);
    $db->bind(':order_item_length',  $datos["length"]);
    $db->bind(':order_item_width',  $datos["width"]);
    $db->bind(':order_item_height',  $datos["height"]);
    $db->bind(':order_item_fixed_value',  $datos["fixed_value"]);
    $db->bind(':order_item_declared_value',  $datos["declared_value"]);

    return  $db->cdp_execute();
}

function cdp_updateCustomerPackagesTotals($datos)
{
    $db = new Conexion;

    $db->cdp_query('UPDATE cdb_customers_packages SET
    
    tax_value=:tax_value,
    tax_discount=:tax_discount,
    tax_insurance_value=:tax_insurance_value,
    total_insured_value=:total_insured_value,
    tax_custom_tariffis_value=:tax_custom_tariffis_value,
    value_weight=:value_weight,
    declared_value=:declared_value,
    total_weight=:total_weight,
    sub_total=:sub_total,
    total_tax_insurance=:total_tax_insurance,
    total_tax_custom_tariffis=:total_tax_custom_tariffis,
    total_tax=:total_tax,
    total_declared_value=:total_declared_value,
    total_fixed_value=:total_fixed_value,
    total_tax_discount=:total_tax_discount,
    total_reexp=:total_reexp,
    total_order=:total_order        

        where order_id  = :order_id
    ');

    $db->bind(':order_id', $datos['order_id']);
    $db->bind(':tax_value', $datos['tax_value']);
    $db->bind(':tax_discount', $datos['tax_discount']);
    $db->bind(':tax_insurance_value', $datos['tax_insurance_value']);
    $db->bind(':value_weight', $datos['value_weight']);
    $db->bind(':sub_total', $datos['sub_total']);
    $db->bind(':total_insured_value', $datos['total_insured_value']);
    $db->bind(':tax_custom_tariffis_value', $datos['tax_custom_tariffis_value']);
    $db->bind(':declared_value', $datos['declared_value']);
    $db->bind(':total_reexp', $datos['total_reexp']);
    $db->bind(':total_declared_value', $datos['total_declared_value']);
    $db->bind(':total_fixed_value', $datos['total_fixed_value']);
    $db->bind(':total_tax_discount', $datos['total_tax_discount']);
    $db->bind(':total_tax_insurance', $datos['total_tax_insurance']);
    $db->bind(':total_tax_custom_tariffis', $datos['total_tax_custom_tariffis']);
    $db->bind(':total_tax', $datos['total_tax']);
    $db->bind(':total_weight', $datos['total_weight']);
    $db->bind(':total_order', $datos['total_order']);

    return $db->cdp_execute();
}


function cdp_insertCustomerPackages($datos)
{
    $db = new Conexion;

    $db->cdp_query("
    INSERT INTO cdb_customers_packages 
    (
        user_id,
        order_prefix,
        order_no,
        order_date,
        sender_id,
        sender_address_id,
        volumetric_percentage,
        order_datetime,
        agency,
        origin_off,
        order_item_category, 
        order_package,
        order_courier,
        order_service_options,
        order_deli_time,                   
        status_courier,
        driver_id,
        status_invoice,
        tracking_purchase,
        provider_purchase,
        price_purchase,
        is_prealert
        )
    VALUES
        (
        :user_id,
        :order_prefix,
        :order_no,
        :order_date,
        :sender_id,
        :sender_address_id,
        :volumetric_percentage,
        :order_datetime,
        :agency,
        :origin_off,
        :order_item_category, 
        :order_package,
        :order_courier,
        :order_service_options,
        :order_deli_time,                   
        :status_courier,
        :driver_id,
        :status_invoice,
        :tracking_purchase,
        :provider_purchase,
        :price_purchase,
        :is_prealert
        )
");

    $db->bind(':order_prefix',  $datos['order_prefix']);
    $db->bind(':order_no', $datos["order_no"]);
    $db->bind(':agency',  $datos["agency"]);
    $db->bind(':origin_off',  $datos["origin_off"]);
    $db->bind(':sender_id',  $datos["sender_id"]);
    $db->bind(':sender_address_id',  $datos["sender_address_id"]);
    $db->bind(':tracking_purchase',  $datos["tracking_purchase"]);
    $db->bind(':provider_purchase',  $datos["provider_purchase"]);
    $db->bind(':price_purchase',  $datos["price_purchase"]);
    $db->bind(':order_item_category',  $datos["order_item_category"]);
    $db->bind(':order_courier',  $datos["order_courier"]);
    $db->bind(':order_service_options',  $datos["order_service_options"]);
    $db->bind(':order_deli_time',  $datos["order_deli_time"]);
    $db->bind(':status_courier',  $datos["status_courier"]);
    $db->bind(':driver_id',  $datos["driver_id"]);
    $db->bind(':order_datetime',  $datos['order_datetime']);
    $db->bind(':order_date',  $datos['order_date']);
    $db->bind(':order_package',  $datos["order_package"]);
    $db->bind(':status_invoice',   $datos["status_invoice"]);
    $db->bind(':volumetric_percentage',   $datos["volumetric_percentage"]);
    $db->bind(':user_id',  $datos['user_id']);
    $db->bind(':is_prealert',  $datos['is_prealert']);

    $db->cdp_execute();
    return $db->dbh->lastInsertId();
}

function cdp_getCustomerPackage($id)
{
    $db = new Conexion;

    $db->cdp_query('SELECT * FROM cdb_customers_packages WHERE order_id=:id');

    $db->bind(':id', $id);

    $db->cdp_execute();

    return  $db->cdp_registro();
}

function cdp_deleteCustomersPackagesItems($id)
{
    $db = new Conexion;

    $db->cdp_query('DELETE  FROM cdb_customers_packages_detail WHERE order_id=:id');
    $db->bind(':id', $id);

    return $db->cdp_execute();
}


function cdp_updateCustomerPackages($datos)
{
    $db = new Conexion;

    $db->cdp_query("
        UPDATE  cdb_customers_packages SET   

        agency =:agency,
        origin_off =:origin_off,
        sender_id =:sender_id,
        sender_address_id=:sender_address_id,
        tracking_purchase=:tracking_purchase,
        provider_purchase=:provider_purchase,
        price_purchase=:price_purchase,
        order_package =:order_package,
        order_item_category =:order_item_category,
        order_courier =:order_courier,
        order_service_options =:order_service_options,
        order_deli_time =:order_deli_time,                   
        status_courier =:status_courier

        WHERE
        order_id=:order_id
");

    $db->bind(':agency',  $datos["agency"]);
    $db->bind(':origin_off',  $datos["origin_off"]);
    $db->bind(':sender_id',  $datos["sender_id"]);
    $db->bind(':sender_address_id',  $datos["sender_address_id"]);
    $db->bind(':tracking_purchase',  $datos["tracking_purchase"]);
    $db->bind(':provider_purchase',  $datos["provider_purchase"]);
    $db->bind(':price_purchase',  $datos["price_purchase"]);
    $db->bind(':order_package',  $datos["order_package"]);
    $db->bind(':order_item_category',  $datos["order_item_category"]);
    $db->bind(':order_courier',  $datos["order_courier"]);
    $db->bind(':order_service_options',  $datos["order_service_options"]);
    $db->bind(':order_deli_time',  $datos["order_deli_time"]);
    $db->bind(':status_courier',  $datos["status_courier"]);
    $db->bind(':order_id',  $datos['order_id']);

    return $db->cdp_execute();
}


function cdp_updatedPreAlertPackage($pre_alert_id)
{
    $db = new Conexion;

    $db->cdp_query("
        UPDATE  cdb_pre_alert SET   
        is_package =:is_package

        WHERE pre_alert_id=:pre_alert_id          
");

    $db->bind(':pre_alert_id',  $pre_alert_id);
    $db->bind(':is_package', '1');


    return $db->cdp_execute();
}
