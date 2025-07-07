if (document.querySelector('.swiper-acf-block-default') && !document.querySelector('.swiper-acf-block-default').closest('.acf-block-preview')) {

	let sliders = document.querySelectorAll('.swiper-acf-block-default');

	sliders.forEach((e, index) => {

		let swiperId = e.id;

		const swiperSlider = new Swiper('#' + swiperId, {
			slidesPerView: 1,
			loop: false,
			navigation: {
				nextEl: '#' + swiperId + ' .slider-btn.next',
				prevEl: '#' + swiperId + ' .slider-btn.prev',
			},
		});
	});
}