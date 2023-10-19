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
       
        ?>
        
        <div class="calculator">
            <div class="row margin-bottom-4">
                
                <div class="col-md-6">
                    <div class="input-box select-box">
                        <label for="term"><?php echo __('Credit term', 'median-finance'); ?></label>
                        <select id="term">
                            <option value="12"><?php echo __('12 months', 'median-finance'); ?></option>
                            <option value="24"><?php echo __('24 months', 'median-finance'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-box  select-box">
                        <label for="property-cost"><?php echo __('Floor', 'median-finance'); ?></label>
                        <select id="floor">
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row margin-bottom-3">
                <div class="col-md-6">
                    <div class="input-box">
                        <label for="property-size"><?php echo __('Quadrature m2', 'median-finance'); ?></label>
                        <input type="number"  id="area" value="32.62" placeholder="32,62 м2">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-box">
                        <label for="property-cost"><?php echo __('Cost, Sum', 'median-finance'); ?></label>
                        <input type="text" id="property-cost" readonly placeholder="381 654 000  <?php echo __('soums', 'median-finance'); ?>" oninput="formatNumberInput(this)">
                        <!-- <div id="rangeSlider"></div> -->
                    </div>
                </div>
                
                
            </div>
        
            <div class="result-group row">
                <div class="result-item col-md-6">
                    <span class="small text-center" ><?php echo __('An initial fee', 'median-finance'); ?></span>
                    <p id="initial-payment">114 496 200  <?php echo __('soums', 'median-finance'); ?> </p>
                </div>

                <div class="result-item col-md-6">
                    <span class="small text-center"><?php echo __('Monthly payment', 'median-finance'); ?></span>
                    <p id="monthly-payment">22 263 150  <?php echo __('soums', 'median-finance'); ?>   </p>
                </div>
            </div>
            <div class="row text-center">
                <button type="button" id="calculate" onclick="calculate()"><?php echo __('Get a mortgage', 'median-finance'); ?></button>
            </div>
            
        </div>
            
        <?php
    }

}


