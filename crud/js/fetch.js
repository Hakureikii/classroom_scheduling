//retrieve schedules 
function fetch_schedules() {
   $.post("../crud/php/fetch_schedules.php", { instructor_id: $("#select_instructors").val() },
      function (response) {
         let schedules = JSON.parse(response);
         let schedule_table = document.getElementById("schedule_table");
         let display_schedules = "";
         if (schedules.msg === "no schedules") {
            display_schedules +=
               `<tr>
               <td colspan = 9 class="text-center"> - NO SCHEDULES YET - </td>
            </tr>`
            schedule_table.innerHTML = display_schedules;

         } else {
            for (let i = 0; i < schedules.length; i++) {
               display_schedules +=
                  `<tr>
                  <td> ${i + 1} </td>
                  <td> ${schedules[i].day} </td>
                  <td> ${schedules[i].room_name} </td>
                  <td> ${schedules[i].section_name} </td>
                  <td> ${schedules[i].course_code} </td>
                  <td> ${schedules[i].instructor} </td>
                  <td> ${schedules[i].time_start_formatted} </td>
                  <td> ${schedules[i].time_end_formatted} </td>
               </tr>`
            }
            schedule_table.innerHTML = display_schedules;
         }
      })
}


// retrieve teaching assignments
function fetch_teaching_assignments() {
   $.get("../crud/php/fetch_assignments.php",
      function (response) {
         let assignments = JSON.parse(response);
         let assignment_table = document.getElementById("teaching_assignment_table");
         let display_assignments = "";

         if (assignments.msg === "no assignments") {
            display_assignments +=
               `<tr>
               <td colspan = 9 class="text-center"> - NO ASSIGNED INSTRUCTORS - </td>
            </tr>`
            assignment_table.innerHTML = display_assignments;
         } else {
            for (let i = 0; i < assignments.length; i++) {
               display_assignments += `<tr>
               <td> ${i + 1} </td>
               <td> ${assignments[i].instructor_name} </td>
               <td> ${assignments[i].course_code} </td>
               <td> ${assignments[i].descriptive_title} </td>
               <td> ${assignments[i].section_name} </td>
            </tr>`
            }
            assignment_table.innerHTML = display_assignments;
         }
      })
}


//retrieve sections
function fetch_sections() {
   $.get("../crud/php/fetch_sections.php",
      function (response) {
         let sections = JSON.parse(response);
         let section_table = document.getElementById("section_table");
         let display_sections = "";

         if (sections.msg === "no sections") {
            display_sections +=
               `<tr>
               <td colspan = 9 class="text-center"> - NO SECTION RECORDS - </td>
            </tr>`
            section_table.innerHTML = display_sections;
         } else {
            for (let i = 0; i < sections.length; i++) {
               display_sections += `<tr>
               <td> ${i + 1} </td>
               <td> ${sections[i].section_name} </td>
            </tr>`
            }
            section_table.innerHTML = display_sections;
         }
      })
}


//retrieve students
function fetch_students() {
   $.get("../crud/php/fetch_students.php",
      function (response) {
         let students = JSON.parse(response);
         let student_table = document.getElementById("user_table");
         let display_students = "";

         if (students.msg === "no sections") {
            display_students +=
               `<tr>
               <td colspan = 9 class="text-center"> - NO SECTION RECORDS - </td>
            </tr>`
            student_table.innerHTML = display_students;
         } else {
            for (let i = 0; i < students.length; i++) {
               display_students += `<tr>
               <td> ${i + 1} </td>
               <td> ${students[i].student_name} </td>
               <td> ${students[i].sex} </td>
               <td> ${students[i].email} </td>
               <td> ${students[i].password} </td>
               <td class="text-center"> <button onclick="delete_student(${students[i].student_id});" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteUsersModal"> 🗑 Delete </button> </td>
            </tr>`
            }
            student_table.innerHTML = display_students;
         }
      })
}


//retrieve instructors
function fetch_instructors() {
   $.get("../crud/php/fetch_instructors.php",
      function (response) {
         let instructors = JSON.parse(response);
         let instructor_table = document.getElementById("user_table");
         let display_instructors = "";

         if (instructors.msg === "no sections") {
            display_instructors +=
               `<tr>
               <td colspan = 9 class="text-center"> - NO SECTION RECORDS - </td>
            </tr>`
            instructor_table.innerHTML = display_instructors;
         } else {
            for (let i = 0; i < instructors.length; i++) {
               display_instructors += `<tr>
               <td> ${i + 1} </td>
               <td> ${instructors[i].instructor_name} </td>
               <td> ${instructors[i].sex} </td>
               <td> ${instructors[i].email} </td>
               <td> ${instructors[i].password} </td>
               <td class="text-center"> <button onclick="delete_instructor(${instructors[i].instructor_id});" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteUsersModal"> 🗑 Delete </button> </td>
            </tr>`
            }
            instructor_table.innerHTML = display_instructors;
         }
      })
}


//retrieve admin
function fetch_admin() {
   $.get("../crud/php/fetch_admin.php",
      function (response) {
         let admins = JSON.parse(response);
         let admin_table = document.getElementById("user_table");
         let display_admins = "";

         if (admins.msg === "no sections") {
            display_admins +=
               `<tr>
               <td colspan = 9 class="text-center"> - NO SECTION RECORDS - </td>
            </tr>`
            admin_table.innerHTML = display_admins;
         } else {
            for (let i = 0; i < admins.length; i++) {
               display_admins += `<tr>
               <td> ${i + 1} </td>
               <td> ${admins[i].name} </td>
               <td> ${admins[i].sex} </td>
               <td> ${admins[i].username} </td>
               <td> ${admins[i].password} </td>
               <td class="text-center"> <button onclick="delete_instructor(${admins[i].student_id});" class="btn btn-danger"> 🗑 </button> </td>
            </tr>`
            }
            admin_table.innerHTML = display_admins;
         }
      })
}


//fetch room status
function fetch_room_status() {
   $.get("../crud/php/fetch_room_status.php", function (response) {
      let rooms = JSON.parse(response);

      rooms.forEach(room => {
         let room_status = document.getElementById(`${room.room_name}`);

         if (room.status === "occupied") {
            room_status.style.backgroundColor = "red";
            room_status.style.color = "white";
         } else {
            room_status.style.backgroundColor = "rgb(11, 162, 11)";
            room_status.style.color = "white";

         }
      });
   });
}


function fetch_courses() {
   $.get("../crud/php/fetch_courses.php", function (response) {
      let courses = JSON.parse(response);
      let courses_table = $("#course_table");
      let display_courses = "";

      if (courses.length > 0) {
         courses.forEach((course, index) => {
            display_courses += `
               <tr>
                  <td>${index + 1}</td>
                  <td>${course.course_code}</td>
                  <td>${course.descriptive_title}</td>
                  <td>${course.units}</td>
                  <td>
                  <button class="btn btn-sm btn-outline-danger course-delete-btn" data-id="${course.course_id}"> 🗑 Delete </button>
                  <button class="btn btn-sm btn-outline-success course-edit-btn"
                     data-bs-toggle="modal" 
                     data-bs-target="#editCourseModal"
                     data-id = "${course.course_id}"
                     data-code = "${course.course_code}"
                     data-title = "${course.descriptive_title}"
                     data-units = "${course.units}"> 
                     ✎ Edit </button></td>
               </tr>`;
         });
      } else {
         display_courses = `<tr><td colspan="5" class="text-center text-muted">No courses found.</td></tr>`;
      }
      courses_table.html(display_courses);
   });
}

function fetch_room_schedules(room_id) {
   $.post("../crud/php/fetch_room_schedules.php", {room_id: room_id}, function(response) {
      let room_schedule = JSON.parse(response);
      let room_schedule_table = $("#room_table_schedule");
      let display_room_schedule = "";

      if (room_schedule.length > 0) {
         room_schedule.forEach((room_schedules, index) => {
            display_room_schedule += `<tr>
               <td>${index + 1}</td>
               <td>${room_schedules.day}</td>
               <td>${room_schedules.room_name}</td>
               <td>${room_schedules.section_name}</td>
               <td>${room_schedules.course}</td>
               <td>${room_schedules.instructor}</td>
               <td>${room_schedules.time_start_formatted}</td>
               <td>${room_schedules.time_end_formatted}</td>
            </tr>`
         })
         room_schedule_table.html(display_room_schedule);
      } else {
         display_room_schedule = `<tr><td colspan="5" class="text-center text-muted"> - No Schedules - </td></tr>`;
      }
   });
}

function fetch_current_schedule(room_id) {
   $.post("", {}, function(response) {
      alert(response)
   })
}