<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label class="control-label" for="input-email"><?php echo $entry_email; ?></label>
					<input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
				</div>
				<div class="form-group">
					<label class="control-label" for="input-password"><?php echo $entry_password; ?></label>
					<input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
				</div>
				<div class="form-group">
					<div class="col-sm-12 confirmation">
				<label>
					<input name="confirm" value="yes" type="checkbox"><?php echo $text_remember; ?>
				</label>
					<a href="<?php echo $forgotten; ?>" class="colorLink subHeadingText icon-wrap pull-right"><?php echo $text_forgotten; ?></a>
					</div>
				</div>
				<div class="buttons">
					<input type="submit" value="<?php echo $button_login; ?>" class="btn btn-primary btnus" />
					<?php if ($redirect) { ?>
					<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
					<?php } ?>
				</div>
				<p><?php echo $text_donot; ?> <a href="<?php echo $register; ?>"><?php echo $text_register; ?></a></p>
            </form>

