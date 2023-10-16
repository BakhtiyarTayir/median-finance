// document.addEventListener('DOMContentLoaded', function() {
//     var slider = document.getElementById('property-cost');
//     if (slider) {
//         slider.addEventListener('input', function() {
//             document.getElementById('property-cost-value').textContent = this.value + ' сумов';
//         });
//     }
// });


var slider = document.getElementById('rangeSlider');

noUiSlider.create(slider, {
    start: [150000000], // начальное значение
    step: 1, // шаг слайдера
    range: {
        'min': [0],   // минимальное значение
        'max': [300000000] // максимальное значение
    },
    format: wNumb({
        decimals: 0
    })
});

// Обновление значения input или span при изменении ползунка
slider.noUiSlider.on('update', function (values, handle) {
    // здесь ваш код для обновления значения, например:
    document.getElementById('valueSpan').innerText = values[handle];
});


