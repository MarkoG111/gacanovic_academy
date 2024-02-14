$(document).ready(function () {
    $('.add-course-to-cart').click(addToCart);
});

function addToCart() {
    let id = $(this).data('idcourse');

    let courses = coursesInCart();

    if (courses) {
        if (courseAlreadyInCart()) {
            alert('Course is already added in cart, You cannot add more.');
        } else {
            addInLocalStorage();
            alert('Successfully added course in cart! Go to checkout in cart.');
        }
    } else {
        addFirstCourse();
        alert('Successfully added course in cart! Go to checkout in cart.');
    }

    function courseAlreadyInCart() {
        return courses.filter((c) => c.id == id).length;
    }

    function addInLocalStorage() {
        let courses = coursesInCart();

        courses.push({
            id: id
        });

        localStorage.setItem('courses', JSON.stringify(courses));

        $('#numberInCart').html(courses.length);
    }

    function addFirstCourse() {
        let courses = [];

        courses[0] = {
            id: id
        };

        localStorage.setItem('courses', JSON.stringify(courses));

        $('#numberInCart').html(courses.length);
    }
}

function showCart() {
    let courses = coursesInCart();

    if (courses == null) {
        showEmptyCart();
    } else {
        $.ajax({
            url: '/cart/showCourses',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                data = data.filter((c) => {
                    for (let course of courses) {
                        if (c.id_course == course.id) {
                            return true;
                        }
                    }

                    return false;
                });

                makeTable(data);
                addItemsToCart(data);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                console.log(error);
            }
        });
    }
}

function makeTable(data) {
    if (data.length == 0) {
        $('.table-cart').html('<h2 class="text-danger">Your cart is empty.</h2>');
        $('.checkout-btn').css('display', 'none');
        $('.table-cart').css('border', 'none');
    } else {
        $('.checkout-btn').css('display', 'block');
        let html = '';

        data.forEach((d) => {
            html += `
            <tr>
                <td class='cart-image'><a href='#'><img src='/img/courses/${d.image_small}' alt='${d.course_name}' /></a></td>
                <td class='cart-name'><a href='#'>${d.course_name}</a></td>
                <td class='cart-price'><span>${d.price} &euro;</span></td>
                <td>${d.total_hours}</td>
                <td><a href='javascript:void(0)' onclick='removeFromCart(${d.id_course})' class='removeFromCart'><i class='fas fa-times fa-2x'></i></a></td>
            </tr>
        `;
        });

        $('#cart').html(html);
    }

    $('#numberInCart').html(data.length);
}

function addItemsToCart(data) {
    let items = [];

    data.forEach((d) => {
        items.push(d.id_course);
    });

    $('#cartItems').val(items.join(','));
}

function removeFromCart(id) {
    let courses = coursesInCart();
    let filtered = courses.filter((c) => c.id != id);

    localStorage.setItem('courses', JSON.stringify(filtered));

    showCart();
}

function showEmptyCart() {
    $('#numberInCart').html('0');
}

function coursesInCart() {
    return JSON.parse(localStorage.getItem('courses'));
}


let courses = coursesInCart();

if (courses == null) {
    showEmptyCart();
} else {
    showCart();
}
