<?php $cfg = array(
    'title'         => $this->lang['mod']['page']['upgrade'] . ' &raquo; ' . $this->lang['mod']['page']['admin'],
    'sub_title'     => $this->lang['mod']['page']['admin'],
    'mod_help'      => 'upgrade',
    'act_help'      => 'admin',
    'pathInclude'   => BG_PATH_TPLSYS . 'install' . DS . 'default' . DS . 'include' . DS,
);

include($cfg['pathInclude'] . 'upgrade_head.php'); ?>

    <form name="upgrade_form_admin" id="upgrade_form_admin" autocomplete="off">
        <input type="hidden" name="<?php echo $this->common['tokenRow']['name_session']; ?>" value="<?php echo $this->common['tokenRow']['token']; ?>">
        <input type="hidden" name="a" value="admin">
        <input type="hidden" name="admin_status" value="enable">
        <input type="hidden" name="admin_type" value="super">

        <div class="card-body">
            <div class="alert alert-warning">
                <span class="oi oi-warning"></span>
                <?php echo $this->lang['mod']['text']['admin']; ?>
            </div>

            <div class="mb-3">
                <a href="<?php echo BG_URL_INSTALL; ?>index.php?m=upgrade&a=auth" class="btn btn-info"><?php echo $this->lang['mod']['href']['auth']; ?></a>
            </div>

            <div class="form-group">
                <label><?php echo $this->lang['mod']['label']['username']; ?> <span class="text-danger">*</span></label>
                <input type="text" name="admin_name" id="admin_name" data-validate class="form-control">
                <small class="form-text" id="msg_admin_name"></small>
            </div>

            <div class="form-group">
                <label><?php echo $this->lang['mod']['label']['password']; ?> <span class="text-danger">*</span></label>
                <input type="password" name="admin_pass" id="admin_pass" data-validate class="form-control">
                <small class="form-text" id="msg_admin_pass"></small>
            </div>

            <div class="form-group">
                <label><?php echo $this->lang['mod']['label']['passConfirm']; ?> <span class="text-danger">*</span></label>
                <input type="password" name="admin_pass_confirm" id="admin_pass_confirm" data-validate class="form-control">
                <small class="form-text" id="msg_admin_pass_confirm"></small>
            </div>

            <div class="form-group">
                <label><?php echo $this->lang['mod']['label']['mail']; ?></label>
                <input type="text" name="admin_mail" id="admin_mail" data-validate class="form-control">
                <small class="form-text" id="msg_admin_mail"></small>
            </div>

            <div class="form-group">
                <label><?php echo $this->lang['mod']['label']['nick']; ?></label>
                <input type="text" name="admin_nick" id="admin_nick" data-validate class="form-control">
                <small class="form-text" id="msg_admin_nick"></small>
            </div>

            <div class="bg-submit-box"></div>
            <div class="bg-validator-box mt-3"></div>
        </div>

        <div class="card-footer">
            <div class="btn-toolbar justify-content-between">
                <div class="btn-group">
                    <a href="<?php echo BG_URL_INSTALL; ?>index.php?m=upgrade&a=sso" class="btn btn-outline-secondary"><?php echo $this->lang['mod']['btn']['prev']; ?></a>
                    <?php include($cfg['pathInclude'] . 'upgrade_drop.php'); ?>
                    <a href="<?php echo BG_URL_INSTALL; ?>index.php?m=upgrade&a=over" class="btn btn-secondary"><?php echo $this->lang['mod']['btn']['skip']; ?></a>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary bg-submit"><?php echo $this->lang['mod']['btn']['save']; ?></button>
                </div>
            </div>
        </div>
    </form>

<?php include($cfg['pathInclude'] . 'install_foot.php'); ?>

    <script type="text/javascript">
    var opts_validator_form = {
        admin_name: {
            len: { min: 1, max: 30 },
            validate: { type: "ajax", format: "strDigit" },
            msg: { too_short: "<?php echo $this->lang['rcode']['x010201']; ?>", too_long: "<?php echo $this->lang['rcode']['x010202']; ?>", format_err: "<?php echo $this->lang['rcode']['x010203']; ?>", ajaxIng: "<?php echo $this->lang['rcode']['x030401']; ?>", ajax_err: "<?php echo $this->lang['rcode']['x030402']; ?>" },
            ajax: { url: "<?php echo BG_URL_INSTALL; ?>request.php?m=upgrade&a=chkname", key: 'admin_name', type: "str" }
        },
        admin_pass: {
            len: { min: 1, max: 0 },
            validate: { type: "str", format: "text" },
            msg: { too_short: "<?php echo $this->lang['rcode']['x010212']; ?>" }
        },
        admin_pass_confirm: {
            len: { min: 1, max: 0 },
            validate: { type: "confirm", target: "#admin_pass" },
            msg: { too_short: "<?php echo $this->lang['rcode']['x010224']; ?>", not_match: "<?php echo $this->lang['rcode']['x010225']; ?>" }
        },
        admin_mail: {
            len: { min: 0, max: 300 },
            validate: { type: "str", format: "email" },
            msg: { too_long: "<?php echo $this->lang['rcode']['x010207']; ?>", format_err: "<?php echo $this->lang['rcode']['x010208']; ?>" }
        },
        admin_nick: {
            len: { min: 0, max: 30 },
            validate: { type: "str", format: "text" },
            msg: { too_long: "<?php echo $this->lang['rcode']['x020216']; ?>" }
        }
    };

    var options_validator_form = {
        msg_global:{
            msg: "<?php echo $this->lang['common']['label']['errInput']; ?>"
        }
    };

    var opts_submit_form = {
        ajax_url: "<?php echo BG_URL_INSTALL; ?>index.php?m=upgrade&c=request",
        msg_text: {
            submitting: "<?php echo $this->lang['common']['label']['submitting']; ?>"
        },
        jump: {
            url: "<?php echo BG_URL_INSTALL; ?>index.php?m=upgrade&a=over",
            text: "<?php echo $this->lang['mod']['href']['jumping']; ?>"
        }
    };

    $(document).ready(function(){
        var obj_validator_form    = $("#upgrade_form_admin").baigoValidator(opts_validator_form, options_validator_form);
        var obj_submit_form       = $("#upgrade_form_admin").baigoSubmit(opts_submit_form);
        $(".bg-submit").click(function(){
            if (obj_validator_form.verify()) {
                obj_submit_form.formSubmit();
            }
        });
    });
    </script>

<?php include($cfg['pathInclude'] . 'html_foot.php');