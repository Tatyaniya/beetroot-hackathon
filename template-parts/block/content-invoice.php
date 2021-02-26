<?php
/**
 * Block Name: Invoice
 * Category: layout
 *
 * @var array $block
 */

$slug     = str_replace( 'acf/', '', $block['name'] );
$block_id = $slug . '-' . $block['id'];

$bg_color      = get_field( "invoice_background_color" );
$section_style = '';
if ( $bg_color ) {
    $section_style .= "background-color:" . $bg_color;
}
?>
  <section class="invoice" style="<?= $section_style; ?>">
    <div class="doctype">invoice</div>

    <?php
        $header = get_field( "invoice_header" );
        if ( $header ) :?>
            <div class="invoice__header"><?php echo $header; ?></div>
    <?php endif; ?>

    <div class="invoice__content">
        <div class="invoice__item">

            <?php
                $invoice_due_date = get_field( "invoice_due_date" );
                if ( $invoice_due_date ) :?>
                    <div class="invoice__left">
                        <p class="invoice__sign">due data</p>
                        <p class="invoice__due_date"><?php echo $invoice_due_date; ?></p>
                    </div>
                <?php endif; ?>

            <?php
                $invoice_id = get_field( "invoice_id" );
                if ( $invoice_id ) :?>
                    <div class="invoice__right">
                        <p class="invoice__sign">invoice id</p>
                        <p class="invoice__data"><?php echo $invoice_id; ?></p>
                    </div>
                <?php endif; ?>

        </div>
        <div class="invoice__item">
            <?php
                $invoice_prepared_for = get_field( "invoice_prepared_for" );
                if ( $invoice_prepared_for ) :?>
                    <div class="invoice__left">
                        <div class="invoice__sign">prepared for</div>
                        <div class="invoice__data"><?php echo $invoice_prepared_for; ?></div>
                    </div>
            <?php endif; ?>
            <?php
                $invoice_project = get_field( "invoice_project" );
                if ( $invoice_project ) :?>
                    <div class="invoice__right">
                        <div class="invoice__sign">project</div>
                        <p class="invoice__project"><?php echo $invoice_project; ?></p>
                    </div>
            <?php endif; ?>
            
        </div>
        <div class="check">
            <div class="repeater">
                <div class="repeater__row">
                    <div class="repeater__task font-weight-bold">Task description</div>
                    <div class="repeater__hours font-weight-bold">hours</div>
                    <div class="repeater__rate font-weight-bold">rate per hour</div>
                    <div class="repeater__total font-weight-bold">total</div>
                </div>

                <?php if ( have_rows( 'invoice_tasks' ) ) : ?>
                    <?php while ( have_rows( 'invoice_tasks' ) ) : the_row(); ?>

                        <div class="repeater__row">
                            <div class="repeater__task">
                                <?php
                                    $task_title= get_sub_field( "task_title" );
                                    if ( $task_title) :?>
                                        <h4 class="repeater__title"><?php echo $task_title; ?></h4>
                                <?php endif; ?>
                                <?php
                                    $task_description= get_sub_field( "task_description" );
                                    if ( $task_description) :?>
                                        <div class="repeater__desc"><?php echo $task_description; ?></div>
                                <?php endif; ?>
                            </div>
                            <?php
                                $hours= get_sub_field( "hours" );
                                if ( $hours) :?>
                                    <span class="repeater__hours"><?php echo $hours; ?></span>
                            <?php endif; ?>
                            <?php
                                $rate_per_hour= get_sub_field( "rate_per_hour" );
                                if ( $rate_per_hour) :?>
                                    <span class="repeater__rate">$<?php echo $rate_per_hour; ?></span>
                            <?php endif; ?>
                            <div class="repeater__total">$ 2.000.00</div>
                        </div>

                    <?php endwhile; ?>
                <?php endif; ?>
                
            </div>
            <div class="total">
                <div class="total__subtitle">
                    total
                </div>
                <div class="total__cost">
                    $4.300.000
                </div>
            </div>
        </div>
        <div class="signature">
            <?php
                $invoice_signature= get_field( "invoice_signature" );
                if ( $invoice_signature) :?>
                    <div class="invoice__signature"><?php echo $invoice_signature; ?></div>
            <?php endif; ?>
        </div> 
    </div>
</section>

<style>

img {
    display: block;
    max-width: 100%;
    height: auto;
}
* {
    margin: 0;
}
.invoice {
    max-width: 900px;
    background: #fff;
    padding: 40px;
    font-family: sans-serif;
    font-size: 14px;
    color: #000;
    margin: 50px auto;
}
.doctype {
    font-size: 25px;
    font-weight: 700;
    text-transform: uppercase;
    text-align: right;
    color: rgba(0, 0, 0, 0.2);
}
.logo {
    width: 260px;
    margin: 0 auto 30px;
}
.invoice__header p {
    text-align: center;
}
.invoice__header img {
    margin: 0 auto 15px;
}
.logo__text {
    width: 230px;
    text-align: center;
    margin: 0 auto;
}
.logo__name {
    font-size: 15px;
    text-transform: uppercase;
}
.logo__addr {
    font-size: 15px;
    font-style: normal;
    color: rgba(0, 0, 0, 0.5);
}
.invoice__content {
    color: rgba(0, 0, 0, 0.6);
}
.invoice__item {
    display: flex;
    justify-content: space-between;
    padding: 25px 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.3);
}
.invoice__sign {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 5px;
}
.invoice__data {
    font-size: 18px;
}


.repeater__row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: rgba(0, 0, 0, 0.5);
    border-bottom: 1px solid rgba(0, 0, 0, 0.3);
    padding: 20px 0;
}
.font-weight-bold {
    font-weight: 700;
    text-transform: uppercase;
    padding: 20px 0;
}
.repeater__task {
    width: 40%;
}
.repeater__hours {
    width: 10%;
}
.repeater__rate,
.repeater__total {
    width: 25%;
}
.repeater__title {
    font-size: 16px;
    margin-bottom: 5px;
}
.repeater__total {
    text-align: right;
}
.total {
    text-align: right;
    padding: 25px 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.3);
}
.total__subtitle {
    text-transform: uppercase;
    margin-bottom: 5px;
}
.total__cost {
    font-size: 24px;
}
.signature {
    padding: 25px 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.3);
}
.signature__sign {
    font-size: 25px;
    font-weight: 700;
    margin-bottom: 10px;
}
.signature__name {
    font-weight: 700;
}

</style>

<?php


