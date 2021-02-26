<?php
/**
 * Block Name: Invoice
 * Category: layout
 *
 * @var array $block
 */


$main_id = get_option( 'page_on_front' );

$slug     = str_replace( 'acf/', '', $block['name'] );
$block_id = $slug . '-' . $block['id'];

$bg_color      = get_field( "invoice_background_color" );
$section_style = '';
if ( $bg_color ) {
    $section_style .= "background-color:" . $bg_color;
}
?>

  <div class="buttons">
    <button type="button" id="download-invoice">Download as PDF</button>
    <button type="button" id="print-invoice" onClick="window.print()">Print this Page</button>
  </div>

  <section id="invoice" class="invoice" style="<?= $section_style; ?>">
    <div class="doctype">invoice</div>

      <?php
      $header        = get_field( "invoice_header", $main_id );
      if ( $header ) :
          $selector = "invoice_header";
          $field_obj = get_field_object( $selector, $main_id );
          $ajax_args = array(
              'acf_field'      => $field_obj["key"],
              'acf_field_type' => 'field',
              'acf_content'    => ''
          );
          $str       = json_encode( $ajax_args );
          ?>
        <div
          class="invoice__header"
          contenteditable="true" data-query-vars='<?php echo $str; ?>'><?php echo $header; ?></div>
      <?php endif; ?>

    <div class="invoice__content">
        <div class="invoice__item">
            <?php
            $invoice_due_date = get_field( "invoice_due_date" );
            if ( $invoice_due_date ) :
                $selector = "invoice_due_date";
                $field_obj    = get_field_object( $selector );
                $ajax_args    = array(
                    'acf_field'      => $field_obj["key"],
                    'acf_field_type' => 'field',
                    'acf_content'    => ''
                );
                $str          = json_encode( $ajax_args );
                ?>
              <div class="invoice__left">
                        <p class="invoice__sign">due data</p>
                        <p
                          class="invoice__data" contenteditable="true"
                          data-query-vars='<?php echo $str; ?>'><?php echo $invoice_due_date; ?></p>
                    </div>
            <?php endif; ?>

            <?php
            $invoice_id    = get_field( "invoice_id", $main_id );
            if ( $invoice_id ) :
                $selector = "invoice_id";
                $field_obj = get_field_object( $selector, $main_id );
                $ajax_args = array(
                    'acf_field'      => $field_obj["key"],
                    'acf_field_type' => 'field',
                    'acf_content'    => ''
                );
                $str       = json_encode( $ajax_args );
                ?>
              <div class="invoice__right">
                        <p class="invoice__sign">invoice id </p>
                        <p
                          class="invoice__data" contenteditable="true"
                          data-query-vars='<?php echo $str; ?>'><?php echo $invoice_id; ?></p>
                    </div>
            <?php endif; ?>

        </div>
        <div class="invoice__item">
            <?php
            $invoice_prepared_for = get_field( "invoice_prepared_for", $main_id );
            if ( $invoice_prepared_for ) :
                $selector = "invoice_prepared_for";
                $field_obj        = get_field_object( $selector, $main_id );
                $ajax_args        = array(
                    'acf_field'      => $field_obj["key"],
                    'acf_field_type' => 'field',
                    'acf_content'    => ''
                );
                $str              = json_encode( $ajax_args );
                ?>
              <div class="invoice__left">
                        <div class="invoice__sign">prepared for</div>
                        <div
                          class="invoice__data" contenteditable="true"
                          data-query-vars='<?php echo $str; ?>'><?php echo $invoice_prepared_for; ?></div>
                    </div>
            <?php endif; ?>
            <?php
            $invoice_project = get_field( "invoice_project", $main_id );
            if ( $invoice_project ) :
                $selector = "invoice_project";
                $field_obj   = get_field_object( $selector );
                $ajax_args   = array(
                    'acf_field'      => $field_obj["key"],
                    'acf_field_type' => 'field',
                    'acf_content'    => ''
                );
                $str         = json_encode( $ajax_args );
                ?>
              <div class="invoice__right">
                        <div class="invoice__sign">project</div>
                        <p
                          class="invoice__project" contenteditable="true"
                          data-query-vars='<?php echo $str; ?>'><?php echo $invoice_project; ?></p>
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
                                $task_title    = get_sub_field( "task_title", $main_id );
                                if ( $task_title ) :
                                    $selector = "task_title";
                                    $field_obj = get_sub_field_object( $selector );
                                    $ajax_args = array(
                                        'acf_field'      => $field_obj["key"],
                                        'acf_field_type' => 'sub_field',
                                        'acf_content'    => ''
                                    );
                                    $str       = json_encode( $ajax_args );
                                    ?>
                                  <h4
                                    class="repeater__title" contenteditable="true"
                                    data-query-vars='<?php echo $str; ?>'><?php echo $task_title; ?></h4>
                                <?php endif; ?>
                                <?php
                                $task_description = get_sub_field( "task_description", $main_id );
                                if ( $task_description ) :
                                    $selector = "task_description";
                                    $field_obj    = get_sub_field_object( $selector );
                                    $ajax_args    = array(
                                        'acf_field'      => $field_obj["key"],
                                        'acf_field_type' => 'sub_field',
                                        'acf_content'    => ''
                                    );
                                    $str          = json_encode( $ajax_args );
                                    ?>
                                  <div
                                    class="repeater__desc" contenteditable="true"
                                    data-query-vars='<?php echo $str; ?>'><?php echo $task_description; ?></div>
                                <?php endif; ?>
                            </div>
                        <?php
                        $hours         = get_sub_field( "hours" );
                        if ( $hours ) :
                            $selector = "hours";
                            $field_obj = get_sub_field_object( $selector );
                            $ajax_args = array(
                                'acf_field'      => $field_obj["key"],
                                'acf_field_type' => 'sub_field',
                                'acf_content'    => ''
                            );
                            $str       = json_encode( $ajax_args );
                            ?>
                          <span
                            class="repeater__hours" contenteditable="true"
                            data-query-vars='<?php echo $str; ?>'><?php echo $hours; ?></span>
                        <?php endif; ?>
                        <?php
                        $rate_per_hour = get_sub_field( "rate_per_hour" );
                        if ( $rate_per_hour ) :
                            $selector = "rate_per_hour";
                            $field_obj = get_sub_field_object( $selector );
                            $ajax_args = array(
                                'acf_field'      => $field_obj["key"],
                                'acf_field_type' => 'sub_field',
                                'acf_content'    => ''
                            );
                            $str       = json_encode( $ajax_args );
                            ?>
                          <span
                            class="repeater__rate" contenteditable="true"
                            data-query-vars='<?php echo $str; ?>'>$<?php echo $rate_per_hour; ?></span>
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
            $invoice_signature = get_field( "invoice_signature", $main_id );
            if ( $invoice_signature ) :
                $selector = "invoice_signature";
                $field_obj     = get_field_object( $selector );
                $ajax_args     = array(
                    'acf_field'      => $field_obj["key"],
                    'acf_field_type' => 'field',
                    'acf_content'    => ''
                );
                $str           = json_encode( $ajax_args );
                ?>
              <div
                class="invoice__signature" contenteditable="true"
                data-query-vars='<?php echo $str; ?>'><?php echo $invoice_signature; ?></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php


