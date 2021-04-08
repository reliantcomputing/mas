
function confirmDelete(name){
    return "Are you sure you wan't to delete this "+ name + "?"
}

function confirmUpdate(name){
    return "Are you sure you wan't to update this "+ name + "?"
}

function confirmRemove(name){
    return "Are you sure you wan't to remove this "+ name
}




$(function () {

    $.validator.addMethod("correctLength",function (value) {
        return value.length >= 8;
    }, "Password should at least contain 8 characters.");

    $.validator.addMethod("containNumber", function (value) {
        return  /\d/.test(value);
    }, "Password should at least contain a number.");

    $.validator.addMethod("containUpperCase", function (value) {
        return /[a-z]/i.test(value);
    }, "Password should at least contain lowercase letter.");

    $.validator.addMethod("containLowerCase", function (value) {
        return /[A-Z]/i.test(value);
    }, "Password should at least contain uppercase letter.");

    $.validator.setDefaults({
        errorClass:"invalid-feedback",
        highlight:function (element) {
           $(".form-control").find("label.error").detach().insertAfter($(".form-control"));
            $(element).closest(".form-control").addClass('is-invalid');
        },
        unhighlight:function (element) {
            $(".form-control").find("label.error").detach().insertAfter($(".form-control"));
            $(element).closest(".form-control").removeClass('is-invalid');
        }

    });

    $(".form-validation").validate({
        rules:{
            username:{
                required:true,
                email:true
            },
            currentPassword:{
                required:true
            },

            newPassword:{
                required:true,
                correctLength: true,
                containUpperCase: true,
                containLowerCase:true,
                containNumber: true
            },

            password:{
                required:true
            },

            confirmPassword:{
                required:true
            },

            country:{
                required:true
            },

            address:{
                required:true
            },

            city:{
                required:true
            },

            postalCode:{
                required:true
            },

            email:{
                required:true,
                email:true
            },
            phoneNumber:{
                required:true
            },

            name:{
                required:true
            },

            securityQuestion:{
              required:true
            },

            securityAnswer:{
                required:true
            },

            //instructor, student, admin any person
            title:{
                required:true,
                maxLength:5
            },
            firstName:{
                required:true,
                minLength:2
            },
            middleName:{
                required:true,
                minLength:2
            },
            lastName:{
                required:true,
                minLength:2
            },
            studentNumber:{
                required:true,
                minLength:2
            },
            file:{
                required:true
            },
            code:{
                required:true
            },
            notification:{
                required:true
            },
            facultyId:{
                required:true
            },

            courseId:{
                required:true
            },
            moduleId:{
                required:true
            },
            province:{
                required:true
            },
            sendTo:{
                required:true
            },
            subject:{
                required:true
            },
            message:{
                required:true
            },
            folder:{
                required:true
            },
            description:{
                required:true
            },
            achievedMark:{
                required:true
            },
            totalMark:{
                required:true
            },
            markStudentNumber:{
                required:true
            },
            progress:{
                required:true
            },
            people:{
                required:true
            },
            allowedStudents:{
                required:true
            },
            gender:{
                required:true
            },
            module:{
                required: true
            },
            year:{
                required: true
            }
        }
    })
});