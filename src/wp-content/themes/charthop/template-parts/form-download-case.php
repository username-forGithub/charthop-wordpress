<div class="download_case_form">
    <h3>Download Customer Case Study</h3>
<!--    <div class="input_line">-->
<!--        <div class="label">COMPANY EMAIL</div>-->
<!--        <input type="email" placeholder="email@company.com">-->
<!--    </div>-->
<!--    <div class="input_line">-->
<!--        <div class="label">YOUR MESSAGE</div>-->
<!--        <textarea placeholder="How did you hear about us?"></textarea>-->
<!--    </div>-->
<!--    <button type="submit" class="button"><span>Download case study</span></button>--><?php

    if (isset($args['special_form']))
    {
        echo $args['special_form'];
    }

    ?><small>By downloading this PDF, you agree to opt-in to emails from ChartHop.</small>
</div>