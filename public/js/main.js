const baseURL = 'http://localhost:8000/'

const regExpLoginRegister = new RegExp(`^${baseURL}login[\#]?$`)
const regExpWishlist = new RegExp(`^${baseURL}wishlist[\#]?$`)

const regExpAdminCourses = new RegExp(`^${baseURL}admin/courses/create[\#]?$`)
const regExpAdminCategories = new RegExp(`^${baseURL}admin/categories/create[\#]?$`)
const regExpAdminTopics = new RegExp(`^${baseURL}admin/topics/create[\#]?$`)
const regExpAdminUsers = new RegExp(`^${baseURL}admin/users/create[\#]?$`)
const regExpAdminMails = new RegExp(`^${baseURL}admin/contact/create[\#]?$`)

const regExpEditTopics = new RegExp(`^${baseURL}admin\/topics\/[0-9]+\/edit[\#]?$`)
const regExpEditCategories = new RegExp(`^${baseURL}admin\/categories\/[0-9]+\/edit[\#]?$`)
const regExpEditCourses = new RegExp(`^${baseURL}admin\/courses\/[0-9]+\/edit[\#]?$`)
const regExpEditUsers = new RegExp(`^${baseURL}admin\/users\/[0-9]+\/edit[\#]?$`)

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

$(document).ready(function () {
    showCart()
    numberOfWishes()

    $(document).on('click', '.js-pagination', function (e) {
        e.preventDefault()

        let page = $(this).data('page')

        $.ajax({
            url: page,
            dataType: 'json',
            method: 'GET',
            success: function (data) {
                switch (window.location.href) {
                    case baseURL + 'admin/courses/create':
                    case baseURL + 'admin/courses/create#':
                        printAllCoursesTable(data.data)
                        break
                    case baseURL + 'admin/categories/create':
                    case baseURL + 'admin/categories/create#':
                        printAllCategoriesTable(data.data)
                        break
                    case baseURL + 'admin/topics/create':
                    case baseURL + 'admin/topics/create#':
                        printAllTopicsTable(data.data)
                        break
                    case baseURL + 'admin/users/create':
                    case baseURL + 'admin/users/create#':
                        printAllUsersTable(data.data)
                        break
                    case baseURL + 'admin/contact/create':
                    case baseURL + 'admin/contact/create#':
                        printAllMailsTable(data.data)
                        break
                }
            },
            error: function (xhr, status, error) {
                alert(xhr.status)
            }
        })
    })

    if (regExpAdminMails.test(window.location.href)) {
        $('#table').attr('id', 'mailsTable')
        $('#table_paginate').attr('id', 'mailsTable_paginate')

        loadAdminMails()

        $(document).on('click', '.delete-mail', function () {
            let id = $(this).data('id')

            $.ajax({
                url: '/admin/contact/' + id,
                method: 'DELETE',
                success: function (data, status, xhr) {
                    if (xhr.status == 204) {
                        loadAdminMails()
                        $('.js-notification').html('Successfully deleted')
                    }
                },
                error: function (xhr, status, error) {
                    $('.js-notification').html(error)
                }
            })
        })
    }

    if (regExpAdminCourses.test(window.location.href) || regExpEditCourses.test(window.location.href)) {
        $('#table').attr('id', 'coursesTable')
        $('#table_paginate').attr('id', 'coursesTable_paginate')

        loadAdminCourses()

        $(document).on('click', '.delete_course', function () {
            let id = $(this).data('id')

            $.ajax({
                url: '/admin/courses/' + id,
                method: 'DELETE',
                success: function (data, status, xhr) {
                    if (xhr.status == 204) {
                        loadAdminCourses()
                        $('.msgCrud').html('Successfully deleted.')
                    }
                },
                error: function (xhr, status, error) {
                    $('.msgCrud').html(error)
                }
            })
        })
    }

    if (regExpAdminCategories.test(window.location.href) || regExpEditCategories.test(window.location.href)) {
        $('#table').attr('id', 'categoriesTable')
        $('#table_paginate').attr('id', 'categoriesTable_paginate')

        loadAdminCategories()

        $(document).on('click', '.delete-category', function () {
            let id = $(this).data('id')

            $.ajax({
                url: '/admin/categories/' + id,
                method: 'DELETE',
                success: function (data, status, xhr) {
                    if (xhr.status == 204) {
                        loadAdminCategories()
                        $('.msgCrud').html('Successfully deleted.')
                    }
                },
                error: function (xhr, status, error) {
                    $('.msgCrud').html(error)
                }
            })
        })
    }

    if (regExpAdminTopics.test(window.location.href) || regExpEditTopics.test(window.location.href)) {
        $('#table').attr('id', 'topicsTable')
        $('#table_paginate').attr('id', 'topicsTable_paginate')

        loadAdminTopics()

        $(document).on('click', '.delete-topic', function () {
            let id = $(this).data('id')

            $.ajax({
                url: '/admin/topics/' + id,
                method: 'DELETE',
                success: function (data, status, xhr) {
                    if (xhr.status == 204) {
                        loadAdminTopics()
                        $('.msgCrud').html('Successfully deleted')
                    }
                },
                error: function (xhr, status, error) {
                    $('.msgCrud').html(error)
                }
            })
        })
    }

    if (regExpAdminUsers.test(window.location.href) || regExpEditUsers.test(window.location.href)) {
        $('#table').attr('id', 'usersTable')
        $('#table_paginate').attr('id', 'usersTable_paginate')

        loadAdminUsers()

        $(document).on('click', '#AddUser', function () {
            data = {
                username: $('#username').val().trim(),
                email: $('#email').val().trim(),
                password: $('#password').val().trim(),
                confirmPassword: $('#confirmPassword').val().trim(),
                role: $('#role').val()
            }
            console.log(data)

            $.ajax({
                url: '/admin/users',
                dataType: 'json',
                method: 'POST',
                headers: {
                    'Accept': 'application/json'
                },
                data: data,
                success: function (data, status, xhr) {
                    if (xhr.status == 201) {
                        $('.js-notification').html('Successfully added a user.')
                        resetUserForm()
                        loadAdminUsers()
                    }
                },
                error: function (xhr, status, error) {
                    if (xhr.status == 422) {
                        let printErrors = handleParametersException(xhr)
                        $('.js-notification').html(printErrors)
                    }
                    if (xhr.status == 500) {
                        let error = JSON.parse(xhr.responseText)
                        $('.js-notification').html(error.error)
                    }
                }
            })
        })

        $(document).on('click', '.delete-user', function () {
            let id = $(this).data('id')

            $.ajax({
                url: '/admin/users/' + id,
                method: 'DELETE',
                success: function (data, status, xhr) {
                    if (xhr.status == 204) {
                        loadAdminUsers()
                        $('.msgCrud').html('Successfully deleted')
                    }
                },
                error: function (xhr, status, error) {
                    $('.msgCrud').html(error)
                }
            })
        })
    }

    if (regExpLoginRegister.test(window.location.href)) {
        $('#login-form-link').click(function (e) {
            e.preventDefault()

            $('#login-form').delay(100).fadeIn(100)

            $('#register-form').fadeOut(100)
            $('#register-form-link').removeClass('active')

            $(this).addClass('active')
        })

        $('#register-form-link').click(function (e) {
            e.preventDefault()

            $('#register-form').delay(100).fadeIn(100)

            $('#login-form').fadeOut(100)
            $('#login-form-link').removeClass('active')

            $(this).addClass('active')
        })

        $('#register-submit').click(function () {
            let data = {
                username: $('#usernameReg').val(),
                email: $('#emailReg').val(),
                password: $('#passwordReg').val(),
                passwordConfirm: $('#passwordRegConf').val()
            }
            //console.log(data)

            let errors = regexForRegistration(data)

            if (errors != null) {
                $('#notification').html(errors)
            } else {
                $.ajax({
                    url: '/register',
                    dataType: 'json',
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json'
                    },
                    data: data,
                    success: function (data, status, xhr) {
                        if (xhr.status == 201) {
                            $('#notification').html('Successfully Registered!')
                            resetRegistrationForm()
                        }
                    },
                    error: function (xhr, status, error) {
                        if (xhr.status == 422) {
                            let printErrors = handleParametersException(xhr)
                            $('#notification').html(printErrors)
                        }
                        if (xhr.status == 500) {
                            let error = JSON.parse(xhr.responseText)
                            $('#notification').html(error.error)
                        }
                    }
                })
            }
        })
    }

    if (regExpWishlist.test(window.location.href)) {
        getAllWishesForOneUser()
    }

})  // END of Document



function printPagination(links, url) {
    let print = `<ul class='pagination'>`
    for (let i = 1; i <= links; i++) {
        print += `<li class='page-item'><a href='#' class='page-link js-pagination' data-page='${url + '?page=' + i}'>${i}</a></li>`
    }
    print += `</ul>`

    switch (window.location.href) {
        case baseURL + 'admin/courses/create':
        case baseURL + 'admin/courses/create#':
            $('#coursesTable_paginate').html(print)
            break
        case baseURL + 'admin/categories/create':
        case baseURL + 'admin/categories/create#':
            $('#categoriesTable_paginate').html(print)
            break
        case baseURL + 'admin/topics/create':
        case baseURL + 'admin/topics/create#':
            $('#topicsTable_paginate').html(print)
            break
        case baseURL + 'admin/users/create':
        case baseURL + 'admin/users/create#':
            $('#usersTable_paginate').html(print)
            break
        case baseURL + 'admin/contact/create':
        case baseURL + 'admin/contact/create#':
            $('#mailsTable_paginate').html(print)
            break
    }
}

function loadAdminMails() {
    $.ajax({
        url: '/admin/contact',
        dataType: 'json',
        method: 'GET',
        success: function (data) {
            let paginationLinks = Math.ceil(data.total / data.per_page)
            printPagination(paginationLinks, data.path)
            printAllMailsTable(data.data)
        },
        error: function (xhr, status, error) {
            console.log(xhr.status)
            console.log(xhr.responseText)
            console.log(error)
        }
    })
}

function printAllMailsTable(data) {
    let print = `<tr>
            <th>ID</th>
            <th>Subject</th>
            <th>Email</th>
            <th>Message</th>
            <th>Datetime</th>
            <th>Action</th>
        </tr>`
    for (let i of data) {
        print += `<tr>
                <td>${i.id_contact_mail}</td>
                <td>${i.subject}</td>
                <td>${i.email}</td>
                <td>${i.message}</td>
                <td>${i.date}</td>
                <td><button class="btn btn-outline-danger delete-mail" data-id="${i.id_contact_mail}">Delete</button></td>
            </tr>`
    }

    $('#mailsTable').html(print)
}

function loadAdminCourses() {
    $.ajax({
        url: '/admin/courses',
        dataType: 'json',
        method: 'GET',
        success: function (data) {
            let paginationLinks = Math.ceil(data.total / data.per_page)
            printPagination(paginationLinks, data.path)
            printAllCoursesTable(data.data)
        },
        error: function (xhr, status, error) {
            alert(xhr.status)
        }
    })
}

function printAllCoursesTable(data) {
    let print = `<tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>`
    for (let i of data) {
        print += `<tr>
                <td>${i.id_course}</td>
                <td>${i.course_name}</td>
                <td>${i.price} &euro;</td>
                <td>${i.created_at}</td>
                <td>${i.updated_at}</td>
                <td><a href='/admin/courses/${i.id_course}/edit' class='btn btn-outline-success' data-id='${i.id_course}'>Edit</a></td>
                <td><a href='#' class='btn btn-outline-danger delete_course' data-id='${i.id_course}'>Delete</a></td>
            </tr>`
    }

    $('#coursesTable').html(print)
}

function loadAdminCategories() {
    $.ajax({
        url: '/admin/categories',
        dataType: 'json',
        method: 'GET',
        success: function (data) {
            let paginationLinks = Math.ceil(data.total / data.per_page)
            printPagination(paginationLinks, data.path)
            printAllCategoriesTable(data.data)
        },
        error: function (xhr, status, error) {
            console.log(error)
            alert(xhr.status)
        }
    })
}

function printAllCategoriesTable(data) {
    let print = `<tr>
        <th>ID</th>
        <th>Name</th>
        <th>Image</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>`
    for (let i of data) {
        print += `<tr>
            <td>${i.id_category}</td>
            <td>${i.category_name}</td>
            <td><img src='/img/categories/${i.category_image}' alt='${i.category_name}' width='85' height='75'/></td>
            <td>${i.created_at}</td>
            <td>${i.updated_at}</td>
            <td><a href='/admin/categories/${i.id_category}/edit' class='btn btn-outline-success'>Edit</a></td>
            <td><a href='#' class='btn btn-outline-danger delete-category' data-id='${i.id_category}'>Delete</a></td>
        </tr>`
    }

    $('#categoriesTable').html(print)
}

function loadAdminTopics() {
    $.ajax({
        url: '/admin/topics',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            let paginationLinks = Math.ceil(data.total / data.per_page)
            printPagination(paginationLinks, data.path)
            printAllTopicsTable(data.data)
        },
        error: function (xhr, status, data) {
            console.log(error)
        }
    })
}

function printAllTopicsTable(data) {
    let print = `<tr>
        <th>ID</th>
        <th>Name</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>`
    for (let i of data) {
        print += `<tr>
            <td>${i.id_topic}</td>
            <td>${i.topic_name}</td>
            <td>${i.created_at}</td>
            <td>${i.updated_at}</td>
            <td><a href='/admin/topics/${i.id_topic}/edit' class='btn btn-outline-success'>Edit</a></td>
            <td><a href='#' class='btn btn-outline-danger delete-topic' data-id='${i.id_topic}'>Delete</a></td>
        </tr>`
    }

    $('#topicsTable').html(print)
}

function loadAdminUsers() {
    $.ajax({
        url: '/admin/users',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            let paginationLinks = Math.ceil(data.total / data.per_page)
            printPagination(paginationLinks, data.path)
            printAllUsersTable(data.data)
        },
        error: function (xhr, status, error) {
            console.log(error)
        }
    })
}

function printAllUsersTable(data) {
    let print = `<tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Active</th>
        <th>Role</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Last Login</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>`
    for (let i of data) {
        print += `<tr>
            <td>${i.id_user}</td>
            <td>${i.username}</td>
            <td>${i.email}</td>
            <td>${i.active}</td>
            <td>${i.role_name}</td>
            <td>${i.created_at}</td>
            <td>${i.updated_at}</td>
            <td>${i.last_login}</td>
            <td><a href='/admin/users/${i.id_user}/edit' class='btn btn-outline-success'>Edit</a></td>
            <td><a href='#' class='btn btn-outline-danger delete-user' data-id='${i.id_user}'>Delete</a></td>
        </tr>`
    }

    $('#usersTable').html(print)
}

function regexForRegistration(data) {
    let regexEmail = /^[A-z0-9._%+-]+@[A-z0-9.-]+\.[A-z]{2,}$/
    let regexUsername = /^[\d\w\_\-\.]{6,30}$/
    let regexPassword = /^[A-z]{3,}[0-9]{1,}$/

    let errors = []

    let printErrors = `<div class="alert alert-danger"<ul>`

    if (!regexEmail.test(data.email)) {
        errors.push('Email is not in good format.')
    }
    if (!regexUsername.test(data.username)) {
        errors.push('Username must have minimum 6 characters.')
    }
    if (!regexPassword.test(data.password)) {
        errors.push('Password must have 3 letters and minimum 1 number.')
    }
    if (data.passwordConfirm != data.password) {
        errors.push('Passwords do not match.')
    }

    if (errors.length) {
        for (let i of errors) {
            printErrors += `<li>${i}</li>`
        }
        printErrors += `</ul></div>`

        return printErrors;
    }

    return null
}

function resetRegistrationForm() {
    $('#emailReg').val('')
    $('#usernameReg').val('')
    $('#passwordReg').val('')
    $('#passwordRegConf').val('')
}
function resetUserForm() {
    $('#username').val('')
    $('#email').val('')
    $('#password').val('')
    $('#confirmPassword').val('')
    $('#role').val('0')
}

function handleParametersException(xhr) {
    let error = JSON.parse(xhr.responseText).errors
    Object.keys(error)

    let printErrors = `<div class="alert alert-danger"<ul>`
    for (let i of Object.values(error)) {
        printErrors += `<li>${i[0]}</li>`
    }
    printErrors += `</ul></div>`

    return printErrors
}


$('.wishhhh').click(addWish)

function addWish() {
    let idCourse = $(this).data('idcourse');

    $.ajax({
        url: '/api/addWish',
        method: 'POST',
        data: {
            idCourse: idCourse,
        },
        success: function () {
            alert('Successfully added into wishes.')
            numberOfWishes()
        },
        error: function (xhr, status, error) {
            console.log(error)
            if (xhr.status == 404) {
                alert('Login if you want to add wish.')
            }
        }
    })
}

function numberOfWishes() {
    $.ajax({
        url: '/api/numberOfWishes',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            $('#numberOfWishes').html(data)
        },
        error: function (xhr, status, error) {
            console.log(error)
        }
    })
}

function getAllWishesForOneUser() {
    $.ajax({
        url: '/api/wishlist',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            printAllWishes(data)
            numberOfWishes()
        },
        error: function (xhr, status, error) {
            console.log(error)
        }
    })
}

function printAllWishes(data) {
    if (data.length == 0) {
        $('.table-wish').html('<h2 class="text-danger">Your wishlist is empty.</h2>')
        $('.table-wish').css('border', 'none')
    } else {
        let html = ''

        data.forEach(d => {
            html += `
            <tr>
                <td class='wish-image'><a href='courses/${d.id_course}'><img src='/img/courses/${d.image_small}' alt='${d.course_name}' /></a></td>
                <td class='wish-name'><a href='courses/${d.id_course}'>${d.course_name}</a></td>
                <td class='wish-price'><span>${d.price} &euro;</span></td>
                <td class='wish-link'><a href='courses/${d.id_course}'>Visit</a></td>
                <td class='wish-deleteBtn'><a href='#' class='delete-wish' data-idwish='${d.id_wish}'><i class='fas fa-trash-alt fa-2x'></i></a></td>
            </tr>
        `
        })

        $('#wishlist').html(html)
    }
}

$(document).on('click', '.delete-wish', function (e) {
    e.preventDefault()

    let idWish = $(this).data('idwish')

    $.ajax({
        url: '/api/deleteWish',
        method: 'DELETE',
        data: {
            idWish: idWish
        },
        success: function () {
            getAllWishesForOneUser()
            $('.msg').text('Successfully deleted wish.')
        },
        error: function (xhr, status, error) {
            console.log(error)
        }
    })
})



$('.add-to-cart').click(addToCart)

function addToCart() {
    let id = $(this).data('idcourse')

    let courses = coursesInCart()

    if (courses) {
        if (courseAlreadyInCart()) {
            alert('Course is already added in cart, You can not add more.')
        } else {
            addInLocalStorage()
            alert("Successfully added course in cart! Go to checkout in cart.")
        }
    } else {
        addFirstCourse()
        alert("Successfully added course in cart! Go to checkout in cart.")
    }

    function courseAlreadyInCart() {
        return courses.filter(c => c.id == id).length
    }
    function addInLocalStorage() {
        let courses = coursesInCart()
        courses.push({
            id: id
        })
        localStorage.setItem('courses', JSON.stringify(courses))
    }
    function addFirstCourse() {
        let courses = []
        courses[0] = {
            id: id
        }
        localStorage.setItem('courses', JSON.stringify(courses))
    }

}


function showCart() {
    let courses = coursesInCart()

    if (courses == null) {
        showEmptyCart()
    } else {
        $.ajax({
            url: '/cart/showCourses',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                data = data.filter(c => {
                    for (let course of courses) {
                        if (c.id_course == course.id) {
                            return true
                        }
                    }
                    return false
                })
                makeTable(data)
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText)
                console.log(error)
            }
        })
    }
}

function makeTable(data) {
    if (data.length == 0) {
        $('.table-cart').html('<h2 class="text-danger">Your cart is empty.</h2>')
        $('.table-cart').css('border', 'none')
    } else {
        let html = ''

        data.forEach(d => {
            html += `
            <tr>
                <td class='cart-image'><a href='#'><img src='/img/courses/${d.image_small}' alt='${d.course_name}' /></a></td>
                <td class='cart-name'><a href='#'>${d.course_name}</a></td>
                <td class='cart-price'><span>${d.price} &euro;</span></td>
                <td>${d.total_hours}</td>
                <td><a href='#' onclick='removeFromCart(${d.id_course})' class='removeFromCart'><i class='fas fa-times fa-2x'></i></a></td>
                <td><a href='javascript:void(0)' id='orderCourse' class='orderCourse' data-id='${d.id_course}'><i class='fas fa-check fa-2x'></i></a></td>
            </tr>
        `
        })

        $('#cart').html(html)
    }

    $('#numberInCart').html(data.length)
}

function removeFromCart(id) {
    let courses = coursesInCart()
    let filtered = courses.filter(c => c.id != id)

    localStorage.setItem('courses', JSON.stringify(filtered))

    showCart()
}

function showEmptyCart() {
    $('#numberInCart').html('0')
}

function coursesInCart() {
    return JSON.parse(localStorage.getItem('courses'))
}

let courses = coursesInCart()
if (courses == null) {
    showEmptyCart()
} else {
    showCart()
}


$('#cart').on('click', '.orderCourse', function () {
    let id = $(this).data('id')

    $.ajax({
        url: '/cart',
        method: 'POST',
        data: {
            id: id
        },
        success: function () {
            alert('Course ordered.')
            removeFromCart(id)
        },
        error: function (xhr, status, error) {
            alert('Admin can not add course to orders.')
        }
    })
})
