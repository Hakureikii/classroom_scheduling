//add schedules
function form_add_new_schedules(day, start_time, end_time, room_no, course_assignment) {
   $.post("../crud/php/create_schedule.php",
      {
         day: day,
         new_start_time: start_time,
         new_end_time: end_time,
         room_no: room_no,
         course_assignment: course_assignment,
      },

      function (response) {
         alert(response);
         let feedback = document.getElementById("message");
         if (response === "overlap") {
            feedback.innerHTML = `<p class="text-danger fs-6 fw-normal"> Conflicting Schedule Unable to Insert </p>`;
            $("#message").fadeOut(5000);

         } else if (response === "assigned today!") {
            feedback.innerHTML = `<p class="text-danger fs-6 fw-normal"> Schedule existing on the same day! </p>`;
            $("#message").fadeOut(5000);

         } else if (response === "limit reached!") {
            feedback.innerHTML = `<p class="text-danger fs-6 fw-normal"> Class limit reached! </p>`;
            $("#message").fadeOut(5000);

         } else {
            fetch_schedules();
            $("#addScheduleModal").modal("hide");
         }
      })
}

//add assignments
function form_add_teaching_assignments(instructor, course, section) {
   $.post("../crud/php/create_teaching_assignments.php ",
      {
         instructor: instructor,
         course: course,
         section: section,
      },
      function (response) {
         let feedback = document.getElementById("assignments_message");
         if (response === "existing") {
            feedback.innerHTML = `<p class="text-danger fs-6 fw-normal"> Existing Assignment </p>`;
            $("#assignments_message").fadeOut(5000);
         } else if (response === "will exceed unit cap") {
            feedback.innerHTML = `<p class="text-danger fs-6 fw-normal"> Will exceed unit limit </p>`;
            $("#assignments_message").fadeOut(5000);
         } else if (response === "maximum units reached") {
            feedback.innerHTML = `<p class="text-danger fs-6 fw-normal"> Max units reached </p>`;
            $("#assignments_message").fadeOut(5000);
         } else {
            fetch_teaching_assignments();
            $("#addAssignmentModal").modal("hide");
         }


      })
}


//add users
function add_users(first_name, middle_name, last_name, sex, section, email, password, role) {
   let empty = "";
   document.getElementById("role").addEventListener("change", select_user);
   function select_user() {
      let user = document.getElementById("role").value;
      if (user === "Student") {
         return;

      } else if (user === "Instructor") {
         $("#section").prop("disabled", true);

      } else if (use === "Admin") {

      }
   }

   if (role === "Student") {
      $.post("../crud/php/add_students.php",
         {
            first_name: first_name,
            middle_name: middle_name,
            last_name: last_name,
            sex: sex,
            section: section,
            email: email,
            password: password
         },
         function (response) {
            if (response === "ok") {
               $("#first_name").val(empty);
               $("#middle_name").val(empty);
               $("#last_name").val(empty);
               $("#email").val(empty);
               $("#password").val(empty);
               $("#addUsersModal").modal("hide");
               fetch_students();
            } else {
               alert("lol");
            };

         })

   } else if (role === "Instructor") {
      $.post("../crud/php/add_instructors.php",
         {
            first_name: first_name,
            middle_name: middle_name,
            last_name: last_name,
            sex: sex,
            email: email,
            password: password
         },
         function (response) {
            if (response === "ok") {
               $("#first_name").val(empty);
               $("#middle_name").val(empty);
               $("#last_name").val(empty);
               $("#email").val(empty);
               $("#password").val(empty);
               $("#addUsersModal").modal("hide");
               fetch_instructors();
            } else {
               alert("lol");
            };
         })

   } else if (role === "Admin") {
      $.post("../crud/php/add_admin",
         {
            first_name: first_name,
            middle_name: middle_name,
            last_name: last_name,
            sex: sex,
            email: email,
            password: password
         },
         function (response) {
            if (response === "ok") {
               $("#addUsersModal").modal("hide");
               fetch_admin();
            } else {
               alert("lol");
            };
         })

   } else {
      let add_feedback = document.getElementById("message");
      add_feedback.innerHTML = `<p class="text-danger fs-6 fw-normal"> Select a Role! </p>`
      $("#message").fadeOut(5000);
   }

}


//add courses
function add_courses(course_code, descriptive_title, units) {
   $.post("../crud/php/create_courses.php",
      {
         course_code: course_code,
         descriptive_title: descriptive_title,
         units: units,
      },
      function (response) {
         if (response === "success") {
            fetch_courses();
            $("#addCourseModal").hide();
         } else {
            let add_courses_feedback = document.getElementById("add_courses_message");
            add_courses_feedback.innerHTML = `<p class="text-danger fs-6 fw-normal"> Existing Course! </p>`
            $("#add_courses_message").fadeOut(5000);
            
         }
      })
}