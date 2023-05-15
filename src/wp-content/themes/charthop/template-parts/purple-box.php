<?php

$logotype = $args['logotype'];
$founded = $args['founded'];
$industry = $args['industry'];
$type = $args['type'];
$number_of_employees = $args['number_of_employees'];
$distribution = $args['distribution'];
$is_mobile = $args['mobile'] == true;
if (
    isset($logotype) ||
    isset($founded) ||
    isset($industry) ||
    isset($type) ||
    isset($number_of_employees) ||
    isset($distribution)
) :
    ?><div class="purple_box <?php
        echo $is_mobile? 'show767': 'hide767';
    ?>">
        <h4>Customer</h4>
        <?php
        if ($logotype) :

            ?><img src="<?php echo $logotype['url']; ?>" alt="" data-no-retina><?php

        endif;

        ?><div class="row">
            <?php
            if ($founded) :
                ?><div class="col-6 col-md-12">
                    <h4>Founded</h4>
                    <p><?php echo $founded; ?></p>
                </div>
            <?php
            endif;
            if ($industry) :
                ?><div class="col-6 col-md-12">
                    <h4>Industry</h4>
                    <p><?php echo $industry; ?></p>
                </div>
            <?php
            endif;
            if ($type) :
                ?><div class="col-6 col-md-12">
                    <h4>Type</h4>
                    <p><?php echo $type; ?></p>
                </div>
            <?php
            endif;
            if ($number_of_employees) :
                ?><div class="col-6 col-md-12">
                    <h4>Number of Employees</h4>
                    <p><?php echo $number_of_employees; ?></p>
                </div>
            <?php
            endif;
            if ($distribution) :
                ?><div class="col-6 col-md-12">
                    <h4>Distribution</h4>
                    <p><?php echo $distribution; ?></p>
                </div><?php
            endif;
        ?></div>
    </div><?php
endif;