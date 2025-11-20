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

//delete courses
$(document).on('click', '.course-delete-btn', function() {
    let course_id = $(this).data("id");
    if (!confirm("Delete Course?")) {
        return;
    } $.post("../crud/php/delete_courses.php", {
        course_id: course_id 
    }, 
    function(response) {
        alert(response);
        fetch_courses();
    })
})


// archive the ended sessions
function archive_sessions() {
    $.get("../crud/php/archive_sessions.php", function(response) {
    });
}