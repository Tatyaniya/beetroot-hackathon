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

$header = get_field( "invoice_header" );
$ajax_args = array(
    'acf_filed' => 'invoice_header',
    'acf_content'   => ''
);
$str       = json_encode( $ajax_args );

?>
  <section class="invoice" style="<?= $section_style; ?>">
    <div class="doctype">invoice</div>

    <?php
        $header = get_field( "invoice_header" );
        if ( $header ) :?>
            <div class="invoice__header"  data-query-vars='<?php echo $str; ?>'
            contenteditable="true"><?php echo $header; ?></div>
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
                        <p class="invoice__sign" >invoice id</p>
                        <p class="invoice__data" contenteditable="true"><?php echo $invoice_id; ?></p>
                    </div>
                <?php endif; ?>

        </div>
        <div class="invoice__item">
            <?php
                $invoice_prepared_for = get_field( "invoice_prepared_for" );
                if ( $invoice_prepared_for ) :?>
                    <div class="invoice__left">
                        <div class="invoice__sign">prepared for</div>
                        <div class="invoice__data popap"><?php echo $invoice_prepared_for; ?></div>
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
                <div class="repeater__row__title">
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
                                    <span class="repeater__hours" contenteditable="true"><?php echo $hours; ?></span>
                            <?php endif; ?>
                            <?php
                                $rate_per_hour= get_sub_field( "rate_per_hour" );
                                if ( $rate_per_hour) :?>
                                    <span class="repeater__rate">$<?php echo $rate_per_hour; ?></span>
                            <?php endif; ?>
                            <div class="repeater__total">$0</div>
                        </div>

                    <?php endwhile; ?>
                <?php endif; ?>
                
            </div>
            <div class="total">
                <div class="total__subtitle">
                    total
                </div>
                <div class="total__cost">
                    $0
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

<?php


