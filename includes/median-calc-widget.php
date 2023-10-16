<?php
// Проверка на прямой доступ
if (!defined('ABSPATH')) {
    exit;
}

class Median_Calc_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'median-calc';  // Обновленное название виджета
    }

    public function get_title() {
        return __('Median Calc', 'median-finance');
    }

    public function get_icon() {
        return 'fa fa-calculator';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {
        // Добавьте здесь свои элементы управления.
        // Это определит поля, с которыми пользователь будет взаимодействовать в редакторе Elementor.
    }

    protected function render() {
        // PHP-код, который вы хотите запустить, когда виджет отображается на веб-странице
        ?>
        
        <div class="calculator">
            <h1>Оформить ипотеку</h1>
            <p>Мы можем вам всё посчитать</p>

            <div class="input-group">
                <label for="property-cost">Стоимость, Сум</label>
                <input type="number" id="property-cost" placeholder="150 000 000 сумов">
                <div id="rangeSlider"></div>
            </div>

            <div class="input-group">
                <label for="property-size">Квадратура м2</label>
                <input type="number" id="property-size" placeholder="30 м2">
            </div>

            <div class="input-group">
                <label for="available-credit">Доступный ипотечный кредит</label>
                <input type="text" id="available-credit" placeholder="145 350 000 сумов" readonly>
            </div>

            <div class="input-group">
                <label for="loan-term">Срок кредита</label>
                <input type="number" id="loan-term" placeholder="20 лет">
            </div>

            <div class="input-group">
                <label for="interest-rate">Процентная ставка %</label>
                <input type="number" id="interest-rate" placeholder="17">
            </div>

            <div class="result-group">
                <div class="result-item">
                    <label>Первоначальный взнос</label>
                    <p id="initial-fee">4 650 000 сумов</p>
                </div>

                <div class="result-item">
                    <label>Ежемесячный платеж</label>
                    <p id="monthly-payment">2 131 995 сумов</p>
                </div>
            </div>

            <button type="button" id="calculate">Получить ипотеку</button>
        </div>
            
        <?php
    }

}
