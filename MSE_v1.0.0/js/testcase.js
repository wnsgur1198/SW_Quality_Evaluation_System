$(document).ready(function () {
    $("#check_big").change(function () {
        if ($("#big_Healthcare").is(":checked")) {
            document.getElementById('choice_middle').style.display = "block";
        } else {
            document.getElementById('choice_middle').style.display = "none";
            document.getElementById('choice_small').style.display = "none";
            document.getElementById('submit').style.display = "none";
        }
    });
});

$(document).ready(function () {
    $("#check_middle").change(function () {
        if ($("#middle_IHE").is(":checked") || $("#middle_NIST").is(":checked")) {
            document.getElementById('choice_small').style.display = "block";
        } else {
            document.getElementById('choice_small').style.display = "none";
        }

    });
});

$(document).ready(function () {
    $("#check_small").change(function () {
        document.getElementById('submit').style.display = "block";
        // document.getElementById('setting').style.display = "block";


        if ($("#middle_IHE").is(":checked")) {

            if ($("#middle_NIST").is(":checked")) {

                document.getElementById('result').value = "대분류 : Healthcare > 중분류 : " +
                    $('input:checkbox[id="middle_IHE"]').val() + ", " + $('input:checkbox[id="middle_NIST"]').val() + " > 소분류 : " +
                    $(":input:checkbox[name=small_cardiology]:checked").val();
                // $(":input:checkbox[name=small_eyecare]:checked").val() + ", " +
                // $(":input:checkbox[name=small_radiation]:checked").val();
                // $('small_cardiology').is(":checked").val() + ", " +
                // $('small_eyecare').is(":checked").val() + ", " +
                // $('small_radiation').is(":checked").val();

            } else {
                document.getElementById('result').value = "대분류 : Healthcare > 중분류 : " +
                    $('input:checkbox[id="middle_IHE"]').val() + " > 소분류 : " +
                    $(":input:checkbox[name=small_cardiology]:checked").val();
            }
        }

    });
});


// $(function () {
//             if ($('input').is(":checked") == true) {
//                 $('b').text('체크된 상태');
//             }