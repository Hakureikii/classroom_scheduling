// edit course button listener
$(document).on("click", ".course-edit-btn", function () {
   const id = $(this).data("id");
   const code = $(this).data("code");
   const title = $(this).data("title");
   const units = $(this).data("units");

   $("#edit_course_id").val(id);
   $("#edit_course_code").val(code);
   $("#edit_descriptive_title").val(title);
   $("#edit_units").val(units);
});