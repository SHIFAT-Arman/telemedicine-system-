// $(document).ready(function () {
//     // alert("Hello"); // test alert
//     $(".doctor_check").click(function () {
//         $("#loader").show();
//        
//         var action = "data";
//         var specialty_filter = get_filter_text("specialty");
//         var gender_filter = get_filter_text("gender");
//        
//         $.ajax({
//             url: "action.php",
//             method: "POST",
//             data: {
//                 action: action,
//                 specialty_filter: specialty_filter,
//                 gender_filter: gender_filter
//             },
//             success: function (response){
//                 $("#result").html(response);
//                 $("#loader").hide();
//                 $("#textChange").text("Filtered Doctors");
//             }
//         });
//     });
//
//     function get_filter_text(text_id) {
//         var filterData = [];
//         $("#" + text_id + ":checked").each(function () {
//             filterData.push($(this).val());
//         });
//         return filterData;
//     }
// })