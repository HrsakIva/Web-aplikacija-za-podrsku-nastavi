<?php

class IndexController extends BaseController{
	public function index() {
		$this->registry->template->title = 'Računarci';
		$this->registry->template->show( 'home' );
	}
};

?>
