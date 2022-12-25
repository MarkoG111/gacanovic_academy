$(document).ready(function() {
	const baseURL = 'http://localhost:8000/';
	const regExpWishlist = new RegExp(`^${baseURL}wishlist[\#]?$`);

	if (regExpWishlist.test(window.location.href)) {
		getAllWishesForOneUser();
	}

	numberOfWishes();
});

$('.wishhhh').click(addWish);

function addWish() {
	let idCourse = $(this).data('idcourse');

	$.ajax({
		url: '/api/addWish',
		method: 'POST',
		data: {
			idCourse: idCourse
		},
		success: function() {
			alert('Successfully added into wishes.');
			numberOfWishes();
		},
		error: function(xhr, status, error) {
			console.log(error);
            if (xhr.status == 400) {
                alert('You already have wish in wishlist.');
            }
			if (xhr.status == 404) {
				alert('Login if you want to add wish.');
			}
		}
	});
}

function numberOfWishes() {
	$.ajax({
		url: '/api/numberOfWishes',
		method: 'GET',
		dataType: 'json',
		success: function(data) {
			$('#numberOfWishes').html(data);
		},
		error: function(xhr, status, error) {
			console.log(error);
		}
	});
}

function getAllWishesForOneUser() {
	$.ajax({
		url: '/api/wishlist',
		method: 'GET',
		dataType: 'json',
		success: function(data) {
			printAllWishes(data);
			numberOfWishes();
		},
		error: function(xhr, status, error) {
			console.log(error);
		}
	});
}

function printAllWishes(data) {
	if (data.length == 0) {
		$('.table-wish').html('<h2 class="text-danger">Your wishlist is empty.</h2>');
		$('.table-wish').css('border', 'none');
	} else {
		let html = '';

		data.forEach((d) => {
			html += `
            <tr>
                <td class='wish-image'><a href='courses/${d.id_course}'><img src='/img/courses/${d.image_small}' alt='${d.course_name}' /></a></td>
                <td class='wish-name'><a href='courses/${d.id_course}'>${d.course_name}</a></td>
                <td class='wish-price'><span>${d.price} &euro;</span></td>
                <td class='wish-link'><a href='courses/${d.id_course}'>Visit</a></td>
                <td class='wish-deleteBtn'><a href='#' class='delete-wish' data-idwish='${d.id_wish}'><i class='fas fa-trash-alt fa-2x'></i></a></td>
            </tr>
        `;
		});

		$('#wishlist').html(html);
	}
}

$(document).on('click', '.delete-wish', function(e) {
	e.preventDefault();

	let idWish = $(this).data('idwish');

	$.ajax({
		url: '/api/deleteWish',
		method: 'DELETE',
		data: {
			idWish: idWish
		},
		success: function() {
			getAllWishesForOneUser();
			$('.msg').text('Successfully deleted wish.');
		},
		error: function(xhr, status, error) {
			console.log(error);
		}
	});
});
