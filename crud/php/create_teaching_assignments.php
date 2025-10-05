<?php
include_once("../../connection.php");
$course_id = $_POST["course"];
$instructor_id = $_POST["instructor"];
$section_id = $_POST["section"];


//retrieving total units per instructor
$total_units = $conn->prepare("SELECT 
    i.instructor_id,
    CONCAT(i.last_name, ', ', i.first_name) AS instructor_name,
    CAST(SUM(c.units) AS UNSIGNED INT) AS total_units
FROM teaching_assignments ta
INNER JOIN instructors i ON i.instructor_id = ta.instructor_id
INNER JOIN courses c ON c.course_id = ta.course_id
WHERE i.instructor_id = :instructor_id
");
$total_units->execute([
    ":instructor_id" => $instructor_id
]);
$total_units_of_instructor = $total_units->fetch(PDO::FETCH_ASSOC);


//retrieve number of units per course
$units = $conn->prepare("SELECT * FROM courses WHERE course_id = :course_id");
$units->execute([
    ":course_id" => $course_id
]);
$num_units = $units->fetch(PDO::FETCH_ASSOC);


//retrieve duplicates of assignments
$teaching_assignments = $conn->prepare("SELECT * FROM teaching_assignments WHERE course_id = :course_id AND instructor_id = :instructor_id AND section_id = :section_id");
$teaching_assignments->execute([
    ":course_id" => $course_id,
    ":instructor_id" => $instructor_id,
    ":section_id" => $section_id
]);
$fetched_teaching_assignments = $teaching_assignments->fetchALL(PDO::FETCH_ASSOC);

// echo json_encode($total_units_of_instructor["total_units"]);
// echo json_encode($num_units["units"]);


// check if inserting the course will reach limit of units per instructors
if ($num_units['units'] + $total_units_of_instructor['total_units'] > 18) {
    echo "will exceed unit cap";
} else {
    //check if the total units per instructor is reached
    if ($total_units_of_instructor['total_units'] >  18) {
        echo "maximum units reached";

    } else {
        //check teaching assignments to prevent duplicate assignments
        if (count($fetched_teaching_assignments) > 0) {
            echo "existing";

        } else {
            $stmt = $conn->prepare("INSERT INTO teaching_assignments(course_id, instructor_id, section_id) VALUES(:course_id, :instructor_id, :section_id)");
            $stmt->execute([
                ":course_id" => $course_id,
                ":instructor_id" => $instructor_id,
                ":section_id" => $section_id
            ]);
            echo "success";
        }
    }
}


?>