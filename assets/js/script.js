

// Функция для форматирования числа с пробелами
function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 ');
}

var slider = document.getElementById('rangeSlider');

noUiSlider.create(slider, {
    start: [10000000], // начальное значение
    step: 1, // шаг слайдера
    range: {
        'min': [10000000],   // минимальное значение
        'max': [3000000000] // максимальное значение
    },
    format: wNumb({
        decimals: 0
    })
});

// Обновление значения input или span при изменении ползунка
slider.noUiSlider.on('update', function (values, handle) {
    var input = document.getElementById('property-cost');
    var formattedValue = formatNumber(values[handle]);  // Форматирование значения слайдера

    input.value = formattedValue;  // Обновление значения input
});

function formatNumberInput(input) {
    var cursorPosition = input.selectionStart;
    var rawValue = input.value.replace(/\D/g, '');
    var formattedValue = new Intl.NumberFormat('ru-RU').format(rawValue);
    input.value = formattedValue;
    cursorPosition = cursorPosition + (input.value.length - formattedValue.length);
    input.setSelectionRange(cursorPosition, cursorPosition);
}


function calculate() {


    var term = document.getElementById('term').value;  
    var area = document.getElementById('area').value;  
    var floor = document.getElementById('floor').value; 

    var pricePerSquareMeter = getPricePerSquareMeter(floor, term);

    
    var totalPrice = pricePerSquareMeter * area;
    document.getElementById('property-cost').value = totalPrice.toLocaleString('ru-RU');
    
    var initialPayment = totalPrice * 0.3;
    document.getElementById('initial-payment').innerText = initialPayment.toLocaleString('ru-RU')  + ' сумов';
    
    var monthlyPayment = (totalPrice - initialPayment) / term;
    document.getElementById('monthly-payment').innerText = monthlyPayment.toLocaleString('ru-RU') + ' сумов';
}



function getPricePerSquareMeter(floor, term) {

    var prices12 = medianFinanceData.prices12;
    var prices24 = medianFinanceData.prices24;
    


    var price;

    if (term == 12) {
        price = prices12[floor];
    } else if (term == 24) {
        price = prices24[floor];
    } else {
        console.error('Invalid term value:', term);
        return 0;
    }
    
    var priceWithoutSpaces = price.replace(/\s/g, '');

    return parseInt(priceWithoutSpaces, 10);
}



