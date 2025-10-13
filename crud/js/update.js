//update courses
function update_courses(course_id, course_code, descriptive_title, units) {
   $.post("../crud/php/update_courses.php", 
      {
         course_id: course_id,
         course_code: course_code,
         descriptive_title: descriptive_title,
         units: units,
      }, 
      function(response) {
         alert(response);
         fetch_courses();
         const editModal = bootstrap.Modal.getInstance(document.getElementById('editCourseModal'));
         editModal.hide();
   })
}