if (window.location.href.indexOf('contact') != -1) {
    var button = document.querySelector("#submitContact")
    button.addEventListener("click", contact)

    document.querySelector("#resetContact").addEventListener("click", function () {
        document.querySelector("#subject").value = ""
        document.querySelector("#email").value = ""
        document.querySelector("#message").value = ""
    })
}

function contact() {
    var email = document.querySelector("#email").value
    var subject = document.querySelector("#subject").value
    var message = document.querySelector("#message").value

    var emailError = document.querySelector("#emailHelp")
    var subjectError = document.querySelector("#subjectHelp")
    var messageError = document.querySelector("#messageHelp")

    var emailTrue = true
    var subjectTrue = true
    var messageTrue = true

    var reSubject = /[A-z0-9]+/
    var reEmail = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/

    if (subject) {
        if (!reSubject.test(subject)) {
            subjectError.textContent = "Subject is not in good format!"
            subjectTrue = false
        }
    } else {
        subjectError.textContent = "Subject field is required!"
        subjectTrue = false
    }

    if (email) {
        if (!reEmail.test(email)) {
            emailError.textContent = "Email is not in good format!"
            emailTrue = false
        }
    } else {
        emailError.textContent = "Email is required!"
        emailTrue = false
    }

    if (!message) {
        messageError.textContent = 'Message is required!'
        messageTrue = false
    }

    if (subjectTrue && emailTrue && messageTrue) {
        subjectError.textContent = ""
        emailError.textContent = ""
        messageError.textContent = ""

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('message')
            },
            url: "/contact",
            method: "POST",
            dataType: "json",
            data: {
                submitContact: "send",
                subject, email, message
            },
            success: function (data) {
                document.querySelector("#subject").value = ""
                document.querySelector("#email").value = ""
                document.querySelector("#message").value = ""

                var alertDiv = document.querySelector('#successMessage')
                var message = document.querySelector('#msg')

                alertDiv.classList.remove('invisible')
                alertDiv.classList.add('alert-success')
                message.textContent = data.success
                setTimeout(function () {
                    alertDiv.classList.add('invisible')
                }, 2500)
            },
            error: function (xhr, status, err) {
                var msgAlert = document.querySelector('#successMessage')
                var message = document.querySelector('#msg')
                switch (xhr.status) {
                    case 409:
                        msgAlert.classList.remove('invisible')
                        msgAlert.classList.add('alert-warning')
                        message.textContent = 'Conflict!'
                        break
                    case 422:
                        msgAlert.classList.remove('invisible')
                        msgAlert.classList.add('alert-warning')
                        message.textContent = 'Error!'
                        break
                }
            }
        })
    } else {
        console.log('Error')
    }
}
