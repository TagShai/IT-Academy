$('#continue').click(function () {
   if($('#fos_user_registration_form_email').val()!=""
       && $('#fos_user_registration_form_username').val()!=""
       && $('#fos_user_registration_form_plainPassword_first').val()==$('#fos_user_registration_form_plainPassword_second').val()
       && $('#fos_user_registration_form_plainPassword_first').val()!=""
       && $('#fos_user_registration_form_plainPassword_second').val()!=""
       && $('#fos_user_registration_form_crole').val()!=""){


       if($('#fos_user_registration_form_crole').val()){
           $('#step').text('Step 2');
           $("#fos_user_registration_form_username,label[for='fos_user_registration_form_username']," +
               "#fos_user_registration_form_email,label[for='fos_user_registration_form_email']," +
               "#fos_user_registration_form_crole,label[for='fos_user_registration_form_crole']," +
               "#fos_user_registration_form_plainPassword_first,label[for='fos_user_registration_form_plainPassword_first']," +
               "#fos_user_registration_form_plainPassword_second,label[for='fos_user_registration_form_plainPassword_second']," +
               "#continue")
               .addClass('hidden');

           $("#fos_user_registration_form_lname,label[for='fos_user_registration_form_lname']," +
               "#fos_user_registration_form_mname,label[for='fos_user_registration_form_mname']," +
               "#fos_user_registration_form_fname," +
               "label[for='fos_user_registration_form_fname'],#step2").removeClass('hidden');


       }
   }
});
$('#step2').click(function () {
    $('#step').text('Step 3');
    if($('#fos_user_registration_form_mname').val()!=""
        && $('#fos_user_registration_form_lname').val()!=""
        && $('#fos_user_registration_form_fname').val()!=""
    ){
        if($('#fos_user_registration_form_crole').val()=="ROLE_STUDENT"){
            $("#fos_user_registration_form_lname,label[for='fos_user_registration_form_lname']," +
                "#fos_user_registration_form_mname,label[for='fos_user_registration_form_mname']," +
                "#fos_user_registration_form_fname,label[for='fos_user_registration_form_fname']," +
                "#step2")
                .addClass('hidden');
            $("#fos_user_registration_form_address,label[for='fos_user_registration_form_address']," +
                "#fos_user_registration_form_group,label[for='fos_user_registration_form_group']," +
                "#fos_user_registration_form_course,label[for='fos_user_registration_form_course']," +
                "#fos_user_registration_form_submit").removeClass('hidden');
        }
        if($('#fos_user_registration_form_crole').val()=="ROLE_TEACHER"){
            $("#fos_user_registration_form_lname,label[for='fos_user_registration_form_lname']," +
                "#fos_user_registration_form_mname,label[for='fos_user_registration_form_mname']," +
                "#fos_user_registration_form_fname,label[for='fos_user_registration_form_fname']," +
                "#step2")
                .addClass('hidden');
            $("#fos_user_registration_form_department,label[for='fos_user_registration_form_department']," +
                "#fos_user_registration_form_rank,label[for='fos_user_registration_form_rank']," +
                "#fos_user_registration_form_submit").removeClass('hidden');
        }
    }
});