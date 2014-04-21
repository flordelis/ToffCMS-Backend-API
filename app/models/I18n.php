<?php

class I18n extends Eloquent {

	protected $table = 'i18n';
	protected $hidden = array('updated_at', 'language', 'id');

}
