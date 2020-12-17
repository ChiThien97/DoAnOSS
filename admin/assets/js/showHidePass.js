// $('.btn-hide').on('click', function(){
//     if($(this).data().toggle == 0)
//     {
//         $('#user_pass').attr('type','text');
//         $(this).data().toggle = 1;
//         $(".fas.fa-eye").addClass("fa-eye-slash");
//     }
//     else 
//     {
//         $('#user_pass').attr('type','password');
//         $(this).data().toggle = 0;
//         $(".fas.fa-eye").removeClass("fa-eye-slash");
//     }
// });

function showHidePass(inputid,btnid,eyeid){
    if($('#'+btnid).data().toggle == 0)
    {
        $('#'+inputid).attr('type','text');
        $('#'+btnid).data().toggle = 1;
        $('#'+eyeid).addClass("fa-eye-slash");
    }
    else 
    {
        $('#'+inputid).attr('type','password');
        $('#'+btnid).data().toggle = 0;
        $('#'+eyeid).removeClass("fa-eye-slash");
    }
}