<?php
/*
 * Note:
 * 'name' is the "name" property of the input field / list
 * 'id' is the "id" property of the input field / list AND the "for" property of the label field
 * 'name' and 'id' dont have to be the same - but it is most logical
 */
$this->load->library('session');
$MAX_INPUT_LENGTHS = $this->config->item('$MAX_INPUT_LENGTHS', 'pm');
$recipients = array(
    'name' => PM_RECIPIENTS,
    'id' => PM_RECIPIENTS,
    'value' => set_value(PM_RECIPIENTS, $message[PM_RECIPIENTS]),
    'maxlength' => $MAX_INPUT_LENGTHS[PM_RECIPIENTS],
    'size' => 40,
    'class' => 'form-control'
);
$subject = array(
    'name' => TF_PM_SUBJECT,
    'id' => TF_PM_SUBJECT,
    'value' => set_value(TF_PM_SUBJECT, $message[TF_PM_SUBJECT]),
    'maxlength' => $MAX_INPUT_LENGTHS[TF_PM_SUBJECT],
    'size' => 40,
    'class' => 'form-control'
);
$body = array(
    'name' => TF_PM_BODY,
    'id' => TF_PM_BODY,
    'value' => set_value(TF_PM_BODY, $message[TF_PM_BODY]),
    'cols' => 80,
    'rows' => 5,
    'class' => 'form-control'
);
?>
<div class="container">
    <?php echo form_open($this->uri->uri_string()); ?>
    <div class="form-group row">
        <div class="col-sm-1"><?php echo form_label('To', $recipients['id']); ?></div>
        <div class="col-sm-4">
            <?php echo form_input($recipients); ?>
            <?php echo form_error($recipients['name']); ?>
        </div>
    </div>	
    <div class="form-group row">
        <div class="col-sm-1"><?php echo form_label('Subject', $subject['id']); ?></div>
        <div class="col-sm-6">
            <?php echo form_input($subject); ?>
            <?php echo form_error($subject['name']); ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-1"><?php echo form_label('Message', $body['id']); ?></div>
        <div class="col-sm-11">
            <?php echo form_textarea($body); ?>
            <?php echo form_error($body['name']); ?>
        </div>
    </div>
    <div class="form-group row">
        <button type="submit" class="btn btn-primary mx-auto" name="btnSend">Send</button>
    </div>
    <tr>
        <td align="left" valign="top" style="font-weight:bold; background:#F2F2F2; padding:4px;">
        </td>
        <td align="left" valign="top" style="font-weight:bold; background:#F2F2F2; padding:4px;">
            <?php
            if (isset($status))
                echo $status . ' ';
            if ($this->session->flashdata('status'))
                echo $this->session->flashdata('status') . ' ';
            if (!$found_recipients) {
                foreach ($suggestions as $original => $suggestion) {
                    echo 'Did you mean <font color="#00CC00">' . $suggestion . '</font> for <font color="#CC0000">' . $original . '</font> ?';
                    echo '<br />';
                }
            }
            ?>
        </td>
        <td></td>
    </tr>
    <?php echo form_close(); ?>
</div>