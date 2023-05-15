<div class="contact_top_form new_contact_top_form">
    <div class="row">
        <?php
            if (get_field('fsh_contact_us', 'options'))
            {
            echo get_field('fsh_contact_us', 'options');
            }
        ?>
    </div>
</div>


<!-- <div class="contact_top_form">
    <div class="row grid52">
        <div class="col-md-6">
            <div class="input_line">
                <div class="label">YOUR NAME</div>
                <input type="text" placeholder="Name Surname">
            </div>
        </div>
        <div class="col-md-6">
            <div class="input_line">
                <div class="label">COMPANY EMAIL</div>
                <input type="email" placeholder="email@companymail.com">
            </div>
        </div>
        <div class="col-md-6">
            <div class="input_line">
                <div class="label">PHONE NUMBER</div>
                <input type="tel" placeholder="0123456789">
            </div>
        </div>
        <div class="col-md-6">
            <div class="input_line">
                <div class="label">COMPANY</div>
                <input type="tel" placeholder="Company Name">
            </div>
        </div>
        <div class="col-12">
            <div class="input_line">
                <div class="label">YOUR MESSAGE</div>
                <textarea placeholder="Hello,"></textarea>
            </div>
            <button type="submit" class="button"><span>Submit</span></button>
        </div>
    </div>
</div> -->