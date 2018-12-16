$(function() {

  // Custom JS

  $("#order-form").on('submit', function () {
    $(this).find('button[type=submit]')
    .prop('disabled', true);
  });

  $("a[rel='m_PageScroll2id']").mPageScroll2id({
    scrollSpeed: 300,
    scrollEasing: 'linear'
  });

  $('#preview-carousel').owlCarousel({
    loop: true,
    margin: 0,
    nav: false,
    dots: false,
    items: 1,
    autoplay: true,
    autoplayTimeout: 3000,
    animateOut: 'fadeOut'
  })

  $('#skills-carousel').owlCarousel({
    loop: true,
    margin: 50,
    nav: true,
    dots: false,
    autoplay: true,
    autoplayTimeout: 3000,
    navText: [
      '<img src="assets/img/left-arrow.svg" alt="Right Arrow">',
      '<img src="assets/img/right-arrow.svg" alt="Left Arrow">'
    ],
    responsive: {
        0: {
          items: 1,
          dots: true
        },
        576: {
          items: 2,
          dots: true
        },
        768: {
          items: 3,
          dots: true
        }
    }
  })

});

const exerciseCheat = new Vue({
  data: {
    selectedCategoryCheat: 0,
    optionsCategoryCheat: [],
    selectedViewCheat: 0,
    optionsViewCheat: [],
    description: '',
    min: 0,
    max: 0,
    min_price: 0.00,
    max_price: 0.00,
    count: '',
    link: '',
    errors: {}
  },

  computed: {
    price () {
      var coef = 0;

      if (!this.min || !this.max) return (0).toFixed(2);

      if (this.count <= this.min) {
        coef = this.min_price / this.min;
      } else {
        coef = this.max_price / 1000;
      }

      return (this.count * coef).toFixed(2);
    }
  },

  watch: {
    selectedCategoryCheat (newValue, oldValue) {
      if (newValue != oldValue) {
        this.selectedViewCheat = 0;
        this.optionsViewCheat = [];
        this.count = 0;

        axios.get('/get-view-cheats-by-category-chaet-id/' + newValue).then((response) => {

          this.optionsViewCheat = response.data;

        }).catch((error) => {
          console.log(error)
        });
      }
    },
    selectedViewCheat (newValue, oldValue) {
      this.count = 0;
      this.description = newValue.desc;
      this.min = newValue.min;
      this.max = newValue.max;
      this.min_price = newValue.min_price;
      this.max_price = newValue.max_price;
    }
  },

  created () {
    if (document.getElementById('exercise-cheat') === null) return false;

    axios.get('/cheat-category').then((response) => {

      this.optionsCategoryCheat = response.data;

    }).catch((error) => {
      console.log(error)
    });
  }

})

if (document.getElementById('exercise-cheat') !== null) {
  exerciseCheat.$mount('#exercise-cheat');
}
