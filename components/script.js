// BACKEND SCRIPT IN FIRST PART
document.getElementById('Department').addEventListener('change', function () {
    var selectedDepartment = this.value;
    var gradeLevelSelect = document.getElementById('txtGradeLevel');
    var strandCourseSelect = document.getElementById('strand_course');

    // Reset selected grade level
    gradeLevelSelect.selectedIndex = 0;

    // Reset selected strand/course
    strandCourseSelect.selectedIndex = 0;

    if (selectedDepartment === 'Pre-Elementary') {
        // SHOW GRADE LEVELS NURSERY / KINDER
        for (var i = 0; i < gradeLevelSelect.options.length; i++) {
            var optionValue = gradeLevelSelect.options[i].value;
            if (optionValue === 'Nursery' || optionValue === 'Kinder') {
                gradeLevelSelect.options[i].style.display = 'block';
            } else {
                gradeLevelSelect.options[i].style.display = 'none';
            }
        }

        // Disable strand/course select
        strandCourseSelect.disabled = true;
    } else if (selectedDepartment === 'Elementary') {
        // SHOW GRADE LEVELS 1 to 6 AND HIDE NECESSARY
        for (var j = 0; j < gradeLevelSelect.options.length; j++) {
            var optionValue = gradeLevelSelect.options[j].value;
            if (optionValue === 'Grade 1' || optionValue === 'Grade 2' || optionValue === 'Grade 3' ||
                optionValue === 'Grade 4' || optionValue === 'Grade 5' || optionValue === 'Grade 6') {
                gradeLevelSelect.options[j].style.display = 'block';
            } else {
                gradeLevelSelect.options[j].style.display = 'none';
            }
        }

        // Disable strand/course select
        strandCourseSelect.disabled = true;
    } else if (selectedDepartment === 'Junior High School') {
        // SHOW GRADE LEVELS 7 to 10 AND HIDE NECESSARY
        for (var k = 0; k < gradeLevelSelect.options.length; k++) {
            var optionValue = gradeLevelSelect.options[k].value;
            if (optionValue === 'Grade 7' || optionValue === 'Grade 8' || optionValue === 'Grade 9' ||
                optionValue === 'Grade 10') {
                gradeLevelSelect.options[k].style.display = 'block';
            } else {
                gradeLevelSelect.options[k].style.display = 'none';
            }
        }

        // Disable strand/course select
        strandCourseSelect.disabled = true;
    } else if (selectedDepartment === 'Senior High School') {
        // Show grade levels 11 to 12 and hide unnecessary
        for (var k = 0; k < gradeLevelSelect.options.length; k++) {
            var optionValue = gradeLevelSelect.options[k].value;
            if (optionValue === 'Grade 11' || optionValue === 'Grade 12') {
                gradeLevelSelect.options[k].style.display = 'block';
            } else {
                gradeLevelSelect.options[k].style.display = 'none';
            }
        }

        // Enable strand/course select
        strandCourseSelect.disabled = false;

        // Show strand options: HUMSS, ABM, STEM
        strandCourseSelect.selectedIndex = 0;
        strandCourseSelect.style.display = 'block';

        // Show HUMSS, ABM, and STEM options; hide others
        for (var m = 0; m < strandCourseSelect.options.length; m++) {
            var optionValue = strandCourseSelect.options[m].value;
            if (optionValue === 'HUMSS' || optionValue === 'ABM' || optionValue === 'STEM') {
                strandCourseSelect.options[m].style.display = 'block';
            } else {
                strandCourseSelect.options[m].style.display = 'none';
            }
        }
    } else if (selectedDepartment === 'College') {
        // Show grade levels 1st year college to 4th year college and hide unnecessary
        for (var n = 0; n < gradeLevelSelect.options.length; n++) {
            var optionValue = gradeLevelSelect.options[n].value;
            if (optionValue === '1st year college' || optionValue === '2nd year college' ||
                optionValue === '3rd year college' || optionValue === '4th year college') {
                gradeLevelSelect.options[n].style.display = 'block';
            } else {
                gradeLevelSelect.options[n].style.display = 'none';
            }
        }

        // Show all strand/course options except HUMSS, ABM, and STEM
        for (var m = 0; m < strandCourseSelect.options.length; m++) {
            var optionValue = strandCourseSelect.options[m].value;
            if (optionValue === 'HUMSS' || optionValue === 'ABM' || optionValue === 'STEM') {
                strandCourseSelect.options[m].style.display = 'none';
            } else {
                strandCourseSelect.options[m].style.display = 'block';
            }
        }

        // Enable strand/course select
        strandCourseSelect.disabled = false;
    } else {
        // Show all grade levels
        for (var n = 0; n < gradeLevelSelect.options.length; n++) {
            gradeLevelSelect.options[n].style.display = 'block';
        }

        // Show all strand/course options
        for (var m = 0; m < strandCourseSelect.options.length; m++) {
            strandCourseSelect.options[m].style.display = 'block';
        }

        // Enable both grade level and strand/course select
        gradeLevelSelect.disabled = false;
        strandCourseSelect.disabled = false;
    }
});

const radioInput = document.querySelectorAll('input[name="bcas"]');
const otherInput = document.getElementById("otherInput");

for (let i = 0; i < radioInput.length; i++) {
    radioInput[i].addEventListener("change", function() {
        if (this.value === "OtherPS" && this.checked) {
            otherInput.style.display = "block";
        } else {
            otherInput.style.display = "none";
        }
    });
}

// BACKEND SCRIPT IN THE PAID RESERVATION
$(document).ready(function() {

$('.field-label.required').hide();
$('input[name="schoolrefund"]').hide();
$('label[for="YY"]').hide();
$('label[for="NN"]').hide();
$('input[name="paidreservation"]').change(function() {
  if ($(this).val() === 'Yes') {
    $('.field-label.required').show();
    $('input[name="schoolrefund"]').show();
    $('label[for="YY"]').show();
    $('label[for="NN"]').show();
  } else {
    $('.field-label.required').hide();
    $('input[name="schoolrefund"]').hide();
    $('label[for="YY"]').hide();
    $('label[for="NN"]').hide();
  }
});

$('input[name="paidreservation"]:checked').trigger('change');
});