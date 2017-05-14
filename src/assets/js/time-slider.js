import jQuery from 'jquery';
import 'nouislider/distribute/nouislider.min.css';

window.noUiSlider = require('nouislider');

jQuery(() => {
  const slider = document.getElementById('slider');

  window.noUiSlider.create(slider, {
    start: [20, 80],
    connect: true,
    range: {
      min: 0,
      max: 100,
    },
  });
});
