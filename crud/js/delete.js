function delete_student(student_id) {
    $("#user_id").val(student_id);

}
$("#confirm_delete_student").on("click", function () {
    let student_id = $("#user_id").val();

    $.post("../crud/php/delete_students.php",
        {
            student_id: student_id
        },
        function (response) {
            if (response === "ok") {
                $("#deleteUsersModal").modal("hide");
                fetch_students();
            }
            
        })
})

function delete_instructor(instructor_id) {
    $("#user_id").val(instructor_id);

}
$("#confirm_delete_student").on("click", function () {
    let instructor_id = $("#user_id").val();

    $.post("../crud/php/delete_instructors.php",
        {
            instructor_id: instructor_id
        },
        function (response) {
            if (response === "ok") {
                $("#deleteUsersModal").modal("hide");
                fetch_instructors();
            }
            
        })
})