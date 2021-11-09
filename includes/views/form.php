<div class="cbxcf-form" id="cbxcf-form">
    <div id="feedback"></div>
    <form action="" method="post">

        <div class="form-row">
            <label for="title"><?php _e( 'Title', 'cbxcustomform' ); ?></label>

            <input type="text" id="title" name="title" value="" required >
        </div>

        <div class="form-row">
            <label for="description"><?php _e( 'Description', 'cbxcustomform' ); ?></label>

            <textarea name="description" id="description" required></textarea>
        </div>
        <div class="form-row">
            <label for="singer"><?php _e( 'Favourite Singer', 'cbxcustomform' ); ?></label>

            <input type="text" id="singer" name="singer" value="" required >
        </div>

        <div class="form-row">

            <?php wp_nonce_field( 'cbxcf-form-nonce' ); ?>

            <input type="hidden" name="action" value="cbxcf_form">
            <input type="submit" name="cbxcf_submit" value="<?php esc_attr_e( 'Submit', 'cbxcustomform' ); ?>">
        </div>

    </form>
</div>
